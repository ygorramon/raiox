@extends('site.desafio.layouts.app')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}" media="screen,projection" />
@stop



@section('content')
<div class="row">
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div id="card-widgets">
                    <div class="row">
                        <div class="col s12">

                        <div id="bordered-table" class="card card card-default scrollspy">
        <div class="card-content">
        @if($challenge->status=='ENVIADO')
         <div class="row">
            <div class="col s12">
              <h4 class="card-title">Seu Desafio foi Enviado! </h4>
            </div>
            <div class="col s12">
              <h4 class="card-title">Em breve você receberá a análise! </h4>
            </div>

         </div>
         @else
          <h4 class="card-title">Análise Diária</h4>
         
          <div class="row">
            <div class="col s12">
            </div>
            <div class="col s12">
              <table class="bordered">
                <thead>
                  <tr>
                    <th data-field="dia">Dia / Formulário</th>
                    <th data-field="dia">Preenchido?</th>
                                      </tr>
                </thead>
                <tbody>
                  <tr>
                  @if(!isset($challenge->analyzes()->where('day','1')->first()->day))

                    <td><a href="{{route('analyze.create',[$challenge->id,1])}}" class="btn waves-effect waves-light red "> Dia 1 </a> </div>
                    @else
                    <td><a href="{{route('analyze.edit',[$challenge->id,1])}}" class="btn waves-effect waves-light red "> Dia 1 </a> </div>
@endif
                                       
                                        @if(isset($challenge->analyzes()->where('day','1')->first()->day))
                    <td><i class="material-icons">check</i> 
                     {{date_format($challenge->analyzes()->where('day','1')->first()->created_at,'d/m/Y') }}</td>
                  @else
                  <td>NÃO</td>
                  
                  @endif
                </tr>
                  @if(isset($challenge->analyzes()->where('day','1')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','1')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.create',[$challenge->id,2])}}" class="btn waves-effect waves-light red "> Dia 2 </a></td>
                @if(isset($challenge->analyzes()->where('day','2')->first()->day))
                <td> <i class="material-icons">check</i> {{date_format($challenge->analyzes()->where('day','2')->first()->created_at,'d/m/Y') }} </td>
               
                @else
                <td>NÃO</td>
                 
                @endif
                @else
                <td>Dia 2</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','1')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif

                  @if(isset($challenge->analyzes()->where('day','2')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','2')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.create',[$challenge->id,3])}}" class="btn waves-effect waves-light red "> Dia 3 </a></td>
                @if(isset($challenge->analyzes()->where('day','3')->first()->day))
                <td> <i class="material-icons">check</i>  {{date_format($challenge->analyzes()->where('day','3')->first()->created_at,'d/m/Y') }} </td>
                @else
                <td>NÃO</td>
                  
                @endif
                @else
                <td>Dia 3</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','2')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif

                  @if(isset($challenge->analyzes()->where('day','3')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','3')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.create',[$challenge->id,4])}}" class="btn waves-effect waves-light red "> Dia 4 </a></td>
                @if(isset($challenge->analyzes()->where('day','4')->first()->day))
                <td> <i class="material-icons">check</i>
                 {{date_format($challenge->analyzes()->where('day','4')->first()->created_at,'d/m/Y') }} </td>
                @else
                <td>NÃO</td>
                  
                @endif
                @else
                <td>Dia 4</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','3')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif

                  @if(isset($challenge->analyzes()->where('day','4')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','4')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.create',[$challenge->id,5])}}" class="btn waves-effect waves-light red "> Dia 5 </a></td>
                @if(isset($challenge->analyzes()->where('day','5')->first()->day))
                <td> <i class="material-icons">check</i>
                {{date_format($challenge->analyzes()->where('day','5')->first()->created_at,'d/m/Y') }} </td>
                @else
                <td>NÃO</td>
                 
                @endif
                @else
                <td>Dia 5</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','4')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif

                  @if(isset($challenge->analyzes()->where('day','5')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','5')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.create',[$challenge->id,6])}}" class="btn waves-effect waves-light red "> Dia 6 </a></td>
                @if(isset($challenge->analyzes()->where('day','6')->first()->day))
                <td> <i class="material-icons">check</i>  {{date_format($challenge->analyzes()->where('day','6')->first()->created_at,'d/m/Y') }} </td>
                @else
                <td>NÃO</td>
                  
                @endif
                @else
                <td>Dia 6</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','5')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif

                  @if(isset($challenge->analyzes()->where('day','6')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','6')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.create',[$challenge->id,7])}}" class="btn waves-effect waves-light red "> Dia 7 </a></td>
                @if(isset($challenge->analyzes()->where('day','7')->first()->day))
                <td> <i class="material-icons">check</i> {{date_format($challenge->analyzes()->where('day','7')->first()->created_at,'d/m/Y') }} </td>
                @else
                <td>NÃO</td>
                  
                @endif
                @else
                <td>Dia 7</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','6')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif
                  
                  @if(isset($challenge->analyzes()->where('day','7')->first()->day))
                <tr>
                    @if(date_format(now(),'Y-d-m')>=date_format($challenge->analyzes()->where('day','7')->first()->created_at->addDays(1),'Y-d-m'))
                <td><a href="{{route('analyze.form',$challenge->id)}}" class="btn waves-effect waves-light red "> Formulário Final </a></td>
               
                @if(isset($challenge->form()->get()->id))
                <td> <i class="material-icons">check</i>
                 {{date_format($challenge->form()->get()->created_at,'d/m/Y') }} </td>
                @else
                <td>NÃO</td>
                  
                @endif
                @else
                <td>Formulário Final</td>
                <td>Disponível em {{date_format($challenge->analyzes()->where('day','7')->first()->created_at->addDays(1),'d/m/Y')}}</td>
                
                @endif
                </tr>
                  @endif
                  @if(isset($challenge->form()->first()->id))
                <tr>
                  <td>
                    <form action="{{route('desafio.update',$challenge->id)}}" method="POST">
                      @csrf
                      {{ method_field('PUT') }}
                      <button class="btn">Enviar Desafio</button>
                  </td>
                </tr>
                    
                
               
                  @endif

                </tbody>
              </table>
            </div>
          </div>
@endif
        </div>
      </div>
                           
                        </div>

                    </div>
                </div>





                @endsection
            </div>
        </div>
    </div>
</div>

@section('js')
<script>
    @if(session('sucesso'))
    M.toast({
        html: '{{session('sucesso')}}'
    })
    @endif
</script>
@endsection