<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * Show the contact form page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::with('news')->get(); 
        $news = News::with('categories', 'user')->orderBy('published_at', 'desc')->get();
        return view('frontend.website.contact',compact( 'categories', 'news'));
    }

    /**
     * Store the contact form submission.
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());

        // Redirect back with success message
        return redirect()->route('contact.create')->with('success', 'Your message has been sent successfully!');
    }
}
