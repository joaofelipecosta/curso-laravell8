<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Raw;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post :: latest()->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->photo->isValid()) {

            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->photo->getClientOriginalExtension();

           $photo = $request->photo->storeAs('posts', $nameFile);

            $data['photo'] = $photo ;
        }

      Post::create($data);

      return redirect()
                ->route('posts.index')
                ->with('message', 'Post Criado com sucesso');
    }

    public function show($id)
    {

        // $post = Post::where('id', $id)->first();
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('posts.index');
        }
        // dd($post);
        return view('admin.posts.show', compact('post'));

    }

    public function destroy($id)
    {

        if (!$post = Post::find($id))

            return redirect()->route('posts.index');

            if (Storage::exists($post->photo))
             (Storage::delete($post->photo));

            $post->delete();

            return redirect()
            ->route('posts.index')
            ->with('message', 'Post Deletado com sucesso');

    }

    public function edit($id)
    {

        if (!$post = Post::find($id)){
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));

    }


    public function update(StoreUpdatePost $request, $id)
    {

        if (!$post = Post::find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->photo && $request->photo->isValid()) {
            if (Storage::exists($post->photo))
               (Storage::delete($post->photo));


            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->photo->getClientOriginalExtension();

            $photo = $request->photo->storeAs('posts', $nameFile);

            $data['photo'] = $photo ;
        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post atualizado com sucesso');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                            ->orWhere('content', 'LIKE', "%{$request->search}%")
                            ->paginate(1);

        return view ('admin.posts.index', compact('posts', 'filters'));

    }

}
