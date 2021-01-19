<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime,File,Input,DB;
use App\Photo;
use App\Posts;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Photo = Photo::paginate(10); 
        return view('backend.Photo.list', ['data'=> $Photo] );
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
        return view('backend.Photo.add', ['posts'=>$posts ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Photo = new Photo();
        $Photo->post_id = $request->post;
        $Photo->title   = $request->title;;
        $Photo->keyword = $request->keyword;
        $Photo->description = $request->description;
        $Photo->link = $request->link;
        if($request->hasfile('photo')){
            $filename = $request->file('photo')->getClientOriginalName(); 
             $request->file('photo')->move(
                base_path() . '/public/upload/Photo/', $filename
            );
            $Photo->src = $filename;
        }
        $Photo->save();
        return redirect('admin/photo');
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
        $Photo = Photo::find($id);
        $posts = Posts::all();
        return view('backend.Photo.edit',['data'=>$Photo,'posts'=>$posts]);
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
        $Photo = Photo::find($id);
        
        if ($request->hasFile('photo')) {
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Photo/', $filename
            );
            $Photo->src = $filename;
        }
        $Photo->post_id = $request->post;
        $Photo->title = $request->title;
        $Photo->keyword = $request->keyword;
        $Photo->description = $request->description;
        $Photo->link = $request->link;
        $Photo->save();
        //return redirect('admin/Photo');
        return redirect()->route('listphoto')->with(['messege'=>'Cập nhật thành công!!!']);
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
        return redirect()->route('listphoto')->with(['message'=> 'Successfully deleted!!']);
    }
}
