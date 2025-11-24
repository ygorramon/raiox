<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Chat;
use App\Models\Client;
use App\Models\Message;
use App\User;
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
           ->select('users.*','clients.*','challenges.*', 'users.name AS users_name', 'challenges.id as Desafio_id')
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
           ->select('users.*','clients.*','challenges.*', 'users.name AS users_name', 'challenges.id as Desafio_id')
           ->whereBetween('answered_at', [$request->date_start,$request->date_end])
           ->get()->groupBy('users_name');
           
        return view ('admin.relatorios.todos', compact('challenges','messages','request'));
        }


        public function atrasados(){
           $challenges=Challenge::whereIn('status',['ENVIADO','ANALISE'])->orderBy('sended_at','desc')->get();
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
         return view ('admin.relatorios.clients.Desafios', compact('challenges'));
      }
      
      public function usersIndex(){
         $users = User::all();
         return view ('admin.relatorios.terapeutas.index', compact('users'));
      }

   public function usersSearch(Request $request)
   {
      $users = User::all();
      $date = $request->filter;
      
      return view('admin.relatorios.terapeutas.search', compact('users', 'date'));
   }
   public function usersShow($id)
   {
      $user=User::find($id);
     
      return view('admin.relatorios.terapeutas.show', compact('user'));
   }

   public function enviados()
   {
      $challenges = Challenge::whereIn('status', ['ENVIADO', 'ANALISE','RESPONDIDO','FINALIZADO'])->orderBy('sended_at', 'desc')->get();
      return view('admin.relatorios.enviados2', compact('challenges'));
   }

   public function transferirChallenge($id){
      $challenge=Challenge::find($id);
      $users = User::all();
     return view ('admin.relatorios.terapeutas.transfer-challenge',compact('challenge','users'));
   }

   public function transferirChallengeUpdate($id, Request $request){
$challenge=Challenge::find($id);
$challenge->update(['user_id'=>$request->user]);
      return redirect()->route('relatorios.users.index');
   }
   
}
