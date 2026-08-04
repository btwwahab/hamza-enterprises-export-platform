<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Columns needed for listing/matching — deliberately excludes the
     * `images` gallery column so bulk queries stay small regardless of
     * how many photos each vehicle has (up to 15 each).
     */
    protected const LIGHT_COLUMNS = [
        'id', 'code', 'name', 'maker', 'model', 'year', 'price', 'mileage',
        'fuel', 'transmission', 'body', 'location',
        'item_no', 'vin_no', 'engine', 'drive', 'seats', 'image',
    ];

    protected function toJsShape(Vehicle $v, ?array $images = null, ?string $description = null): array
    {
        return [
            'id' => $v->code,
            'name' => $v->name,
            'description' => $description,
            'maker' => $v->maker,
            'model' => $v->model,
            'year' => $v->year,
            'price' => $v->price,
            'mileage' => $v->mileage,
            'fuel' => $v->fuel,
            'transmission' => $v->transmission,
            'body' => $v->body,
            'location' => $v->location,
            'image' => $v->image,
            'images' => $images,
            'itemNo' => $v->item_no,
            'vinNo' => $v->vin_no,
            'engine' => $v->engine,
            'drive' => $v->drive,
            'seats' => $v->seats,
        ];
    }

    protected function makerModels($vehicles): array
    {
        return $vehicles
            ->groupBy('maker')
            ->map(fn ($group) => $group->pluck('model')->unique()->values())
            ->all();
    }

    public function index()
    {
        $vehicles = Vehicle::where('status', '!=', 'Sold')
            ->orderBy('id')
            ->get(self::LIGHT_COLUMNS);

        $carDatabase = $vehicles->map(fn ($v) => $this->toJsShape($v))->values();
        $makerModels = $this->makerModels($vehicles);

        $mostViewed = Vehicle::where('status', '!=', 'Sold')
            ->orderByDesc('views')
            ->orderByDesc('id')
            ->take(3)
            ->get(['code', 'name', 'image', 'price', 'fuel', 'engine']);

        return view('pages.cars', compact('carDatabase', 'makerModels', 'mostViewed'));
    }

    public function show(Request $request)
    {
        $id = $request->query('id');

        $vehicles = Vehicle::orderBy('id')->get(self::LIGHT_COLUMNS);
        $found = $vehicles->firstWhere('code', $id);

        abort_if(! $found, 404);

        Vehicle::where('code', $id)->increment('views');

        // Only the vehicle actually being viewed needs its full photo gallery
        // and description loaded — both stay out of the light listing query.
        $target = Vehicle::where('code', $id)->first(['images', 'description']);
        $targetImages = optional($target)->images;
        $targetDescription = optional($target)->description;

        $carDatabase = $vehicles->map(
            fn ($v) => $this->toJsShape($v, $v->code === $id ? $targetImages : null, $v->code === $id ? $targetDescription : null)
        )->values();

        return view('pages.car-detail', compact('carDatabase'));
    }
}
