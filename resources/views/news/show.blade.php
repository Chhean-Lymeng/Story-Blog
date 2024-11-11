@extends('layouts.app', ['title' => 'News'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
            <li class="breadcrumb-item active">@lang('public.news')</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 grid-margin">
            <div class="card rounded">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <p>{{ $news->title_kh }}</p>
                                <p class="tx-15 text-muted">@lang('public.prepare_by'): {{ $news->prepare_by }} <br>
                                    @lang('public.published_at'): {{ published_at($news->published_at) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box text-center mt-4">
                    <img src="{{ asset('storage/image/news/thumbnail/' . $news->thumbnail) }}" width="300px">
                </div>
                <div class="card-body text-center">
                    <p id="description">{!! $news->remark_kh !!}</p>
                </div>
                @foreach ($image_albums as $image_album)
                    <div class="card-box text-center mt-4">
                        <img src="{{ asset('storage/image/news/albums/' . $image_album->name) }}" width="300px">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
@endsection
