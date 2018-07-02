@extends('main')

@section('title','| View Post')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $post->title }}</h1>

            <p class="lead">{{ $post->body }}</p>

            {{--posts tags--}}
            <hr>
            <div class="tags">
            @foreach($post->tags as $tag)

                <span class="label label-default">{{ $tag->name }}</span>


                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <label>Url Slug:</label>
                    <p><a href="{{ route('blog.single',$post->lugs)  }}">{{ route('blog.single',$post->lugs)}}</a></p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Category:</label>
                    <p>{{ $post->category->name }}</p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Last Update</label>
                    <p>{{ date('M j, Y h:ia',strtotime( $post->updated_at))  }}</p>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.edit','Edit',array($post->id),array('class' => 'btn btn-primary btn-block')) !!}
                        {{--<a href="#" class="btn btn-primary btn-block">Edit</a>--}}
                    </div>
                    <div class="col-sm-6">

                        {!! Form::open(['route' =>['posts.destroy',$post->id],'method'=>'DELETE' ]) !!}

                        {{--{!! Html::linkRoute('posts.destroy','Delete',array($post->id),array('class' => 'btn btn-danger btn-block')) !!}--}}
                        {{--<a href="#" class="btn btn-danger btn-block">Delete</a>--}}

                        {{ Form::submit('Delete',['class'=>'btn btn-danger btn-block'])  }}





                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-12">
                        {!! Html::linkRoute('posts.index','<< Show All Posts >>',[],['class'=>'btn btn-default  btn-block btn-h1-spacing'] ) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection

{{--@if(count($errors) > 0)--}}
    {{--<div class="alert aler-danger" role="alert">--}}
        {{--<strong>Errors:</strong>--}}
        {{--<ul>--}}
        {{--@foreach($errors as $error)--}}
                {{--<li>{{$error}}</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}

    {{--</div>--}}




    {{--@endif--}}
