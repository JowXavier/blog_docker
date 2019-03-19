@extends('layouts.appRegular')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center p-5">
        <div class="col-md-11">
            <div class="row p-2 justify-content-center">
                <div class="col-md-8">
                    @foreach($posts as $post)
                        <a href="{{ url('/post/detailRegular/'.$post->id) }}">
                            <div style="margin-bottom: 100px; position: relative;">
                                <img class="img-fluid rounded" src="https://abrilsuperinteressante.files.wordpress.com/2018/07/565c81f082bee174ca00bc30fogo-fatuo.jpeg?quality=70&strip=info" />
                                <div class="info-post" style="border-bottom-left-radius: .25rem !important; border-bottom-right-radius: .25rem !important;">
                                    {{$post->title}}
                                    <br />
                                    <br />
                                    <h6>Por: {{$post->user->name}}</h6>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
</div>
@include("layouts.rodape")
@endsection
