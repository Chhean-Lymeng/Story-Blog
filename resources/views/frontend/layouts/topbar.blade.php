<header class="tech-header header">
    <div class="container-fluid">
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="{{ asset('frontend/images/version/tech-logo.png') }}" alt="" style="max-width: 200px; max-height: 50px;">
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown has-submenu menu-large hidden-md-down hidden-sm-down hidden-xs-down">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Story</a>
                        <ul class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                            <li>
                                <div class="container">
                                    <div class="mega-menu-content clearfix">
                                        <div class="tab">
                                            @foreach($categories as $index => $category)
                                                <button class="tablinks {{ $index === 0 ? 'active' : '' }}" onclick="openCategory(event, 'cat{{ $category->id }}')">{{ $category->name }}</button>
                                            @endforeach
                                        </div>
                                        <div class="tab-details clearfix">
                                            @foreach($categories as $category)
                                                <div id="cat{{ $category->id }}" class="tabcontent {{ $loop->first ? 'active' : '' }}">
                                                    <div class="row">
                                                        @foreach($category->news as $newsItem)
                                                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                                                <div class="blog-box">
                                                                    <div class="post-media">
                                                                        <a href="{{ route('news.show', $newsItem->id) }}" title="">
                                                                            <img src="{{ asset('storage/news/thumbnail/' . $newsItem->thumbnail) }}" alt="" class="img-fluid">
                                                                            <div class="hovereffect"></div>
                                                                            <span class="menucat">{{ $category->name }}</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="blog-meta">
                                                                        <h4><a href="{{ route('news.show', $newsItem->id) }}" title="">{{ $newsItem->title }}</a></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contact') }}">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-2">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-rss"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-android"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-apple"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div><!-- end container-fluid -->
</header>

