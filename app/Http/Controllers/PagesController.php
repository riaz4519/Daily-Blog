<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    //
    public  function getIndex(){
        $posts = Post::orderBy('created_at','desc')->limit(4)->get();

        return view('pages.welcome')->withPosts($posts);

    }

    public function getAbout(){
        $firsname = "Fahim";
        $lastname = "Riaz";
        $full = $firsname.' '.$lastname;
        $email = "riaz.i3216@gmail.com";
        return view('pages.about')->withFullname($full)->withEmail($email);
    }

    public  function getContact(){
        return view('pages.contact');

    }
    public  function postContact(Request $request){

        $this->validate($request,[
            'email'=>'required|email',
            'subject'=>'min:3',
            'message'=>'min:10'

        ]);
        $data  = array(
            'email'=> $request->email,
            'subject'=> $request->subject,
            'bodyMessage'=> $request->message

        );

        Mail::send('emails.contact',$data,function ($message) use ($data) {

            $message->from($data['email']);
            $message->to('riaz.i3216@gmail.com');
            $message->subject($data['subject']);


        });

    }

}
