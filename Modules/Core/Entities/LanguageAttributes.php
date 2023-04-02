<?php


namespace Modules\Core\Entities;

class LanguageAttributes extends CoreModel
{
    public static function lang_code()
    {
        return app()->getLocale();
    }

    public static function lang_dir()
    {
        if (app()->getLocale() == 'en') {
            return 'ltr';
        } else {
            return 'rtl';
        }
    }

    public static function current_lang()
    {
        $code = self::lang_code();
        $lang = Language::where('language_code', $code)->first();
        if (!isset($lang)) {
            return 1;
        }
        return $lang->id;
    }

    public static function get_lang_id($code)
    {
        $lang = Language::where('language_code', $code)->first();

        return $lang->id;
    }
}