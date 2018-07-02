<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Session;
use Illuminate\Http\Request;
use App\Tag;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */

    public  function __construct(){

        $this->middleware('auth');

    }
    public function index()
    {
        //create a variable and store all the blog post in it from the database

        $posts = Post::orderBy('id','desc')->paginate(10);

        //send the variable posts to the view

        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        //
        $this->validate($request,array(
            'title' => 'required|max:255',
            'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category'=>'required|integer',
            'body' => 'required'


        ));
        $post = new Post();

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category;
        $post->body = $request->body;

        $post->save();
        $post->tags()->sync($request->tags,false);
        \Session::flash('success','The blog post was successfully save!');
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);

        //grab all the categories

        $categories = Category::all();
        $cats  = array();
        foreach ($categories as $category){

            $cats[$category->id] = $category->name;

        }
//        $tags= Tag::all();
//        $tag2 = array();
//        foreach ($tags as $tag){
//
//            $tag2[$tag->id] = $tag->name;
//
//        }
        $tag2 = Tag::pluck('name','id');


        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tag2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
        $post = Post::find($id);

        if($request->input('slug') == $post->slug){
            $this->validate($request,array(
                'title' => 'required|max:255',
                'category_id'=>'required|integer',
                'body' =>'required'
            ));
        }else{
            $this->validate($request,array(
                'title' => 'required|max:255',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'=>'required|integer',
                'body' =>'required'
            ));
        }


        //update in the database
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        $post->save();
        if (isset($request->tags)){
            $post->tags()->sync($request->tags,true);
        }
        else{
            $post->tags()->sync(array());
        }


//        flash success message
        \Session::flash('success','This post is successfully saved');

        //redirect

        return redirect()->route('posts.show',$post->id);






    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::find($id);

        $post->tags()->detach();

        $post->delete();
        \Session::flash('success','Post Successfully Deleted');

        return redirect()->route('posts.index');
    }
}
