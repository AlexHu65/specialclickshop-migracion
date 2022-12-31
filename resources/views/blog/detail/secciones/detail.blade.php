<section class="blog_area pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{asset('storage/' . $post->banner)}}" alt="{{$post->title}}">
                        </div>
                    </div>
                    <div class="col-lg-3  col-md-3">
                        <div class="blog_info text-right">
                            <div class="post_tag">
                                @php
                                    $tags = explode(',',$post->tags);
                                @endphp
                                @if ($tags)
                                    @foreach ($tags as $tag)
                                        <a href="{{route('blog.tag' , ['tag' => strtolower($tag)])}}">{{$tag}}</a>
                                    @endforeach
                                @endif
                            </div>
                            <ul class="blog_meta list">
                                <li>
                                    <a href="#">Admin
                                        <i class="lnr lnr-user"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">{{$post->created_at->format('m-d-Y')}}
                                        <i class="lnr lnr-calendar-full"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">{{$post->views}} Views
                                        <i class="lnr lnr-eye"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        </div>
                        <div class="col-lg-9 col-md-9 blog_details">
                            <h2>{{$post->title}}</h2>
                            {!! $post->content !!}
                                
                        </div>
                        
                </div>
                <div class="navigation-area">
                    <div class="row">
                        @if ($previous)
                            <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="thumb">
                                    <a href="{{route('blog.detail' ,['slug' => $previous->slug])}}">
                                        <img class="img-fluid" src="{{asset('img/blog/prev.jpg')}}" alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="lnr text-white lnr-arrow-left"></span>
                                    </a>
                                </div>
                                <div class="detials">
                                    <p>Prev Post</p>
                                    <a href="#">
                                        <h4>Space The Final Frontier</h4>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if ($next)
                            <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="detials">
                                    <p>Next Post</p>
                                    <a href="#">
                                        <h4>Telescopes 101</h4>
                                    </a>
                                </div>
                                <div class="arrow">
                                    <a href="#">
                                        <span class="lnr text-white lnr-arrow-right"></span>
                                    </a>
                                </div>
                                <div class="thumb">
                                    <a href="#">
                                        <img class="img-fluid" src="{{asset('img/blog/next.jpg')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    @include('blog.secciones.popular')
                    @include('blog.secciones.categories')
                    @include('blog.secciones.tags')
                </div>
            </div>
        </div>
    </div>
</section>