<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function single_news()
    {
        $categories = Category::with('news')->get(); 
        $news = News::where('id', '=', 2)->first();
        $prevNews = News::where('id', '=', 1)->first();
        $nextNews = News::where('id', '=', 1)->first();
        $user = auth()->user();
        return view('frontend.website.single_news', compact('news', 'prevNews','nextNews',  'user'));
    }

    public function get_news(Request $request, $id)
    {
        $categories = Category::with('news')->get(); 
        $news = News::findOrFail($id); 
        $prevNews = News::where('id', '<', $news->id)->orderBy('id', 'desc')->first();
        $nextNews = News::where('id', '>', $news->id)->orderBy('id', 'asc')->first();
        $prevNews = $prevNews ?? News::find($id);
        $nextNews = $nextNews ?? News::find($id);
        $user = $news->user;
        return view('frontend.website.single_news', compact('news', 'prevNews', 'nextNews', 'user', 'categories'));
    }
    
    public function get_home() {
        $categories = Category::with('news')->get(); 
        $news = News::with('categories', 'user')->orderBy('published_at', 'desc')->get();
        return view('frontend.website.index', compact('news', 'categories'));
    }

    public function get_categories() {
        $category = Category::with('categories', 'user')->orderBy('published_at', 'desc')->get();
        return view('frontend.website.index', compact('category'));
    }
}
