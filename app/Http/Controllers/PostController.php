<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('post.indexArticle')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::all();
        return view('post.createArticle')->with('tags',$tags);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ]);
        $post = Post::create($request->all());
        $post->title=$request->title;
        $post->body=$request->body;
        $post->tag()->sync($request->tag,false);
        $post->save();
        return redirect('/post')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        return view('post.showArticle')->with('post',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        $tags = Tag::all();
        $tagToRelatedArray=[];
        $tagChecked=[];
        foreach ($posts->tag as $tag){
            $tagChecked[$tag["id"]]="id";
        }
        foreach($tags as $tag){
            $tagToRelatedArray[$tag->id]=$tag->name;
        }
        return view('post.editArticle')->with('post',$posts)->with('tags',$tagToRelatedArray)->with('tagChecked',$tagChecked);
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ]);
        $post = Post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->save();
        if(isset($request->tag)){
            $post->tag()->sync($request->tag);
        }
        else{
            $post->tag()->sync([]);
        }
        return redirect('/post')->with('success','Post Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->tag()->detach();
        $post->destroy($id);
        $post->save();
        return redirect('/post')->with('success','Post Removed');
    }
}
