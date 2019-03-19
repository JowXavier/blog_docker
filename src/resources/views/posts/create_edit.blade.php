@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center p-5">
        <div class='col-lg-12 p-0'>
            <nav aria-label='breadcrumb'>
                <ol class='breadcrumb'>
                    <li class='breadcrumb-item' aria-current='page'><a href="{{ url('/post') }}">Posts</a></li>
                    <li class='breadcrumb-item active' aria-current='page'> @if(isset($post->id)) Editar post @else Novo post @endif</li>
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(!isset($post->id))
                {!! Form::open(['url' => 'post/store', 'id' => 'form_cadastro_post', 'name' => 'form_cadastro', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::model($post, ['url' => 'post/store/', 'id' => 'form_cadastro_post', 'name' => 'form_cadastro', 'enctype' => 'multipart/form-data']) !!}
                {!! Form::input('hidden','id', $post->id) !!}
            @endif
            {!! Form::input('hidden','controller', 'post', ['id' => 'controller']) !!}
            <div class="form-group">
                {!! Form::label('title', 'Título') !!}
                {!! Form::input('text', 'title', null, ['class' =>'form-control', 'autofocus']) !!}
                <div class='input-group mb-2 mb-sm-0 text-danger' id='error-title'></div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Descrição') !!}
                {!! Form::textarea('description', null, ['id' => 'description', 'name' => 'description', 'class' => 'form-control','rows' => '20']) !!}
                <div class='input-group mb-2 mb-sm-0 text-danger' id='error-description'></div>
            </div>
            {!! Form::label('tags', 'Tags') !!}
            <div class="col-lg-12 bg-white rounded p-3">
                <?php $i = 0;?>
                @foreach($tags as $tag)

                    <?php $checked = ""; ?>
                    @if(isset($postTags))
                        @foreach($postTags as $postTag)
                            <?php if($tag->id == $postTag->tag_id) $checked = "checked"; ?>
                        @endforeach
                    @endif

                    <div class="form-check form-check-inline checkbox checbox-switch switch-success custom-controls-stacked">
                        <label for='<?php echo "tag".$i?>' class='text-dark'>
                            <input type='checkbox' {{$checked}} id='<?php echo "tag".$i?>' name='tag[]' value='{{$tag->id}}' /><span></span> {{$tag->title}}
                        </label>
                    </div>
                        <?php $i++; ?>
                @endforeach
            </div>
            <div class='input-group mb-2 mb-sm-0 text-danger' id='error-tag'></div>
            <br />
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
    @include("layouts.modal")
@endsection