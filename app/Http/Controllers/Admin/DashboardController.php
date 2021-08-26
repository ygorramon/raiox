<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
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
}
