<?php

namespace Modules\Settings\Services;

use Modules\Core\Services\S3Service;
use Modules\Settings\Repositories\SiteSettingRepositoryEloquent;

class SiteSettingsService
{
    private $setting;
    public function __construct(SiteSettingRepositoryEloquent $setting)
    {
        $this->setting = $setting;

    }

    public function siteSettings($data)
    {
        $siteSettings = $this->setting->first();
        $aws = new S3Service();
        if(isset($data['image'])){
            $site_image = request()->file('image');
            $site_img = time().rand(11111,99999).$site_image->getClientOriginalName();
            $aws->upload('uploads/settings'.$site_img,$site_image);
            $siteSettings->site_logo = 'uploads/settings'.$site_img;
        }
        $start = date('Y-m-d',strtotime(str_replace('/','-',$data['offer_start_at'])));
        $end = date('Y-m-d',strtotime(str_replace('/','-',$data['offer_end_at'])));

        $siteSettings->update([
            'site_name'	=> $data['site_name'],
            'site_email' => $data['site_email'],
            'phone' => $data['phone'],
            'facebook' => $data['facebook'],
            'linkedin' => $data['linkedin'],
            'instagram' => $data['instagram'],
            'youtube' => $data['youtube'],
            'twitter' => $data['twitter'],
            'telegram' => $data['telegram'],
            'tiktok' => $data['tiktok'],
            'slogan' => $data['slogan'],
            'address' => $data['address'],
            'contact_message' => $data['contact_message'],
            'contact_message_ar' => $data['contact_message_ar'],
            'about' => $data['about'],
            'about_ar' => $data['about_ar'],
            'default_currancy' => $data['default_currancy'],
            'convert_to_usd' => $data['convert_to_usd'],
            'cashback_percentage' => $data['cashback_percentage'],
            'minimum_order_cashback' => $data['minimum_order_cashback'],
            'offer_amount' => $data['offer_amount'],
            'offer_deduction' => $data['offer_deduction'],
            'offer_applied_on' => $data['offer_applied_on'],
            'offer_start_at' => $start . ' ' . '00:00:00',
            'offer_end_at' => $end . ' ' . '23:59:59'
        ]);
    }
}
