<?php

namespace Database\Seeders;

use App\Models\ab_article;
use App\Models\ab_articlecategory;
use App\Models\ab_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DevelopmentData extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ab_user::query()->truncate();
        ab_article::query()->truncate();
        ab_articlecategory::query()->truncate();
        $csv_dateien=['user','articles','articlecategory'];
        foreach ($csv_dateien as $csv_datei){
            try {
                $csv_input = fopen(base_path("database/DevelopmentData/".$csv_datei.'.csv'), "r");
            }catch (\Exception $ex){
                Log::error(__CLASS__.'-'.__LINE__.':'.$ex->getMessage());
            }
            $firstline = true;
            while (($data = fgetcsv($csv_input, 2000, ";")) !== FALSE) {
                if (!$firstline) {
                   switch ($csv_datei){
                       case 'user':
                           $new_user=new ab_user;
                           $new_user->ab_name=$data['1'] ;
                           $new_user->ab_password=Hash::make($data['2']);
                           $new_user->ab_mail=$data['3'] ;
                           $new_user->save();
                           break;
                       case 'articles':
                            $article=new ab_article;
                            $article->ab_name=$data['1'];
                            $article->ab_price=intval($data['2']);
                            $article->ab_description=$data['3'];
                            $article->ab_creator_id=intval($data['4']);
                            $article->ab_createdate= $data['5'];
                            $article->save();

                           break;
                       case 'articlecategory':
                           $ab_articlecategory=new ab_articlecategory;
                           $ab_articlecategory->ab_name=$data['1'];
                           $ab_articlecategory->ab_parent=$data['2']!='NULL'?intval($data['2']):null;
                           $ab_articlecategory->save();
                           break;
                       default:
                           break;
                   }
                }
                $firstline = false;
            }
            fclose($csv_input);
        }
    }
}
