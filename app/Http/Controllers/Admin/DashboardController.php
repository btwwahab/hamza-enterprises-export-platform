<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Machinery;
use App\Models\Part;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $vehicleStats = [
            'total' => Vehicle::count(),
            'available' => Vehicle::where('status', 'Available')->count(),
            'reserved' => Vehicle::where('status', 'Reserved')->count(),
            'sold' => Vehicle::where('status', 'Sold')->count(),
        ];

        $machineryStats = [
            'total' => Machinery::count(),
            'available' => Machinery::where('status', 'Available')->count(),
        ];

        $partsTotal = Part::count();
        $partsCategories = Part::distinct()->count('category');

        $unreadInquiries = Inquiry::where('status', 'New')->count();
        $totalInquiries = Inquiry::count();
        $recentInquiries = Inquiry::orderByDesc('id')->limit(6)->get();

        $recentVehicles = Vehicle::orderByDesc('id')->limit(6)->get();

        $vehiclesByMaker = Vehicle::selectRaw('maker, count(*) as total')->groupBy('maker')->pluck('total', 'maker');
        $machineryByMaker = Machinery::selectRaw('maker, count(*) as total')->groupBy('maker')->pluck('total', 'maker');

        $combinedByMaker = [];
        foreach ($vehiclesByMaker as $maker => $total) {
            $combinedByMaker[$maker] = ($combinedByMaker[$maker] ?? 0) + $total;
        }
        foreach ($machineryByMaker as $maker => $total) {
            $combinedByMaker[$maker] = ($combinedByMaker[$maker] ?? 0) + $total;
        }

        $stockByMake = collect($combinedByMaker)
            ->map(fn ($total, $maker) => (object) ['maker' => $maker, 'total' => $total])
            ->sortByDesc('total')
            ->take(8)
            ->values();

        return view('admin.dashboard', compact(
            'vehicleStats', 'machineryStats', 'partsTotal', 'partsCategories',
            'unreadInquiries', 'totalInquiries', 'recentInquiries',
            'recentVehicles', 'stockByMake'
        ));
    }
}
