<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderByDesc('published_at')->get();

        return view('admin.videos', compact('videos'));
    }

    public function form(Request $request)
    {
        $video = $request->filled('id')
            ? Video::findOrFail($request->integer('id'))
            : null;

        return view('admin.videos-form', compact('video'));
    }

    public function store(VideoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeThumbnail($request);
        }

        Video::create($data);

        return redirect()->route('admin.videos')->with('status', 'Video added successfully.');
    }

    public function update(VideoRequest $request, Video $video)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->storeThumbnail($request);
        }

        $video->update($data);

        return redirect()->route('admin.videos')->with('status', 'Video updated successfully.');
    }

    protected function storeThumbnail(VideoRequest $request): string
    {
        return '/storage/' . $request->file('thumbnail')->store('videos', 'public');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos')->with('status', 'Video deleted.');
    }
}
