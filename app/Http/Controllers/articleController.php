<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class articleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        $article_name=$request->get('search');
        $query=ab_article::query()
            ->leftJoin('ab_user as user','user.id','=','ab_article.ab_creator_id')
            ->select('ab_article.*','user.ab_name as user_name');
        if (isset($article_name)){
            $article=$query->where('ab_article.ab_name','ilike','%'.$article_name.'%')
                ->get();
        }else{
            $article=$query->get();
        }
       try {
           $file_names=scandir(base_path('public/storage/articleimages/'));

       }catch (\Exception $ex){
            Log::error(__CLASS__.':'.__LINE__.'-'.$ex->getMessage());
       }
       foreach ($file_names as $name){
           foreach ($article as $val){
               if($name==$val->id.'.jpg'|| $name==$val->id.'.png'){
                   $val->img=$name;
               }
           }
       }
        return view('articles', ['articles' => $article,'request'=>$request]);
    }
    public function newarticle() {
        return view('newarticle');
    }
}
