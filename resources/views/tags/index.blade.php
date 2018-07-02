@extends('main')

@section('title','| All Tags')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th>{{ $tag->id  }}</th>
                        <td>{{ $tag->name }}</td>
                        <td> <a href="{{ route('tags.show',$tag->id)  }}" class="btn btn-defaut"> show </a> </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div> <!-- end of col-md-8 -->

        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['route'=>'tags.store','method'=>'POST']) !!}

                <h2>New Tags</h2>

                {{ Form::label('name','Name:') }}
                {{ Form::text('name',null,['class'=>'form-control']) }}

                {{Form::submit('Create New Tag',['class' => 'btn btn-primary btn-block form-spacing-top'])}}


                {!! Form::close() !!}

            </div>
        </div>

    </div>


@endsection