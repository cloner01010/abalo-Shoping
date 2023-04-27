<?php

namespace App\Http\Controllers;

use App\Models\ab_article;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class articleController extends Controller
{
    public function __construct(){
        @parent::__construct();
    }
    public function index(Request $request){
        $article_name=$request->get('search');
        $query=ab_article::query()
            ->leftJoin('ab_user as user','user.id','=','ab_article.ab_creator_id')
            ->select('ab_article.*','user.ab_name as user_name')
            ->orderBy('ab_article.ab_createdate','desc');
        if (isset($article_name)){
            $article=$query->where('ab_article.ab_name','ilike','%'.$article_name.'%')
                ->get();
        }else{
            $article=$query->get();
        }
        return view('articles', ['articles' => $article,'request'=>$request]);
    }
    public function newarticle() {
        return view('newarticle');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|string|min:1',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least :min characters.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be greater than :min.',
        ]);

        if($request->file('picture') !== null) {
            $picturePath = $request->file('picture')->store('public/articleimages');
        }else{
            $picturePath='public/articleimages/no-photo.png';
        }
        $new_article = new ab_article();
        $new_article->ab_name = $validatedData['name'];
        $new_article->ab_price =$validatedData['price'];
        $new_article->ab_description = request('description');
        $new_article->ab_creator_id = session('abalo_id');
        $new_article->ab_createdate = now();
        $new_article->ab_file_path=str_replace('public','storage' ,$picturePath);
        $new_article->save();

        //TODO:
        //store $picturePath in DB

        return redirect('/');
    }
}
