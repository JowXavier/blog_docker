@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        @if( session( 'error' ) )
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center p-5">
            <div class='col-lg-12 p-0'>
                <nav aria-label='breadcrumb'>
                    <ol class='breadcrumb'>
                        <li class='breadcrumb-item' aria-current='page'><a href="{{ url('/tag') }}">Tags</a></li>
                        <li class='breadcrumb-item active' aria-current='page'> @if(isset($tag->id)) Editar tag @else Nova tag @endif</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12 bg-dark p-3 rounded text-white">
                <div>
                    <a href='javascript:window.history.go(-1)' title='Voltar'>
                        <span class='fas fa-arrow-circle-left text-white' style='font-size: 25px;'></span>
                    </a>
                </div>
                <br />
                @if(!isset($tag->id))
                    {!! Form::open(['route' => 'tag.store']) !!}
                @else
                    {!! Form::model($tag, ['method' => 'PATCH', 'route' => ['tag.update', $tag->id]]) !!}
                @endif
                    <div class="form-group">
                        {!! Form::label('title', 'Título') !!}
                        {!! Form::input('text', 'title', null, ['class' =>'form-control', 'autofocus']) !!}
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('url', 'Url') !!}
                        {!! Form::input('text', 'url', null, ['class' =>'form-control', 'autofocus']) !!}
                        @if ($errors->has('url'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include("layouts.modal")
@endsection