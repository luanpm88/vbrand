<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime,File,Input,DB; 
use App\myclass\Slug;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    private function make_slug($categories){
         $slug       = new Slug();
        foreach ($categories as $cate) {
            $cate->slug     = $slug->createSlug($cate->title);
            $cate->save();
        }
    }
    public function index()
    {
        $category = Category::paginate(10);  
        return view('backend.Category.list', ['data'=> $category] );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$category = Category::where('parent','<',1); 
        $category = DB::table('category')->where('parent','<',1); 
        
        return view('backend.Category.add', ['category'=>$category ] ); 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug       = new Slug();
        $category = new Category();
        $category->title = $request->title;
        $category->slug     = $slug->createSlug($request->title);
        $category->keyword = $request->keyword;
        $category->description = $request->description;
        $category->content = $request->content;
        $category->home = $request->home;
        $category->parent = $request->parent;
        $category->save(); 
        return redirect()->route('backend.listcategory')->with(['messenge'=> 'Add New Successfully !!']);
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
        $parent = Category::where('parent','<',1);
        $category = Category::find($id);  
        return view('backend.Category.edit',['data'=>$category,'parent'=>$parent]);
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
        $slug       = new Slug();
        $category = Category::find($id);
        $category->title = $request->title;
        if ($category->slug != $request->slug) {
            $category->slug = $slug->createSlug($request->slug, $id);
        }
        $category->keyword = $request->keyword;
        $category->description = $request->description;
        $category->content = $request->content;
        $category->home = $request->home;
        $category->parent = $request->parent;
        $category->save(); 
        return redirect()->route('backend.listcategory')->with(['messenge'=> 'Update Successfully !!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $category = Category::find($id);
        if($category){
            $category->delete();
        }        
        return redirect()->route('backend.listcategory')->with(['messenge'=> 'Successfully deleted!!']);
    }

    public function switchhome(Request $request)
    {
        $category   = Category::find($request->catID);
        if($category){
            if($request->status=='true')
                $category->home = 1;
            else
                $category->home = 0;
            $category->save();
            return response()->json(['msg' => "successfully...!"], 200);
        } 
        return response()->json(['msg' => 'No result found!'], 404);
    }

}
