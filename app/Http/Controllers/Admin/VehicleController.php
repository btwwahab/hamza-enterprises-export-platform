<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    use ExportsCsv;

    protected function filteredQuery(Request $request)
    {
        return Vehicle::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q');
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('vin_no', 'like', "%{$q}%")
                        ->orWhere('item_no', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('maker'), fn ($query) => $query->where('maker', $request->string('maker')))
            ->when($request->filled('body'), fn ($query) => $query->where('body', $request->string('body')))
            ->when($request->filled('fuel'), fn ($query) => $query->where('fuel', $request->string('fuel')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')));
    }

    public function index(Request $request)
    {
        $vehicles = $this->filteredQuery($request)
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $makers = Vehicle::query()->select('maker')->distinct()->orderBy('maker')->pluck('maker');

        $stats = [
            'total' => Vehicle::count(),
            'available' => Vehicle::where('status', 'Available')->count(),
            'reserved' => Vehicle::where('status', 'Reserved')->count(),
            'sold' => Vehicle::where('status', 'Sold')->count(),
        ];

        return view('admin.vehicles', compact('vehicles', 'makers', 'stats'));
    }

    public function form(Request $request)
    {
        $vehicle = $request->filled('id')
            ? Vehicle::findOrFail($request->integer('id'))
            : null;

        return view('admin.vehicles-form', compact('vehicle'));
    }

    public function store(VehicleRequest $request)
    {
        $data = $request->validated();
        $data['code'] = Vehicle::nextCode();
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('images')) {
            $paths = $this->storeImages($request);
            $data['images'] = $paths;
            $data['image'] = $paths[0];
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles')->with('status', 'Vehicle added successfully.');
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $data = $request->validated();
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('images')) {
            $paths = $this->storeImages($request);
            $data['images'] = $paths;
            $data['image'] = $paths[0];
        }

        $vehicle->update($data);

        return redirect()->route('admin.vehicles')->with('status', 'Vehicle updated successfully.');
    }

    protected function storeImages(VehicleRequest $request): array
    {
        return collect($request->file('images'))
            ->map(fn ($file) => '/storage/' . $file->store('vehicles', 'public'))
            ->all();
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles')->with('status', 'Vehicle deleted.');
    }

    public function export(Request $request)
    {
        $vehicles = $this->filteredQuery($request)->orderByDesc('id')->get();

        $headers = [
            'Code', 'Name', 'Maker', 'Model', 'Year', 'Price (USD)', 'Mileage (km)',
            'Fuel', 'Transmission', 'Body', 'Location', 'Item No', 'VIN No',
            'Engine', 'Drive', 'Seats', 'Status', 'Created At',
        ];

        $rows = $vehicles->map(fn (Vehicle $v) => [
            $v->code, $v->name, $v->maker, $v->model, $v->year, $v->price, $v->mileage,
            $v->fuel, $v->transmission, $v->body, $v->location, $v->item_no, $v->vin_no,
            $v->engine, $v->drive, $v->seats, $v->status, optional($v->created_at)->format('Y-m-d'),
        ]);

        return $this->csvDownload('vehicles-report-' . now()->format('Y-m-d') . '.csv', $headers, $rows);
    }
}
