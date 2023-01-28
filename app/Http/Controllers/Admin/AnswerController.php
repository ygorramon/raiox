<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Category;

class AnswerController extends Controller
{
 
    private $repository, $category;

    public function __construct (Answer $answer, Category $category){
        $this->repository = $answer;
        $this->category=$category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       
        if (!$category = $this->category->where('id', $id)->first()) {
            return redirect()->back();
        }

        $answers= $category->answers()->get();
        return view ('admin.answers.index',[
            'answers'=>$answers,
            'category'=>$category
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (!$category = $this->category->where('id', $id)->first()) {
            return redirect()->back();
        }

        return view('admin.answers.create', [
            'category' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (!$category = $this->category->where('id', $id)->first()) {
            return redirect()->back();
        }

        $category->answers()->create($request->all());

        return redirect()->route('situacoes.respostas.index', $category->id);
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
    public function edit($id, $answerId)
    {
        if (!$category = $this->category->where('id', $id)->first()) {
            return redirect()->back();
        }
        if (!$answer = $this->repository->where('id', $answerId)->first()) {
            return redirect()->back();
        }

        return view('admin.answers.edit', [
            'category' => $category,
            'answer' => $answer,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $answerId)
    {
        if (!$category = $this->category->where('id', $id)->first()) {
            return redirect()->back();
        }
        if (!$answer = $this->repository->where('id', $answerId)->first()) {
            return redirect()->back();
        }
       $answer->update($request->all());


       return redirect()->route('situacoes.respostas.index', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function categories()
    {
       
        $categories= Category::all();
        return view ('admin.answers.categories',[
            'categories'=>$categories
        ]);
        

    }

    public function respostas()
    {

        $categories = Category::all();
        return view('admin.answers.respostas', [
            'categories' => $categories
        ]);
    }
}
