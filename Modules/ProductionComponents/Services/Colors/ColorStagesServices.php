<?php


namespace Modules\ProductionComponents\Services\Colors;



use Modules\ProductionComponents\Repositories\Colors\ColorInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Colors\ColorsCategoryRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class ColorStagesServices
{
    public $user;
    public $categorycolors;
    public $Color_info;
   
    public function __construct(UserRepositoryEloquent $user,ColorInfoRepositoryEloquent $Color_info,ColorsCategoryRepositoryEloquent $categorycolors)
    {
       $this->user = $user;
       $this->categorycolors = $categorycolors;
        $this->Color_info = $Color_info;
    }

    public function get_colors($data = null)
    {
        $allData = [];
        $Colors = $this->Color_info->join('colorscategory','colors_stages.colcategcode','colorscategory.id')
        ->where('colorscategory.deleted_at',null)
        ->select('colors_stages.*');
        if(isset($data['search'])){
            $Colors = $Colors->where('colors_stages.colorcode', $data['search'])
            ->orwhere('colorname','LIKE','%'.$data['search'].'%')
            ->orwhere('colorscategory.CategoryCol_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        
        }

        $Colors = $Colors->orderBy('id','desc')->paginate(20);
        foreach ($Colors as $color){
            $color->user = $this->user->where('id',$color->created_by)->first();
            $color->categorycolors = $this->categorycolors->where('id',$color->colcategcode)->first();
            $color->Color_info = $this->Color_info->where('colorcode',$color->id)->first();
             
        }
        $allData['colors_stages'] = $Colors;
        return $allData;
    }


    public function get_printcolors()
    {
        $allData = [];
        $Colors = $this->Color_info->join('colorscategory','colors_stages.colcategcode','colorscategory.id')
        ->join('users','colors_stages.created_by','users.id')
        ->where('colorscategory.deleted_at',null)
        ->select('colors_stages.*');
        // $Fabrics = $this->user;
   

        $Colors = $Colors->orderBy('colorcode','asc')->get();
        foreach ($Colors as $color){
            $color->user = $this->user->where('id',$color->created_by)->first();
            $color->categorycolors = $this->categorycolors->where('id',$color->colcategcode)->first();
            $color->Color_info = $this->Color_info->where('colorcode',$color->id)->first();
             
        }
        $allData['colors_stages'] = $Colors;
        return $allData;
    }
}
