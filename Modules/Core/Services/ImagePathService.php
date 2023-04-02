<?php


namespace Modules\Core\Services;


class ImagePathService
{
    function getImagePath($foldername,$filename,$dimention=null){
        if(strpos($filename, 'assets') !== false){
            return public_path().'/'.$filename;
        }

        $awsimgurl = getenv('AWS_BUCKET_IMAGES_URL');
        if($foldername){
            if(strpos($filename, '/') !== false){
                $file = explode('/',$filename);
                $filename = $file[count($file)-1];
            }
            if($dimention){
                $path = 'uploads/'.$foldername.'/'.$dimention.'/'.$filename;
            }
            $path = 'uploads/'.$foldername.'/'.$filename;
        }else {
            if(strpos($filename, '.com/') !== false){
                $file = explode('.com/',$filename);
                $filename = $file[count($file)-1];
            }
            $path  = $filename;
        }

        if($awsimgurl != ''){
            $path = str_replace('/public/','',$path);
            $path = str_replace('public/','',$path);
            $path = $awsimgurl . $path;
        }
        else $path = public_path().'/'.$path;
        return $path;
    }

}
