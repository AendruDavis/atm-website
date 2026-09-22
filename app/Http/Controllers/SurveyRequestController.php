<?php

namespace App\Http\Controllers;

use App\Actions\CreateSurveyRequestAction;
use App\Http\Requests\StoreSurveyRequestRequest;
use App\Models\Service;
use App\Models\SurveyRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SurveyRequestController extends Controller
{
    public function create(): View
    {
        return view('survey-requests.create', [
            'services' => Service::published()->orderBy('sort_order')->get(['id', 'title']),
        ]);
    }

    public function store(StoreSurveyRequestRequest $request, CreateSurveyRequestAction $createSurveyRequest): RedirectResponse
    {
        $surveyRequest = $createSurveyRequest->handle($request->validated(), $request->file('attachments', []));

        return to_route('survey-requests.success', $surveyRequest);
    }

    public function success(SurveyRequest $surveyRequest): View
    {
        return view('survey-requests.success', compact('surveyRequest'));
    }
}
