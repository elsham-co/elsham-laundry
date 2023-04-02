<?php


namespace Modules\ProductionComponents\Services\Colors;


// use Modules\Core\Entities\LanguageAttributes;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class ColorsCategoryServices
{
    public $user;
    public $categoryColors;

    public function __construct(UserRepositoryEloquent $user,ColorsCategoryRepositoryEloquent $categoryColors)
    {
        $this->user = $user;
        $this->categoryColors =$categoryColors;
    }

    public function getColorsCategoryName()
    {
        $ColorCategoryName =  $this->categoryColors->get();
        foreach($ColorCategoryName as $ColorCategory1)
        {
                $ColorCategory1->CategoryCol_name = $ColorCategory1->CategoryCol_name;
       
        }
        return $ColorCategoryName;
    }

    public function ColorCategoryDetail($data = null)
    {
        $allData = [];
        $Allcolorcategory = $this->categoryColors
        ->select('colorscategory.*');

        if(isset($data['search'])){
            $Allcolorcategory = $Allcolorcategory->where('colorscategory.CategoryCol_code', $data['search'])
            ->orwhere('colorscategory.CategoryCol_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }


        $Allcolorcategory  = $Allcolorcategory ->orderBy('CategoryCol_code','asc')->paginate(20);
        foreach ($Allcolorcategory  as $singalecategory ){
            $singalecategory->user = $this->user->where('id',$singalecategory->created_by)->first();
            $singalecategory->categoryColors = $this->categoryColors->where('CategoryCol_code',$singalecategory->id)->first();
             
        }
        $allData['colorscategory'] = $Allcolorcategory;
        return $allData;
    }

    public function getCategoryColorID()
    {
       
        $categoryColors = $this->categoryColors->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($categoryColors)){
            $categoryColorID = $this->categoryColors->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $categoryColorID;
        }else{
            $categoryColorID = $this->categoryColors->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $categoryColorID;
        } 
    }
}