<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getSelectOptions($model, $display_name="name")
    {
        $collections = $model::all();
        $options = $collections->map(function ($obj, $key) use ($display_name) {
            return [
                "id" => $obj['id'],
                "name" => $obj[$display_name]
            ];
        });
        return $options;
    }

    public function getEnumSelectOptions($enum)
    {
        $options = [];
        foreach ($enum as $key => $value) {
            $options[] = [
                "id" => $key,
                "name" => $value
            ];
        }
        return $options;
    }
}
