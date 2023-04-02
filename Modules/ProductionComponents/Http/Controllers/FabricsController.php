<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Entities\Fabric;
use Modules\ProductionComponents\Entities\FabricsCategory;
use Modules\ProductionComponents\Services\Fabrics\FabricsServices;
use Modules\ProductionComponents\Services\Fabrics\EditFabricsService;
use Modules\ProductionComponents\Services\Fabrics\FabricsCategoryServices;
use Modules\ProductionComponents\Services\Fabrics\StoreFabricsService;
use Modules\ProductionComponents\Services\Fabrics\UpdateFabricsServices;
use Modules\ProductionComponents\Services\Fabrics\SoftDeleteFabricServices;
use Modules\ProductionComponents\Services\Fabrics\DeletedFabricServices;
use Modules\ProductionComponents\Services\Fabrics\RestoreFabricsServices;
use Modules\ProductionComponents\Services\Fabrics\ShowFabricsService;

class FabricsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,FabricsServices $service,FabricsCategoryServices $FabcategoryService)
    {
        $fabCategoryName  = $FabcategoryService->getFabricsCategoryName();
        $Fabrics = $service->get_fabrics($request->all());
        if($request->ajax()){
            return view('productioncomponents::Fabrics/fabrics_table')->with('Fabrics',$Fabrics)->with('fabCategoryName',$fabCategoryName);
        }
        return view('productioncomponents::Fabrics.index')->with('Fabrics',$Fabrics)->with('fabCategoryName',$fabCategoryName);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(EditFabricsService $service,FabricsCategoryServices $FabcategoryService)
    {
        $fabCategoryName  = $FabcategoryService->getFabricsCategoryName();
        $categoryfabricID =$service->getCategoryFabricID();
        $Fabric = $service->getFabric();
        return view('productioncomponents::Fabrics/create')->with('Fabric',$Fabric)->with('fabCategoryName',$fabCategoryName)->with('categoryfabricID',$categoryfabricID);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, StoreFabricsService $service)
    {
        $request->validate([
          
            'fabric_code' => ['required','numeric'],
            'fabricName' => ['required' ,'unique:fabric','max:45'],
            'categoryFabric' => ['required']
            ],[
            'fabric_code.required'=>__('Fabric Code is Required Field...Please Add Fabric Code'),
              'fabric_code.numeric'=>__('Fabric Code is Numeric Field Only'),
            'fabricName.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'fabricName.unique'=>__('Fabric Name is Unique Field, Please Add Fabric Name'),
            'fabricName.max'=>__('Sorry...it is allowed to enter 45 characters in Fabric Name'),

            'categoryFabric.required'=>__('Sorry...You Mast Select A Category Fabric Name'),

        ]);

        
        $service->store_fabric($request->all());
        session()->put('success',__('Fabric Created Successfully'));
        return redirect()->back()->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Fabric $Fabric,ShowFabricsService $service)
    {
      
  
        $Fabrics = $service->ShowFabric($Fabric);
        return view('productioncomponents::Fabrics.show')
            ->with('Fabric',$Fabrics);
        // return $Fabrics;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Fabric $Fabric,EditFabricsService $service,FabricsCategoryServices $FabcategoryService)
    {
        $fabCategoryName  = $FabcategoryService->getFabricsCategoryName();
        $categoryfabricID =$service->getCategoryFabricID();
        $Fabric = $service->editFabric($Fabric);
        return view('productioncomponents::Fabrics.edit')
            ->with('Fabric',$Fabric)->with('fabCategoryName',$fabCategoryName)->with('categoryfabricID',$categoryfabricID);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Fabric $Fabric,UpdateFabricsServices $service,FabricsServices $service1)
    {
        $request->validate([
          
            'fabric_code' => ['required','numeric'],
            'fabricName' => ['required','max:45'],
            'categoryFabric' => ['required']
            ],[
            'fabric_code.required'=>__('Fabric Code is Required Field...Please Add Fabric Code'),
              'fabric_code.numeric'=>__('Fabric Code is Numeric Field Only'),
            'fabricName.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            // 'fabricName.unique'=>__('Fabric Name is Unique Field, Please Add Fabric Name'),
            'fabricName.max'=>__('Sorry...it is allowed to enter 45 characters in Fabric Name'),

            'categoryFabric.required'=>__('Sorry...You Mast Select A Category Color Name'),

        ]);

        $service->update_fabric($Fabric,$request->all());
        session()->put('success',__('Fabric Modified Successfully'));
       
        $Fabric = $service1->get_fabrics($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::Fabrics/fabrics_table')->with('Fabric',$Fabric);
        }
       
        return redirect()-> route('Fabrics.index')->with('Fabric',$Fabric)->with('Fabric',$Fabric);

        // $service->update_fabric($Fabric,$request->all());
        // session()->put('success',__('Customer updated Successfully'));
        // return redirect()->back();
    
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Fabric $Fabric,SoftDeleteFabricServices $service)
    {
        $service->softDelete_Fabric($Fabric);
        session()->put('success',__('Fabric Deleted Successfully'));
        return redirect()->back();
        // return $Fabric;
    }
     /**
     * Restore the specified resource from storage.
     */
    public function restoreThread($id,RestoreFabricsServices $service)
    {
      $rstored =$service->restoreFabric($id);

        session()->put('success',__('Fabric Restored Successfully'));
        return redirect()->back();
    // return $rstored;
    }
/**
    * Display All deleted resource.
    */
   public function deletedFabrics(Request $request,DeletedFabricServices $service)
   {
       $DeletedFabrics = $service->deletedfabrics($request->all());
       if($request->ajax()){
           return view('productioncomponents::Fabrics/deleted_Fabric_table')->with('DeletedFabrics',$DeletedFabrics);
       }
       return view('productioncomponents::Fabrics.deleted_Fabrics')->with('DeletedFabrics',$DeletedFabrics);

   }
   /*pass print route*/
   public function printFabrics(Request $request,FabricsServices $service)
   {
       $Fabrics = $service->get_printfabrics($request->all());

           return view('productioncomponents::Fabrics.print_Fabrics')->with('Fabrics',$Fabrics);
   }
}
