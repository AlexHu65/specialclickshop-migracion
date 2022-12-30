<div class="footer-area bg-dark">
    <div class="container">
      <div class="row section_gap">
        <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
          <div class="single-footer-widget tp_widgets">
            <h4 class="footer_title">{{ __('Quick Links') }}</h4>
            <ul class="list">
              <li><a href="{{route('home')}}">{{ __('HOME') }}</a></li>
              <li><a href="{{route('categories.detail')}}">{{ __('SHOP') }}</a></li>
              <li><a href="{{route('blog')}}">Blog</a></li>
            </ul>
          </div>
        </div>
        <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
          <div class="single-footer-widget tp_widgets">
            <h4 class="footer_title">{{ __('Contact Us') }}</h4>
            <div class="ml-40">
              @if(!empty(setting('site.direccion')))

              <p class="sm-head">
                <span class="fa fa-location-arrow"></span>
                {{ __('Head Office') }}
              </p>
              <p>
                  {!! setting('site.direccion') !!}
             </p>
             @endif

              <p class="sm-head">
                <span class="fa fa-phone"></span>
                {{ __('Phone Number') }}
              </p>
              <p>
                {{setting('site.whatsapp')}}
              </p>

              <p class="sm-head">
                <span class="fa fa-envelope"></span>
                Email
              </p>
              <p>
                <a href="mailto:{{setting('site.email')}}">{{setting('site.email')}}</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="wrapper">

    <div class="floater">
        <div class="scrolltop">
          <i class="fas fa-angle-up"></i>
        </div>
        <div class="share-wrap">
              <ul>
                <li class="facebook"><a style="color: white;" target="_blank" href="{{setting('site.facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
                <li class="insta"><a style="color: white;" target="_blank" href="{{setting('site.instagram')}}"><i class="fab fa-instagram"></i></a></li>
                <li class=shareclk> <i class="fas fa-share-alt"></i> </li>
            </ul>
        </div>
    </div>    
  </div>

  <div class="footer-bottom">
    <div class="container">
      <div class="row d-flex">
        <p class="col-lg-12 footer-text text-center">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          <!--  Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
      </div>
    </div>
  </div>
