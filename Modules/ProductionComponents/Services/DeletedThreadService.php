<?php


namespace Modules\ProductionComponents\Services;



use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class DeletedThreadService
{
    public $user;
    public $thread_info;
   
    public function __construct(UserRepositoryEloquent $user,ThreadInfoRepositoryEloquent $thread_info)
    {
        $this->user = $user;

        $this->thread_info = $thread_info;
    }

    public function deletedThreads($data = null)
    {
        $allData = [];
        $threads = $this->thread_info;

        if(isset($data['search'])){
            $threads = $threads->where(function ($q) use($data){
                $q->where('threads.thread_code','LIKE','%'.$data['search'].'%')
                    ->orwhere('thread_name','LIKE','%'.$data['search'].'%')
                       ->orWhere(function ($q) use ($data){
             $q->whereHas('user_deleted', function ($query) use ($data) {
                 $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
            });
             });
              });
     }

        $threads = $threads->onlyTrashed()->orderBy('id','desc')->paginate(10);
        foreach ($threads as $thread){
            
            $thread->user = $this->user->where('id',$thread->deleted_by)->first();
            $thread->thread_inf = $this->thread_info->where('thread_code',$thread->id)->first();
        }
        $allData['threads'] = $threads;

        return $allData;
    }



}
