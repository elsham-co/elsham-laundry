<?php


namespace Modules\ProductionComponents\Services\Fashions;


// use Modules\Core\Entities\LanguageAttributes;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class FashionsCategoryServices
{
    public $user;
    public $categoryFashions;

    public function __construct(UserRepositoryEloquent $user,FashionCategorRepositoryEloquent $categoryFashions)
    {
        $this->user = $user;
        // $this->fabCategory1 = $fabCategory1;
        $this->categoryFashions =$categoryFashions;
    }

    public function getFashionsCategoryName()
    {
       
        $FashionCategoryName =  $this->categoryFashions->get();
        foreach($FashionCategoryName as $FashionCategory)
        {
                $FashionCategory->fascategory_name = $FashionCategory->fascategory_name;
       
        }
        return $FashionCategoryName;
    }

    public function FashionCategoryDetail($data = null)
    {
        $allData = [];
        $AllFashioncategory = $this->categoryFashions
        ->select('fashioncategory.*');
        if(isset($data['search'])){
            $AllFashioncategory = $AllFashioncategory->where('fashioncategory.fascategory_code', $data['search'])
            ->orwhere('fascategory_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });

        }


        $AllFashioncategory  = $AllFashioncategory ->orderBy('fascategory_code','asc')->paginate(20);
        foreach ($AllFashioncategory  as $singalecategory ){
            $singalecategory->user = $this->user->where('id',$singalecategory->created_by)->first();
            $singalecategory->categoryFashions = $this->categoryFashions->where('fascategory_code',$singalecategory->id)->first();
             
        }
        $allData['fashioncategory'] = $AllFashioncategory;
        return $allData;
    }

    public function getCategoryFashionID()
    {
       
        $categoryFashions = $this->categoryFashions->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($categoryFashions)){
            $categoryFashionID = $this->categoryFashions->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $categoryFashionID;
        }else{
            $categoryFashionID = $this->categoryFashions->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $categoryFashionID;
        } 
    }
}