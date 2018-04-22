<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Article;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'category')->get();
        //dd($categories);
        return view('write_post.write', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $articles = new Article;

        $detail = $request->content;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getelementsbytagname('img');

        /*
        * convert base64 image to filepath
        */
        foreach($images as $i => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';',$data);
            list(, $data) = explode(',',$data);

            $data = base64_decode($data);
            $images_name = time().$i.'.png';
            $path = public_path().'/'.'images'.'/'.$images_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src','/images/'.$images_name);
        }
        $detail = $dom->savehtml();

        $this->validate($request, [
            'chooseCategory'=>'required|not_in:0',
            'title'=>'required',
            'content'=>'required'
        ]);

        $articles->category_id = $request->chooseCategory;
        $articles->user_id = '1';
        $articles->title = $request->title;
        $articles->content = $detail;
        $articles->save();
        //dd($articles);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
