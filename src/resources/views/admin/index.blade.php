@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <div class="row justify-content-center p-5">
            <div class="col-md-10">
                <div class="row p-2 justify-content-center">
                    <div class="card d-inline-bloc text-white bg-dark mb-3 ml-5" style="max-width: 18rem;">
                        <div class="card-header text-center">Quantidade de posts cadastrados</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text text-center h1">{{$quantidade['posts']}}</p>
                        </div>
                    </div>
                    <div class="card d-inline-bloc text-white bg-dark mb-3  ml-5" style="max-width: 18rem;">
                        <div class="card-header text-center">Quantidade de comentários realizados</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text text-center h1">{{$quantidade['comments']}}</p>
                        </div>
                    </div>
                    <div class="card d-inline-bloc text-white bg-dark mb-3  ml-5" style="max-width: 18rem;">
                        <div class="card-header text-center">Quantidade de tags cadastradas</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                            <p class="card-text text-center h1">{{$quantidade['tags']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
