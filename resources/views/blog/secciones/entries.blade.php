<section class="blog_area pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <!-- empieza blog -->
                    @foreach ($posts as $post)
                    <article class="row blog_item">
                        <div class="col-md-3">
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
                        <div class="col-md-9">
                            <div class="blog_post">
                                <img src="{{asset('storage/' . $post->banner)}}" alt="{{$post->title}}">
                                <div class="blog_details">
                                    <a href="{{route('blog.detail' , ['slug' => $post->slug])}}">
                                        <h2>{{$post->title}}</h2>
                                    </a>
                                    <p> {!! $post->content !!} </p>
                                    <a class="button button-blog text-light" href="{{route('blog.detail' , ['slug' => $post->slug])}}">View More</a>
                                </div>
                            </div>
                        </div>
                    </article>    
                    @endforeach
                    <!--termina blog-->
                    <nav class="blog-pagination justify-content-center d-flex">
                        {{ $posts->links() }}
                    </nav>
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