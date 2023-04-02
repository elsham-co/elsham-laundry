<?php


namespace Modules\ProductionComponents\Services\Fashions;


use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditFashionsServices
{
    public $user;
    public $Fashion_info;
    public $categoryFashions_info;

    public function __construct(FashionInfoRepositoryEloquent $Fashion_info,UserRepositoryEloquent $user,FashionCategorRepositoryEloquent $categoryFashions_info)
    {
        $this->user = $user;
        $this->Fashion_info = $Fashion_info;
        $this->categoryFashions_info = $categoryFashions_info;
    }

    public function getFashion()
    {
       
        $Fashion_info = $this->Fashion_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($Fashion_info)){
            $Fashion = $this->Fashion_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $Fashion;
        }else{
            $Fashion = $this->Fashion_info->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $Fashion;
        } 
        
    }

    public function EditFashions($editFashion)
    {
        $infoFashions = $this->Fashion_info->where('fashioncode',$editFashion->id)->get();

        $editFashion->info = $infoFashions;
        return $editFashion;
    }

  

}
