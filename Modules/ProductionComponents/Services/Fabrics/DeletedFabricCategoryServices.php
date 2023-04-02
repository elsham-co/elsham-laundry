<?php


namespace Modules\ProductionComponents\Services\Fabrics;



use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class DeletedFabricCategoryServices
{
    public $user;
    public $categoryfabrics;

   
    public function __construct(UserRepositoryEloquent $user,FabricsCategoryRepositoryEloquent $categoryfabrics)
    {
       $this->user = $user;
       $this->categoryfabrics =$categoryfabrics;
    }

    public function deletedCategoryfabrics($data = null)
    {
        $allData = [];
        $Allfabcategory = $this->categoryfabrics
        ->select('fabric_category.*');
        // if(isset($data['search'])){
        //        $Allfabcategory  = $Allfabcategory ->where(function ($q) use($data){
        //            $q->where('Categoryfab_code','LIKE','%'.$data['search'].'%')
        //                ->orwhere('Categoryfab_name','LIKE','%'.$data['search'].'%')
        //                 ->orwhere('users.username','LIKE','%'.$data['search'].'%');
        //        });
        // }

        if(isset($data['search'])){
            $Allfabcategory = $Allfabcategory->where(function ($q) use($data){
                $q->where('Categoryfab_code','LIKE','%'.$data['search'].'%')
                     ->orwhere('Categoryfab_name','LIKE','%'.$data['search'].'%')
                       ->orWhere(function ($q) use ($data){
             $q->whereHas('user_deleted', function ($query) use ($data) {
                 $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
            });
             });
              });
     }

        $Allfabcategory = $Allfabcategory->onlyTrashed()->orderBy('Categoryfab_code','asc')->paginate(20);
        foreach ($Allfabcategory as $singalecategory){
            $singalecategory->user = $this->user->where('id',$singalecategory->deleted_by)->first();
            $singalecategory->categoryfabrics = $this->categoryfabrics->where('Categoryfab_code',$singalecategory->id)->first();
           
        }
        $allData['fabric_category'] = $Allfabcategory;
        return $allData;
    }



}
