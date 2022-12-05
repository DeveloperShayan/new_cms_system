<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {
        $posts = auth()->user()->posts()->paginate(5);
        // $posts = Post::all();
        return view('admin.posts.index',['posts'=>$posts]);
    }

 
    public function create()
    {

        return view('admin.posts.create');

    }
    
    public function show(post $post)
    {
        // $post = Post::findOrFall();
        return view('blog-post',['post'=>$post]);
    }


    public function store(Request $request)
    {
        $this->authorize('create',Post::class);
       $inputs = request()->validate([

                    'title'          => 'required|min:8|max:255',
                    'post_image'     => 'file',
                    'body'           => 'required|min:10|' 

                 ]);
        
        if (request('post_image')) {
            
            $inputs['post_image'] = request('post_image')->store('images');

        }

        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message','Post has Created');
        return redirect()->route('post.index');

    }


    public function edit(Post $post)
    {
        $this->authorize('view',$post);
        return view('admin.posts.edit',['post'=>$post]);
    }

    public function update(Post $post)
    {
       $inputs = request()->validate([

                    'title'          => 'required|min:8|max:255',
                    'post_image'     => 'file',
                    'body'           => 'required|min:10|' 

                 ]);
        
        if (request('post_image')) {
            
            $inputs['post_image'] = request('post_image')->store('images');

        }

        $post->title = $inputs['title'];
        // $post->post_image = $inputs['post_image'];
        $post->body = $inputs['body'];

        $this->authorize('update',$post);
        $post->save();
        // auth()->user()->posts()->save($post);
        session()->flash('post-updated-message','Post has updated');

        return redirect()->route('post.index');


    }


    public function destroy(Post $post, Request $request)
    {
        $this->authorize('delete',$post);
        $post->delete();
        
        // Session::flash('message','Post has been deleted');
        $request->session()->flash('message','Post has been deleted');
        
        return back();

    }



}
