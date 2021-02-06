<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime,File,Input,DB; 
use App\Posts;
use App\Category;
use App\myclass\Slug;
 
class PostsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = posts::paginate(10);
        return view('backend.Post.list', ['data'=> $posts] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        //echo "<pre>";print_r($category);echo "</pre>";
        return view('backend.Post.add', ['category'=>$category ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new posts(); 
        $slug       = new Slug();
        $post->category_id = $request->category;
        $post->title = $request->title;;
        $post->keyword = $request->keyword;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->slug = $slug->createSlug($request->title,0,'Posts');
        if($request->hasfile('photo')){
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Post/', $filename
            );
            $post->photo = $filename;
        }
        $post->save();
        return redirect('admin/posts');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  Posts::find($id)->category;
        $posts = $category->posts;
        foreach($posts as $post){
        }        
        // $user->posts()->where('active', 1)->get();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = posts::find($id);
        $category = Category::all();
        return view('backend.Post.edit',['data'=>$post,'category'=>$category]);
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
        $post = posts::find($id);
        $slug       = new Slug();
        if ($request->hasFile('photo')) {
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Post/', $filename
            );
            $post->photo = $filename;
        }
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->keyword = $request->keyword;
        $post->description = $request->description;
        $post->content = $request->content;
        
        if ($post->slug != $request->slug) { 
            $post->slug = $slug->createSlug($request->title, $id,'Posts');
        }

        $post->save();
        //return redirect('admin/post');
        return redirect()->route('backend.listposts')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $post = posts::find($id);
        $post->delete(); 
        return redirect()->route('backend.listposts')->with(['message'=> 'Successfully deleted!!']);
    }
    public function popular_post(){        
        $popular = DB::table('posts')->orderBy('view','DESC')->limit(5)->get();
        view()->share('popular', $popular);
    }
    public function post_of_all()
    {
        $category   = Category::all();
        $posts      = Posts::where('status',1)->orderBy('title','ASC')->paginate(10);
        $this->popular_post();
        return view('fontend.Posts.list', [
                    'data'  => $posts,
                    'category'=>$category
                ]);
    }
    public function show_detail($slug)
    {
        $category   = Category::all(); 
        $post       = Posts::where('slug', $slug)->firstOrFail();
        $parent     = $post->category;
        $post_same  = $parent->posts;
        $tags       = $parent->tag!=''? explode(',',$parent->tag ):'';
        $this->popular_post();
        
        $other       = Posts::where('id','<>', $post->id)->paginate(5);

        return view('fontend.Posts.detail', [
            'data'  => $post, 'parent'=> $parent, 'tags'  =>$tags,
            'category'=>$category, 'post_same'=>$post_same, 'other'=>$other
        ]);
    }
    
}
