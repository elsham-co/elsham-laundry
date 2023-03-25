<?php


namespace Modules\ProductionComponents\Services\Fabrics;


// use Modules\Core\Entities\LanguageAttributes;
use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class FabricsCategoryServices
{
    public $user;
    public $categoryfabrics;

    public function __construct(UserRepositoryEloquent $user,FabricsCategoryRepositoryEloquent $categoryfabrics)
    {
        $this->user = $user;
        // $this->fabCategory1 = $fabCategory1;
        $this->categoryfabrics =$categoryfabrics;
    }

    public function getFabricsCategoryName()
    {
        $fabCategoryName =  $this->categoryfabrics->get();
        foreach($fabCategoryName as $fabCategory1)
        {
                $fabCategory1->Categoryfab_name = $fabCategory1->Categoryfab_name;
       
        }
        return $fabCategoryName;
    }

    public function getfabCategoryDetail($data = null)
    {
        $allData = [];
        $Allfabcategory = $this->categoryfabrics
        ->select('fabric_category.*');
        if(isset($data['search'])){
            $Allfabcategory = $Allfabcategory->where('fabric_category.Categoryfab_code', $data['search'])
            ->orwhere('fabric_category.Categoryfab_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }


        $Allfabcategory  = $Allfabcategory ->orderBy('Categoryfab_code','asc')->paginate(20);
        foreach ($Allfabcategory  as $singalecategory ){
            $singalecategory->user = $this->user->where('id',$singalecategory->created_by)->first();
            $singalecategory->categoryfabrics = $this->categoryfabrics->where('Categoryfab_code',$singalecategory->id)->first();
             
        }
        $allData['fabric_category'] = $Allfabcategory;
        return $allData;
    }

}
