@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-4 offset-md-8">
                        <a href="{{ route('capturar') }}">
                            <button type="button" class="btn btn-success">Nova Busca</button>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center mt-4 mb-4">Exibir os carros</h3>
                    </div>
                </div>

                @if(count($artigos) > 0)
                    @foreach ($artigos as $key => $artigo)

                        <div class="card-body">
                            <a href="{{$artigo->link}}" style="text-decoration: none;color: #000;" target="_blank">
                                <div class="row">
                                    <div class="col-3">
                                    <img width="827" height="593" src="{{$artigo->img}}" style="border-radius: 20px;" class="img-fluid">
                                    </div>
                                    <div class="col-9">
                                        <h3>{{$artigo->nome_veiculo}}</h3>
                                        <ul style="list-style: none;">
                                                <li class="list-artigos"><span style="font-weight: bold;color: #222;">Ano:</span> <span>{{$artigo->ano}}</span></li>
                                                <li class="list-artigos"><span style="font-weight: bold;color: #222;">Quilometragem:</span> <span>{{$artigo->quilometragem}}</span></li>
                                                <li class="list-artigos"><span style="font-weight: bold;color: #222;">Combustível:</span> <span>{{$artigo->combustivel}}</span></li>
                                                <li class="list-artigos"><span style="font-weight: bold;color: #222;">Câmbio:</span> <span>{{$artigo->cambio}}</span></li>
                                                <li class="list-artigos"><span style="font-weight: bold;color: #222;">Portas:</span> <span>{{$artigo->portas}}</span></li>
                                                <li class="list-artigos"><span style="font-weight: bold;color: #222;">Cor:</span> <span>{{$artigo->cor}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 offset-md-8">
                                    <p style="font-weight: bold">Preço <span style="color: #01b4b3;">{{'R$ '.$artigo['preco']}}</span></p>
                                    </div>
                                </div>
                            </a>
                            <div class="row">
                                <div class="col-md-4 offset-md-8">
                                    <form action="{{ route('capturar.destroy', ['id' => $artigo->id])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Remover</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        </div>

                    @endforeach

                @else
                    <p class="text-center">Nenhum Carro Encontrado.</p>
                @endif

                {{$artigos->links()}}

            </div>
        </div>
    </div>
</div>
@endsection
