<?php


namespace Modules\ProductionComponents\Services\Colors;


use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditColorsServices
{
    public $user;
    public $Color_info;
    public $categoryColors_info;

    public function __construct(ColorInfoRepositoryEloquent $Color_info,UserRepositoryEloquent $user,ColorsCategoryRepositoryEloquent $categoryColors_info)
    {
        $this->user = $user;
        $this->Color_info = $Color_info;
        $this->categoryColors_info = $categoryColors_info;
    }

    public function getColor()
    {
       
        // $Color_info = $this->Color_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        $Color_info = $this->Color_info->withTrashed()->first(); 
        if(empty($Color_info)){
            $Color = $this->Color_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $Color;
        }else{
            // $Color = $this->Color_info->withTrashed()->select('id')
            // ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            $Color = $this->Color_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            return $Color;
        } 
    }

    public function EditColors($editColor)
    {
        $infoColors = $this->Color_info->where('colorcode',$editColor->id)->get();

        $editColor->info = $infoColors;
        return $editColor;
    }

  

}
