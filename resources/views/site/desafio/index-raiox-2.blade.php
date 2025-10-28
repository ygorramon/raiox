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
                            <ul id="task-card" class="collection with-header animate fadeLeft">
                                <li class="collection-header red">
                                    <h5 class="task-card-title mb-3">Minhas Análises Individuais</h5>
                                    <p class="task-card-date white-text">Acompanhe seus dias de forma independente</p>
                                </li>
                                
                                <table class="bordered">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Título</th>
                                            <th>Idade do Bebê</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($analises as $analise)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($analise->data)->format('d/m/Y') }}</td>
                                            <td>{{ $analise->titulo ?? 'Análise do Dia' }}</td>
                                            <td>{{ $analise->idadeBebe }} meses</td>
                                            <td>
                                                <a class="btn waves-effect waves-light blue" href="{{ route('analises.individuais.show', $analise->id) }}">
                                                    👁️ Ver
                                                </a>
                                                <a class="btn waves-effect waves-light orange" href="{{ route('analises.individuais.edit', $analise->id) }}">
                                                    ✏️ Editar
                                                </a>
                                                <form action="{{ route('analises.individuais.destroy', $analise->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn waves-effect waves-light red" onclick="return confirm('Tem certeza que deseja excluir esta análise?')">
                                                        🗑️ Excluir
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="center-align">
                                                <div class="card-panel yellow lighten-4">
                                                    <p class="yellow-text darken-4">Nenhuma análise individual encontrada.</p>
                                                    <p>Comece criando sua primeira análise!</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                
                                <li class="collection-item center-align">
                                    <a class="btn waves-effect waves-light green" href="{{ route('analises.individuais.create') }}">
                                        ➕ Iniciar Nova Análise
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="card-alert card purple lighten-5">
                                <div class="card-content purple-text">
                                    <a href="https://api.whatsapp.com/send?phone=5588996620215" target="_blank" class="btn">
                                        Suporte Técnico
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('.modal').modal({
            // Configurações do modal se necessário
        });
        
        // Inicializa tooltips se estiver usando
        $('.tooltipped').tooltip();
    });
</script>
@endsection