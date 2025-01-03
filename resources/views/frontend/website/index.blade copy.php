@extends('frontend.layouts.app')
@section('content')
<section class="section first-section">
    <div class="container-fluid">
        <div class="masonry-blog clearfix">
            <div class="first-slot">
                <div class="masonry-box post-media">
                    <img src="{{asset('frontend/upload/tech_01.jpg')}}" alt="" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html"
                                        title="">Technology</a></span>
                                <h4><a href="tech-single.html" title="">Say hello to real handmade office
                                        furniture! Clean & beautiful design</a></h4>
                                <small><a href="tech-single.html" title="">24 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Amanda</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end first-side -->

            <div class="second-slot">
                <div class="masonry-box post-media">
                    <img src="{{asset('frontend/upload/tech_02.jpg')}}" alt="" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html"
                                        title="">Gadgets</a></span>
                                <h4><a href="tech-single.html" title="">Do not make mistakes when choosing web
                                        hosting</a></h4>
                                <small><a href="tech-single.html" title="">03 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Jessica</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->

            <div class="last-slot">
                <div class="masonry-box post-media">
                    <img src="{{asset('frontend/upload/tech_03.jpg')}}" alt="" class="img-fluid">
                    <div class="shadoweffect">
                        <div class="shadow-desc">
                            <div class="blog-meta">
                                <span class="bg-orange"><a href="tech-category-01.html"
                                        title="">Technology</a></span>
                                <h4><a href="tech-single.html" title="">The most reliable Galaxy Note 8 images
                                        leaked</a></h4>
                                <small><a href="tech-single.html" title="">01 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Jessica</a></small>
                            </div><!-- end meta -->
                        </div><!-- end shadow-desc -->
                    </div><!-- end shadow -->
                </div><!-- end post-media -->
            </div><!-- end second-side -->
        </div><!-- end masonry -->
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="page-wrapper">
                    <div class="blog-top clearfix">
                        <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a></h4>
                    </div><!-- end blog-top -->
    
                    <div class="blog-list clearfix">
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('frontend/upload/tech_blog_01.jpg')}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">Top 10 phone applications and 2017 mobile
                                        design awards</a></h4>
                                <p>Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et
                                    pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus
                                    ac felis nec, maximus tempor odio.</p>
                                <small><a href="tech-single.html" title="">21 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 1114</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
    
                        <hr class="invis">
    
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('frontend/upload/tech_blog_02.jpg')}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">A device you can use both headphones and
                                        usb</a></h4>
                                <p>Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et
                                    pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus
                                    ac felis nec, maximus tempor odio.</p>
                                <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html"
                                        title="">Technology</a></small>
                                <small><a href="tech-single.html" title="">21 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i>
                                        4412</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
    
                        <hr class="invis">
    
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('frontend/upload/tech_blog_03.jpg')}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">Two brand new laptop models from ABC
                                        computer</a></h4>
                                <p>Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et
                                    pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus
                                    ac felis nec, maximus tempor odio.</p>
                                <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html"
                                        title="">Development</a></small>
                                <small><a href="tech-single.html" title="">20 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i>
                                        2313</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
    
                        <hr class="invis">
    
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <div class="banner-spot clearfix">
                                    <div class="banner-img">
                                        <img src="{{asset('frontend/upload/banner_02.jpg')}}" alt="" class="img-fluid">
                                    </div><!-- end banner-img -->
                                </div><!-- end banner -->
                            </div><!-- end col -->
                        </div><!-- end row -->
    
                        <hr class="invis">
    
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('frontend/upload/tech_blog_04.jpg')}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">Applications for taking photos of nature in
                                        your mobile phones</a></h4>
                                <p>Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et
                                    pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus
                                    ac felis nec, maximus tempor odio.</p>
                                <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html"
                                        title="">Design</a></small>
                                <small><a href="tech-single.html" title="">19 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i>
                                        4441</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
    
                        <hr class="invis">
    
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('frontend/upload/tech_blog_05.jpg')}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">Say hello to colored strap models in smart
                                        hours</a></h4>
                                <p>Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et
                                    pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus
                                    ac felis nec, maximus tempor odio.</p>
                                <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html"
                                        title="">Materials</a></small>
                                <small><a href="tech-single.html" title="">18 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i>
                                        33312</a></small>
                            </div><!-- end meta -->
                        </div><!-- end blog-box -->
    
                        <hr class="invis">
    
                        <div class="blog-box row">
                            <div class="col-md-4">
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="{{asset('frontend/upload/tech_blog_06.jpg')}}" alt="" class="img-fluid">
                                        <div class="hovereffect"></div>
                                    </a>
                                </div><!-- end media -->
                            </div><!-- end col -->
    
                            <div class="blog-meta big-meta col-md-8">
                                <h4><a href="tech-single.html" title="">How about evaluating your old mobile phones
                                        in different ways?</a></h4>
                                <p>Aenean interdum arcu blandit, vehicula magna non, placerat elit. Mauris et
                                    pharetratortor. Suspendissea sodales urna. In at augue elit. Vivamus enim nibh, maximus
                                    ac felis nec, maximus tempor odio.</p>
                                <small><a href="tech-single.html" title="">17 July, 2017</a></small>
                                <small><a href="tech-author.html" title="">by Matilda</a></small>
                                <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i>
                                        4440</a></small>
                            </div><!-- end meta -->
                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end page-wrapper -->
    
                <hr class="invis">
    
                <div class="row">
                    <div class="col-md-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-start">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end col -->
            @include('frontend.website.news_extra')
        </div><!-- end row -->
    </div>
    </div>
     </section>
@endsection