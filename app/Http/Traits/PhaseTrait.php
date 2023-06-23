<?php

namespace App\Http\Traits;

use App\Http\Services\LocalizationService;
use App\Models\Phase;
use function array_merge;
use function str_replace;

trait PhaseTrait
{
    private function fillData($request, $phase)
    {
        $data = LocalizationService::getLocalizationDataAsArray(Phase::$translatableData, $request);
        if (!$phase->id) {
            $last_phase = Phase::orderBy('step', 'desc')->first();
            $last_step_number = $last_phase->step;
            $data = array_merge($data, ['step' => $last_step_number + 1]);
        }
        $this->phaseModel->updateOrCreate(['id' => $phase->id], $data);
        return true;
    }
}
