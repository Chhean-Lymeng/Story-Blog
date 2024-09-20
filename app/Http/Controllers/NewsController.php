<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $news = News::with('categories')->get();
        return view('news.index', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::all(); 
        $count_order = News::count();
        return view('news.create', compact('categories', 'count_order'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'categories_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image',
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Title is required.',
            'content.required' => 'Content is required.',
            'categories_id.required' => 'Category is required.',
            'categories_id.exists' => 'Selected category does not exist.',
        ]);

        $fileNameToStore = null;
        if ($request->hasFile('thumbnail')) {
            $fileNameToStore = time() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->storeAs('public/news/thumbnail', $fileNameToStore);
        }
        $input = $request->all();
        $input['thumbnail'] = $fileNameToStore;
        $input['status'] = $request->has('status');
        $news = News::create($input);

        if ($news) {
            return redirect()->route('news.index')->with('message', 'News created successfully.');
        }
        return redirect()->route('news.index')->with('error', 'An error occurred.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all(); // Fetch categories for the dropdown
        return view('news.edit', compact('news', 'categories'));
    }

    public function show(Request $request, $id)
    {
        // dd($id);
        $news = News::where('id', '=', $id)->first();
        $prevNews = News::where('id', '=', 1)->first();
        $nextNews = News::where('id', '=', 1)->first();
        $user = auth()->user();
        return view('frontend.website.single_news', compact('news', 'prevNews','nextNews',  'user' ));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
            'categories_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Title is required.',
            'content.required' => 'Content is required.',
            'categories_id.required' => 'Category is required.',
            'categories_id.exists' => 'Selected category does not exist.',
        ]);

        $news = News::findOrFail($id);
        $input = $request->all();

        // Handle file upload if there's a new thumbnail
        if ($request->hasFile('thumbnail')) {
            $fileNameToStore = time() . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->storeAs('public/news/thumbnail', $fileNameToStore);

            // Delete old thumbnail
            if ($news->thumbnail) {
                Storage::delete('public/news/thumbnail/' . $news->thumbnail);
            }
            $input['thumbnail'] = $fileNameToStore;
        }

        $input['status'] = $request->has('status');
        $news->update($input);

        return redirect()->route('news.index')->with('message', 'News updated successfully.');
    }

    public function destroy(Request $request)
    {
        $news = News::find($request->id);
        if ($news->thumbnail) {
            Storage::delete('public/news/thumbnail/' . $news->thumbnail);
        }
        if ($news->delete()) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'News item deleted successfully.',
            ]);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Something went wrong.',
            ]);
        }
    }
}
