<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class DeletedColorCategoryServices
{
    public $user;
    public $categorycolors;

   
    public function __construct(UserRepositoryEloquent $user,ColorsCategoryRepositoryEloquent $categorycolors)
    {
       $this->user = $user;
       $this->categorycolors =$categorycolors;
    }

    public function deletedCategoryColors($data = null)
    {
        $allData = [];
        $Allcolorcategory = $this->categorycolors;

        if(isset($data['search'])){
        $Allcolorcategory = $Allcolorcategory->where(function ($q) use($data){
            $q->where('colorscategory.CategoryCol_code','LIKE','%'.$data['search'].'%')
                ->orwhere('CategoryCol_name','LIKE','%'.$data['search'].'%')
                   ->orWhere(function ($q) use ($data){
         $q->whereHas('user_deleted', function ($query) use ($data) {
             $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
        });
         });
          });
 }


        $Allcolorcategory = $Allcolorcategory->onlyTrashed()->orderBy('CategoryCol_code','asc')->paginate(20);
        foreach ($Allcolorcategory  as $singalecategory ){
            $singalecategory->user = $this->user->where('id',$singalecategory->deleted_by)->first();
            $singalecategory->categorycolors = $this->categorycolors->where('CategoryCol_code',$singalecategory->id)->first();
             
        }
        $allData['colorscategory'] = $Allcolorcategory;
        return $allData;
    }



}
