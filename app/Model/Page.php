<?php

namespace App\Model;

use \App\Libs\Model;

class Page extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url' ,'visibility', 'parent_id', 'queue', 'page', 'active',
    ];

    protected $defaultImage = "resources/images/icons/page.png";

    protected $imageDir = "storage/images/pages";

    public static function home(){
        return self::find(Settings::get('home_page'));
    }

    public static function getByFunction($function){
        return self::where('url',$function)->get()->first();        
    }


    public static function findBySlug($slug){

        $page = self::where('slug',$slug)->get()->first();

        if($page!=NULL){
            return $page;
        }else{

            foreach (self::where('slug',NULL)->orWhere('slug',"")->get() as $page) {
                if(str_slug($page->name)==$slug){
                    return $page;
                }
            }

        }

        return NULL;
    }

    public static function activeMain(){
         return self::where('visibility',1)->where('parent_id',NULL)->orderBy('queue')->orderBy('id')->get();
    }

    public static function active(){
        return self::where('visibility',1)->orderBy('queue')->orderBy('id')->get();
    }

    public function isActive(){
        return $this->visibility==1;
    }

    public function isParent(){
        return $this->parent_id==NULL;
    }

    public function hasSubpages(){
        return $this->subpages->count()>0;
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id','id');
    }


    public function subpages(){
        return $this->hasMany(self::class,'parent_id','id');
    }

    public function author(){
        return $this->belongsTo(\App\Model\User::class,'author_id','id'); //In db it has to be author_id else it won't work because Laravel priority is attr -> function
   }   

    public function getSlug(){
        return ($this->slug!=NULL && $this->slug!="")? $this->slug : str_slug($this->name);
    }

    public static function search($search_key){

        $search_key = '%'.$search_key.'%';

        return self::where('name', 'LIKE' ,$search_key)->orWhere('page', 'LIKE' ,$search_key)->get();

    }


}
