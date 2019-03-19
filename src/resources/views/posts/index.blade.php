@extends('layouts.app')
@section('content')
    @include('layouts.modal')
    <div class="container-fluid ">
        <div class="row justify-content-center p-5">
            <div class='col-lg-12 p-0'>
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item active' aria-current='page'>Posts</li>
                    </ol>
                </nav>
            </div>
            {!! Form::input('hidden','controller', 'post', ['id' => 'controller']) !!}
            <div class="col-lg-12 bg-dark p-3 rounded">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-white">
                        <thead>
                        <tr>
                            <td colspan="3" class="text-right">
                                <a class="btn btn-primary" href="{{ url('/post/create') }}">
                                    Novo post
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Título</td>
                            <td>Usuário</td>
                            <td class="text-right">Ações</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user->name}}</td>
                                <td class="text-right">
                                    <a href="post/edit/{{$post->id}}" title="Editar" class="btn btn-sm text-danger"><i class="fas fa-edit"></i></a>
                                    <a href="post/detail/{{$post->id}}" title="Visualizar" class="btn btn-sm text-danger"><i class="fas fa-info"></i></a>
                                    <button onclick="Main.confirm_delete({{$post->id}})" title="Excluir" class="btn btn-sm text-danger" style="background-color: transparent;"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection