<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'required|mimes:mp4|max:102400', // 100MB
        ]);

        $path = $request->file('video')->store('videos', 'public');

        $video = new Video();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->path = $path;
        $video->save();

        return response()->json(['message' => 'Vídeo salvo com sucesso']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'video' => 'nullable|mimes:mp4|max:51200',
        ]);

        if ($request->hasFile('video')) {
            // Deleta o antigo
            Storage::delete('public/' . $video->file_path);
            $path = $request->file('video')->store('public/videos');
            $video->file_path = str_replace('public/', '', $path);
        }

        $video->title = $request->title;
        $video->description = $request->description;
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Vídeo atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        Storage::delete('public/' . $video->file_path);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Vídeo removido!');
    }
}
