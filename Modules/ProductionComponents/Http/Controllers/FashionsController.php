<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\ProductionComponents\Entities\Fashion;
use Modules\ProductionComponents\Entities\FashionCategory;
use Modules\ProductionComponents\Services\Fashions\FashionsCategoryServices;
use Modules\ProductionComponents\Services\Fashions\FashionStagesServices;
use Modules\ProductionComponents\Services\Fashions\EditFashionsServices;
use Modules\ProductionComponents\Services\Fashions\StoreFashionStagesService;
use Modules\ProductionComponents\Services\Fashions\UpdateFoshionsServices;
use Modules\ProductionComponents\Services\Fashions\SoftDeleteFashionServices;
use Modules\ProductionComponents\Services\Fashions\DeletedFashionServices;
use Modules\ProductionComponents\Services\Fashions\RestoreFashionServices;

class FashionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,FashionStagesServices $service,FashionsCategoryServices $FascategoryService)
    {
        $FasCategoryName  = $FascategoryService->getFashionsCategoryName();
        $Fashions = $service->get_fashions($request->all());
        if($request->ajax()){
            return view('productioncomponents::Fashions/Fashions_table')->with('Fashions',$Fashions)->with('FasCategoryName',$FasCategoryName);
        }
        return view('productioncomponents::Fashions.index')->with('Fashions',$Fashions)->with('FasCategoryName',$FasCategoryName);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(EditFashionsServices $service,FashionsCategoryServices $FashioncategoryService)
    {
        $FashionCategoryName  = $FashioncategoryService->getFashionsCategoryName();
        $categoryFashionID =$FashioncategoryService->getCategoryFashionID();
        $Color = $service->getFashion();
        return view('productioncomponents::Fashions.create')->with('Color',$Color)->with('FashionCategoryName',$FashionCategoryName)->with('categoryFashionID',$categoryFashionID);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request ,StoreFashionStagesService $service)
    {
        $request->validate([
          
            'fashioncode' => ['required','numeric','unique:fashions_stages'],
            'fashionname' => ['required' ,'unique:fashions_stages','max:45'],
            'fascateg_code' => ['required'],
            'fashioncount' => ['numeric','nullable', 'min:0.2','max:99.99'],
            'fashionnotes' => ['max:127']
            ],[
            'fashioncode.required'=>__('Fashion ID is Required Field...Please Add Fashion ID'),
              'fashioncode.numeric'=>__('Fashion ID is Numeric Field Only'),
            'fashioncode.unique'=>__('Fashion ID is Unique Field, Please Add Fashion Code'),

            'fashionname.required'=>__('Fashion Name is Required Field...Please Add Fashion Name'),
            'fashionname.unique'=>__('Fashion Name is Unique Field, Please Add Fashion Name'),
            'fashionname.max'=>__('Sorry...it is allowed to enter 45 characters in Fashion Name'),

            'fascateg_code.required'=>__('Sorry...You Mast Select A Category Fashion Name'),

            'fashioncount.numeric'=>__('Fashion Count is Numeric Field Only'),
            'fashioncount.max'=>__('Sorry...it is allowed to enter 99.99 characters in Fashion Count'),
            'fashioncount.min'=>__('Sorry...it is not allowed to enter smaller than 0.2 characters in Fashion Count'),

            'fashionnotes.max'=>__('Sorry...it is allowed to enter 127 characters in Fashion Notes'),
        ]);

        
        $service->store_fashionStages($request->all());
        session()->put('success',__('Fashion Created Successfully'));
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
    public function edit(Fashion $Fashion,EditFashionsServices $service,FashionsCategoryServices $FascategoryService)
    {

        $FashionCategoryName  = $FascategoryService->getFashionsCategoryName();
        // $getCategoryColorID =$ColcategoryService->getCategoryColorID();
        $Fashion = $service->EditFashions($Fashion);
        return view('productioncomponents::Fashions.edit')
            ->with('Fashion',$Fashion)->with('FashionCategoryName',$FashionCategoryName);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Fashion $Fashion,UpdateFoshionsServices $service,FashionStagesServices $service1)
    {
        $request->validate([
          
            'fashioncode' => ['required','numeric'],
            'fashionname' => ['required','max:45'],
            'fascateg_code' => ['required'],
            'fashioncount' => ['numeric','nullable', 'min:0.2','max:99.99'],
            'fashionnotes' => ['max:127']
            ],[
            'fashioncode.required'=>__('Fashion ID is Required Field...Please Add Fashion ID'),
              'fashioncode.numeric'=>__('Fashion ID is Numeric Field Only'),

            'fashionname.required'=>__('Fashion Name is Required Field...Please Add Fashion Name'),
            // 'fashionname.unique'=>__('Fashion Name is Unique Field, Please Add Fashion Name'),
            'fashionname.max'=>__('Sorry...it is allowed to enter 45 characters in Fashion Name'),

            'fascateg_code.required'=>__('Sorry...You Mast Select A Category Fashion Name'),

            'fashioncount.numeric'=>__('Fashion Count is Numeric Field Only'),
            'fashioncount.max'=>__('Sorry...it is allowed to enter 99.99 characters in Fashion Count'),
            'fashioncount.min'=>__('Sorry...it is not allowed to enter smaller than 0.2 characters in Fashion Count'),

            'fashionnotes.max'=>__('Sorry...it is allowed to enter 127 characters in Fashion Notes'),
        ]);

        $service->update_fashion($Fashion,$request->all());
        session()->put('success',__('Fashion Modified Successfully'));
       
        $Fashion = $service1->get_fashions($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::Fashions/Fashions_table')->with('Fashion',$Fashion)->with('Fashion',$Fashion);
        }
       
        return redirect()-> route('Fashions.index')->with('Fashion',$Fashion)->with('Fashion',$Fashion);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Fashion $Fashion,SoftDeleteFashionServices $service)
    {
        $service->softDelete_Fashion($Fashion);
        session()->put('success',__('Fashion Deleted Successfully'));
        return redirect()->back();
    }

    public function restoreFashion($id,RestoreFashionServices $service)
    {

       $service->restoreFashion($id);

        session()->put('success',__('Fashion Restored Successfully'));
        return redirect()->back();
    }
    /**
    * Display All deleted resource.
    */
    public function deletedFashions(Request $request,DeletedFashionServices $service)
    {
        $Fashions = $service->deletedFashions($request->all());
        if($request->ajax()){
            return view('productioncomponents::Fashions/deleted_Fashion_table')->with('Fashions',$Fashions);
        }
        return view('productioncomponents::Fashions.deleted_Fashion')->with('Fashions',$Fashions);
 
    }
   /*pass print route*/
   public function printFashions(Request $request,FashionStagesServices $service)
   {
       $Fashions = $service->get_printfashions($request->all());

           return view('productioncomponents::Fashions.print_Fashions')->with('Fashions',$Fashions);
   }
}
