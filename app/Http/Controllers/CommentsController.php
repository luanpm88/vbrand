<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = comments::paginate(10); 
        return view('backend.comments.list', ['data'=> $comments] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.comments.add' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function active( $id)
    {
        $comments = comments::find($id);
        $comments->active = 1;
        $comments->save();
        return redirect('backend.listcomments')->with(['messenge'=>'Active Successfully']);
    }
    public function deactive( $id)
    {
        $comments = comments::find($id);
        $comments->active = 0;
        $comments->save();
        return redirect('backend.listcomments')->with(['messenge'=>'DeActive Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comments = comments::find($id);  
        return view('backend.comments.edit',['data'=>$comments]);
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
        $comments = comments::find($id);
        $comments->title = $request->title;;
        $comments->keyword = $request->keyword;
        $comments->description = $request->description;
        $comments->content = $request->content;
        $comments->save();
        return redirect('admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $comments = comments::find($id);
        $comments->delete(); 
        return redirect()->route('listcomments')->with(['message'=> 'Successfully deleted!!']);
    }
}
