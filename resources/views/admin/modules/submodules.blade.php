@extends ('adminlte::page')

@section ('title' , 'Respostas Automáticas')
@section('content_header')
 <h1>Perguntas Módulos </h1> 
@stop

@section('content')
<div class="card">
        <div class="card-header">
            Filtros
        </div>
        <div class="card-body">
        <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Sub-módulo</th>
                        
                        <th >Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submodules as $submodule)
                        <tr>
                            <td>
                                {{$submodule->description }}
                            </td>
                            
                            <td style="width=10px;">
                                <a href="{{route('queries.index',$submodule->id)}}" class="btn btn-warning"> Perguntas </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            Footer
        </div>
    </div>
@stop