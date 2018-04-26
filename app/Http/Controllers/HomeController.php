<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**content */
        $articles = Article::all();

        /**end of content */

        /**headline */
        $headlines = Article::all()->sortByDesc('created_at')->first();
        $content = $headlines->content;

        $dom = new \domdocument();
        //libxml_use_internal_errors(true);
        @$dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        $separatedImg = $images->item(0)->attributes->getNamedItem("src")->value;

        $imgs = array();
        foreach ($images as $img) {
            $imgs[] = $img;
        }
        foreach ($imgs as $img) {
            $img->parentNode->removeChild($img);
        }
        $content = $dom->savehtml();
        /**end of headline */

        //dd($articlesContent);

        return view('main.main')->with(compact('headlines'))
            ->with(compact('separatedImg'))
            ->with(compact('content'))
            ->with(compact('articles'));
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
        $articles = Article::find($id);
        dd($articles);
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
