@extends('frontend.layouts.app')

@section('content')
<style>
    .single-post-media img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }
    .single-post-media {
    max-width: 100%; /* Ensure container doesn't exceed parent width */
    overflow: hidden; /* Prevent overflow if the image exceeds container */
}

    .blog-content {
        text-align: center;
    }

    .blog-title-area, .blog-meta, .post-sharing {
        text-align: center;
    }

    .text-warning {
        color: #ffc107 !important;
    }
</style>

<section class="section single-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-title-area text-center">
                        <ol class="breadcrumb d-none d-md-block">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Blog</a></li>
                            <li class="breadcrumb-item active">{{ $news->title }}</li>
                        </ol>

                        {{-- <span class="text-warning"><a href="{{ route('category.show', $news->category_id) }}" title="">{{ $news->category_name }}</a></span> --}}

                        <h3>{{ $news->title }}</h3>

                        <div class="blog-meta big-meta">
                            <small><a href="#" title="">{{ release_date($news->published_at) }}</a></small>
                            <small><a href="#" title="">by {{ $news->author_name }}</a></small>
                            <small><a href="#" title=""><i class="fa fa-eye"></i> {{ $news->views }}</a></small>
                        </div>

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="d-none d-md-inline">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="d-none d-md-inline">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="single-post-media">
                        <img src="{{ asset('upload/' . $news->image) }}" alt="" class="img-fluid">
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

                        <div class="post-sharing">
                            <ul class="list-inline">
                                <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-spot clearfix">
                                <div class="banner-img">
                                    <img src="{{ asset('upload/banner_01.jpg') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="invis1">

                    <div class="custombox prevnextpost clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="{{ route('news.show', $prevNews->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between text-right">
                                                <img src="{{ asset('upload/' . $prevNews->image) }}" alt="" class="img-fluid float-right">
                                                <h5 class="mb-1">{{ $prevNews->title }}</h5>
                                                <small>Prev Post</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="blog-list-widget">
                                    <div class="list-group">
                                        <a href="{{ route('news.show', $nextNews->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                            <div class="w-100 justify-content-between">
                                                <img src="{{ asset('upload/' . $nextNews->image) }}" alt="" class="img-fluid float-left">
                                                <h5 class="mb-1">{{ $nextNews->title }}</h5>
                                                <small>Next Post</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="invis1">

                    <div class="custombox authorbox clearfix">
                        <h4 class="small-title">About author</h4>
                        <div class="row">
                            {{-- <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <img src="{{ asset('upload/' . $user->image) }}" alt="" class="img-fluid rounded-circle">
                            </div> --}}

                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <h4><a href="#">{{ $user->name }}</a></h4>
                                <p> {{ $user->name }}</p>

                                <div class="topsocial">
                                    <a href="{{ $user->facebook }}" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                                    <a href="{{ $user->youtube }}" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                                    <a href="{{ $user->pinterest }}" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                                    <a href="{{ $user->twitter }}" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                                    <a href="{{ $user->instagram }}" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                                    <a href="{{ $user->website }}" data-toggle="tooltip" data-placement="bottom" title="Website"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="invis1">

                    {{-- <div class="custombox clearfix">
                        <h4 class="small-title">You may also like</h4>
                        <div class="row">
                            @foreach ($relatedNews as $newsItem)
                                <div class="col-lg-6">
                                    <div class="blog-box">
                                        <div class="post-media">
                                            <a href="{{ route('news.show', $newsItem->id) }}" title="">
                                                <img src="{{ asset('upload/' . $newsItem->image) }}" alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                    <span class=""></span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="blog-meta">
                                            <h4><a href="{{ route('news.show', $newsItem->id) }}" title="">{{ $newsItem->title }}</a></h4>
                                            <small><a href="#" title="">{{ $newsItem->category_name }}</a></small>
                                            <small><a href="#" title="">{{ $newsItem->published_at->format('d M, Y') }}</a></small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">3 Comments</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="comments-list">
                                    {{-- @foreach ($comments as $comment)
                                        <div class="media">
                                            <a class="media-left" href="#">
                                                <img src="{{ asset('upload/' . $comment->author_image) }}" alt="" class="rounded-circle">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading user_name">{{ $comment->author_name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h4>
                                                <p>{{ $comment->content }}</p>
                                                <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                            </div>
                                        </div>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="invis1">

                    <div class="custombox clearfix">
                        <h4 class="small-title">Leave a Comment</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                {{-- <form action="{{ route('comments.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" id="comment" name="content" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">
                                <img src="upload/banner_07.jpg" alt="" class="img-fluid">
                            </div><!-- end banner-img -->
                        </div><!-- end banner -->
                    </div><!-- end widget -->

                    <div class="widget">
                        <h2 class="widget-title">Trend Videos</h2>
                        <div class="trend-videos">
                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="upload/tech_video_01.jpg" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                            <span class="videohover"></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="tech-single.html" title="">We prepared the best 10 laptop presentations for you</a></h4>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->

                            <hr class="invis">

                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="upload/tech_video_02.jpg" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                            <span class="videohover"></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="tech-single.html" title="">We are guests of ABC Design Studio - Vlog</a></h4>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->

                            <hr class="invis">

                            <div class="blog-box">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="upload/tech_video_03.jpg" alt="" class="img-fluid">
                                        <div class="hovereffect">
                                            <span class="videohover"></span>
                                        </div><!-- end hover -->
                                    </a>
                                </div><!-- end media -->
                                <div class="blog-meta">
                                    <h4><a href="tech-single.html" title="">Both blood pressure monitor and intelligent clock</a></h4>
                                </div><!-- end meta -->
                            </div><!-- end blog-box -->
                        </div><!-- end videos -->
                    </div><!-- end widget -->

                    <div class="widget">
                        <h2 class="widget-title">Popular Posts</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="upload/tech_blog_08.jpg" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">5 Beautiful buildings you need..</h5>
                                        <small>12 Jan, 2016</small>
                                    </div>
                                </a>

                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="upload/tech_blog_01.jpg" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">Let's make an introduction for..</h5>
                                        <small>11 Jan, 2016</small>
                                    </div>
                                </a>

                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 last-item justify-content-between">
                                        <img src="upload/tech_blog_03.jpg" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">Did you see the most beautiful..</h5>
                                        <small>07 Jan, 2016</small>
                                    </div>
                                </a>
                            </div>
                        </div><!-- end blog-list -->
                    </div><!-- end widget -->

                    <div class="widget">
                        <h2 class="widget-title">Recent Reviews</h2>
                        <div class="blog-list-widget">
                            <div class="list-group">
                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="upload/tech_blog_02.jpg" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">Banana-chip chocolate cake recipe..</h5>
                                        <span class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                </a>

                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 justify-content-between">
                                        <img src="upload/tech_blog_03.jpg" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">10 practical ways to choose organic..</h5>
                                        <span class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                </a>

                                <a href="tech-single.html" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="w-100 last-item justify-content-between">
                                        <img src="upload/tech_blog_07.jpg" alt="" class="img-fluid float-left">
                                        <h5 class="mb-1">We are making homemade ravioli..</h5>
                                        <span class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        </div><!-- end blog-list -->
                    </div><!-- end widget -->

                    <div class="widget">
                        <h2 class="widget-title">Follow Us</h2>

                        <div class="row text-center">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="#" class="social-button facebook-button">
                                    <i class="fa fa-facebook"></i>
                                    <p>27k</p>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="#" class="social-button twitter-button">
                                    <i class="fa fa-twitter"></i>
                                    <p>98k</p>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="#" class="social-button google-button">
                                    <i class="fa fa-google-plus"></i>
                                    <p>17k</p>
                                </a>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                <a href="#" class="social-button youtube-button">
                                    <i class="fa fa-youtube"></i>
                                    <p>22k</p>
                                </a>
                            </div>
                        </div>
                    </div><!-- end widget -->

                    <div class="widget">
                        <div class="banner-spot clearfix">
                            <div class="banner-img">
                                <img src="upload/banner_03.jpg" alt="" class="img-fluid">
                            </div><!-- end banner-img -->
                        </div><!-- end banner -->
                    </div><!-- end widget -->
                </div><!-- end sidebar -->
            </div>
        </div>
    </div>
</section>
@endsection
