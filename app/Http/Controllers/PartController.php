<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    protected const CATEGORY_ICONS = [
        'Engine' => 'icon-gauge',
        'Transmission' => 'icon-grid',
        'Lighting' => 'icon-bolt',
        'Body Parts' => 'icon-car',
        'Suspension' => 'icon-shield',
    ];

    protected function toJsShape(Part $p): array
    {
        return [
            'id' => $p->code,
            'name' => $p->name,
            'description' => $p->description,
            'maker' => $p->maker,
            'model' => $p->model,
            'category' => $p->category,
            'image' => $p->image,
            'images' => $p->images,
            'year' => $p->year,
            'price' => $p->price,
            'condition' => $p->condition,
            'location' => $p->location,
            'partNo' => $p->part_no,
            'oemNo' => $p->oem_no,
            'engineType' => $p->engine_type,
            'weight' => $p->weight,
            'fitsModels' => $p->fits_models,
            'hp' => $p->hp,
            'status' => $p->status,
        ];
    }

    public function index()
    {
        // Unlike vehicles, the parts UI already renders a "Sold"/"Reserved" badge
        // inline instead of a buy button, so sold parts stay visible in the listing.
        $parts = Part::orderBy('id')->get();

        $partsDatabase = $parts->map(fn ($p) => $this->toJsShape($p))->values();

        $modelMapping = $parts
            ->groupBy('maker')
            ->map(fn ($group) => $group->pluck('model')->filter()->unique()->values())
            ->all();

        $mostViewed = Part::orderByDesc('views')
            ->orderByDesc('id')
            ->take(3)
            ->get(['code', 'name', 'category', 'condition', 'price']);

        $categoryIcons = self::CATEGORY_ICONS;

        return view('pages.parts', compact('partsDatabase', 'modelMapping', 'mostViewed', 'categoryIcons'));
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $parts = Part::orderBy('id')->get();
        $found = $parts->firstWhere('code', $id);

        abort_if(! $found, 404);

        Part::where('code', $id)->increment('views');

        $partsDatabase = $parts->map(fn ($p) => $this->toJsShape($p))->values();

        return view('pages.part-detail', compact('partsDatabase'));
    }
}
