<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ElectricityBill;
use App\Models\House;
use App\Models\HouseBill;
use App\Models\Penalty;
use App\Models\Tenant;
use App\Models\WaterBill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillUserController extends Controller
{
    public function index(Request $request)
    {
        $currentUserId = auth()->user()->user_id;

        $tenants = Tenant::where('is_delete', 0)
            ->where('user_id', $currentUserId)
            ->get();

        $houseIds = $tenants->pluck('house_id')->all();

        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);

        $startDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->endOfMonth();

        $waterBillsQuery = WaterBill::whereIn('house_id', $houseIds)
            ->whereBetween('billing_date', [$startDate, $endDate]);
        $waterBills = $waterBillsQuery->get();

        $electricityBillsQuery = ElectricityBill::whereIn('house_id', $houseIds)
            ->whereBetween('billing_date', [$startDate, $endDate]);
        $electricityBills = $electricityBillsQuery->get();

        $houseBillsQuery = HouseBill::whereIn('house_id', $houseIds)
            ->whereBetween('billing_date', [$startDate, $endDate]);
        $houseBills = $houseBillsQuery->get();

        $houses = House::whereIn('house_id', $houseIds)->pluck('name', 'house_id');

        foreach ($waterBills as $waterBill) {
            $waterBill->house_name = $houses->get($waterBill->house_id);
        }

        foreach ($electricityBills as $electricityBill) {
            $electricityBill->house_name = $houses->get($electricityBill->house_id);
        }

        foreach ($houseBills as $houseBill) {
            $houseBill->house_name = $houses->get($houseBill->house_id);
        }

        $totalWaterAmount = $waterBills->where('status', 0)->sum('amount');
        $totalElectricityAmount = $electricityBills->where('status', 0)->sum('amount');
        $totalHouseAmount = $houseBills->where('status', 0)->sum('amount');
        $totalAmount = $totalWaterAmount + $totalElectricityAmount + $totalHouseAmount;

        return view('user.bills_list', compact(
            'waterBills',
            'electricityBills',
            'houseBills',
            'selectedMonth',
            'selectedYear',
            'totalWaterAmount',
            'totalElectricityAmount',
            'totalHouseAmount',
            'totalAmount'
        ));
    }




    public function showPenalties(Request $request)
    {
        $user = auth()->user();
        $tenant = Tenant::where('user_id', $user->user_id)->first();
        $house_id = $tenant ? $tenant->house_id : null;

        $penaltiesQuery = Penalty::where('house_id', $house_id);

        $currentDate = Carbon::now();
        $selectedMonth = $request->input('month', $currentDate->month);
        $selectedYear = $request->input('year', $currentDate->year);

        $penaltiesQuery->whereYear('penalty_date', $selectedYear)
            ->whereMonth('penalty_date', $selectedMonth);

        $penalties = $penaltiesQuery->get();

        $totalPenaltyAmount = $penalties->where('status', 0)->sum('amount');

        return view('user.penalties_list', compact('penalties', 'totalPenaltyAmount', 'selectedMonth', 'selectedYear'));
    }




}
