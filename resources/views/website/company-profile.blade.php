@extends('website.layouts.app')

@section('content')
<div class="ps-about-intro">
    <div class="container">
        <div class="ps-section__header">
            <h1 class=" text-capitalize">{{$company->name ?? ''}}</h1>
        </div>
        <div class="ps-section__header">
            {!! $company->about ?? '' !!}
        </div>
    </div>
</div>
@endsection
