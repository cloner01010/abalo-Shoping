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

    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|string|min:1',
            'price' => 'required|numeric|min:0',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least :min characters.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be greater than :min.',
        ]);
        $new_article = new ab_article();
        $new_article->ab_name = $validatedData['name'];
        $new_article->ab_price =$validatedData['price'];
        $new_article->ab_description = request('description');
        $new_article->ab_creator_id = session('abalo_id');
        $new_article->ab_createdate = now();
        $new_article->save();
        $fileFormat = $request->file('picture')->getClientOriginalExtension();
        $picturePath = $request->file('picture')->storeAs('public/articleimages', $new_article->id .'.'.$fileFormat);
        //TODO:
        //store $picturePath in DB
        return redirect('/');
    }
}
