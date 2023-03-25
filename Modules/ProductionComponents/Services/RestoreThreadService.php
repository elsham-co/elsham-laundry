<?php


namespace Modules\ProductionComponents\Services;


use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;

class RestoreThreadService
{

    protected $thread_info;

    public function __construct(ThreadInfoRepositoryEloquent $thread_info)
    {
        $this->thread_info = $thread_info;
        // $this->productEditSQS =$productEditSQS;

    }

    public function restoreThread($id)
    {
        $restorecode= $this->thread_info->withTrashed()->where('id',$id)->first();

        $this->thread_info->where('thread_code',$restorecode->thread_code)->restore($restorecode);
        $restorecode->deleted_by = null;
        $restorecode->update();
    }
}
