<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Service;
use Session;
use App\Models\Appointment;
use App\Models\AppointmentService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $doctors = Doctor::all();
        return view('dashboards.reception-partial.services', compact('services', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'service-tax' => 'required|numeric',
            'code' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:7',
            'doctor_name' => 'nullable|string',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'price' => $request->price,
            'gst' => $request->{'service-tax'},
            'code' => $request->code,
            'priority' => $request->priority,
            'service_owner' => $request->doctor_name,
        ]);

        return response()->json(['success' => 'Service added successfully', 'service' => $service]);
    }
    public function show($id)
    {
        $service = Service::find($id);
        return response()->json($service);
    }
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'service-tax' => 'required|numeric',
            'code' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:7',
            'doctor_name' => 'nullable|string',
        ]);

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'gst' => $request->{'service-tax'},
            'code' => $request->code,
            'priority' => $request->priority,
            'service_owner' => $request->doctor_name,
        ]);

        return response()->json(['success' => 'Service updated successfully', 'service' => $service]);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['success' => 'Service deleted successfully']);
    }

    public function addServiceBackup_20072025(Request $request)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $service = Service::find($validatedData['service_id']);
        $quantity = $request->input('quantity', 1);
        $totalPrice = $validatedData['price'] * $quantity - $validatedData['discount'];

        // Add your logic to save the service details
       
        Session::put('s_id', $request->input('s_id'));

        return response()->json([
            'success' => true,
            'service' => $service->name,
            'totalPrice' => $totalPrice,
            'discount' => $validatedData['discount'],
            's_id'=> $service->id,
        ]);
    }

    public function addService(Request $request)
    {
        $services = $request->services;

        $savedServices = [];
        $totalAmount = 0;
        $s_id = null;

        foreach ($services as $service) {
            $serviceData = Service::find($service['service_id']);
            $amount = $service['price'] * $service['quantity'];
            $discount = $service['discount'];
            $netAmount = $amount - $discount;

            // Save to DB here...

            $savedServices[] = [
                
                'name' => $serviceData->name,
                'totalPrice' => number_format($netAmount, 2),
                'discount' => $discount,
                'id' => $service['service_id'],
            ];

            $totalAmount += $netAmount;
            $s_id = $service['service_id'];
        }
        
        return response()->json([
            'success' => true,
            'services' => $savedServices,
            'totalPrice' => $totalAmount,
            'depositamount' => $amount,
            's_id' => $s_id,
            'services_id' => $s_id,
        ]);
    }
    public function getAppointmentServices(Request $request)
    {
        $request->validate([
            'uniquePatientID' => 'required|exists:appointments,uniquePatientID',
        ]);
        $appointment = Appointment::where('uniquePatientID', $request->uniquePatientID)->first();
        if (!$appointment) {
            return response()->json(['error' => 'Appointment not found'], 404);
        }

        $appointmentServices = AppointmentService::with('service')
            ->where('appointment_id', $appointment->id)
            ->get();

        $services = $appointmentServices->map(function ($item) {
            return [
                'id' => $item->service->id,
                'name' => $item->service->name,
                'price' => $item->service->price,
                'discount' => $item->service->discount,
            ];
        });
        //dd($services);
        return response()->json([
            'success' => true,
            'services' => $services,
        ]);
    }

}
