@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Capturar</div>

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

                <form method="POST">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-11 ml-3">
                                <input type="text" name="textoDigitado" id="textoDigitado" required class="form-control" placeholder="Digite aqui a sua busca" />
                            </div>
                        </div>

                        <div class="row mt-3 mb-3">
                            <div class="col-md-3 offset-md-9">
                                    <button type="button" id="btnCapturar" class="btn btn-success">Capturar</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
@endsection
