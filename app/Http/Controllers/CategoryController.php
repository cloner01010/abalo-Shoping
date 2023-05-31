<?php

namespace App\Http\Controllers;

use App\Models\ab_articlecategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index_api(){
        $query=ab_articlecategory::query()->
            leftJoin('ab_articlecategory as parent','parent.id','=','ab_articlecategory.ab_parent')
            ->select('ab_articlecategory.*','parent.ab_name as parent')
            ->orderBy('ab_name')
            ->get();
        return response()->json($this->buildSubMenu($query));
    }

    public function buildSubMenu($categories, $parentId = null)
    {
        $submenu = [];

        foreach ($categories as $category) {
            if ($category['ab_parent'] === $parentId) {
                $submenuItem = [
                    'label' => $category['ab_name'],
                    'link' => '#'
                ];

                $children = $this->buildSubMenu($categories, $category['id']);

                if (!empty($children)) {
                    $submenuItem['submenu'] = $children;
                }

                $submenu[] = $submenuItem;
            }
        }

        return $submenu;
    }



}
