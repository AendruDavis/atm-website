@extends('layouts.app')
@section('title', 'Contact '.($siteSettings?->company_name ?? 'ATM Surveyors Uganda'))
@section('content')
<section class='page-hero'><div class='shell relative z-10 py-16 sm:py-24'><p class='eyebrow text-yellow-400'>Contact</p><h1 class='display-title mt-6'>Let’s discuss<br>your site.</h1></div></section>
<section class='bg-paper py-16 sm:py-24'><div class='shell grid gap-14 lg:grid-cols-[.7fr_1.3fr] lg:gap-24'>
    <aside class='reveal'>
        <h2 class='font-display text-3xl font-black uppercase text-green-950'>Direct contact</h2>
        <div class='mt-7 grid gap-5 text-sm'>
            <a class='border-t border-green-950/15 pt-4' href='tel:{{ preg_replace('/\D+/', '', $siteSettings?->phone ?? '+256779269784') }}'><span class='block text-xs font-black uppercase tracking-widest text-red-600'>Call</span><strong class='mt-1 block text-lg'>{{ $siteSettings?->phone ?? '+256 779 269 784' }}</strong></a>
            <a class='border-t border-green-950/15 pt-4' href='https://wa.me/{{ preg_replace('/\D+/', '', $siteSettings?->whatsapp ?? '+256703063147') }}'><span class='block text-xs font-black uppercase tracking-widest text-red-600'>WhatsApp</span><strong class='mt-1 block text-lg'>{{ $siteSettings?->whatsapp ?? '+256 703 063 147' }}</strong></a>
            <div class='border-t border-green-950/15 pt-4'><span class='block text-xs font-black uppercase tracking-widest text-red-600'>Office</span><strong class='mt-1 block text-lg'>{{ $siteSettings?->office_address ?? 'Kampala, Uganda' }}</strong></div>
        </div>
    </aside>
    <div class='reveal'>
        @if(session('status'))<div class='mb-8 border-l-4 border-green-700 bg-green-700/10 p-5 font-bold text-green-950' role='status'>{{ session('status') }}</div>@endif
        <form method='post' action='{{ route('contact.store') }}' enctype='multipart/form-data' class='grid gap-6 sm:grid-cols-2'>@csrf
            <div class='field'><label for='name'>Name *</label><input class='input @error('name') input-error @enderror' id='name' name='name' value='{{ old('name') }}' required>@error('name')<p class='error-text'>{{ $message }}</p>@enderror</div>
            <div class='field'><label for='organization'>Organization</label><input class='input' id='organization' name='organization' value='{{ old('organization') }}'></div>
            <div class='field'><label for='email'>Email *</label><input class='input' id='email' type='email' name='email' value='{{ old('email') }}' required>@error('email')<p class='error-text'>{{ $message }}</p>@enderror</div>
            <div class='field'><label for='telephone'>Telephone</label><input class='input' id='telephone' type='tel' name='telephone' value='{{ old('telephone') }}'></div>
            <div class='field sm:col-span-2'><label for='service_id'>Service</label><select class='input' id='service_id' name='service_id'><option value=''>Choose a service</option>@foreach($services as $service)<option value='{{ $service->id }}' @selected(old('service_id', request('service')) == $service->id)>{{ $service->title }}</option>@endforeach</select></div>
            <div class='field'><label for='location'>Project location</label><input class='input' id='location' name='location' value='{{ old('location') }}'></div>
            <div class='field'><label for='preferred_survey_date'>Preferred date</label><input class='input' id='preferred_survey_date' type='date' name='preferred_survey_date' value='{{ old('preferred_survey_date') }}'></div>
            <div class='field sm:col-span-2'><label for='project_description'>Tell us about the project *</label><textarea class='input min-h-40' id='project_description' name='project_description' required>{{ old('project_description') }}</textarea>@error('project_description')<p class='error-text'>{{ $message }}</p>@enderror</div>
            <div class='field sm:col-span-2'><label for='attachment'>Plan or reference file</label><input class='input py-3' id='attachment' type='file' name='attachment' accept='.pdf,.jpg,.jpeg,.png,.dwg,.dxf'><p class='text-xs text-ink/50'>PDF, image, DWG or DXF · maximum 10 MB</p>@error('attachment')<p class='error-text'>{{ $message }}</p>@enderror</div>
            <div class='sm:col-span-2'><button class='button button-red' type='submit'>Send enquiry →</button></div>
        </form>
    </div>
</div></section>
@endsection
