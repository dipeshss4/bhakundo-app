<?php 

namespace App\Http\Controllers\UI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\service\NewsService;
use Auth;
class UIController extends Controller {
    

    private $requestURI  = "/";
    private $metas = ["title"=> "Welcome to Bhakundo", "desc" => "A site for all football fanactics", "image" => "", "url" => "/", "metaDesc" => "", "type" => ""];

    public function injectMeta(Request $request) {
        $this->requestURI = $request->fullUrl();
        $this->metas['url'] = $this->requestURI;
        $this->injectNewsArticleMeta($request);
        $meta = $this->metas;
        return view('ui', compact('meta'));
    }

    private function injectNewsArticleMeta (Request $request) {
        
        if(str_contains($this->requestURI, "/article/")){
            $reqid = $request->id;
            $news = News::find($reqid);
            $this->metas['title'] = $news->title;
            $this->metas['desc'] = strlen($news->content) > 26 ? substr($news->content) : $news->content . "...";
            $this->metas['image'] = $news->image_url;
            $this->metas['type'] = "article";
            $this->metas['metaDesc'] = $news->meta_description;
        }
    
    }

}