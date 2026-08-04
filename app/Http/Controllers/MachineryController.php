<?php

namespace App\Http\Controllers;

use App\Models\Machinery;
use Illuminate\Http\Request;

class MachineryController extends Controller
{
    /**
     * Columns needed for listing/matching — deliberately excludes the
     * `images` gallery column so bulk queries stay small regardless of
     * how many photos each machine has (up to 15 each).
     */
    protected const LIGHT_COLUMNS = [
        'id', 'code', 'name', 'maker', 'model', 'category', 'year', 'price', 'hours',
        'fuel', 'capacity', 'location',
        'item_no', 'serial_no', 'engine', 'image',
    ];

    protected function toJsShape(Machinery $m, ?array $images = null, ?string $description = null): array
    {
        return [
            'id' => $m->code,
            'name' => $m->name,
            'description' => $description,
            'maker' => $m->maker,
            'model' => $m->model,
            'category' => $m->category,
            'year' => $m->year,
            'price' => $m->price,
            'hours' => $m->hours,
            'fuel' => $m->fuel,
            'capacity' => $m->capacity,
            'location' => $m->location,
            'image' => $m->image,
            'images' => $images,
            'itemNo' => $m->item_no,
            'serialNo' => $m->serial_no,
            'engine' => $m->engine,
        ];
    }

    protected function makerModels($machines): array
    {
        return $machines
            ->groupBy('maker')
            ->map(fn ($group) => $group->pluck('model')->unique()->values())
            ->all();
    }

    public function index()
    {
        $machines = Machinery::where('status', '!=', 'Sold')
            ->orderBy('id')
            ->get(self::LIGHT_COLUMNS);

        $machineryDatabase = $machines->map(fn ($m) => $this->toJsShape($m))->values();
        $makerModels = $this->makerModels($machines);

        return view('pages.machinery', compact('machineryDatabase', 'makerModels'));
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $machines = Machinery::orderBy('id')->get(self::LIGHT_COLUMNS);
        $found = $machines->firstWhere('code', $id);

        abort_if(! $found, 404);

        // Only the machine actually being viewed needs its full photo gallery
        // and description loaded — both stay out of the light listing query.
        $target = Machinery::where('code', $id)->first(['images', 'description']);
        $targetImages = optional($target)->images;
        $targetDescription = optional($target)->description;

        $machineryDatabase = $machines->map(
            fn ($m) => $this->toJsShape($m, $m->code === $id ? $targetImages : null, $m->code === $id ? $targetDescription : null)
        )->values();

        return view('pages.machinery-detail', compact('machineryDatabase'));
    }
}
