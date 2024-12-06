@extends('frontend.layouts.app')
@section('meta')
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($news->content), 150) }}" />
    <meta property="og:image" content="{{ asset('storage/news/thumbnail/' . $news->thumbnail) }}" />
    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="article" />
@endsection
@section('content')
    <style>
        .centered-button {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .single-post-media img,
        .blog-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .single-post-media {
            max-width: 100%;
            overflow: hidden;
        }

        .blog-title-area,
        .blog-meta,
        .post-sharing {
            text-align: center;
        }

        .blog-content {
            text-align: justify;
            line-height: 1.6;
            letter-spacing: 0.5px;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .ad-container {
            width: 100%;
            max-width: 728px;
            /* Adjust this value as needed */
            margin: 0 auto;
            /* Center the ad */
            overflow: hidden;
            /* Prevent overflow */
        }

        @media (max-width: 768px) {
            .ad-container {
                max-width: 100%;
                /* Allow full width on smaller screens */
                height: auto;
                /* Adjust height as needed */
            }
        }
    </style>
    <div style="margin-top:-60px" class="ad-container">
        <script type="text/javascript">
            atOptions = {
                'key': '85a7d10931f0a4b936a4aabea9f2bc14',
                'format': 'iframe',
                'height': 90,
                'width': 728,
                'params': {}
            };
        </script>
        <div class="container">
            <section class="section single-wrapper">
                <script type="text/javascript" src="//www.topcreativeformat.com/85a7d10931f0a4b936a4aabea9f2bc14/invoke.js"></script>
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area text-center">
                                <ol class="breadcrumb d-none d-md-block">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                                    <li class="breadcrumb-item active">{{ $news->title }}</li>
                                </ol>

                                <h3>{{ $news->title }}</h3>

                                <div class="blog-meta big-meta">
                                    <small><a href="#"
                                            title="">{{ release_date($news->published_at) }}</a></small>
                                    <small><a href="#" title="">by {{ $user->name }}</a></small>
                                    <small><a href="#" title=""><i class="fa fa-eye"></i>
                                            {{ $news->views }}</a></small>
                                </div>
                            </div>

                            <div class="single-post-media">
                                <img src="{{ asset('storage/news/thumbnail/' . $news->thumbnail) }}" alt=""
                                    class="img-fluid">
                            </div>

                            <div class="blog-content">
                                {!! $news->content !!}
                            </div>

                            <div class="blog-title-area">
                                <div class="tag-cloud-single">
                                    <span>Tags</span>
                                    @foreach ($news->tags as $tag)
                                        <small><a href="#" title="">{{ $tag }}</a></small>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner-spot clearfix">
                                        <div class="banner-img">
                                            <img src="{{ asset('upload/banner_01.jpg') }}" alt=""
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="invis1">

                            <div class="custombox prevnextpost clearfix">
                                <div class="row">
                                    <!-- Previous Post -->
                                    <div class="col-lg-6">
                                        <div class="card h-100 d-flex flex-column">
                                            <a href="{{ route('news.show', $prevNews ? $prevNews->id : $news->id) }}"
                                                class="d-flex flex-column flex-grow-1 text-decoration-none">
                                                <!-- Content Area -->
                                                <div class="d-flex flex-column flex-grow-1 p-3">
                                                    <img src="{{ asset('storage/news/thumbnail/' . ($prevNews ? $prevNews->thumbnail : $news->thumbnail)) }}"
                                                        alt="" class="img-thumbnail w-100 mb-3"
                                                        style="max-height: 300px; object-fit: cover;">

                                                    <div class="text-left">
                                                        <h5 class="card-title mb-1">
                                                            {{ $prevNews ? $prevNews->title : $news->title }}</h5>
                                                    </div>
                                                </div>
                                                <div class="mt-auto p-3 centered-button-container">
                                                    <a href="{{ route('news.show', $prevNews ? $prevNews->id : $news->id) }}"
                                                        class="btn btn-primary centered-button">
                                                        Previous Post
                                                    </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Next Post -->
                                    <div class="col-lg-6">
                                        <div class="card h-100 d-flex flex-column">
                                            <a href="{{ route('news.show', $nextNews ? $nextNews->id : $news->id) }}"
                                                class="d-flex flex-column flex-grow-1 text-decoration-none">
                                                <!-- Content Area -->
                                                <div class="d-flex flex-column flex-grow-1 p-3">
                                                    <img src="{{ asset('storage/news/thumbnail/' . ($nextNews ? $nextNews->thumbnail : $news->thumbnail)) }}"
                                                        alt="" class="img-thumbnail w-100 mb-3"
                                                        style="max-height: 300px; object-fit: cover;">

                                                    <div class="text-left">
                                                        <h5 class="card-title mb-1">
                                                            {{ $nextNews ? $nextNews->title : $news->title }}</h5>
                                                    </div>
                                                </div>

                                                <!-- Button Area -->
                                                <div class="p-3 centered-button-container">
                                                    <a href="{{ route('news.show', $nextNews ? $nextNews->id : $news->id) }}"
                                                        class="btn btn-primary centered-button">
                                                        Next Post
                                                    </a>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr class="invis1">

                            <div class="custombox authorbox clearfix">
                                <h4 class="small-title">About author</h4>
                                <div class="row">
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <h4><a href="#">{{ $user->name }}</a></h4>
                                        <p>{{ $user->name }}</p>

                                        <div class="topsocial">
                                            <a href="{{ $user->facebook }}" data-toggle="tooltip" data-placement="bottom"
                                                title="Facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="{{ $user->youtube }}" data-toggle="tooltip" data-placement="bottom"
                                                title="Youtube"><i class="fa fa-youtube"></i></a>
                                            <a href="{{ $user->pinterest }}" data-toggle="tooltip" data-placement="bottom"
                                                title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                            <a href="{{ $user->twitter }}" data-toggle="tooltip" data-placement="bottom"
                                                title="Twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="{{ $user->instagram }}" data-toggle="tooltip"
                                                data-placement="bottom" title="Instagram"><i
                                                    class="fa fa-instagram"></i></a>
                                            <a href="{{ $user->website }}" data-toggle="tooltip" data-placement="bottom"
                                                title="Website"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">{{ $news->comments->count() }} Comments</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="comments-list">
                                            @foreach ($news->comments as $comment)
                                                <div class="media mb-3 p-3 rounded" style="background-color: #f8f9fa;">
                                                    <a class="media-left mr-3" href="#">
                                                        <img src="{{ asset('path/to/default/image.jpg') }}"
                                                            alt="" class="rounded-circle"
                                                            style="width: 50px; height: 50px;">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="media-heading user_name mb-1">
                                                            {{ $comment->name ?? 'Anonymous' }} <small
                                                                class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                        </h5>
                                                        <p class="mb-0">{{ $comment->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="invis1">
                            <div class="custombox clearfix">
                                <h4 class="small-title">Leave a reply</h4>
                                <form role="form" method="post" action="{{ route('comments.store') }}">
                                    @csrf
                                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                                    <div class="form-group">
                                        <label for="name">Name (optional)</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="6" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @include('frontend.website.news_extra')
                </div>
        </div>
    </div>
    </section>
@endsection
