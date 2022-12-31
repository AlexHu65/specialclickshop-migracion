<aside class="single-sidebar-widget tag_cloud_widget">
    <h4 class="widget_title">{{ __('Tag Clouds') }}</h4>
    <ul class="list">
        @foreach ($tags as $tag)
            <li>
                <a href="{{route('blog.tag' , ['tag' => strtolower($tag)])}}">{{$tag}}</a>
            </li>    
        @endforeach
    </ul>
</aside>