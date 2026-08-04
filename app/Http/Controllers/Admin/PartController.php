<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartRequest;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $parts = Part::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->string('q');
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('part_no', 'like', "%{$q}%")
                        ->orWhere('oem_no', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->when($request->filled('condition'), fn ($query) => $query->where('condition', $request->string('condition')))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.parts', compact('parts'));
    }

    public function form(Request $request)
    {
        $part = $request->filled('id')
            ? Part::findOrFail($request->integer('id'))
            : null;

        return view('admin.parts-form', compact('part'));
    }

    public function store(PartRequest $request)
    {
        $data = $request->validated();
        $data['code'] = Part::nextCode();

        if ($request->hasFile('images')) {
            $paths = $this->storeImages($request);
            $data['images'] = $paths;
            $data['image'] = $paths[0];
        }

        Part::create($data);

        return redirect()->route('admin.parts')->with('status', 'Part added successfully.');
    }

    public function update(PartRequest $request, Part $part)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $paths = $this->storeImages($request);
            $data['images'] = $paths;
            $data['image'] = $paths[0];
        }

        $part->update($data);

        return redirect()->route('admin.parts')->with('status', 'Part updated successfully.');
    }

    protected function storeImages(PartRequest $request): array
    {
        return collect($request->file('images'))
            ->map(fn ($file) => '/storage/' . $file->store('parts', 'public'))
            ->all();
    }

    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()->route('admin.parts')->with('status', 'Part deleted.');
    }
}
