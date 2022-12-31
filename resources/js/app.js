import './bootstrap';
import '../vendors/owl-carousel/owl.carousel.min';
import { createApp } from 'vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp({});
const menu = createApp({});
const banner = createApp({});

app.use(VueSweetalert2);

import ExampleComponent from './components/ExampleComponent.vue';
import Menu from './components/Menu.vue';
import Banner from './components/Banner.vue';
import Review from './components/Review.vue';
import Gallery from './components/Gallery.vue';
import Cart from './components/Cart.vue';
import CartDetail from './components/CartDetail.vue';
import Dashboard from './components/Dashboard.vue';
import ProductComponent from './components/ProductComponent.vue';

app.component('example-component', ExampleComponent);
app.component('review-component', Review);
app.component('gallery-component', Gallery);
app.component('cart-component', Cart);
app.component('cart-component-detail', CartDetail);
app.component('dashboard-component', Dashboard);
app.component('product-component', ProductComponent);

menu.component('menu-component', Menu);

banner.component('banner-component', Banner);


app.mount('#app');
menu.mount('#menu');
banner.mount('#banner');

// ---------- Go Top ---------------//
$('.scrolltop').on('click', function(){
    $(window).scrollTop(0);
});

//------- single product area carousel -------//
$(".s_Product_carousel").owlCarousel({
    items:1,
    autoplay:true,
    autoplayTimeout: 2500,
    loop:true,
    nav:false,
    navigationText: ["<i class=' ti-angle-double-left'></i>","<i class=' ti-angle-double-right '></i>"],
    dots:false
  });
