

@extends('main')

@section('title','| Homepage')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>Hello, world!</h1>
                    <p class="lead">Thank you so much for visiting.This is my test website build with laravel.please read my latest post! </p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular post</a></p>
                </div>
            </div>
        </div><!--end of header .row-->

        <div class="row">
            <div class="col-md-8">


                @foreach($posts as $post)

                    <div class="post">
                        <h3>{{ $post->title }}</h3>
                        <p> {{substr($post->body,0,300)}} {{ strlen($post->body) >300 ?"...":'' }}</p>
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read more</a>
                    </div>

                    <hr>
                    @endforeach


            </div>


            <div class="col-md-3 col-md-offset-1">
                <h1>side bar</h1>

            </div>
        </div>
    @endsection


