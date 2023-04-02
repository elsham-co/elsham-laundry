<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class DeletedColorServices
{
    public $user;
    public $categorycolors;
    public $Color_info;
   
    public function __construct(UserRepositoryEloquent $user,ColorInfoRepositoryEloquent $Color_info,ColorsCategoryRepositoryEloquent $categorycolors)
    {
       $this->user = $user;
       $this->categorycolors =$categorycolors;
        $this->Color_info = $Color_info;
    }

    public function deletedcolors($data = null)
    {
        $allData = [];
        $Colors = $this->Color_info->join('colorscategory','colors_stages.colcategcode','colorscategory.id')
        ->where('colorscategory.deleted_at',null)
        ->select('colors_stages.*');

if(isset($data['search'])){
    $Colors = $Colors->where(function ($q) use($data){
        $q->where('colors_stages.colorcode','LIKE','%'.$data['search'].'%')
            ->orwhere('colorname','LIKE','%'.$data['search'].'%')
             ->orwhere('colorscategory.CategoryCol_name','LIKE','%'.$data['search'].'%')
               ->orWhere(function ($q) use ($data){
     $q->whereHas('user_deleted', function ($query) use ($data) {
         $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
    });
     });
      });
}

        $Colors = $Colors->onlyTrashed()->orderBy('colorcode','asc')->paginate(20);
        foreach ($Colors as $color){
            $color->user = $this->user->where('id',$color->deleted_by)->first();
            $color->categorycolors = $this->categorycolors->where('id',$color->colcategcode)->first();
            $color->Color_info = $this->Color_info->where('colorcode',$color->id)->first();
             
        }
        $allData['colors_stages'] = $Colors;
        return $allData;
    }



}
