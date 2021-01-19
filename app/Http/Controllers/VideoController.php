<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime,File,Input,DB; 
use App\Video;
use App\Posts;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::paginate(10); 
        return view('backend.Video.list', ['data'=> $video] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = posts::all();
        //echo "<pre>";print_r($category);echo "</pre>";
        return view('backend.Video.add', ['posts'=>$posts ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = new Video();
        $video->post_id = $request->post;
        $video->title   = $request->title;;
        $video->keyword = $request->keyword;
        $video->description = $request->description;
        $video->code = $request->code;
        if($request->hasfile('photo')){
            $filename = $request->file('photo')->getClientOriginalName(); 
             $request->file('photo')->move(
                base_path() . '/public/upload/Video/', $filename
            );
            $video->src = $filename;
        }
        $video->save();
        return redirect('admin/video');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  Photo::find($id)->category;
        echo $category->title."<br />";
        $Photo = $category->Photo;
        foreach($Photo as $Product){
            echo $Product->title."<br />";
        }
        // $user->Photos()->where('active', 1)->get();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $posts = Posts::all();
        return view('backend.Video.edit',['data'=>$video,'posts'=>$posts]);
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
        $video = Video::find($id);
        
        if ($request->hasFile('photo')) {
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Photo/', $filename
            );
            $video->src = $filename;
        }
        $video->post_id = $request->post;
        $video->title = $request->title;
        $video->keyword = $request->keyword;
        $video->description = $request->description;
        $video->code = $request->code;
        $video->save();
        //return redirect('admin/Photo');
        return redirect()->route('listvideo')->with(['messege'=>'Cập nhật thành công!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Photo = Photo::find($id);
        $Photo->delete(); 
        return redirect()->route('listvideo')->with(['message'=> 'Successfully deleted!!']);
    }
}
