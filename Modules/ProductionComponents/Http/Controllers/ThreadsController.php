<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Entities\User;
use Modules\ProductionComponents\Entities\Thread;
use Modules\ProductionComponents\Services\StoreThreadService;
use Modules\ProductionComponents\Services\EditThreadService;
use Modules\ProductionComponents\Services\ThreadService;
use Modules\ProductionComponents\Services\SoftDeleteThreadService;
use Modules\ProductionComponents\Services\RestoreThreadService;
use Modules\ProductionComponents\Services\DeletedThreadService;
use Modules\ProductionComponents\Services\UpdateThreadService;
use Modules\ProductionComponents\Services\PrintThreadsService;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.  
     * @return Renderable
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,ThreadService $service)
    {
        // return view('productioncomponents::Threads/index');
        $threads = $service->get_threads($request->all());
        if($request->ajax()){
            return view('productioncomponents::Threads/thread_table')->with('threads',$threads);
        }
        return view('productioncomponents::Threads.index')->with('threads',$threads)->with('threads',$threads);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(EditThreadService $service)
    {
    $threads = $service->getThread();
    return view('productioncomponents::Threads/create')->with('threads',$threads);
   
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request,StoreThreadService $service)
    {
       
        $request->validate([
          
            'thread_code' => ['required','numeric'],
            'thread_name' => ['required' ,'unique:threads','max:20'],
            'thread_color' => ['required' ,'max:25']
            ],[
            'thread_code.required'=>__('Thread is Required Field, Please Add Thread'),
            'thread_code.numeric'=>__('Thread_code is Numeric Field, Please Add Thread_code'),
            'thread_name.required'=>__('Thread_name is Required Field, Please Add Thread_name'),
            'thread_name.unique'=>__('Thread_name is Unique Field, Please Add Thread_name'),
            'thread_name.max'=>__('Sorry...it is allowed to enter 20 characters in Thread name'),

            'thread_color.required'=>__('Thread color is Required Field, Please Add Thread color'),
            'thread_color.max'=>__('Sorry...it is allowed to enter 25 characters in Thread color')

        ]);

        
        $service->store_thread($request->all());
        session()->put('success',__('Thread Created Successfully'));
        return redirect()->back()->withInput();
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // return view('productioncomponents::Threads/show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Thread $thread,EditThreadService $service)
    {
        $thread = $service->editThread($thread);
        return view('productioncomponents::Threads.edit')
            ->with('thread',$thread);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Thread $thread,UpdateThreadService $service,ThreadService $service1)
    {
        $request->validate([
          
            'thread_code' => ['required','numeric'],
            'thread_name' => ['required' ,'unique:threads','max:20'],
            'thread_color' => ['required' ,'max:25']
            ],[
            'thread_code.required'=>__('Thread is Required Field, Please Add Thread'),
            'thread_code.numeric'=>__('Thread_code is Numeric Field, Please Add Thread_code'),
            'thread_name.required'=>__('Thread_name is Required Field, Please Add Thread_name'),
            'thread_name.unique'=>__('Thread_name is Unique Field, Please Add Thread_name'),
            'thread_name.max'=>__('Sorry...it is allowed to enter 63 characters in Thread name'),
            'thread_color.required'=>__('Thread color is Required Field, Please Add Thread color'),
            'thread_color.max'=>__('Sorry...it is allowed to enter 25 characters in Thread color')
        ]);

        
        $service->updateThread($thread,$request->all());
        session()->put('success',__('Thread Modified Successfully'));
        // return view('productioncomponents::Threads.index');
        $threads = $service1->get_threads($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::Threads/thread_table')->with('threads',$threads);
        }
       
        return redirect()-> route('Threads.index')->with('threads',$threads)->with('threads',$threads);
    
    }

      /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Thread $thread,SoftDeleteThreadService $service)
    {
        $service->softDelete_Thread($thread);
        session()->put('success',__('Thread deleted Successfully'));
        return redirect()->back();
    }
        /**
     * Restore the specified resource from storage.
     */
    public function restoreThread($id,RestoreThreadService $service)
    {

       $service->restoreThread($id);

        session()->put('success',__('Thread Restored Successfully'));
        return redirect()->back();
    }

    /**
     * Display All deleted resource.
     */
    public function deletedThreads(Request $request,DeletedThreadService $service)
    {
        $threads = $service->deletedThreads($request->all());
        if($request->ajax()){
            return view('productioncomponents::Threads/deleted_thread_table')->with('threads',$threads);
        }
        return view('productioncomponents::Threads.deleted_thread')->with('threads',$threads);

    }
    /*pass print route*/
    public function printOrder(Request $request,ThreadService $service)
    {
        $threads = $service->get_threads($request->all());
            return view('productioncomponents::Threads.print_threads')->with('threads',$threads);
    }
}
