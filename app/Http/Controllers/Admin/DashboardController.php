<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Chat;
use App\Models\Client;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

   public function __construct(Client $client)
   {
       $this->client = $client;

   }

    public function relatorios(){




        $messages = DB::table('messages')
                    ->join('chats', 'chats.id', '=', 'messages.chat_id')
                    ->join('challenges', 'challenges.id', '=', 'chats.challenge_id')
                    ->join('users', 'users.id', '=', 'challenges.user_id')
                    ->select('users.name', 'chats.*')
                    ->where('messages.type','2')
                 //   ->where('users.id','1')
                //    ->whereBetween('messages.created_at', ['2021-08-01',now()])
                    ->get()->groupBy('name');
        
        $challenges= DB::table('challenges')
                    ->join('users','users.id','=','challenges.user_id')
                    ->join('clients','clients.id','=','challenges.client_id')
           ->select('users.*','clients.*','challenges.*', 'users.name AS users_name', 'challenges.id as desafio_id')
                    //->whereBetween('answered_at', ['2021-08-01',now()])
                    ->get()->groupBy('users_name');
                    
        return view ('admin.relatorios.todos', compact('challenges','messages'));
        }
        
        public function search(Request $request){
           $messages = DB::table('messages')
           ->join('chats', 'chats.id', '=', 'messages.chat_id')
           ->join('challenges', 'challenges.id', '=', 'chats.challenge_id')
           ->join('users', 'users.id', '=', 'challenges.user_id')
           ->select('users.name', 'chats.*')
           ->where('messages.type','2')
        //   ->where('users.id','1')
            ->whereBetween('messages.created_at', [$request->date_start,$request->date_end])
           ->get()->groupBy('name');
        
        $challenges= DB::table('challenges')
           ->join('users','users.id','=','challenges.user_id')
           ->join('clients','clients.id','=','challenges.client_id')
           ->select('users.*','clients.*','challenges.*', 'users.name AS users_name', 'challenges.id as desafio_id')
           ->whereBetween('answered_at', [$request->date_start,$request->date_end])
           ->get()->groupBy('users_name');
           
        return view ('admin.relatorios.todos', compact('challenges','messages','request'));
        }


        public function atrasados(){
           $challenges=Challenge::whereIn('status',['ENVIADO','ANALISE','RESPONDIDO','FINALIZADO'])->orderBy('sended_at','desc')->get();
           return view ('admin.relatorios.atrasados', compact('challenges'));
        }

        public function chats(){
         $chats=Chat::orderBy('status','asc')->get();
         return view ('admin.relatorios.chats', compact('chats'));
      }

      public function relatorioClientsIndex(){
         return view ('admin.relatorios.clients.index');
      }

      public function relatorioClientsSearch(Request $request){
       
         
             $filters = $request->only('filter');
     
             $clients = $this->client
                                 ->where(function($query) use ($request) {
                                     if ($request->filter) {
                                         $query->orWhere('name', 'LIKE', "%{$request->filter}%");
                                         $query->orWhere('email', $request->filter);
                                     }
                                 })
                                 ->latest()
                                 ->paginate();
     
             return view('admin.relatorios.clients.index', compact('clients', 'filters'));
           
      }

      public function relatorioClientsDesafios($id){
         $challenges = $this->client->find($id)->challenges()->get();
         return view ('admin.relatorios.clients.desafios', compact('challenges'));
      }
      
}
