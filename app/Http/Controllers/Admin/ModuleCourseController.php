<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseModule;
use App\Models\Video;
use Illuminate\Http\Request;

class ModuleCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = CourseModule::latest()->get();
        return view('admin.cursos.modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $videos = Video::all();
        return view('admin.cursos.modules.create', compact('videos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $module = CourseModule::create($request->only('title', 'description'));
        $module->videos()->sync($request->videos ?? []);
        return back()->with('success', 'Módulo criado!');
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
    public function edit($id)
    {
        $courseModule = CourseModule::with('videos')->findOrFail($id);
        $videos = Video::all();

        return view('admin.cursos.modules.edit', compact('courseModule', 'videos'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $courseModule = CourseModule::findOrFail($id);
        $courseModule->update($request->only('title', 'description'));

        $courseModule->videos()->sync($request->videos ?? []);

        return redirect()->route('modulos.index')->with('success', 'Módulo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseModule $module)
    {
        $module->delete();
        return redirect()->route('modulos.index')->with('success', 'Módulo removido!');
    }
}
