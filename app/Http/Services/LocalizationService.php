<?php


namespace App\Http\Services;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocalizationService
{
    public static function getModelRules($translatable): array
    {
        $data = [];

        foreach ($translatable as $item => $value) {
            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $key) {
                $data[$item . '_' . $key] = $value['validate'];
            }
        }
        return $data;
    }

    public static function getLocalizationDataAsArray($translatableData, $request): array
    {
        $data = [];
        foreach ($translatableData as $item => $value) {

            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $key) {
                $lang = $item . '_' . $key;
                $data[$item][$key] = $request->$lang;
            }
        }
        return $data;
    }

//    public static function getLocalizationAttributeWith_Lang($translatableData,): array
//    {
//        $data = [];
//        foreach ($translatableData as $item => $value) {
//
//            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $key) {
//                $lang = $item . '_' . $key;
//                $data[] = $lang;
//            }
//        }
//
//        return $data;
//
//    }

}
