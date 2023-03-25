<?php

namespace Modules\Samples\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Samples\Entities\Samplecreation;
use Modules\Samples\Entities\Sample_infocreation;
use Modules\Customers\Entities\CustomerInfo;
use Modules\Samples\Services\Sampleorder\SamplesOrderServices;
use Modules\Samples\Services\SamplesCreation\TestSamplesServices;
use Modules\Samples\Services\SamplesCreation\confirmSampleTestService;
use Modules\Samples\Services\SamplesCreation\EditsampleServices;
use Modules\Samples\Services\SamplesCreation\UpdatSampleServices;
use Modules\Samples\Services\SamplesCreation\RecreateSampleServices;
use Modules\Samples\Services\SamplesCreation\viewSampleServices;



class TestSamplesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request,TestSamplesServices $service)
    {
   
        $TestSample = $service->get_testsamples($request->all());
        $counttestsample=$service->count_testsamples($request->all());
        $countsampleinlab = $service->count_SampleStelinLab($request->all());
        if($request->ajax()){
            return view('samples::SamplesCreation/test_sample_table')->with('TestSample',$TestSample);
            // return view('samples::SamplesCreation/test_sample_inlab_table')->with('TestSampleInLab',$TestSampleInLab);
        }

        return view('samples::SamplesCreation/all_test_samples')->with('TestSample',$TestSample)
        ->with('counttestsample',$counttestsample)->with('countsampleinlab',$countsampleinlab);
        // return view('samples::index');
    }

    public function indexinlab(Request $request,TestSamplesServices $service)
    {
   
        $TestSampleInLab = $service->get_SampleStelinLab($request->all());
        $counttestsample=$service->count_testsamples($request->all());
        $countsampleinlab = $service->count_SampleStelinLab($request->all());
        if($request->ajax()){
            return view('samples::SamplesCreation/test_sample_inlab_table')->with('TestSampleInLab',$TestSampleInLab);
        }

        return view('samples::SamplesCreation/all_inlab_samples')->with('TestSampleInLab',$TestSampleInLab)
        ->with('counttestsample',$counttestsample)->with('countsampleinlab',$countsampleinlab);
        // return view('samples::index');
    }

    public function indexbank(Request $request,TestSamplesServices $service,SamplesOrderServices $service1)
    {
   
        $banksamples = $service->get_Samplebank($request->all());
        $counttestsample=$service->count_testsamples($request->all());
        $countsampleinlab = $service->count_SampleStelinLab($request->all());
        $CustomerName  = $service1->getCustomerName();
        $FabricName  = $service1->getFabricName();
        $ColorCatName = $service1->getColorsCategoryName();
        $FashionCatName= $service1->getFashionCatName();
        $UsersName=$service1->getUserName();
        if($request->ajax()){
            return view('samples::SamplesCreation/samples_bank_table')->with('banksamples',$banksamples);
        }

        return view('samples::SamplesCreation/samples_bank')->with('banksamples',$banksamples)
        ->with('counttestsample',$counttestsample)->with('countsampleinlab',$countsampleinlab)
        ->with('CustomerName',$CustomerName)->with('FabricName',$FabricName)
        ->with('ColorCatName',$ColorCatName)->with('FashionCatName',$FashionCatName)->with('UsersName',$UsersName);
        // return $banksamples;
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('samples::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('samples::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($Sample_inlab,EditsampleServices $service,SamplesOrderServices $SamplesOrderservice)
    {
        $ColorsName  = $SamplesOrderservice->getColorName();
        $FashionsName  = $SamplesOrderservice->getFashionName();
        $Sample_inlab = $service->editCustomer($Sample_inlab);
        return view('samples::SamplesCreation.edit')
            ->with('Sample_inlab',$Sample_inlab)->with('ColorsName',$ColorsName)->with('FashionsName',$FashionsName);

        // return $Sample_inlab;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,Samplecreation $Sample_create ,UpdatSampleServices $service,TestSamplesServices $service1)
    {
        $request->validate([
          
            'phase_name' => ['required'],
            // 'technical_description' => ['required' ,'unique:sample_creation'],
            // 'operation_type' => ['required']
            ],[
            // 'operation_type.required'=>__('Operation Type is Required Field...Please Select Operation Type'),
            // 'technical_description.required'=>__('Technical Description is Required Field...Please Add Technical Description'),
            // 'technical_description.unique'=>__('Technical Description is Unique Field, Please Add Technical Description'),
            'phase_name.required'=>__('Phase Name is Required Field...Please Add Phase Name'),

        ]);

        $service->update_sample_creation($Sample_create,$request->all());
        session()->put('success',__('Sample Created Successfully'));
       
        $TestSampleInLab = $service1->get_SampleStelinLab($request->all());
        $counttestsample=$service1->count_testsamples($request->all());
        $countsampleinlab = $service1->count_SampleStelinLab($request->all());
        if($request->ajax()){
            return redirect()-> route('samples::SamplesCreation/test_sample_inlab_table')->with('Sample_create',$Sample_create);
        }
       
        return redirect()-> route('inlabSample.index')->with('TestSampleInLab',$TestSampleInLab)
        ->with('counttestsample',$counttestsample)->with('countsampleinlab',$countsampleinlab);
        // return $request->all();
    }
    
    public function viewsamplebank($Sample_bank,viewSampleServices $service)
    {

        $Sample_bank = $service->viewSampleBank($Sample_bank);
        return view('samples::SamplesCreation/view_sample')
            ->with('Sample_bank',$Sample_bank);

        // return $Sample_bank;
    }

    public function editsamplebank($Sample_bank,EditsampleServices $service,SamplesOrderServices $SamplesOrderservice)
    {
        $ColorsName  = $SamplesOrderservice->getColorName();
        $FashionsName  = $SamplesOrderservice->getFashionName();
        $Sample_bank = $service->editSampleBank($Sample_bank);
        return view('samples::SamplesCreation/edit_sample')
            ->with('Sample_bank',$Sample_bank)->with('ColorsName',$ColorsName)->with('FashionsName',$FashionsName);

        // return $Sample_bank;
    }
    public function update_sampleinfo(Request $request, $Sample_info ,UpdatSampleServices $service)
    {
        // $Sample_info = Sample_infocreation::where('sample_code',$Sample_info)->first();
        $request->validate([
          
            'phase_name' => ['required']
            ],[

            'phase_name.required'=>__('Phase Name is Required Field...Please Add Phase Name'),

        ]);

        $service->update_sample_info($Sample_info,$request->all());
        session()->put('success',__('Sample Updated Successfully'));
        return redirect()->back()->withInput();

        // return $Sample_info;
    }

    public function editrecreate($Sample_bank,EditsampleServices $service,SamplesOrderServices $SamplesOrderservice)
    {
        $ColorsName  = $SamplesOrderservice->getColorName();
        $FashionsName  = $SamplesOrderservice->getFashionName();
        $CustomerName  = $SamplesOrderservice->getCustomerName();
        $FabricName  = $SamplesOrderservice->getFabricName();
        $Sample_inlab = $service->editSampleBank($Sample_bank);
        return view('samples::SamplesCreation.re_edit')
            ->with('Sample_inlab',$Sample_inlab)->with('ColorsName',$ColorsName)->with('FashionsName',$FashionsName)
            ->with('CustomerName1',$CustomerName)->with('FabricName',$FabricName);

        // return $Sample_inlab;
    }

    
    public function update_recreate(Request $request, $Sample_info ,RecreateSampleServices $service)
    {
        
        // $request->validate([
          
        //     'phase_name' => ['required']
        //     ],[

        //     'phase_name.required'=>__('Phase Name is Required Field...Please Add Phase Name'),

        // ]);

        // $service->sample_recreation($Sample_info,$request->all());
        // session()->put('success',__('Sample Updated Successfully'));
        // return redirect()->back()->withInput();

        return $request->all();
    }

    /**
     * Remove the specified resource from storage. 
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function getOptions($id,SamplesOrderServices $SamplesOrderservice)
    {
        if($id =='colors'){
        $options  = $SamplesOrderservice->getColorNames(); // call the method in your repository to get the options

        return response()->json($options);
    }else{
        $options  = $SamplesOrderservice->getFashionNames(); // call the method in your repository to get the options

        return response()->json($options);

    }
    }
}
