<template>
		<div id="bannerSilder" class="carousel slide d-none d-sm-none d-md-block d-lg-bloc" data-ride="carousel">
			
			<div class="carousel-inner">
				<div v-for="(banner, index) in banners" :key="index" class="carousel-item active">
					<img class="d-block w-100" :src="`${url}/storage/${banner.banner}`" alt="First slide">
				</div>
				
			</div>
			<a class="carousel-control-prev" href="#bannerSilder" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#bannerSilder" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
</template>

<script>

import {VueAgile} from 'vue-agile';

export default {
	props:['url'],
	data(){
		return {
			banners: []
		}
	},
	components: {
		agile:VueAgile
	},
	mounted() {
		this.getBanners();
	},
	methods:{
		getBanners(){
			axios.get(`${this.url}/api/banners`).then( res => {
				const data = res.data;
				console.log('dARA MO', data);
				// Vamos a filter los moviles
				if(this.isMobile()){
					this.banners  = data.filter( p =>  p.movil);
				}else{
					this.banners  = data.filter( p =>  !p.movil);
				}

			}).catch( res => console.warn );
		},
		isMobile() {
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
				return true
			} else {
				return false
			}
		}
	}
}
</script>