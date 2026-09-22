<?php

namespace App\Http\Controllers;

use App\Actions\CreateContactEnquiryAction;
use App\Http\Requests\StoreContactEnquiryRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactEnquiryController extends Controller
{
    public function create(): View
    {
        return view('contact.create', [
            'services' => Service::published()->orderBy('sort_order')->get(['id', 'title']),
        ]);
    }

    public function store(StoreContactEnquiryRequest $request, CreateContactEnquiryAction $createContactEnquiry): RedirectResponse
    {
        $createContactEnquiry->handle($request->validated(), $request->file('attachment'));

        return to_route('contact.create')->with('status', 'Thank you. Your enquiry has been received and our team will contact you shortly.');
    }
}
