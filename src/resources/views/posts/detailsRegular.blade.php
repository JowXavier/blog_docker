@extends("layouts.appRegular")
@section('content')
    <div class="container-fluid ">
        <div class="row justify-content-center p-5">
            <div class="col-md-8">
                <div class="row p-2 justify-content-center">
                    <div class="col-md-12">
                        <p>
                            Por: {{$post->user->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fas fa-calendar-alt"></i>
                            {{ date( 'd/m/Y H:i' , strtotime($post->created_at))}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#description" class="text-dark">
                                <i class="fas fa-comments"></i>
                                Comentar
                            </a>
                        </p>
                        <h2 class="text-center">{{$post->title}}</h2>
                        <img class="w-100 img-fluid rounded" src="https://abrilsuperinteressante.files.wordpress.com/2018/07/565c81f082bee174ca00bc30fogo-fatuo.jpeg?quality=70&strip=info" />
                        <div class="w-100 mt-4">
                            <b>Compartilhe</b> &nbsp;&nbsp;&nbsp;
                            <a href="http://www.facebook.com/sharer/sharer.php?u={{ url('/post/detailRegular/'.$post->id) }}" class="icon-button facebook" target="_blank">
                                <i class="fab fa-facebook-f" style="font-size: 2em;"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="http://twitter.com/intent/tweet?text={{ url('/post/detailRegular/'.$post->id) }}" class="icon-button twitter" target="_blank">
                                <i class="fab fa-twitter" style="font-size: 2em;"></i>
                            </a>
                        </div>
                        <div class="w-100 mt-4" style="line-height: 30px; text-align: justify;">
                            {{$post->description}}
                        </div>
                        <div class="w-100">
                            <br />
                            <label>Tags</label>
                            <br />
                            @foreach($tags as $tag)
                                <div class="d-inline-block"><h1><span class="badge badge-primary ">{{$tag->title}}</span></h1></div>
                            @endforeach
                        </div>
                        <div class="w-100">
                            @if(Auth::check())
                                <br />
                                {{Form::open(['url' => 'post/storeComment','id' => 'form_cadastro_comment', 'name' => 'form_cadastro'])}}
                                {!! Form::input('hidden','post_id', $post->id, ['id' => 'post_id']) !!}
                                {!! Form::input('hidden','controller', 'post', ['id' => 'controller']) !!}
                                    <div class="form-group">
                                        {!! Form::label('description', 'Compartilhe conoso a sua opinião', ['class' => ' font-weight-bold']) !!}
                                        {!! Form::textarea('description', null, ['id' => 'description', 'name' => 'description', 'class' => 'form-control','rows' => '10', 'style' => 'resize: none;']) !!}
                                        <div class='input-group mb-2 mb-sm-0 text-danger' id='error-description'></div>
                                    </div>
                                {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
                                {{Form::close()}}
                            @else
                                <br />
                                <h3 class="text-center">Para comentar é necessário realizar <a href="{{ route('login') }}">{{ __('Login') }}</a></h3>
                            @endif
                        </div>
                        <br />
                        <div class="w-100 p-3" style="border: 1px solid black;">
                            <label>Todos os comentários</label>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        <div class="card border-secondary mb-3 text-primary" style="max-width: 100%;">
                                            <div class="card-header">{{$comment->user->name}} - {{ date( 'd/m/Y H:i:s' , strtotime($comment->created_at))}}</div>
                                            <div class="card-body text-primary">
                                                <h5 class="card-title">{{$comment->user->email}}</h5>
                                                <p class="card-text">{{$comment->description}}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <br />
                            <?php  if(count($comments) == 0) echo "<h4 class='text-center'>Não existe comentários para esta publicação. Seja o primeiro a comentar.<h4>"; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("layouts.rodape")
    @include("layouts.modal")
@endsection