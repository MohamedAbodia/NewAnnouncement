<?php

namespace App\Http\Controllers;

use App\data_display_options_interface;
use App\DataDisplayOptionsInterface;
use App\Http\Requests\StoreDataValidation;
use App\Http\Resources\DataDisplayOptionResource;
use App\Models\DataDisplayOption;
use App\Models\DataDisplayOptions;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;

class DataDisplayOptionsApiController extends Controller
{
    protected $repository;
    public function __construct(DataDisplayOptionsInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(StoreDataValidation  $request)
    {
        return $this->repository->store($request);
    }

    
    public function destroy($DataId)
    {
        return $this->repository->destroy($DataId);
    }
}
