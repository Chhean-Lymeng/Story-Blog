<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsAlbum;
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
        $input = $request->except('pictures', 'primary');
        $input['thumbnail'] = $fileNameToStore;
        $input['status'] = $request->has('status');
        $input['count_album'] = $request->pictures ? count($request->pictures) : 0;
        $news = News::create($input);
        if ($news) {
            if ($input['count_album'] != 0) {
                $pictures = $request->pictures;
                $album_images = [];
                foreach ($pictures as $index => $picture) {
                    $album_images[] = new NewsAlbum([
                        'name' => $picture,
                        'primary' => $picture == $request->primary ? 1 : 0,
                        'orderby' => $index + 1,
                    ]);
                }
                $news->news_albums()->saveMany($album_images);
            }
            return redirect()->route('news.index')->with('message', 'News created successfully!');
        }
        return redirect()->route('news.index')->with('error', 'Something went wrong while creating the news.');
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
        return view('frontend.website.single_news', compact('news', 'prevNews', 'nextNews', 'user'));
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
        $input = $request->except('pictures', 'primary');
        $primary_image = $request->primary;
        $input['count_album'] = $request->pictures ? $news->count_album + count($request->pictures) : $news->count_album + 0;
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
        $newss = $news->update($input);

        if ($newss) {
            $pictures = $request->pictures;
            if ($pictures) {
                $album_images = [];
                $currentCount = NewsAlbum::where('news_id', $id)->count();
                foreach ($pictures as $index => $picture) {
                    $album_images[] = new NewsAlbum([
                        'name' => $picture,
                        'primary' => $picture == $request->primary ? 1 : 0,
                        'orderby' => $currentCount + $index + 1,
                    ]);
                }
                $params->news_albums()->saveMany($album_images);
            } else {
                $album_images = NewsAlbum::where('news_id', '=', $id)->get();
                foreach ($album_images as $image) {
                    $image->primary = 0;
                    $image->save();
                }

                $checked = $album_images->where('name', $primary_image)->first();
                if ($checked !== null) {
                    $checked->primary = 1;
                    $checked->save();
                }
            }

            return redirect(route('news.index'))->with('message', 'News updated');
        }

        return redirect(route('news.index'))->with('error', 'News not updated');
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

    public function togglePin(Request $request)
    {
        $news = News::find($request->id);
        if (empty($news->file)) {
            $news->pin = $news->pin == 1 ? 0 : 1;
            if ($news->pin == 1) {
                $news->pinned_at = now();
            } else {
                $news->pinned_at = null;
            }
            $update = $news->save();

            if ($update) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'message' => $news->pin ? 'News Pinned.' : 'News Unpinned.',
                ]);
            }
        }
        return response()->json([
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'Something went wrong.',
        ]);
    }

    public function search_news(Request $request)
    {
        $categories = Category::where('status', '=', true)->get();
        $news = News::where('category_id', '=', $request->categoryId)->orderBy('orderby', 'desc')->get();
        if ($request->categoryId == 0) {
            $news = News::get();
        }
        return view('frontend.news.index', compact('news', 'categories'))->render();
    }

    public function pushed(Request $request)
    {
        $news = News::find($request->id);
        $update = $news->update(['send' => 1]);
        if ($update) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Notification sent.',
            ]);
        }
        return response()->json([
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'Something wrong',
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->ajax() && $request->hasFile('file')) {
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('file')->storeAs('public/image/news/albums', $fileNameToStore);
        }
        return response()->json(['filePath' => $fileNameToStore]);
    }

    public function remove(Request $request)
    {
        if ($request->ajax()) {
            Storage::delete('public/image/news/albums/' . $request->name);
            return response()->json('success');
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request['id'];
            $news_id = $request['news_id'];
            $file_name = $request['name'];
            $params = News::where('id', $news_id)->firstOrFail();
            $count = $params['count_album'] - 1;
            News::where('id', $news_id)->update(['count_album' => $count]);
            Storage::delete('public/image/news/albums/' . $file_name);
            $isDeleteFromDB = NewsAlbum::destroy($id);
            if ($isDeleteFromDB) {
                $galleries = NewsAlbum::all();
                $checked = $galleries->where('primary', 1)->first();
                if ($checked == null) {
                    $galleries[0]['primary'] = 1;
                    $galleries[0]->save();
                }
                return response()->json('success');
            }
        }
    }

    public function count_order(Request $request)
    {
        $count_order = News::where('category_id', '=', $request->categoryId)->count();
        if ($request->categoryId == 0) {
            $count_order = News::join('categories', 'news.category_id', '=', 'categories.id')->count();
        }
        return response()->json(['count_order' => $count_order]);
    }

    public function updateOrder(Request $request)
    {
        $data = $request->all();
        foreach ($data['albums'] as $album) {
            NewsAlbum::where('id', $album['id'])->update(['orderby' => $album['order'] + 1]);
        }
        return response()->json(['status' => 'success']);
    }
}
