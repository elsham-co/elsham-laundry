<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\SiteSetting;
use Modules\Settings\Services\SiteSettingsService;

class SettingsController extends Controller
{

    public function edit(SiteSetting $setting)
    {

        return view('settings::edit')->with('site',$setting->first());
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request,SiteSettingsService $service)
    {
        $service->siteSettings($request->all());
        session()->put('success',__('Data Updated Successfully'));
        return redirect()->back();
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
}
