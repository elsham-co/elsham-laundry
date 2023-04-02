<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Entities\Fashion;
use Modules\ProductionComponents\Entities\FashionCategory;
use Modules\ProductionComponents\Services\Fashions\FashionsCategoryServices;
use Modules\ProductionComponents\Services\Fashions\StoreFashionCategoryService;
use Modules\ProductionComponents\Services\Fashions\EditFashionCategoryServices;
use Modules\ProductionComponents\Services\Fashions\UpdateFashionsCategoryServices;
use Modules\ProductionComponents\Services\Fashions\SoftDeleteFasCategoryServices;
use Modules\ProductionComponents\Services\Fashions\DeleteFashionCategoryServices;
use Modules\ProductionComponents\Services\Fashions\RestoreFasCategoryServices;

class FashionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,FashionsCategoryServices $service)
    {
        $Allfascategory = $service->FashionCategoryDetail($request->all());
        if($request->ajax()){
            return view('productioncomponents::Fashions/Fascategory_table')->with('Allfascategory',$Allfascategory);
        }
        return view('productioncomponents::Fashions/FashionsCategory')->with('Allfascategory',$Allfascategory);
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
    public function store(Request $request ,StoreFashionCategoryService $service)
    {
              $request->validate([
          
            'fascategory_code' => ['required','numeric'], 
            'fascategory_name' => ['required' ,'unique:fashioncategory','max:45']
            ],[
            'fascategory_code.required'=>__('Fashion Category ID is Required Field...Please Add Fashion Category ID'),
              'fascategory_code.numeric'=>__('Fashion Category Code is Numeric Field Only'),

            'fascategory_name.required'=>__('Fashion Category Name is Required Field...Please Add Fashion Category Name'),
            'fascategory_name.unique'=>__('Fashion Category Name is Unique Field, Please Add Fashion Category Name'),
            'fascategory_name.max'=>__('Fashion...it is allowed to enter 45 characters in Fashion Category Name'),

        ]);

        
        $service->store_Fashion_category($request->all());
        session()->put('success',__('Fashion Category Created Successfully'));
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
    public function edit(FashionCategory $fascategory,EditFashionCategoryServices $service)
    {
      
        $fascategory = $service->editCategoryFashion($fascategory);
        return view('productioncomponents::Fashions.edit_fascategory')->with('fascategory',$fascategory);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, FashionCategory $fascategory,UpdateFashionsCategoryServices $service,FashionsCategoryServices $service1)
    {
        $request->validate([
          
            'fascategory_code' => ['required','numeric'], 
            'fascategory_name' => ['required' ,'unique:fashioncategory','max:45']
            ],[
            'fascategory_code.required'=>__('Fashion Category ID is Required Field...Please Add Fashion Category ID'),
              'fascategory_code.numeric'=>__('Fashion Category Code is Numeric Field Only'),

            'fascategory_name.required'=>__('Fashion Category Name is Required Field...Please Add Fashion Category Name'),
            'fascategory_name.unique'=>__('Fashion Category Name is Unique Field, Please Add Fashion Category Name'),
            'fascategory_name.max'=>__('Fashion...it is allowed to enter 45 characters in Fashion Category Name'),

        ]);
        
        $service->update_Fashion_category($fascategory,$request->all());
        session()->put('success',__('Fashion Category Modified Successfully'));
       
        $Allfascategory = $service1->FashionCategoryDetail($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::Fashions/Fascategory_table')->with('Allfascategory',$Allfascategory)->with('fascategory',$fascategory);
        }
       
        return redirect()-> route('fascategory.index')->with('Allfascategory',$Allfascategory)->with('fascategory',$fascategory);


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(FashionCategory $fascategory,SoftDeleteFasCategoryServices $service)
    {
        $service->softDelete_Fashion($fascategory);
        session()->put('success',__('Fashion Category Deleted Successfully'));
        return redirect()->back();
    }

/**
     * Restore the specified resource from storage.
     */
    public function restoreFasCategory($id,RestoreFasCategoryServices $service)
    {

       $service->restoreFasCategory($id);

        session()->put('success',__('Fashion Category Restored Successfully'));
        return redirect()->back();
    }

          /**
    * Display All deleted resource.
    */
   public function deletedCategoryFas(Request $request,DeleteFashionCategoryServices $service)
   {
       $Allfascategory = $service->deletedCategoryFashions($request->all());
       if($request->ajax()){
           return view('productioncomponents::Fashions/deleted_FashionCategory_table')->with('Allfascategory',$Allfascategory);
       }
       return view('productioncomponents::Fashions.deleted_FashionCategory')->with('Allfascategory',$Allfascategory);

   }
}
