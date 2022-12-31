@if(!isset($showMainBanner))
<div class="container mt-5">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">{{config('app.name')}}</a></li>
          <?php $segments = ''; ?>
                @foreach(Request::segments() as $segment)
                    <?php $segments .= '/'.$segment; ?>
                    <li class="breadcrumb-item">
                        <a href="{{ $segments }}">{{$segment}}</a>
                    </li>
                @endforeach
        </ol>
      </nav>
</div>    
@endif