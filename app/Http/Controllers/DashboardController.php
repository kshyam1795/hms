<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Deposit;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Doctor;



class DashboardController extends Controller
{
    
    
    public function superadmin(Request $request)
    {
        // Default date range: last 7 days if no start_date and end_date provided
        $startDate = $request->input('start_date', now()->subDays(7)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        // Filter data for appointments
        $appointments = Appointment::with(['doctor', 'patient'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Check if appointments exist, if not fetch all appointments
        if ($appointments->isEmpty()) {
            $appointments = Appointment::with(['doctor', 'patient'])->get();
            $startDate = null; // Indicate no date range filter was applied
            $endDate = null;
        }

        // Total collection from deposits
        $totalCollection = Deposit::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        if ($totalCollection == 0) {
            $totalCollection = Deposit::sum('amount'); // Fallback to total collection
        }

        // Pending payments from the billing table
        $pendingPayments = Billing::where('balance_amount', '>', 0)
            ->whereDoesntHave('deposits')
            ->get();

        // Appointments grouped by doctor
        $appointmentsByDoctor = $appointments->groupBy('doctor_id')->map(function ($group) {
            return [
                'doctor_name' => optional($group->first()->doctor)->name,
                'appointment_count' => $group->count(),
            ];
        });

        // Chart data
        $chartData = [
            'dates' => collect($appointments)->groupBy(function ($appointment) {
                return $appointment->created_at->format('Y-m-d');
            })->map->count()->toArray(),
        ];

        return view('dashboards.superadmin', compact(
            'totalCollection',
            'pendingPayments',
            'appointmentsByDoctor',
            'chartData',
            'startDate',
            'appointments',
            'endDate'
        ));
    }


    public function patient()
    {
        return view('dashboards.patient');
    }

    public function doctor()
    {
        return view('dashboards.doctor');
    }

    public function receptionist()
    {
        //$patients = Patient::with('appointments', 'bills')->get();
        $doctors = Doctor::all();
        return view('dashboards.receptionist', compact('doctors'));
    }

    public function lab()
    {
        return view('dashboards.lab');
    } 
    public function webadmin()
    {
        $postsCount = BlogPost::count();
        $categoriesCount = Category::count();
        // $pagesCount = StaticPage::count(); // Uncomment if StaticPage is used

        return view('dashboards.webadmin', compact('postsCount', 'categoriesCount'));
        
    }

    
}
