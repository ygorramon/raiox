<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
   public function __construct(Challenge $challenge)
   {
      $this->repository = $challenge;
   }

   public function availables()
   {
      $challenges = $this->repository->where('status', 'ENVIADO')->where('user_id', null)->paginate();
      return view('admin.challenges.availables.index', compact('challenges'));
   }
   public function myChallenges()
   {
      $challenges = Auth::user()->challenges()->paginate();
      return view('admin.challenges.meus.index', compact('challenges'));
   }

   public function getChallenge($id)
   {
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }
      $user = Auth::user();
      $this->repository->find($id)->update(['user_id' => $user->id, 'status' => 'ANALISE']);
      return redirect()->route('challenge.availables');
   }

   public function showAvailables($id)
   {
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }

      $challenge = $this->repository->with('client')->find($id);


      return view('admin.challenges.availables.show', compact('challenge'));
   }

   public function showMyChallenge($id)
   {
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }

      $challenge = $this->repository->with('client')->find($id);


      return view('admin.challenges.meus.show', compact('challenge'));
   }

   public function responder($id)
   {
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }

      $challenge = $this->repository->with('client')->find($id);


      return view('admin.challenges.meus.responder', compact('challenge'));
   }

   public function responderUpdate($id, Request $request)
   {
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }

      $challenge = $this->repository->with('client')->find($id);

      $challenge->update([
         'status' => 'RESPONDIDO', 'passo1' => $request->passo1,
         'passo2' => $request->passo2,
         'passo3_despertar' => $request->passo3_despertar,
         'passo3_rotina_alimentar'=>$request->passo3_rotina_alimentar,
        'passo3_rotina_sonecas'=> $request->passo3_rotina_sonecas,
         'passo3_ambiente_sonecas'=>$request->passo3_ambiente_sonecas,
         'passo3_sono_noturno'=>$request->passo3_sono_noturno,
         'passo3_ambiente_noturno'=>$request->passo3_ambiente_noturno,
         'passo4_associacoes_sonecas'=>$request->passo4_associacoes_sonecas,
         'passo4_associacoes_noturno'=>$request->passo4_associacoes_noturno,
         'conclusao'=>$request->conclusao,
      ]);


      return redirect()->route('challenge.meus.show', $id);
   }

   public function chat($id)
   {
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }

      $challenge = $this->repository->with('client')->find($id);


      return view('admin.challenges.meus.chat', compact('challenge'));
   }

   public function chatStore(Request $request, $id){
      if (!$challenge = $this->repository->find($id)) {
         return redirect()->back();
      }

      $challenge = $this->repository->with('client')->find($id);

      $chat=$challenge->chat()->first();
      $chat->update(['status'=>'odilo']);
      $chat->messages()->create(['content'=>$request->message,'type'=>2]);
      return redirect()->route('challenge.meus.chat', $challenge->id);

   }
}
