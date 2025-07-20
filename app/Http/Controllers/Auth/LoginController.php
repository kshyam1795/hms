<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Role;
use App\Models\Doctor;



class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated()
    {
        $role = Auth::user()->role->name;
        $startDate = now()->subDays(7);
        $endDate = now();    
        $appointments = Appointment::with(['doctor', 'receptionist', 'patient'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();   
         
        switch ($role) {
            case 'superadmin':
                session([
                    'appointments' => $appointments
                ]);
                return redirect()->route('superadmin.dashboard', [
                    'start_date' => $startDate,
                    'end_date' => $endDate                     
                ]);
            
            case 'patient':
                return redirect()->route('patient.dashboard');
            case 'doctor':
                return redirect()->route('doctor.dashboard');
            case 'receptionist':
                $doctors = Doctor::all();
                dd($doctors);
                session([
                    'doctors' => $doctors
                ]);
                return redirect()->route('receptionist.dashboard', [
                    'doctors' => $doctors
                ]);

            case 'lab':
                return redirect()->route('lab.dashboard');
            
            case 'webadmin':
                    $postsCount = BlogPost::count();
                    $categoriesCount = Category::count();
                    return redirect()->url('webadmin/dashboard', [
                        'postsCount' => $postsCount,
                        'categoriesCount' => $categoriesCount
                    ]);
            default:
                return redirect('/');
        }
    }
}
