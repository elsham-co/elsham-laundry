<?php


namespace Modules\Core\Entities;

class DisplayImage extends CoreModel
{
    public static function displayImage($img)
    {
        $image = $img && $img != 'https://beljoumla.com'?
            (str_contains($img, 'public') || str_contains($img, 'https://beljoumla.com')?
                'uploads'.explode('/uploads', $img)[1]: explode('/uploads', $img)[0]):'';

        if (!str_contains($img, 'uploads')) {
            $image = 'uploads/products/'.$image;
        }

        return $image;
    }

    public static function getColor($current, $color=false)
    {
        $colors = ['red'=>'Red – أحمر','green'=>'Green – أخضر','blue'=>'Blue – أزرق','white'=>'White – أبيض','black'=>'Black – أسود',
                'yellow'=>'Yellow – أصفر','pink'=>'Pink – وردي ','purple'=>'Purple – بنفسجي','brown'=>'Brown – بني',
                'orange'=>'Orange – برتقالي','gray'=>'Gray – رمادي','baby blue'=>'Baby blue – سماوي','navy blue'=>'Navy blue – كحلي ',
                'turquoise'=>'Turquoise – فيروزي','beige'=>'Beige – بيج','burgundy'=>'Burgundy – أرجواني غامق',
                'baby pink'=>'Baby pink – زهري','hot pink'=>'Hot pink – فوشي','mustard'=>'Mustard – أصفر غامق ','caramel'=>'Caramel –بني فاتح',
                'أحمر'=>'Red – أحمر','أخضر'=>'Green – أخضر','أزرق'=>'Blue – أزرق','أبيض'=>'White – أبيض','أسود'=>'Black – أسود',
                'أصفر'=>'Yellow – أصفر','وردي'=>'Pink – وردي ','بنفسجي'=>'Purple – بنفسجي','بني'=>'Brown – بني',
                'برتقالي'=>'Orange – برتقالي','رمادي'=>'Gray – رمادي','سماوي'=>'Baby blue – سماوي','كحلي'=>'Navy blue – كحلي ',
                'فيروزي'=>'Turquoise – فيروزي','بيج'=>'Beige – بيج','أرجواني غامق'=>'Burgundy – أرجواني غامق',
                'زهري'=>'Baby pink – زهري','فوشي'=>'Hot pink – فوشي','أصفر غامق'=>'Mustard – أصفر غامق ','بني فاتح'=>'Caramel –بني فاتح'
            ];
    
        if ($color && !empty($colors[$current])) {
            $color = explode(' – ', $colors[$current]);
            return $color['1'] ?? $color['0'];
        }
        $options = '';
        foreach ($colors as $key => $color) {
            if ($current == $key) {
                $select = 'selected';
            } else {
                $select='';
            }
            $options .= '<option '.$select.' class="colorsoptions '.str_replace(' ', '_', $key).'"  value="'.$key.'">'.$color.'</option>';
        }
        return $options;
    }
}