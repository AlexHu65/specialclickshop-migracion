<aside class="single_sidebar_widget post_category_widget">
    <h4 class="widget_title">{{ __('Post Categories') }}</h4>
    <ul class="list cat-list">
        @foreach ($blogCategories as $category)
        <li>
            <a href="{{route('blog.category', ['slug' => $category->slug])}}" class="d-flex justify-content-between">
                <p>{{$category->name}}</p>
            </a>
        </li>    
        @endforeach
    </ul>
    <div class="br"></div>
</aside>