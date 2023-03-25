<?php


namespace Modules\Core\Services;

use Illuminate\Support\Facades\App;

class LanguageService
{
    public function change_language($locale){
        App::setLocale($locale);
    }
}
