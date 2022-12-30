<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description"
                 aria-selected="false">{{__('Description')}}</a>
            </li>            
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                 aria-selected="false">{{__('Comments')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                 aria-selected="false">{{__('Reviews')}}</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                {!! ( App::getLocale() == 'en' ? $product->description : $product->description_esp) !!}
            </div>            
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                            @if (count($product->comments) > 0)

                                @foreach ($product->comments as $comment)
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img style="height: 50px; width:50px;" src="{{asset('images/user.png')}}" alt="{{$product->name}} comment">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{$comment->name}}</h4>
                                            <h5>{{$comment->created_at->format('Y-m-d H:m:s')}}</h5>
                                            <p class="p-0 m-0">{{$comment->message}}</p>
                                        </div>
                                    </div>
                                </div>    
                                @endforeach
                            @else
                                <div class="alert alert-warning" role="alert">
                                    {{__('No commets yet!')}}
                                </div>
                            @endif
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>{{__('Post a comment')}}</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="row contact_form" action="{{route('product.comment')}}" method="post" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="article_id" value="{{$product->id}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Your Full name')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{__('Email Address')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="number" placeholder="{{__('Phone Number')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="{{__('Message')}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn primary-btn">{{__('Submit Now')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">                
                <review-component url={{url('/')}} product="{{$product->id}}" locale="{{App::getLocale()}}"></review-component>
            </div>
        </div>
    </div>
</section>