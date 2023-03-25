<?php


namespace Modules\ProductionComponents\Services;


use Modules\ProductionComponents\Repositories\ThreadInfoRepositoryEloquent;

class StoreThreadService
{
    public $thread_info;
    public $lastId;
    public function __construct(ThreadInfoRepositoryEloquent $thread_info)
    {
        $this->thread_info = $thread_info;
    }
    public function store_thread($data)
    {
       // $aws = new S3Service();

       $lastId = $this->thread_info->withTrashed()->select('id')->latest('id')->pluck('id')->first();
       
       $this->thread_info->create([     
       
        'thread_code'=>$lastId+1,
        'thread_name'=>$data['thread_name'],
        'thread_color'=>$data['thread_colortext'],
        'created_by'=>auth()->user()->id,
        'created_at'=>now()
       
    ]);

   
/*
        $customer = $this->user->create([
            'ip_address'=>request()->ip(),
            'username'=>$data['username'],
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'phone'=>$data['phone'],
            'full_name'=>$data['username'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
            'created_by'=>auth()->user()->id,
            'created_on'=>time(),
            'active'=>1
        ]);

        $group = $this->group->where('name','customer')->first();
        $this->user_group->create([
            'user_id'=>$customer->id,
            'group_id'=>$group->id,
        ]);

        foreach($data['shipping'] as $key=> $address){
                $info = $this->thread_info->create([
                    'customer_id' => $customer->id,
                    'shipping_firstname' =>$address['first_name'],
                    'shipping_lastname' => $address['last_name'],
                    'shipping_email' => $address['email'],
                    'shipping_phone' => $address['phone'],
                    'shipping_city' => $address['city'],
                    'shipping_area' => $address['area'],
                    'shipping_country' =>$address['country'],
                    'shipping_address' => $address['address'],
                    'shipping_zipcode' => $address['zip_code'],
                    'shop_name' => $data['shop_name'],
                    'shop_url' => $data['shop_online'],
                    'category_used' => json_encode($data['category_used']??[]),
                    'shoptype' => json_encode($data['shop_type']??[])
                ]);


                
                if (!empty($data['image'])){
                    $banner_image = request()->file('image');

                    $shop_banner = time().rand(11111,99999).$banner_image->getClientOriginalName();
                    $aws->upload('uploads/customers/'.$shop_banner,$banner_image);
                    $info->shop_banner = 'uploads/customers/'.$shop_banner;
                    $info->save();
                }*/


        }


    }