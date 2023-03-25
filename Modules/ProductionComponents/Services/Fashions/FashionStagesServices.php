<?php


namespace Modules\ProductionComponents\Services\Fashions;



use Modules\ProductionComponents\Repositories\Fashions\FashionInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\Fashions\FashionCategorRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class FashionStagesServices
{
    public $user;
    public $categoryfashions;
    public $Fashion_info;
   
    public function __construct(UserRepositoryEloquent $user,FashionInfoRepositoryEloquent $Fashion_info,FashionCategorRepositoryEloquent $categoryfashions)
    {
       $this->user = $user;
       $this->categoryfashions = $categoryfashions;
        $this->Fashion_info = $Fashion_info;
    }

    public function get_fashions($data = null)
    {
        $allData = [];
        $Fashions = $this->Fashion_info->join('fashioncategory','fashions_stages.fascateg_code','fashioncategory.id')
        ->where('fashioncategory.deleted_at',null)
        ->select('fashions_stages.*');
        if(isset($data['search'])){
            $Fashions = $Fashions->where('fashions_stages.fashioncode', $data['search'])
            ->orwhere('fashionname','LIKE','%'.$data['search'].'%')
            ->orwhere('fashioncategory.fascategory_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });

        }

        $Fashions = $Fashions->orderBy('id','desc')->paginate(20);
        foreach ($Fashions as $fashion){
            $fashion->user = $this->user->where('id',$fashion->created_by)->first();
            $fashion->categoryfashions = $this->categoryfashions->where('id',$fashion->fascateg_code)->first();
            $fashion->Fashion_info = $this->Fashion_info->where('fashioncode',$fashion->id)->first();
             
        }
        $allData['fashions_stages'] = $Fashions;
        return $allData;
    }


    public function get_printfashions()
    {
        $allData = [];
        $Fashions = $this->Fashion_info->join('fashioncategory','fashions_stages.fascateg_code','fashioncategory.id')
        ->join('users','fashions_stages.created_by','users.id')
        ->where('fashioncategory.deleted_at',null)
        ->select('fashions_stages.*');
        // $Fabrics = $this->user;
   

        $Fashions = $Fashions->orderBy('fashioncode','asc')->get();
        foreach ($Fashions as $fashion){
            $fashion->user = $this->user->where('id',$fashion->created_by)->first();
            $fashion->categoryfashions = $this->categoryfashions->where('id',$fashion->fascateg_code)->first();
            $fashion->Fashion_info = $this->Fashion_info->where('fashioncode',$fashion->id)->first();
             
        }
        $allData['fashions_stages'] = $Fashions;
        return $allData;
    }
}
