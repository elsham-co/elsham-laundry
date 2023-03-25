<?php


namespace Modules\ProductionComponents\Services\Colors;


use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditColorCategoryServices
{
    public $user;
    public $categorycolors_info;

    public function __construct(UserRepositoryEloquent $user,ColorsCategoryRepositoryEloquent $categorycolors_info)
    {
        $this->user = $user;
        $this->categorycolors_info = $categorycolors_info;
    }


    public function editCategoryColor($colcategories)
    {
        $infoColCategory = $this->categorycolors_info->where('CategoryCol_code',$colcategories->id)->get();

        $colcategories->info = $infoColCategory;
        return $colcategories;
    }

}
