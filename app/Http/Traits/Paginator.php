<?php
namespace App\Http\Traits;
use Illuminate\Pagination\LengthAwarePaginator;

trait Paginator{
    public function paginateQuery($query,$page,$perPage=5){
        $count  = $query->count();
        $ret=$query->limit($perPage)->offset($perPage * ($page -1))->get();
        return new LengthAwarePaginator($ret, $count, $perPage, $page);
    }

}
