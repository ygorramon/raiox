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
                        <th>Módulo</th>
                        
                        <th >Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modules as $module)
                        <tr>
                            <td>
                                {{ $module->description }}
                            </td>
                            
                            <td style="width=10px;">
                                <a href="{{route('submodules.index',$module->id)}}" class="btn btn-warning"> Sub-módulos </a>
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