<?php

namespace App\Http\Controllers;

use App\FeedbackInterface;
use App\Http\Requests\StoreFeedbackValidation;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;


class FeedbackApiController extends Controller
{
    protected $interface;
    public function __construct(FeedbackInterface $interface)
    {
        $this->interface = $interface;
    }
    public function index()
    {
        return $this->interface->index();
    }

    public function show($FeedbackID)
    {
        return $this->interface->show($FeedbackID);
    }

    public function store(StoreFeedbackValidation  $request)
    {
        return $this->interface->store($request);
    }

    public function update(StoreFeedbackValidation $request,$FeedbackId)
    {
        return $this->interface->update($request,$FeedbackId);
    }

    public function destroy($FeedbackID)
    {
        return $this->interface->destroy($FeedbackID);
    }
}
