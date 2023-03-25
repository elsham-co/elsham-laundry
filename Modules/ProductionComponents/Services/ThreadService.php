<?php


namespace Modules\ProductionComponents\Services;



use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class ThreadService
{
    public $user;
    public $thread_info;
   
    public function __construct(UserRepositoryEloquent $user,ThreadInfoRepositoryEloquent $thread_info)
    {
        $this->user = $user;

        $this->thread_info = $thread_info;
    }

    public function get_threads($data = null)
    {
        $allData = [];
        $threads = $this->thread_info;

        if(isset($data['search'])){
            $threads = $threads->where('threads.thread_code', $data['search'])
            ->orwhere('thread_name','LIKE','%'.$data['search'].'%')
            ->orWhere(function ($q) use ($data){
                $q->whereHas('user', function ($query) use ($data) {
                    $query->Where('username', 'LIKE', '%' . $data['search'] . '%');
                });
            });
        }
      
        $threads = $threads->orderBy('id','asc')->paginate(15);
        foreach ($threads as $thread){
            $thread->user = $this->user->where('id',$thread->created_by)->first();
            $thread->thread_inf = $this->thread_info->where('thread_code',$thread->id)->first();
             
        }
        $allData['threads'] = $threads;
        return $allData;
    }



}
