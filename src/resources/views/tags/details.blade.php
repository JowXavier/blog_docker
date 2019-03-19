@extends('layouts.app')
@section('content')
    @include('layouts.modal')
    <div class="container-fluid ">
        <div class="row justify-content-center p-5">
            <div class='col-lg-12 p-0'>
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item' aria-current='page'><a href="{{ url('/tag') }}">Tags</a></li>
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
                            <td class="text-right w-50">Título</td>
                            <td>{{$tag->title}}</td>
                        </tr>
                        <tr>
                            <td class="text-right">Url</td>
                            <td>{{$tag->url}}</td>
                        </tr>
                        <tr>
                            <td class="text-right align-middle">
                                Posts com esta tag
                            </td>
                            <td>
                                @foreach($posts as $post)
                                    {{$post->title}}
                                    <br />
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection