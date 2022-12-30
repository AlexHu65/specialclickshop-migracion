<template>
  <carousel :settings="settings">
    <slide v-for="slide in images" :key="slide">
      <div class="carousel__item m-5 p-3">
        <img class="w-100" :src="`${url}/storage/${slide}`" >
      </div>
    </slide>
    <template #addons>
      <navigation />
    </template>
  </carousel>
</template>
<script>

    import 'vue3-carousel/dist/carousel.css'

    import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

    export default {
        props:['url', 'product'],
        components: {
          Carousel,
          Slide,
          Pagination,
          Navigation,
        },
        data(){
          return{
            images:null,
            settings: {
              itemsToShow: 1,
              snapAlign: 'center',
              autoplay:'2000'
            },
          }
        },
        mounted() {
          this.getGallery();
        },
        methods:{
          getGallery(){
            axios.get(`${this.url}/api/images/${this.product}`).then( res => {
              const data = res.data;
              this.images = JSON.parse(data.gallery);
            }).catch( res => console.warn );
          },
        }
    }
</script>
