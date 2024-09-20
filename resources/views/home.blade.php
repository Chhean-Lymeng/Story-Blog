@extends('layouts.app', ['title' => 'Home'])
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">@lang('public.welcome')</h4>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">@lang('public.total_committee_activity')</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <div class="d-flex align-items-baseline">
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <img src="assets/images/activity.jpg" alt="Not Found!" width="100" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">@lang('public.total_news')</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <div class="d-flex align-items-baseline">
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <img src="assets/images/news.jpg" alt="Not Found!" width="100" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">@lang('public.total_ministry')</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <div class="d-flex align-items-baseline">
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <img src="assets/images/ministry.jpg" alt="Not Found!" width="100" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">@lang('public.total_laws')</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-6">
                                    <div class="d-flex align-items-baseline">
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-6">
                                    <img src="assets/images/laws.jpeg" alt="Not Found!" width="120" height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection