@extends('main')
@section('title','| Contactpage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Contact Me</h1>
            <hr>
            <form action="{{ url('contact')  }}" method="POST">

               {{ csrf_field()  }}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input id="email" name="email" class="form-control" >
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input id="subject" name="subject" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="5" class="form-control">Type your message here...</textarea>
                </div>
                <input type="submit" class=" btn btn-success" value='Send Massege'>
            </form>
        </div>
    </div>
@endsection

