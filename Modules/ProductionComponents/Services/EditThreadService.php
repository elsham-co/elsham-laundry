<?php


namespace Modules\ProductionComponents\Services;


use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class EditThreadService
{
    public $user;
    public $Thread_info;

    public function __construct(UserRepositoryEloquent $user,ThreadInfoRepositoryEloquent $Thread_info)
    {
        $this->user = $user;
        $this->Thread_info = $Thread_info;
    }

    public function getThread()
    {
       
        $Thread_info = $this->Thread_info->withTrashed()->where('created_by',auth()->user()->id)->first(); 
        if(empty($Thread_info)){
            $threads = $this->Thread_info->withTrashed()->select('id')->latest('id')->pluck('id')->first(); 
            
            return $threads;
        }else{
            $threads = $this->Thread_info->withTrashed()->select('id')
            ->where('created_by',auth()->user()->id)->latest('id')->pluck('id')->first(); 
            
            return $threads;
        } 
    }

    public function editThread($thread)
    {
        $infoThreads = $this->Thread_info->where('thread_code',$thread->id)->get();

        $thread->info = $infoThreads;
        return $thread;
    }

}
