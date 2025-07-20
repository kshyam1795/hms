<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Billing;
use App\Models\Doctor;
use App\Models\Deposit;
use App\Models\Patient;
use App\Models\Visit;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }
    public function index()
    {
        return view('reports.index');
    }

    

    public function generate(Request $request)
    {
        $reportType = $request->input('report_type');
        // Example: Generate a report based on the type
        if ($reportType == 'appointments') {
            $data = Appointment::all();
        }
        // Add other report types as needed

        return view('reports.show', compact('data'));
    }

    public function receIndex(Request $request)
    {
        // Filter parameters
        $filterType = $request->input('filterType', 'all'); // Default is 'all'
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $doctorName = $request->input('doctor_name');

        // Query base
        $appointmentsQuery = Appointment::with('doctor', 'patient','billing');

        // Apply date filters
        if ($filterType === 'custom' && $startDate && $endDate) {
            $appointmentsQuery->whereBetween('appointment_date', [$startDate, $endDate]);
        } elseif ($filterType === 'weekly') {
            $appointmentsQuery->whereBetween('appointment_date', [now()->subWeek(), now()]);
        } elseif ($filterType === 'monthly') {
            $appointmentsQuery->whereBetween('appointment_date', [now()->subMonth(), now()]);
        } elseif ($filterType === '3months') {
            $appointmentsQuery->whereBetween('appointment_date', [now()->subMonths(3), now()]);
        } elseif ($filterType === '6months') {
            $appointmentsQuery->whereBetween('appointment_date', [now()->subMonths(6), now()]);
        } elseif ($filterType === 'yearly') {
            $appointmentsQuery->whereYear('appointment_date', now()->year);
        }

        // Filter by doctor's name
        if ($doctorName) {
            $appointmentsQuery->whereHas('doctor', function ($query) use ($doctorName) {
                $query->where('name', 'like', '%' . $doctorName . '%');
            });
        }

        $appointments = $appointmentsQuery->get();

        // Billing Summary
        $allBillied = Billing::sum('total_amount');
        $allCollected = Billing::sum('paid_amount');
        $allOutstanding = Billing::sum('balance_amount');

        //$billings = Billing::with('patient')->paginate(10);
        $billingGraphData = Billing::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as total, SUM(paid_amount) as collected, SUM(balance_amount) as outstanding')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Appointment Stats by Doctor
        $appointmentStats = $appointments->groupBy('doctor_id')->map(function ($group) {
            return [
                'doctor_name' => $group->first()->doctor->name ?? 'Unknown',
                'total' => $group->count(),
                'booked' => $group->where('status', '2')->count(),
                'arrived' => $group->where('status', '1')->count(),
                'ongoing' => $group->where('status', '3')->count(),
                'reviewed' => $group->where('status', '4')->count(),
            ];
        });

        return view('dashboards.reception-partial.index', compact('allBillied', 'allCollected', 'allOutstanding', 'appointments', 'appointmentStats', 'filterType', 'startDate', 'endDate', 'doctorName', 'billingGraphData'));
    }

    public function billingReport()
    {
        $allBillied = Billing::sum('total_amount');
        $allCollected = Billing::sum('paid_amount');
        $allOutstanding = Billing::sum('balance_amount');

        $data = [
            'allBillied' => $allBillied,
            'allCollected' => $allCollected,
            'allOutstanding' => $allOutstanding,
        ];

        return view('reception-partial.billing', compact('data'));
    }

    public function appointmentsReport()
    {
        $appointments = Appointment::with('doctor', 'patient')->get();

        $report = $appointments->groupBy('doctor_id')->map(function ($group) {
            return [
                'total' => $group->count(),
                'booked' => $group->where('status', 'booked')->count(),
                'arrived' => $group->where('status', 'arrived')->count(),
                'reviewed' => $group->where('status', 'reviewed')->count(),
            ];
        });

        $data = [
            'allAppointments' => $appointments->count(),
            'byDoctor' => $report,
        ];

        return view('reception-partial.appointments', compact('data'));
    }

    public function labReport()
    {
        // Assuming Lab services are identified by a specific service_id range
        $labs = Appointment::whereIn('service_id', [LAB_SERVICE_ID_RANGE])->get();

        $data = [
            'labBillied' => $labs->sum('total_amount'),
            'labCollected' => $labs->sum('paid_amount'),
            'labOutstanding' => $labs->sum('balance_amount'),
        ];

        return view('reception-partial.lab', compact('data'));
    }

    public function othersReport()
    {
        $others = Billing::whereNotIn('service_id', [APPOINTMENT_SERVICE_ID, LAB_SERVICE_ID])->get();

        $data = [
            'othersBillied' => $others->sum('total_amount'),
            'othersCollected' => $others->sum('paid_amount'),
            'othersOutstanding' => $others->sum('balance_amount'),
        ];

        return view('reception-partial.others', compact('data'));
    }

    

//     public function doctorReport(Request $request, $doctorId)
// {
//     // Fetch the authenticated doctor
//     $doctor = auth()->user()->doctor;
    
