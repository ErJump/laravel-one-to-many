<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    protected $validationArray = [
        'title' => 'required|string|max:255',
        'post_content' => 'required|string',
        'post_image' => 'required|active_url',
        'category_id' => 'required|integer',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        return view('admin.posts.create', compact('post', 'categories'),);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->validationArray);
        $post = new Post();
        $lastPostId = Post::orderBy('id', 'desc')->first();
        $data['user_id'] = Auth::user()->id;
        $data['post_date'] = new DateTime();
        $data['slug'] = Str::slug($data['title'], '-'). '-' . ($lastPostId->id + 1);
        $post->fill($data);
        $post->save();
        return redirect()->route('admin.posts.index')->with('result-message', '"'.$data['title'].'" successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = $request->validate($this->validationArray);
        $post = Post::where('slug', $slug)->firstOrFail();
        $data['user_id'] = $post->user->id;
        $data['post_date'] = $post->post_date;
        $data['slug'] = Str::slug($data['title'], '-'). '-' . $post->id;
        $post->update($data);
        return redirect()->route('admin.posts.index')->with('result-message', '"'.$data['title'].'" successfully modified');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post= Post::where('slug', $slug)->firstOrFail();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('result-message', '"'.$post->title.'" successfully removed');
    }
}
