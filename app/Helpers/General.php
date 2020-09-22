<?php


//function show_name()
//{
//    return "bian bahaa";
//}

use Illuminate\Support\Facades\Config;

function get_Languages()
{
   // \App\Models\Language::active()->select('id','name','abbr','direction')->get();
    // هحسن من الكود بتاعي واشيل ال select دي كلها وهعوض هنها
  return   \App\Models\Language::active() -> Selection() ->get();
}

function get_default_language()
{
    return Config::get('app.locale');
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}