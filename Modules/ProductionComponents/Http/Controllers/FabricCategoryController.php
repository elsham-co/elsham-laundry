<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Entities\FabricsCategory;
use Modules\ProductionComponents\Services\Fabrics\FabricsCategoryServices;
use Modules\ProductionComponents\Services\Fabrics\StoreCategoryService;
use Modules\ProductionComponents\Services\Fabrics\EditCategoryServices;
use Modules\ProductionComponents\Services\Fabrics\UpdateFabCategoryServices;
use Modules\ProductionComponents\Services\Fabrics\SoftDeleteFabCategoryServices;
use Modules\ProductionComponents\Services\Fabrics\DeletedFabricCategoryServices;
use Modules\ProductionComponents\Services\Fabrics\RestoreFabCategoryServices;


class FabricCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    // public function index(FabricsCategory $fabcategory,Request $request,FabricsCategoryServices $service)
    public function index(Request $request,FabricsCategoryServices $service)
    {
        $Allfabcategory = $service->getfabCategoryDetail($request->all());
        if($request->ajax()){
            return view('productioncomponents::Fabrics/Fabcategory_table')->with('Allfabcategory',$Allfabcategory);
        }
        return view('productioncomponents::Fabrics/Fabricscategory')->with('Allfabcategory',$Allfabcategory);
        // Fabricscategory
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('productioncomponents::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request ,StoreCategoryService $service)
    {
              $request->validate([
          
            'Categoryfab_code' => ['required','numeric','unique:fabric_category'],
            'Categoryfab_name' => ['required' ,'unique:fabric_category','max:45']
            ],[
            'Categoryfab_code.required'=>__('Fabric Category Code is Required Field...Please Add Fabric Category Code'),
              'Categoryfab_code.numeric'=>__('Fabric Category Code is Numeric Field Only'),
            'Categoryfab_code.unique'=>__('Fabric Category Code is Unique Field, Please Add Fabric Category Code'),
            'Categoryfab_name.required'=>__('Fabric Category Name is Required Field...Please Add Fabric Category Name'),
            'Categoryfab_name.unique'=>__('Fabric Category Name is Unique Field, Please Add Fabric Category Name'),
            'Categoryfab_name.max'=>__('Sorry...it is allowed to enter 45 characters in Fabric Category Name'),

        ]);

        
        $service->store_fabric_category($request->all());
        session()->put('success',__('Fabric Category Created Successfully'));
        return redirect()->back()->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // return view('productioncomponents::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FabricsCategory $fabcategory,EditCategoryServices $service)
    {
      
        $fabcategory = $service->editCategoryFabric($fabcategory);
        return view('productioncomponents::Fabrics.edit_fabcategory')->with('fabcategory',$fabcategory);
// return response()->json($fabcategory);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, FabricsCategory $fabcategory,UpdateFabCategoryServices $service,FabricsCategoryServices $service1)
    {
        $request->validate([
          
            'Categoryfab_code' => ['required','numeric'],
            'Categoryfab_name' => ['required' ,'unique:fabric_category','max:45'],
            ],[
            'fabric_code.required'=>__('Fabric Code is Required Field...Please Add Fabric Code'),
              'fabric_code.numeric'=>__('Fabric Code is Numeric Field Only'),
            'Categoryfab_name.required'=>__('Fabric Name is Required Field...Please Add Fabric Name'),
            'Categoryfab_name.unique'=>__('Fabric Name is Unique Field, Please Add Fabric Name'),
            'Categoryfab_name.max'=>__('Sorry...it is allowed to enter 45 characters in Fabric Name'),

        ]);

        $service->update_fabric_category($fabcategory,$request->all());
        session()->put('success',__('Fabric Category Modified Successfully'));
       
        $Allfabcategory = $service1->getfabCategoryDetail($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::Fabrics/Fabcategory_table')->with('Allfabcategory',$Allfabcategory)->with('fabcategory',$fabcategory);
        }
       
        return redirect()-> route('Category.index')->with('Allfabcategory',$Allfabcategory)->with('fabcategory',$fabcategory);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(FabricsCategory $fabcategory,SoftDeleteFabCategoryServices $service)
    {
        $service->softDelete_Fabric($fabcategory);
        session()->put('success',__('Fabric Category Deleted Successfully'));
        return redirect()->back();
    }

/**
     * Restore the specified resource from storage.
     */
    public function restoreFabCategory($id,RestoreFabCategoryServices $service)
    {

       $service->restoreFabCategory($id);

        session()->put('success',__('Fabric Category Restored Successfully'));
        return redirect()->back();
    }
    /**
    * Display All deleted resource.
    */
   public function deletedCategoryfab(Request $request,DeletedFabricCategoryServices $service)
   {
       $Allfabcategory = $service->deletedCategoryfabrics($request->all());
       if($request->ajax()){
           return view('productioncomponents::Fabrics/deleted_FabricCategory_table')->with('Allfabcategory',$Allfabcategory);
       }
       return view('productioncomponents::Fabrics.deleted_FabricCategory')->with('Allfabcategory',$Allfabcategory);

   }
}
