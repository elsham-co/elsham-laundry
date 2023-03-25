<?php


namespace Modules\ProductionComponents\Services\Fashions;

use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class DeleteFashionCategoryServices
{
    public $user;
    public $categoryfashions;

   
    public function __construct(UserRepositoryEloquent $user,FashionCategorRepositoryEloquent $categoryfashions)
    {
       $this->user = $user;
       $this->categoryfashions =$categoryfashions;
    }

    public function deletedCategoryFashions($data = null)
    {
        $allData = [];
        $Allfashioncategory = $this->categoryfashions
        ->select('fashioncategory.*');
        if(isset($data['search'])){
            $Allfashioncategory = $Allfashioncategory->where(function ($q) use($data){
                $q->where('fashioncategory.fascategory_code','LIKE','%'.$data['search'].'%')
                    ->orwhere('fascategory_name','LIKE','%'.$data['search'].'%')
                       ->orWhere(function ($q) use ($data){
             $q->whereHas('user_deleted', function ($query) use ($data) {
                 $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
            });
             });
              });
     }


        $Allfashioncategory = $Allfashioncategory->onlyTrashed()->orderBy('fascategory_code','asc')->paginate(20);
        foreach ($Allfashioncategory  as $singalecategory ){
            $singalecategory->user = $this->user->where('id',$singalecategory->deleted_by)->first();
            $singalecategory->categoryfashions = $this->categoryfashions->where('fascategory_code',$singalecategory->id)->first();
             
        }
        $allData['fashioncategory'] = $Allfashioncategory;
        return $allData;
    }



}
