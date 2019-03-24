@extends('layouts.app')
@section('content')
    @include('layouts.modal')
    <div class="container-fluid ">
        <div class="row justify-content-center p-5">
            <div class='col-lg-12 p-0'>
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item' aria-current='page'><a href="{{ url('/post') }}">Posts</a></li>
                        <li class='breadcrumb-item active' aria-current='page'>Detalhes</li>
                    </ol>
                </nav>
            </div>

            <div class="col-lg-12 bg-dark p-3 rounded">
                <div>
                    <a href='javascript:window.history.go(-1)' title='Voltar'>
                        <span class='fas fa-arrow-circle-left text-white' style='font-size: 25px;'></span>
                    </a>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-white">
                        <tr>
                            <td class="text-center">{{$post->title}}</td>
                        </tr>
                        <tr>
                            <td class="text-justify">{{$post->description}}</td>
                        </tr>
                        <tr>
                            <td>
                                @foreach($post->tags as $tag)
                                    <div class="d-inline-block"><h1><span class="badge badge-primary ">{{$tag->title}}</span></h1></div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Comentários</td>
                        </tr>
                            @foreach($post->comments as $comment)
                                <tr>
                                    <td>
                                        <div class="card border-secondary mb-3 text-primary" style="max-width: 100%;">
                                            <div class="card-header">{{$comment->usuario->name}} - {{ date( 'd/m/Y H:i:s' , strtotime($comment->created_at))}}</div>
                                            <div class="card-body text-primary">
                                                <h5 class="card-title">{{$comment->usuario->email}}</h5>
                                                <p class="card-text">{{$comment->description}}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection