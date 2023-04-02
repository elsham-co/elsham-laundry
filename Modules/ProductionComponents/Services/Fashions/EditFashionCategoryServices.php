<?php


namespace Modules\ProductionComponents\Services\Fashions;



use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditFashionCategoryServices
{
    public $user;
    public $categoryfashions_info;

    public function __construct(UserRepositoryEloquent $user,FashionCategorRepositoryEloquent $categoryfashions_info)
    {
        $this->user = $user;
        $this->categoryfashions_info = $categoryfashions_info;
    }


    public function editCategoryFashion($fascategories)
    {
        $infoFasCategory = $this->categoryfashions_info->where('fascategory_code',$fascategories->id)->get();

        $fascategories->info = $infoFasCategory;
        return $fascategories;
    }

}
