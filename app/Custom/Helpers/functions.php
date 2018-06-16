<?php


function getPaginateSize() {
    return config('app.paginate_size');
}


function normal_case($string)
{
    return ucwords(str_replace('_', ' ', $string));
}

function faker() {
    return Faker\Factory::create();
}

function is_json($string,$assoc=false){
    try{
        $v = json_decode($string,$assoc);
        return (json_last_error()===JSON_ERROR_NONE)?$v:false;
    }
    catch(\Exception $e){return false;}
}

function json_failure () {

}