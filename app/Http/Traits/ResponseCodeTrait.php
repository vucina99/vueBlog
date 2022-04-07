<?php

namespace App\Http\Traits;

trait ResponseCodeTrait{
    public function success($data){
        return response()->json(["code" =>200 , "data" => $data]);
    }

    public function error($code, $data){
        return response()->json(["code" =>$code , "data" => $data]);
    }
}