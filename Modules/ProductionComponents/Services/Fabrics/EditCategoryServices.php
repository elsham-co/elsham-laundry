<?php


namespace Modules\ProductionComponents\Services\Fabrics;


use Modules\ProductionComponents\Repositories\Fabrics\FabricsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditCategoryServices
{
    public $user;
    public $categoryfabrics_info;

    public function __construct(UserRepositoryEloquent $user,FabricsCategoryRepositoryEloquent $categoryfabrics_info)
    {
        $this->user = $user;
        $this->categoryfabrics_info = $categoryfabrics_info;
    }


    public function editCategoryFabric($fabcategories)
    {
        $infoFabCategory = $this->categoryfabrics_info->where('Categoryfab_code',$fabcategories->id)->get();

        $fabcategories->info = $infoFabCategory;
        return $fabcategories;
    }

}