//     // Ensure the doctorId in the route matches the authenticated user's doctor ID
//     if ($doctor->id !== (int)$doctorId) {
//         return redirect()->back()->with('error', 'You are not authorized to view this report');
//     }

//     // Date filter logic
//     $filter = $request->input('filter', 'all-time');
//     $startDate = Carbon::now();
//     $endDate = Carbon::now();

//     if ($filter === 'last-week') {
//         $startDate = Carbon::now()->subWeek();
//     } elseif ($filter === 'last-month') {
//         $startDate = Carbon::now()->subMonth();
//     } elseif ($filter === 'yearly') {
//         $startDate = Carbon::now()->subYear();
//     } elseif ($filter === 'custom-date') {
//         $startDate = Carbon::parse($request->input('start_date'));
//         $endDate = Carbon::parse($request->input('end_date'));
//     }

//     // Fetch data (appointments, billings, deposits, visits)
//     $appointments = Appointment::where('doctor_id', $doctorId)
//         ->whereBetween('appointment_date', [$startDate, $endDate])
//         ->get();

    // $billings = Billing::whereHas('appointment', function ($query) use ($doctorId) {
    //     $query->where('doctor_id', $doctorId);
    // })
    // ->whereBetween('created_at', [$startDate, $endDate])
    // ->get();

//     $deposits = DB::table('deposits')
//         ->join('billings', 'deposits.billing_id', '=', 'billings.id')
//         ->join('appointments', 'billings.uniquePatientID', '=', 'appointments.uniquePatientID')
//         ->where('appointments.doctor_id', '=', $doctorId)
//         ->whereBetween('deposits.created_at', [$startDate, $endDate])
//         ->select('deposits.*')
//         ->get();

//     $visits = Visit::where('doctor_id', $doctorId)
//         ->whereBetween('created_at', [$startDate, $endDate])
//         ->get();

//     // Calculate counts
//     $completedAppointmentsCount = $appointments->where('status', 'completed')->count();
//     $pendingAppointmentsCount = $appointments->where('status', 'pending')->count();
//     $totalBillAmount = $billings->sum('total_amount');

//     // Group appointments by service
//     $appointmentsByService = $appointments->groupBy('service_id')->map(function ($group) {
//         return $group->count();
//     });

