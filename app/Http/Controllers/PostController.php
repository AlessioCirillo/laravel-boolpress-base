<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get(); 

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // GET FROM DATA
        $data = $request->all();
        // dump($data);

        // VALIDATION
        // $request->validate([
            //     'title' => 'required',
            //     'body' => 'required',
            //     'path_img' => 'image'
            // ]);
        $request->validate($this->ruleValidation());

        // SETTARE SLUG
        $data['slug'] = Str::slug($data['title'], '-');
        // dd($data);

        // SE IMG è PRESENTE
        if(!empty($data['path_img'])){
            $data['path_img'] = Storage::disk('public')->put('images/' , $data['path_img']);
        }

        // SALVARE A DB
        $newPost = new Post();
        $newPost->fill($data);

        $saved = $newPost->save();

        // SE SALVATO RITORNO ALLA VISTA
        if($saved){
            return redirect()->route('posts.index');
        } else{
            return redirect()->route('homepage');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug' , $slug)->first();

        return view('posts.show' , compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        
        return view('posts.edit' , compact('post'));
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
        // GET DATA FORM FORM
        $data = $request->all();

        // VALIDAZIONE
        $request->validate($this->ruleValidation());

        // get post to update
        $post = Post::find($id);

        // SLUG
        $data['slug'] = Str::slug($data['title'], '-');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // REGOLE DI VAIDAZIONE
    private function ruleValidation(){
        return [
            'title' => 'required',
            'body' => 'required',
            'path_img' => 'image'
        ];
    }
}
