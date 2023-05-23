<?php
namespace App\Http\Controllers;
use App\Models\ab_article;
use App\Models\ab_shoppingcart;
use App\Models\ab_shoppingcart_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShoppingcartController extends Controller
{
    //
    public function index_api(){
        $query = ab_shoppingcart::query()
            ->where('ab_shoppingcart.ab_creator_id','=',session('abalo_id'))
            ->join('ab_shoppingcart_item as cart_item','cart_item.ab_shoppingcart_id','=','ab_shoppingcart.id')
            ->join('ab_article as article','article.id','=','cart_item.ab_article_id')
            ->select('article.*','cart_item.ab_createdate as date','ab_shoppingcart.id as shoppingcartId')
            ->orderBy('cart_item.ab_createdate','desc');
        return response()->json(array('cart-items'=>$query->get()));
    }
    public function store_api(Request $request){
        $shoppingcart = ab_shoppingcart::query()->where('ab_creator_id','=',session('abalo_id'))->get();
        $shoppingcart_id=$shoppingcart->value('id');
        if($shoppingcart->isEmpty()){
            $shoppingcart = new ab_shoppingcart();
            $shoppingcart->ab_creator_id=session('abalo_id');
            $shoppingcart->ab_createdate=now();
            $shoppingcart->save();
            $shoppingcart_id=$shoppingcart->id;
        }
        $item=ab_shoppingcart_item::query()->where('ab_article_id','=',$request->input('id'))->get();
        if($item->isEmpty()){
            $shoppingcartItem=new ab_shoppingcart_item();
            $shoppingcartItem->ab_shoppingcart_id=$shoppingcart_id;
            $shoppingcartItem->ab_article_id=$request->input('id');
            $shoppingcartItem->ab_createdate=now();
            $shoppingcartItem->save();
            return response()->json([
                'shoppingCartId' => $shoppingcart_id,
                'articleId'=> $shoppingcartItem->ab_article_id
            ]);
        }else{
            return response()->json(['errors' => 'Artikel nicht verfügbar.']);
        }
    }

    public function destroy_api($shoppingcartid, $articleId){
        ab_shoppingcart_item::query()
            ->where('ab_shoppingcart_id','=',$shoppingcartid)
            ->where('ab_article_id','=',$articleId)
            ->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
