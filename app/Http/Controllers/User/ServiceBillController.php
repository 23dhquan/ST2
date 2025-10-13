<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\HouseService;
use App\Models\Service;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceBillController extends Controller
{
    public function index()
    {

        $currentUserId = auth()->user()->user_id;
        $houseId = Tenant::where('user_id', $currentUserId)->first()->house_id;


        $services = Service::all();


        $registeredServices = HouseService::where('house_id', $houseId)->get();
        Log::info($registeredServices);
        foreach ($registeredServices as $service) {
            $service->service_name = Service::find($service->service_id)->name;
            $service->service_price =Service::find($service->service_id)->price;
        }
        // Trả về view với dữ liệu
        return view('user.service', compact('services', 'registeredServices'));
    }


    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'description' => 'nullable|string|max:255',
        ]);

        $currentUserId = auth()->user()->user_id;
        $houseId = Tenant::where('user_id', $currentUserId)->first()->house_id;

        HouseService::create([
            'house_id' => $houseId,
            'service_id' => $validatedData['service_id'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('services.index')->with('success', 'Đăng ký dịch vụ thành công!');
    }
}
