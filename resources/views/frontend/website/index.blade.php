@extends('frontend.layouts.app')
@section('content')

<section class="section first-section">
    <div class="d-flex justify-content-center">
        <script type="text/javascript">
            atOptions = {
                'key' : '85a7d10931f0a4b936a4aabea9f2bc14',
                'format' : 'iframe',
                'height' : 90,
                'width' : 728,
                'params' : {}
            };
        </script>
    </div>
    
    <script type="text/javascript" src="//www.topcreativeformat.com/85a7d10931f0a4b936a4aabea9f2bc14/invoke.js"></script>
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
            @foreach($news->take(2) as $article)
            <div class="first-slot">
                <div class="masonry-box post-media">
                    <img src="{{ asset('storage/news/thumbnail/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange">
                                    <a href="{{ route('category.show', $article->categories->id) }}" title="">{{ $article->categories->name }}</a>
                                </span>
                                <h4><a href="{{ route('news.show', $article->id) }}" title="">{{ $article->title }}</a></h4>
                                <small><a href="{{ route('news.show', $article->id) }}" title="">{{ release_date($article->published_at) }}</a></small>
                                <small><a href="{{ route('author.show', $article->user->id) }}" title="">by {{ $article->user->name }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-slot -->
            @endforeach 
        </div><!-- end masonry -->
    </div>
</section>

<section class="section">
    <div class="container">
        <script type="text/javascript">
            atOptions = {
                'key' : '85a7d10931f0a4b936a4aabea9f2bc14',
                'format' : 'iframe',
                'height' : 90,
                'width' : 728,
                'params' : {}
            };
        </script>
        <script type="text/javascript" src="//www.topcreativeformat.com/85a7d10931f0a4b936a4aabea9f2bc14/invoke.js"></script>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent Stories <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->
    
                    <div class="blog-list clearfix">
                        @foreach($news as $article)
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="{{ route('news.show', $article->id) }}" title="">
                                        <img src="{{ asset('storage/news/thumbnail/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="{{ route('news.show', $article->id) }}" title="">{{ $article->title }}</a></h4>
                                <p>{{ Str::limit($article->short_description, 150) }}</p>
                                <small><a href="{{ route('category.show', $article->categories->id) }}" title="">{{ $article->categories->name }}</a></small>
                                <small><a href="{{ route('news.show', $article->id) }}" title="">{{ release_date($article->published_at) }}</a></small>
                                <small><a href="{{ route('author.show', $article->user->id) }}" title="">by {{ $article->user->name }}</a></small>
                                <small><a href="{{ route('news.show', $article->id) }}" title=""><i class="fa fa-eye"></i> {{ $article->views_count }}</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
                        <hr class="invis">
                        @endforeach
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->

                <hr class="invis">

                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
            @include('frontend.website.news_extra')
        </div><!-- end row -->
    </div>
</section>

@endsection
