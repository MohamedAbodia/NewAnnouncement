<?php

namespace App;

use App\Http\Requests\StoreFeedbackValidation;

interface FeedbackInterface
{
    public function index();
    public function show($FeedbackID);
    public function store(StoreFeedbackValidation  $request);
    public function update(StoreFeedbackValidation $request,$FeedbackId);
    public function destroy($FeedbackID);
}
