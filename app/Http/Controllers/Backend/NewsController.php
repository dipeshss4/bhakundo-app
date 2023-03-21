<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\service\NewsService;
use App\Models\Author;
use App\Models\News_Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $newService;
    public function __construct(NewsService $newService)
    {
        $this->newService=$newService;
    }

    public function index()
    {
        $news=$this->newService->getAllNews();
        return view('pages.news.index-news',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $authors =   Author::with('user')->whereHas('user', function($query) {
            $query->whereHas('roles', function($query) {
                $query->where('name', 'editor');
            });
        })->where('status',1)->get();
        $newsCategory= News_Category::where('status',1)->get();
        return  view('pages.news.create-news',compact('authors','newsCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
      $news = $this->newService->addNews($request);
      if ($news){
          return redirect()->route('news.index')->with('success','News Successfully Created');
      }
      else{
          return redirect()->back()->with('error','Cannot Create News');
      }
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
