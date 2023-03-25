<?php


namespace Modules\ProductionComponents\Services;


use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;

class UpdateThreadService
{
    public $thread_info;
    // public $lastId;
    public function __construct(ThreadInfoRepositoryEloquent $thread_info)
    {
        $this->thread_info = $thread_info;
    }
    public function updateThread($thread,$data)
    {
      

     
        $thread->update([     
       
        'thread_code'=>$data['thread_code'],
        'thread_name'=>$data['thread_name'],
        'thread_color'=>$data['thread_colortext'],
        'updated_by'=>auth()->user()->id,
        'updated_at'=>now()
        
       
    ]);
        }


    }


