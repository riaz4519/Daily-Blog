@extends('main')

@section('title','| Edit Blog Post')
@section('stylesheets')


    {!! Html::style('css/select2.min.css') !!}


@endsection

@section('content')
    <div class="row">
        {!! Form::model($post,['route' => ['posts.update',$post->id],'data-parsley-validate' => '','method'=>'PUT']) !!}
        <div class="col-md-8">
            {{ Form::label('title'),'Title' }}
            {{ Form::text('title',null,["class"=>'form-control input-lg','required' =>'','maxlenght' => '255'])  }}

            {{ Form::label('slug','Slug:')  }}
            {{ Form::text('slug',null,['class'=>'form-control input-lg']) }}

            {{ Form::label('category_id','Category',['class'=>'form-spacing-top'])  }}
            {{ Form::select('category_id',$categories,null,['class'=>'form-control']) }}

            {{ Form::label('tags','Tags',['class'=>'form-spacing-top']) }}
            {{ Form::select('tags[]',$tags,null,['class'=>'select-multi form-control','multiple'=>'multiple']) }}

            {{Form::label('body','Body',['class'=>'form-spacing-top'])}}
            {{ Form::textarea('body',null,['class' => 'form-control','required'=>''])  }}


        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Update</dt>
                    <dd>{{ date('M j, Y h:ia',strtotime( $post->updated_at))  }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show','Cancel',array($post->id),array('class' => 'btn btn-danger btn-block')) !!}
                        {{--<a href="#" class="btn btn-primary btn-block">Edit</a>--}}
                    </div>
                    <div class="col-sm-6">
                        {{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
                        {{--{!! Html::linkRoute('posts.update','Save Changes',array($post->id),array('class' => 'btn btn-success btn-block')) !!}--}}
                        {{--<a href="#" class="btn btn-danger btn-block">Delete</a>--}}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div><!-- .row closed -->

    @endsection


@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script>
        $(document).ready(function () {
            $('.select-multi').select2();
        });
    </script>
@endsection