@extends('layouts.app')
@section('content')
    @include('layouts.modal')
    <div class="container-fluid ">
        <div class="row justify-content-center p-5">
            <div class='col-lg-12 p-0'>
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item active' aria-current='page'>Tags</li>
                    </ol>
                </nav>
            </div>
            {!! Form::input('hidden','controller', 'tag', ['id' => 'controller']) !!}
            <div class="col-lg-12 bg-dark p-3 rounded">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-white">
                        <thead>
                        <tr>
                            <td colspan="3" class="text-right">
                                <a class="btn btn-primary" href="{{ url('/tag/create') }}">
                                    Nova tag
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>Título</td>
                            <td>Url</td>
                            <td class="text-right">Ações</td>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->title}}</td>
                                    <td>{{$tag->url}}</td>
                                    <td class="text-right">
                                        <a href="tag/edit/{{$tag->id}}" title="Editar" class="btn btn-sm text-danger"><i class="fas fa-edit"></i></a>
                                        <a href="tag/detail/{{$tag->id}}" title="Visualizar" class="btn btn-sm text-danger"><i class="fas fa-info"></i></a>
                                        <button onclick="Main.confirm_delete({{$tag->id}})" title="Excluir" class="btn btn-sm text-danger" style="background-color: transparent;"><i class="fas fa-trash-alt"></i></button>
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

