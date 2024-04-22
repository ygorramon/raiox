<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    public function __construct(Client $client)
    {
        $this->repository = $client;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = $this->repository
        ->whereRaw('DATEDIFF(expireAt,created_at) < 365')
        ->latest()->paginate();

        return view('admin.clients.index', compact('clients'));
    }

    public function ativos(){
        $totalClients= $this->repository->where('active', 1)->where('expireAt', '>', now())->count();
        $totalClientsAcesso = $this->repository->where('active', 1)->where('expireAt', '>', now())->where('name','<>','null')->count();
        $clients =$this->repository->where('active',1)->where('expireAt','>',now())->paginate();
        return view('admin.clients.ativos', compact('clients', 'totalClients', 'totalClientsAcesso'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = $this->repository->create([
            'email' => $request->email,
            'active' => 1,
            'expireAt' => now()->addDays($request->expire),
        ]);

     return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$client = $this->repository->find($id)) {
            return redirect()->back();
        }

       
        return view ('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$client = $this->repository->find($id)) {
            return redirect()->back();
        }


        return view('admin.clients.edit', compact('client'));
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



        if (!$client = $this->repository->find($id)) {
            return redirect()->back();
        }

        $active = 0;
        $liberado = 0;

        if (isset($request->liberado)) {
            $liberado = 1;
        }
        if (isset($request->active)) {
            $active = 1;
        }


        $client->update([
            'email' => $request->email,
            'active' => $active,
            'liberado' =>  $liberado,
            'expireAt' => $request->expireAt,
            'babyName' => $request->babyName,
            'birthBaby' => $request->birthBaby,
            'class' => $request->class,
        ]);

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$client = $this->repository->find($id)) {
            return redirect()->back();
        }
        $client->delete();

        return redirect()->route('clients.index');
    }


    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $clients = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                    $query->orWhere('email', $request->filter);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.clients.index', compact('clients', 'filters'));
    }

    public function apiUser(Request $request){
       
        $client = $this->repository->create([
            'email' => $request->email,
            'class' => $request->prod_name,
            'active' => 1,
            'expireAt' => now()->addDays(365),
        ]);
    
    }

    public function desativeUser(Request $request){
        $client = $this->repository->where('email',$request->email);

        //dd($client);
        
        $client->update(['active'=>0]);

    }

    public function resetSenha($id)
    {

        if (!$client = $this->repository->find($id)) {
            return redirect()->back();
        }
        $client->update([
            'password' => Hash::make('123456'),

        ]);

        return redirect()->route('clients.index');
    }
}
