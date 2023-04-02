<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Entities\ColorsCategory;
use Modules\ProductionComponents\Entities\Color;

use Modules\ProductionComponents\Services\Colors\EditColorCategoryServices;
use Modules\ProductionComponents\Services\Colors\ColorsCategoryServices;
use Modules\ProductionComponents\Services\Colors\StoreColorCategoryService;
use Modules\ProductionComponents\Services\Colors\UpdateColorsCategoryServices;
use Modules\ProductionComponents\Services\Colors\SoftDeleteColCategoryServices;
use Modules\ProductionComponents\Services\Colors\DeletedColorCategoryServices;
use Modules\ProductionComponents\Services\Colors\RestoreColCategoryServices;

class ColorcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,ColorsCategoryServices $service)
    {
        $Allcolcategory = $service->ColorCategoryDetail($request->all());
        if($request->ajax()){
            return view('productioncomponents::colors/Colcategory_table')->with('Allcolcategory',$Allcolcategory);
        }
        return view('productioncomponents::colors/Colorscategory')->with('Allcolcategory',$Allcolcategory);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request ,StoreColorCategoryService $service)
    {
              $request->validate([
          
            'CategoryCol_code' => ['required','numeric'], 
            'CategoryCol_name' => ['required' ,'unique:colorscategory','max:45']
            ],[
            'CategoryCol_code.required'=>__('Color Category ID is Required Field...Please Add Color Category ID'),
              'CategoryCol_code.numeric'=>__('Color Category Code is Numeric Field Only'),
            'CategoryCol_name.required'=>__('Color Category Name is Required Field...Please Add Color Category Name'),
            'CategoryCol_name.unique'=>__('Color Category Name is Unique Field, Please Add Color Category Name'),
            'CategoryCol_name.max'=>__('Color...it is allowed to enter 45 characters in Color Category Name'),

        ]);

        
        $service->store_Color_category($request->all());
        session()->put('success',__('Color Category Created Successfully'));
        return redirect()->back()->withInput();   
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('productioncomponents::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ColorsCategory $colcategory,EditColorCategoryServices $service)
    {
      
        $colcategory = $service->editCategoryColor($colcategory);
        return view('productioncomponents::colors.edit_colcategory')->with('colcategory',$colcategory);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, ColorsCategory $colcategory,UpdateColorsCategoryServices $service,ColorsCategoryServices $service1)
    {
        $request->validate([
          
            'CategoryCol_code' => ['required','numeric'], 
            'CategoryCol_name' => ['required' ,'unique:colorscategory','max:45']
            ],[
            'CategoryCol_code.required'=>__('Color Category ID is Required Field...Please Add Color Category ID'),
              'CategoryCol_code.numeric'=>__('Color Category Code is Numeric Field Only'),
            'CategoryCol_name.required'=>__('Color Category Name is Required Field...Please Add Color Category Name'),
            'CategoryCol_name.unique'=>__('Color Category Name is Unique Field, Please Add Color Category Name'),
            'CategoryCol_name.max'=>__('Color...it is allowed to enter 45 characters in Color Category Name'),

        ]);
        $service->update_color_category($colcategory,$request->all());
        session()->put('success',__('Fabric Category Modified Successfully'));
       
        $Allcolcategory = $service1->ColorCategoryDetail($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::Colors/Colcategory_table')->with('Allcolcategory',$Allcolcategory)->with('colcategory',$colcategory);
        }
       
        return redirect()-> route('ccategory.index')->with('Allcolcategory',$Allcolcategory)->with('colcategory',$colcategory);


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ColorsCategory $colcategory,SoftDeleteColCategoryServices $service)
    {
        $service->softDelete_Color($colcategory);
        session()->put('success',__('Color Category Deleted Successfully'));
        return redirect()->back();
    }

/**
     * Restore the specified resource from storage.
     */
    public function restoreColCategory($id,RestoreColCategoryServices $service)
    {

       $service->restoreColCategory($id);

        session()->put('success',__('Color Category Restored Successfully'));
        return redirect()->back();
    }
      /**
    * Display All deleted resource.
    */
   public function deletedCategoryCol(Request $request,DeletedColorCategoryServices $service)
   {
       $Allcolcategory = $service->deletedCategoryColors($request->all());
       if($request->ajax()){
           return view('productioncomponents::Colors/deleted_ColorCategory_table')->with('Allcolcategory',$Allcolcategory);
       }
       return view('productioncomponents::Colors.deleted_ColorCategory')->with('Allcolcategory',$Allcolcategory);

   }
}
