<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ExportsCsv;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MachineryRequest;
use App\Models\Machinery;
use Illuminate\Http\Request;

class MachineryController extends Controller
{
    use ExportsCsv;

    protected function filteredQuery(Request $request)
    {
        return Machinery::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q');
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('serial_no', 'like', "%{$q}%")
                        ->orWhere('item_no', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('maker'), fn ($query) => $query->where('maker', $request->string('maker')))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->when($request->filled('fuel'), fn ($query) => $query->where('fuel', $request->string('fuel')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')));
    }

    public function index(Request $request)
    {
        $machines = $this->filteredQuery($request)
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $makers = Machinery::query()->select('maker')->distinct()->orderBy('maker')->pluck('maker');

        $stats = [
            'total' => Machinery::count(),
            'available' => Machinery::where('status', 'Available')->count(),
            'reserved' => Machinery::where('status', 'Reserved')->count(),
            'sold' => Machinery::where('status', 'Sold')->count(),
        ];

        return view('admin.machinery', compact('machines', 'makers', 'stats'));
    }

    public function form(Request $request)
    {
        $machine = $request->filled('id')
            ? Machinery::findOrFail($request->integer('id'))
            : null;

        return view('admin.machinery-form', compact('machine'));
    }

    public function store(MachineryRequest $request)
    {
        $data = $request->validated();
        $data['code'] = Machinery::nextCode();

        if ($request->hasFile('images')) {
            $paths = $this->storeImages($request);
            $data['images'] = $paths;
            $data['image'] = $paths[0];
        }

        Machinery::create($data);

        return redirect()->route('admin.machinery')->with('status', 'Machinery added successfully.');
    }

    public function update(MachineryRequest $request, Machinery $machinery)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $paths = $this->storeImages($request);
            $data['images'] = $paths;
            $data['image'] = $paths[0];
        }

        $machinery->update($data);

        return redirect()->route('admin.machinery')->with('status', 'Machinery updated successfully.');
    }

    protected function storeImages(MachineryRequest $request): array
    {
        return collect($request->file('images'))
            ->map(fn ($file) => '/storage/' . $file->store('machinery', 'public'))
            ->all();
    }

    public function destroy(Machinery $machinery)
    {
        $machinery->delete();

        return redirect()->route('admin.machinery')->with('status', 'Machinery deleted.');
    }

    public function export(Request $request)
    {
        $machines = $this->filteredQuery($request)->orderByDesc('id')->get();

        $headers = [
            'Code', 'Name', 'Maker', 'Model', 'Category', 'Year', 'Price (USD)', 'Hours',
            'Fuel', 'Capacity', 'Location', 'Item No', 'Serial No', 'Engine', 'Status', 'Created At',
        ];

        $rows = $machines->map(fn (Machinery $m) => [
            $m->code, $m->name, $m->maker, $m->model, $m->category, $m->year, $m->price, $m->hours,
            $m->fuel, $m->capacity, $m->location, $m->item_no, $m->serial_no, $m->engine,
            $m->status, optional($m->created_at)->format('Y-m-d'),
        ]);

        return $this->csvDownload('machinery-report-' . now()->format('Y-m-d') . '.csv', $headers, $rows);
    }
}
