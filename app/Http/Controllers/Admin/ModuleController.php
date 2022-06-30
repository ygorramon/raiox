<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doubt;
use App\Models\Module;
use App\Models\Submodule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository, $category;

    public function __construct(Module $module)
    {
        $this->repository = $module;
    }

    public function index()
    {
      $modules = $this->repository->all();
      return view ('admin.modules.index', compact('modules')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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


public function submodules($id)
{
    $submodules = $this->repository->find($id)->submodules()->get();
        return view('admin.modules.submodules', compact('submodules')); 
}

    public function queries($id)
    {
        $queries =  Submodule::find($id)->queries()->get();
        return view('admin.modules.queries', compact('queries'));
    }

    public function doubtsArasadosView(){
        $doubts=Doubt::where('status','Enviado')->get();
        return view('admin.doubts.index', compact('doubts'));

    }
    public function doubtsShow($id)
    {
        $doubt = Doubt::find($id);
   
        return view('admin.doubts.show', compact('doubt'));
    }

    public function doubtsResponder($id, Request $request)
    {
        $user = Auth::user();
        $doubt = Doubt::find($id);
        $doubt->update(['response' => $request->resposta, 'status'=>'RESPONDIDO', 'user_id'=>$user->id, 'answered_at'=>now()]);
        return redirect()->route('duvidas.index');
    }

    public function doubtsView()
    {
        $doubts = Doubt::all();
        return view('admin.doubts.index', compact('doubts'));
    }
    

}
