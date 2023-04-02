<?php

namespace Modules\ProductionComponents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductionComponents\Entities\ColorsCategory;
use Modules\ProductionComponents\Entities\Color;
// use Modules\ProductionComponents\Services\Colors\ColorsStagesServices;
use Modules\ProductionComponents\Services\Colors\EditColorsServices;
use Modules\ProductionComponents\Services\Colors\ColorStagesServices;
use Modules\ProductionComponents\Services\Colors\StoreColorStagesService;
use Modules\ProductionComponents\Services\Colors\ColorsCategoryServices;
use Modules\ProductionComponents\Services\Colors\UpdateColorsServices;
use Modules\ProductionComponents\Services\Colors\SoftDeleteColorServices;
use Modules\ProductionComponents\Services\Colors\DeletedColorServices;
use Modules\ProductionComponents\Services\Colors\RestorColorServices;

class ColorStagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,ColorStagesServices $service,ColorsCategoryServices $ColcategoryService)
    {
        $ColCategoryName  = $ColcategoryService->getColorsCategoryName();
        $Colors = $service->get_colors($request->all());
        if($request->ajax()){
            return view('productioncomponents::colors/colors_table')->with('Colors',$Colors)->with('ColCategoryName',$ColCategoryName);
        }
        return view('productioncomponents::colors.index')->with('Colors',$Colors)->with('ColCategoryName',$ColCategoryName);
//    return $Colors;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(EditColorsServices $service,ColorsCategoryServices $ColorcategoryService)
    {
        $ColorCategoryName1  = $ColorcategoryService->getColorsCategoryName();
        $categoryColorID =$ColorcategoryService->getCategoryColorID();
        $Color = $service->getColor();
        return view('productioncomponents::colors.create')->with('Color',$Color)->with('ColorCategoryName1',$ColorCategoryName1)->with('categoryColorID',$categoryColorID);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function save(Request $request ,StoreColorStagesService $service)
    {
        $request->validate([
          
            'colorcode' => ['required','numeric'],
            'colorname' => ['required' ,'unique:colors_stages','max:45'],
            'colcategcode' => ['required']
            ],[
            'colorcode.required'=>__('Color ID is Required Field...Please Add Color ID'),
              'colorcode.numeric'=>__('Sorry...it is allowed to enter 45 characters in Color Name'),

            'colorname.required'=>__('Color Name is Required Field...Please Add Color Name'),
            'colorname.unique'=>__('Color Name is Unique Field, Please Add Color Name'),
            'colorname.max'=>__('Sorry...it is allowed to enter 45 characters in Color Name'),

            'colcategcode.required'=>__('Sorry...You Mast Select A Category Color Name'),

        ]);

        
        $service->store_colorStages($request->all());
        session()->put('success',__('Color Created Successfully'));
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
    public function edit(Color $Color,EditColorsServices $service,ColorsCategoryServices $ColcategoryService)
    {
        $ColorCategoryName  = $ColcategoryService->getColorsCategoryName();
        $getCategoryColorID =$ColcategoryService->getCategoryColorID();
        $Color = $service->EditColors($Color);
        return view('productioncomponents::colors.edit')
            ->with('Color',$Color)->with('ColorCategoryName',$ColorCategoryName)->with('getCategoryColorID',$getCategoryColorID);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Color $Color,UpdateColorsServices $service,ColorStagesServices $service1)
    {
        $request->validate([
          
            'colorcode' => ['required','numeric'],
            'colorname' => ['required','max:45'],
            'colcategcode' => ['required']
            ],[
            'colorcode.required'=>__('Color ID is Required Field...Please Add Color ID'),
              'colorcode.numeric'=>__('Sorry...it is allowed to enter 45 characters in Color Name'),
            'colorcode.unique'=>__('Color Name is Unique Field, Please Add Color Name'),

            'colorname.required'=>__('Color Name is Required Field...Please Add Color Name'),
            // 'colorname.unique'=>__('Color Name is Unique Field, Please Add Color Name'),
            'colorname.max'=>__('Sorry...it is allowed to enter 45 characters in Color Name'),

            'colcategcode.required'=>__('Sorry...You Mast Select A Category Color Name'),

        ]);

        $service->update_color($Color,$request->all());
        session()->put('success',__('Color Modified Successfully'));
       
        $Color = $service1->get_colors($request->all());
        if($request->ajax()){
            return redirect()-> route('productioncomponents::colors/colors_table')->with('Color',$Color)->with('Color',$Color);
        }
       
        return redirect()-> route('colors.index')->with('Color',$Color)->with('Color',$Color);
    
     }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Color $Color,SoftDeleteColorServices $service)
    {
        $service->softDelete_Color($Color);
        session()->put('success',__('Color Deleted Successfully'));
        return redirect()->back();
    }

    public function restoreColor($id,RestorColorServices $service)
    {

       $service->restoreColor($id);

        session()->put('success',__('Color Restored Successfully'));
        return redirect()->back();
    }
    /**
    * Display All deleted resource.
    */
   public function deletedcolors(Request $request,DeletedColorServices $service)
   {
       $Colors = $service->deletedcolors($request->all());
       if($request->ajax()){
           return view('productioncomponents::colors/deleted_Color_table')->with('Colors',$Colors);
       }
       return view('productioncomponents::colors.deleted_Color')->with('Colors',$Colors);

   }

   /*pass print route*/
   public function printColors(Request $request,ColorStagesServices $service)
   {
       $Colors = $service->get_printcolors($request->all());

           return view('productioncomponents::colors.print_Colors')->with('Colors',$Colors);
   }
}
