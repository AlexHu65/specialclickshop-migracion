@if ($popular)
<aside class="single_sidebar_widget popular_post_widget">
    <h3 class="widget_title">{{ __('Popular Posts') }}</h3>
    @foreach ($popular as $item)
        <div class="media post_item">
            <img style="width: 30%" src="{{asset('storage/' . $item->banner)}}" alt="{{$item->title}}">
            <div class="media-body">
                <a href="{{route('blog.detail', ['slug' => $item->slug])}}">
                    <h3>{{$item->title}}</h3>
                </a>
                <p>{{$item->created_at->format('m-d-Y')}}</p>
            </div>
        </div>    
    @endforeach
    <div class="br"></div>
</aside>
@endif
