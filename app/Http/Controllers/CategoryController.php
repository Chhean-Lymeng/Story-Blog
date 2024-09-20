<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $count_order = Category::count();
        return view('categories.create', compact('count_order'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255', // updated to match form field 'name'
            'image' => 'required|image|max:2048', // added validation for image type
            'orderby' => 'required', // added validation for 'orderby'
        ], [
            'name.required' => 'Name is required.',
            'image.required' => 'Image is required.',
            'name.max' => 'Name can only be up to 255 characters.',
            'orderby.required' => 'Order By is required.',
        ]);

        // Handling file upload
        if ($request->hasFile('image')) {
            $fileNameToStore = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/image/categories', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.png'; // Default image if none provided
        }

        // Inserting data
        $input = $request->all();
        $input['image'] = $fileNameToStore;
        $input['status'] = $request->has('status'); // handle status toggle
        $category = Category::create($input);

        if ($category) {
            return redirect()->route('categories.index')->with('message', 'Category created successfully.');
        }
        return redirect()->route('categories.index')->with('error', 'An error occurred.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::where('id', '=', $id)->first();
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255', // updated to match form field
            'orderby' => 'required|integer', // added validation for 'orderby'
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name can only be up to 255 characters.',
            'orderby.required' => 'Order By is required.',
        ]);

        $category = Category::findOrFail($id);
        $input = $request->all();

        // Handle file upload if there's a new image
        if ($request->hasFile('image')) {
            $fileNameToStore = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/image/categories', $fileNameToStore);

            // Delete old image
            Storage::delete('public/image/categories/' . $category->image);
            $input['image'] = $fileNameToStore;
        }

        $input['status'] = $request->has('status'); // handle status toggle
        $category->update($input);

        return redirect()->route('categories.index')->with('message', 'Category updated successfully.');
    }

    public function destroy(Request $request)
    {
        $categories = Category::find($request->id);
        if ($categories->image) {
            Storage::delete('public/image/categories/' . $categories->image);
        }
        if ($categories->delete()) {
            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Category is deleted',
            ]);
        } else {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Something wrong',
            ]);
        }
    }
}
