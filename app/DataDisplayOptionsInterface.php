<?php

namespace App;

use App\Http\Requests\StoreDataValidation;

interface DataDisplayOptionsInterface
{
    public function index();
    public function store(StoreDataValidation  $request);
    public function destroy($DataId);
}
