<?php


namespace Modules\ProductionComponents\Services;


use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;
use Modules\ProductionComponents\Repositories\UserRepositoryEloquent;

class SoftDeleteThreadService
{

    public $thread_info;

                                public function __construct(ThreadInfoRepositoryEloquent $thread_info)
    {
 
        $this->thread_info = $thread_info;
    }

    public function softDelete_Thread($thread)
    {
        $this->thread_info->where('thread_code',$thread->id)->delete($thread);
        $thread->delete();
        $thread->deleted_by = auth()->user()->id;
        // $thread->deleted_at = now()->format("date format");
        $thread->update();
    }

}
