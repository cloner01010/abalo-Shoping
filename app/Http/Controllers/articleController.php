<?php

namespace App\Http\Controllers;

use App\Http\Traits\Paginator;
use App\Models\ab_article;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class articleController extends Controller
{
    use Paginator;
    public function __construct()
    {
        @parent::__construct();
    }
    public function newsite(){
        return view('newsite');
    }
    public function index(Request $request)
    {
        $article_name = $request->get('search');
        $query = ab_article::query()
            ->leftJoin('ab_user as user', 'user.id', '=', 'ab_article.ab_creator_id')
            ->leftJoin('ab_shoppingcart_item as cart-item',function ($join){
                $join->on('cart-item.ab_article_id', '=', 'ab_article.id');
            })
            ->whereNull('cart-item.id')

            ->select(
                'ab_article.*',
                'user.ab_name as user_name',

            )
            ->orderBy('ab_article.id');

        if (isset($article_name)) {
            $article = $query->where('ab_article.ab_name', 'ilike', '%' . $article_name . '%')
                ->get();
        } else {
            $article = $query->get();
        }
        return view('articles', ['articles' => $article, 'request' => $request]);
    }
    public function index_api(Request $request)
    {
        $article_name = $request->get('search');
        $query = ab_article::query()
            ->leftJoin('ab_user as user', 'user.id', '=', 'ab_article.ab_creator_id')
            ->leftJoin('ab_shoppingcart_item as cart-item',function ($join){
                $join->on('cart-item.ab_article_id', '=', 'ab_article.id');
            })
            ->whereNull('cart-item.id')

            ->select(
                'ab_article.*',
                'user.ab_name as user_name',

            )
            ->orderBy('ab_article.id');

        $query = $query->where('ab_article.ab_name', 'ilike', '%' . $article_name . '%');
        $ret= $this->paginateQuery($query,$request->input('page'));
        foreach ($ret as $item){
            $item->ab_createdate= $item->id + rand(1,30);
        }
        return $ret;
    }

    public function newarticle()
    {
        return view('newarticle');
    }

    public function store(Request $request)
    {
        $validator =
            Validator::make($request->all(), [
                'name' => 'required|string|min:1',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string|min:1'
            ], [
                    'name.required' => 'The name field is required.',
                    'name.min' => 'The name must be at least :min characters.',
                    'price.required' => 'The price field is required.',
                    'price.numeric' => 'The price must be a number.',
                    'price.min' => 'Der Preis muss größer oder gleich :min sein.',
                    'description.required' => 'The description field is required.',
                    'description.min' => 'The description must be at least :min characters.',
                ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            if ($request->file('picture') !== null) {
                $picturePath = $request->file('picture')->store('public/articleimages');
            } else {
                $picturePath = 'public/articleimages/no-photo.png';
            }
            $new_article = new ab_article();
            $new_article->ab_name = request('name');
            $new_article->ab_price = request('price');
            $new_article->ab_description = request('description');
            $new_article->ab_creator_id = session('abalo_id');
            $new_article->ab_createdate = now();
            $new_article->ab_file_path = str_replace('public', 'storage', $picturePath);
            $new_article->save();
            return response()->json(['id' => $new_article->id]);
        }
    }

}
