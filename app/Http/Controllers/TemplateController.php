<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime,File,Input,DB; 
use App\Template;
use App\Category;
use App\myclass\Slug;
 
class TemplateController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Template = Template::paginate(10); 
        return view('backend.Template.list', ['data'=> $Template] );
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
        return view('backend.Template.add', ['category'=>$category ] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = new Template(); 
        $slug       = new Slug();
        $template->category_id = $request->category;
        $template->title = $request->title;;
        $template->keyword = $request->keyword;
        $template->description = $request->description;
        $template->content = $request->content;
        $template->slug = $slug->createSlug($request->title,0,'Template');
        if($request->hasfile('photo')){
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Template/', $filename
            );
            $template->photo = $filename;
        }
        $template->save();
        return redirect('admin/template');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  Template::find($id)->category;
        $Template = $category->Template;
        foreach($Template as $template){
        }        
        // $user->Template()->where('active', 1)->get();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);
        $category = Category::all();
        return view('backend.Template.edit',['data'=>$template,'category'=>$category]);
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
        $template = Template::find($id);
        $slug       = new Slug();
        if ($request->hasFile('photo')) {
            $filename=$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(
                base_path() . '/public/upload/Template/', $filename
            );
            $template->photo = $filename;
        }
        $template->category_id = $request->category;
        $template->title = $request->title;
        $template->keyword = $request->keyword;
        $template->description = $request->description;
        $template->content = $request->content;
        
        if ($template->slug != $request->slug) { 
            $template->slug = $slug->createSlug($request->title, $id,'Template');
        }

        $template->save();
        //return redirect('admin/post');
        return redirect()->route('backend.listtemplate')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thành công!!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $template = Template::find($id);
        $template->delete(); 
        return redirect()->route('backend.listtemplate')->with(['message'=> 'Successfully deleted!!']);
    }
    public function popular_post(){        
        $popular = DB::table('Template')->orderBy('view','DESC')->limit(5)->get();
        view()->share('popular', $popular);
    }
    public function post_of_all()
    {
        $category   = Category::all();
        $Template      = Template::where('status',1)->orderBy('title','ASC')->paginate(10);
        $this->popular_post();
        return view('fontend.Template.list', [
                    'data'  => $Template,
                    'category'=>$category
                ]);
    }
    public function show_detail($slug)
    {
        $category   = Category::all(); 
        $template       = Template::where('slug', $slug)->firstOrFail();
        $parent     = $template->category;
        $template_same  = $parent->Template;
        $tags       = $parent->tag!=''? explode(',',$parent->tag ):'';
        $this->popular_post();
        
        $other       = Template::where('id','<>', $template->id)->paginate(5);

        return view('fontend.Template.detail', [
            'data'  => $template, 'parent'=> $parent, 'tags'  =>$tags,
            'category'=>$category, 'post_same'=>$template_same, 'other'=>$other
        ]);
    }
    
    
}

   
 
