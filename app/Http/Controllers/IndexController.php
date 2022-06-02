<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IndexController extends Controller
{
 public function index(){
     $products =  Http::withHeaders([
         'Content-Type'=>'application/json',
         'X-Shopify-Access-Token'=>'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',
         'Authorization'=>'Basic Og=='
     ])->get('https://e4cd4a95f3fe2ec2da7fac639da52402:f4816e0d6c56e729ce668202eb0598f8@sellenvoinc.myshopify.com/admin/api/2022-04/products.json');
     $products =json_decode($products);

     $result = [];
     foreach ($products->products as $product ){
         $res=[];
         foreach ($product as $p_K=>$p_v ){
             if (is_array($p_v)){

                 $in = [];
                 foreach ($p_v as $val){
                     foreach ($val as $n=>$k){

                         if (is_null($k)|| $k==null){

                         }
                         else{

                             $e= [];
                             $e[$n]=$k;

                             $in[$n] =$k;

                         }
                     }

                 }



                 array_push($res,$in);
             }
             else{
                 if ($p_v==''){

                 }else{
                     $arr =[];
                     $arr[$p_K]=$p_v;
                     $res[$p_K]=$p_v;
                 }
             }

         }
         array_push($result,$res);

     }
     return $result;
 }
}
