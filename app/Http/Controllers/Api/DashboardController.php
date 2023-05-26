<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function statistics()
    {






        $users = User::query()
            ->active()
            ->get();
        $activeClients = $users->filter(function ($item) {
            return $item->role->value == 'client';
        })->count();

        $activeEmployees = $users->filter(function ($item) {
            return $item->role->value == 'employee';
        })->count();

        $totalOrders = Order::count();

        $monthlyOrders = $this->generateMonthlyOrders();

        return response()->json([
            'months' => $monthlyOrders['months'],
            'monthlyOrders' => $monthlyOrders['monthlyOrders'],
            'activeEmployees' => $activeEmployees,
            'activeClients' => $activeClients,
            'totalOrders' => $totalOrders,
        ]);

    }

    public function generateMonthlyOrders()
    {
        $months = [];
        $monthlyOrders = [];
        for ($i = 0; $i <= 11; ++$i) {
            $months[$i] = date('F', mktime(0, 0, 0, $i + 1, 1));
            $monthlyOrders[$i] = Order::query()
                ->when(auth()->user()->isRoleEmployee(), function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                // ->where('status', 'settled')
                ->whereMonth('created_at', $i + 1)
                ->whereYear('created_at', date('Y'))
                ->count();
        }

        return [
            'months' => $months,
            'monthlyOrders' => $monthlyOrders,
        ];
    }

}