//     return view('dashboards.doctor-partials.reports', compact(
//         'appointments',
//         'billings',
//         'deposits',
//         'visits',
//         'completedAppointmentsCount',
//         'pendingAppointmentsCount',
//         'totalBillAmount',
//         'appointmentsByService',
//         'doctor'
//     ));
// }

    public function doctorReport(Request $request, $doctorId)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now());

        // Appointments within the given date range
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->get();

        // Billings within the given date range
        // $billings = Billing::whereHas('appointments', function($query) use ($doctorId) {
        //     $query->where('doctor_id', $doctorId);
        // })
        // ->whereBetween('created_at', [$startDate, $endDate])
        // ->get();
        $billings = Billing::whereHas('appointment', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

        // Deposits within the given date range
        // $deposits = Deposit::whereHas('bill.appointment', function($query) use ($doctorId) {
        //     $query->where('doctor_id', $doctorId);
        // })
        // ->whereBetween('created_at', [$startDate, $endDate])
        // ->get();

        $deposits = DB::table('deposits')
        ->join('billings', 'deposits.billing_id', '=', 'billings.id')
        ->join('appointments', 'billings.uniquePatientID', '=', 'appointments.uniquePatientID')
        ->where('appointments.doctor_id', '=', $doctorId)
        ->whereBetween('deposits.created_at', [$startDate, $endDate])
        ->select('deposits.*')
        ->get();

        // Patient visits within the given date range
        $visits = Visit::whereHas('patient.appointments', function($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

        // Pending and completed patients
        $pendingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'pending')
            ->count();

        $completedAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'completed')
            ->count();

        $totalBill = Billing::whereHas('appointment', function($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })
        ->whereBetween('created_at', [$startDate, $endDate])
        ->sum('total_amount');

        // Data for the charts
        $appointmentChartData = Appointment::selectRaw('DATE(appointment_date) as date, count(*) as total')
            ->where('doctor_id', $doctorId)
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $billingChartData = Billing::selectRaw('DATE(created_at) as date, sum(total_amount) as total')
            ->whereHas('appointment', function($query) use ($doctorId) {
                $query->where('doctor_id', $doctorId);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        $patientChartData = Visit::selectRaw('DATE(created_at) as date, count(*) as total')
            ->whereHas('patient.appointments', function($query) use ($doctorId) {
                $query->where('doctor_id', $doctorId);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->get();

        return view('dashboards.doctor-partials.reports', compact(
            'appointments', 'billings', 'deposits', 'visits',
            'pendingAppointments', 'completedAppointments', 'totalBill',
            'appointmentChartData', 'billingChartData', 'patientChartData','doctorId'
        ));
    }

    public function paymentMethodReportOLD(Request $request)
    {
        // Filter parameters
        $filterType = $request->input('filterType', 'all'); // Default is 'all'
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Base query for deposits
        $depositsQuery = Deposit::with('bill');

        // Apply date filters
        if ($filterType === 'custom' && $startDate && $endDate) {
            $depositsQuery->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($filterType === 'today') {
            $depositsQuery->whereDate('created_at', Carbon::today());
        } elseif ($filterType === 'weekly') {
            $depositsQuery->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
        } elseif ($filterType === 'monthly') {
            $depositsQuery->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
        } elseif ($filterType === '3months') {
            $depositsQuery->whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()]);
        } elseif ($filterType === '6months') {
            $depositsQuery->whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()]);
        } elseif ($filterType === 'yearly') {
            $depositsQuery->whereYear('created_at', Carbon::now()->year);
        }

        // Get all deposits
        $deposits = $depositsQuery->get();

        // Group deposits by payment mode
        $paymentMethodSummary = $deposits->groupBy('mode')->map(function ($group) {
            return [
                'count' => $group->count(),
                'total_amount' => $group->sum('amount')
            ];
        });

        // Calculate totals
        $totalDeposits = $deposits->count();
        $totalAmount = $deposits->sum('amount');
        $paymentModes = [
            0 => 'CASH',
            1 => 'CARD',
            2 => 'M-WALLET',
            3 => 'CHEQUE',
            4 => 'BANK TRANSFER',
            5 => 'INSURANCE',
        ];

        // Get payment methods for chart
        $paymentMethodChartData = $paymentMethodSummary->map(function ($data, $mode) use ($paymentModes) {
            return [
                'mode' => $paymentModes[$mode] ?: 'Unknown',
                'amount' => $data['total_amount']
            ];
        })->values();

        // Get daily deposit amounts for trend chart
        $dailyDepositTrend = $deposits
            ->groupBy(function ($deposit) {
                return Carbon::parse($deposit->created_at)->format('Y-m-d');
            })
            ->map(function ($group, $date) {
                return [
                    'date' => $date,
                    'amount' => $group->sum('amount')
                ];
            })
            ->values();

        // Get recent deposits for the table
        $recentDeposits = $deposits->sortByDesc('created_at')->take(10);

        return view('dashboards.reception-partial.payment-method-report', compact(
            'paymentMethodSummary',
            'totalDeposits',
            'totalAmount',
            'paymentMethodChartData',
            'dailyDepositTrend',
            'recentDeposits',
            'filterType',
            'startDate',
            'endDate'
        ));
    }

    public function paymentMethodReport(Request $request)
{
    // Filter parameters
    $filterType = $request->input('filterType', 'all'); // Default is 'all'
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Base query for deposits (Eager load bill and patient)
    $depositsQuery = Deposit::with(['bill.patient']);

    // Apply date filters
    if ($filterType === 'custom' && $startDate && $endDate) {
        $depositsQuery->whereBetween('created_at', [$startDate, $endDate]);
    } elseif ($filterType === 'today') {
        $depositsQuery->whereDate('created_at', Carbon::today());
    } elseif ($filterType === 'weekly') {
        $depositsQuery->whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()]);
    } elseif ($filterType === 'monthly') {
        $depositsQuery->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
    } elseif ($filterType === '3months') {
        $depositsQuery->whereBetween('created_at', [Carbon::now()->subMonths(3), Carbon::now()]);
    } elseif ($filterType === '6months') {
        $depositsQuery->whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()]);
    } elseif ($filterType === 'yearly') {
        $depositsQuery->whereYear('created_at', Carbon::now()->year);
    }

    // Get all deposits with eager loaded relationships
    $deposits = $depositsQuery->get();

    // Group deposits by payment mode
    $paymentMethodSummary = $deposits->groupBy('mode')->map(function ($group) {
        return [
            'count' => $group->count(),
            'total_amount' => $group->sum('amount')
        ];
    });

    // Calculate totals
    $totalDeposits = $deposits->count();
    $totalAmount = $deposits->sum('amount');

    $paymentModes = [
        0 => 'CASH',
        1 => 'CARD',
        2 => 'M-WALLET',
        3 => 'CHEQUE',
        4 => 'BANK TRANSFER',
        5 => 'INSURANCE',
    ];

    // Get payment methods for chart
    $paymentMethodChartData = $paymentMethodSummary->map(function ($data, $mode) use ($paymentModes) {
        return [
            'mode' => $paymentModes[$mode] ?? 'Unknown',
            'amount' => $data['total_amount']
        ];
    })->values();

    // Get daily deposit amounts for trend chart
    $dailyDepositTrend = $deposits
        ->groupBy(function ($deposit) {
            return Carbon::parse($deposit->created_at)->format('Y-m-d');
        })
        ->map(function ($group, $date) {
            return [
                'date' => $date,
                'amount' => $group->sum('amount')
            ];
        })
        ->values();

    // Get recent deposits for the table
    $recentDeposits = $deposits->sortByDesc('created_at')->take(10);

    return view('dashboards.reception-partial.payment-method-report', compact(
        'paymentMethodSummary',
        'totalDeposits',
        'totalAmount',
        'paymentMethodChartData',
        'dailyDepositTrend',
        'recentDeposits',
        'filterType',
        'startDate',
        'endDate'
    ));
}



}
