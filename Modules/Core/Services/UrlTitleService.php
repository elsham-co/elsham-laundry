<?php


namespace Modules\Core\Services;


class UrlTitleService
{
    public function url_title(string $str, string $separator = '-', bool $lowercase = false): string
    {
        $q_separator = preg_quote($separator, '#');

        $trans = [
            '&.+?;'                   => '',
            '[^\w\d _-]'              => '',
            '\s+'                     => $separator,
            '(' . $q_separator . ')+' => $separator,
        ];

        $str = strip_tags($str);
        foreach ($trans as $key => $val)
        {
            $str = preg_replace('#' . $key . '#iu', $val, $str);
        }

        if ($lowercase === true)
        {
            $str = mb_strtolower($str);
        }

        return trim(trim($str, $separator));
    }

}
