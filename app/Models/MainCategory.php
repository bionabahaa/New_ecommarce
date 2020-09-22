<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\MainCategoryObserver;
use App\Models\SubCategory;

class MainCategory extends Model
{
    use HasFactory;

    protected $table = 'main_categories';


    protected $fillable = [

     'name','translation_lang', 'translation_of','local','slug','created_at','updated_at','active','photo'
    ];

    public function scopeActive($query)
    {
       return $query->where('active',1);
    }

    public function scopeSelection($query)
    {
        return $query->select('id','name','slug','photo','active','translation_lang','translation_of');
    }

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }


    public function getphotoAttribute($val)
    {
        // هنا معناها لو الصوره موجوده رجعلي ال PATH بتاعها غير كده سيبها فاضيه
        return ($val !== null) ? asset('assets/' . $val) : "";

    }


    // get all translation categories
    public function categories()
    {
        return $this->hasMany(self::class, 'translation_of');
    }



    public function vendors(){

        return $this -> hasMany('App\Models\Vendor','category_id','id');
    }


    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }


    public function scopeDefaultCategory($query){
        return  $query -> where('translation_of',0);
    }


    public  function subCategories(){
        return $this -> hasMany(SubCategory::class,'category_id','id');
    }
}
