<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Posts;
use App\Products;
use App\Category;
use App\Tags;


class SitemapController extends Controller
{
    //
    public function index()
	{
		$posts 		= Posts::all()->first();
		$categories = Category::all()->first();
		$products 	= Products::all()->first();
		$tags 		= Tags::all()->first();
		return response()->view('sitemap.index', [
			'posts' 		=> $posts,
			'categories' 	=> $categories,
			'products' 		=> $products,
			'tags' 			=> $tags,
			])->header('Content-Type', 'text/xml');
	}
	public function posts()
	{
        $posts = Posts::latest()->get();
        return response()->view('sitemap.posts', [
            'data' => $posts,
        ])->header('Content-Type', 'text/xml');
	}

	public function categories()
	{
        $categories = Category::all();
        return response()->view('sitemap.categories', [
            'data' => $categories,
        ])->header('Content-Type', 'text/xml');
	}

	public function products()
	{
        $products = Products::latest()->get();
        return response()->view('sitemap.products', [
            'data' => $products,
        ])->header('Content-Type', 'text/xml');
	}

	public function tags()
	{
        $tags = Tags::all();
        return response()->view('sitemap.tags', [
            'data' => $tags,
        ])->header('Content-Type', 'text/xml');
	}
	//---

}
