<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id')->get();

        return view('admin.brands', compact('brands'));
    }

    public function sync(Request $request)
    {
        $request->validate([
            'brands.*.logo' => ['nullable', 'image', 'max:2048'],
        ]);

        $rows = $request->input('brands', []);
        $keptIds = [];

        foreach ($rows as $index => $row) {
            $name = trim($row['name'] ?? '');
            if ($name === '') {
                continue;
            }

            $data = [
                'name' => $name,
                'count' => max(0, (int) ($row['count'] ?? 0)),
                'show' => isset($row['show']),
                'logo' => $row['existing_logo'] ?? null,
            ];

            if ($request->hasFile("brands.{$index}.logo")) {
                $data['logo'] = '/storage/' . $request->file("brands.{$index}.logo")->store('brands', 'public');
            }

            if (! empty($row['id']) && $brand = Brand::find($row['id'])) {
                $brand->update($data);
                $keptIds[] = $brand->id;
            } else {
                $keptIds[] = Brand::create($data)->id;
            }
        }

        Brand::whereNotIn('id', $keptIds)->delete();

        return redirect()->route('admin.brands')->with('status', 'Brands saved successfully.');
    }
}
