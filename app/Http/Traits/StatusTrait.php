<?php

namespace App\Http\Traits;

use App\Http\Services\LocalizationService;
use App\Models\Status;

trait StatusTrait
{
    private function fillData($request, $status)
    {
        $localization_data = LocalizationService::getLocalizationDataAsArray(Status::$translatableData, $request);
        $this->statusModel->updateOrCreate(['id' => $status->id], $localization_data);
        return true;
    }
}
