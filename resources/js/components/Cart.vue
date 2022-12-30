<template>
    <div class="container">
		<div class="row">
			<div class="col-sm-12 p-0 m-0">
				<small class="pt-2 pb-2">{{ translates.please3 }}</small>
				<ul v-if="mobile" class="list-group">
					<li @click="setModel(p.id)" v-for="(p, index) in productModels" class="list-group-item d-flex justify-content-between align-items-start">	
						<div class="d-flex justify-content-between align-items-center">
							<div :style="{
							'background-image':`url(${url}/storage/${p.thumbnail})`,
								backgroundRepeat: 'no-repeat',
								backgroundSize: 'contain',
								backgroundPosition: 'center center',
								width: '35px',
								height: '35px',
								}">
							</div>
							<small>
								{{p.name}}
							</small>
						</div>		
						<span v-if="modelSelected && p.id == modelSelected.id" class="badge bg-danger rounded-pill text-white"><i class="ti-check"></i></span>
						
					</li>
				</ul>
				<carousel v-if="!mobile" :settings="settings">
					<slide v-for="slide in productModels" :key="slide">
						<div 
						v-bind:class="[modelSelected && slide.id == modelSelected.id ? 'border border-5 shadow-sm bg-body rounded' : '']" 
						class="carousel__item p-2">							
							<div @click="setModel(slide.id)" 
								:style="{
								'background-image':`url(${url}/storage/${slide.thumbnail})`,
								backgroundRepeat: 'no-repeat',
								backgroundSize: 'contain',
								backgroundPosition: 'center center',
								width: '100px',
								height: '100px',
								cursor: 'pointer'
								}">
							</div>
							<div class="text-center">
								<small>
									{{ slide.name }}
								</small>
							</div>
						</div>
					</slide>
					<template #addons>
						<navigation />
					</template>
				</carousel>
			</div>
		</div>
		<div v-if="inventario" class="row pt-3 pb-3">
			<div class="col-sm-12 p-0 m-0">
				<div class="d-flex align-items-center">					
					<div 
						@click="setColor(inv)" v-for="inv in inventario"  
						v-bind:class="[inventarioSelected && inv.id == inventarioSelected.id ? 'border-5 border-danger shadow bg-body rounded' : '']" 
						class="color-rectangle m-2 p-3 bg-body rounded border  rounded-circle" 
						:style="{
							'background': (inv.color_secundario ? `linear-gradient(to right, ${inv.color.hexadecimal} 0%,${inv.color.hexadecimal} 50%,${inv.color_secundario.hexadecimal} 50%,${inv.color_secundario.hexadecimal} 100%)` : `${inv.color.hexadecimal}`),
							cursor:'pointer'
						}">										
				    </div>
				</div>
			</div>
		</div>
		<div v-if="modelSelected || inventarioSelected" class="row">
			<div class="col-sm-12 col-md-6 card pt-2 pb-2">
				<p class="p-0 m-0" v-if="modelSelected"> <small v-if="modelSelected"> {{ modelSelected.name }} </small></p>
				<p class="p-0 m-0" v-if="inventarioSelected"> <small v-if="inventarioSelected"> {{ inventarioSelected.color.name }} {{ (inventarioSelected.color_secundario ? ` + ${inventarioSelected.color_secundario.name}` : ``) }}</small></p>
				<p class="p-0 m-0" v-if="stock > 0"> <small>{{ translates.model2 }}: {{ stock }}</small> </p>
			</div>
			<div v-if="modelSelected && inventarioSelected && stock > 0" class="col-sm-12 col-md-6 d-flex justify-content-center align-items-center">				
				<div class="d-flex justify-content-arround align-items-center">
					<button @click="reduceQuantity()" type="button" class="btn btn-outline-danger rounded-circle btn-sm m-2"><i class="ti-minus"></i></button>
					{{ quantity }}
					<button @click="increaseQuantity()" type="button" class="btn btn-outline-danger rounded-circle btn-sm m-2"><i class="ti-plus"></i></button>
				</div>
			</div>
		</div>
		<div v-if="modelSelected && inventarioSelected && quantity > 0" class="row pt-3">			
			<div  class="col-sm-12 p-0 m-0 d-flex justify-content-arround align-items-center">
				<a @click="validateCart()" style="width: 100%;" class="btn btn-danger text-white"><i class="ti-shopping-cart "></i> {{translates.add}}</a>    
			</div>
		</div>

		<div v-if="this.cart.length > 0" class="row pt-3">
			<small><i class="ti-shopping-cart-full"></i> <strong>{{ translates.myShopping }}</strong> </small>
			<div class="col-sm-12 p-0 m-0 pt-3">
				<ul class="list-group">
					<li v-for="(p, index) in cart" class="list-group-item">	
						<div class="d-flex justify-content-between align-items-center">
							<div :style="{
							'background-image':`url(${url}/storage/${p.inventarioSelected.modelo.thumbnail})`,
								backgroundRepeat: 'no-repeat',
								backgroundSize: 'contain',
								backgroundPosition: 'center center',
								width: '35px',
								height: '35px',
								}">
							</div>
							<small :style="{
								width: '50px'
							}">
								{{p.inventarioSelected.modelo.name}} x {{ p.quantity }}
							</small>
							<div class="color-rectangle p-3 bg-body rounded border  rounded-circle" 
							:style="{
							'background': (p.inventarioSelected.color_secundario ? `linear-gradient(to right, ${p.inventarioSelected.color.hexadecimal} 0%,${p.inventarioSelected.color.hexadecimal} 50%,${p.inventarioSelected.color_secundario.hexadecimal} 50%,${p.inventarioSelected.color_secundario.hexadecimal} 100%)` : `${p.inventarioSelected.color.hexadecimal}`),
							cursor:'pointer'}">
				    		</div>
							<div>
								<button @click="removeCart(index)" class="btn btn-danger btn-sm">
									<i class="ti-trash"></i>
								</button>
							</div>	
						</div>		
						
					</li>
				</ul>
			</div>
		</div>
		<div v-if="cart.length > 0" class="row pt-3">			
			<div  class="col-sm-12 p-0 m-0 d-flex justify-content-arround align-items-center">
				<a @click="goToCart()" style="width: 100%;" class="btn btn-danger text-white">{{translates.go}}</a>    
			</div>
		</div>
	</div>
</template>
<script>

	import 'vue3-carousel/dist/carousel.css'
	import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

    export default {
		props:['url', 'locale', 'product'],
		components: {
          Carousel,
          Slide,
          Pagination,
          Navigation,
        },
		data(){
			return {
				translates:[],
				productModels:[],
				cart: [],
				inventario:[],
				settings: {
					itemsToShow: 3
				},	
				modelSelected:null,			
				inventarioSelected:null,
				quantity:0,
				stock:0,
				mobile: this.isMobile(),
			}
		},
        mounted() {
			this.getTranslation();
			this.getModels();
			this.getCart();
        },
		methods:{
			goToCart(){
				window.location.href = `${this.url}/cart`;
			},
			getTranslation(){
				axios.get(`${this.url}/api/traducciones/cart/${this.locale}`).then( res => {
					this.translates = res.data;
				}).catch( res => console.warn );
			},
			getModels(){
				axios.get(`${this.url}/api/models/${this.product}`).then( res => {
						this.productModels = res.data;						
				}).catch( res => console.warn );
			},
			addCart(){

				if(!this.inventarioSelected){
					this.showAlert('error', 'Oops...', this.translates.please);
				}

				if(!this.modelSelected){
					this.showAlert('error', 'Oops...', this.translates.please3);
				}
			},
			setModel(id){

				this.stock = 0;

				this.quantity = 0;

				this.inventarioSelected = null;

				this.inventario = [];

				const model = this.productModels.find(model => model.id  == id);	
				
				this.modelSelected = model;

				this.getInventario(id);

			},
			setColor(inv){
				this.inventarioSelected = inv;
				this.stock = inv.cantidad;
			},
			getInventario(model){
				axios.get(`${this.url}/api/product/inventario/${this.product}/${model}`).then( res => {
					this.inventario = res.data;			
				}).catch( res => console.warn );
			},
			cleanModel(){
				this.modelSelected = null;
				this.inventarioSelected = null;
			},
			reduceQuantity(){
				if(this.quantity > 0){
					this.quantity -= 1;
				}
			},
			increaseQuantity(){
				if(this.quantity < this.stock){
					this.quantity += 1;
				}
			},
			getCart(){

				if(localStorage.cart){
					this.cart = JSON.parse(localStorage.cart);
				}

			},
			showAlert(){

				this.$swal({
					title: this.translates.crt1,
					text: this.translates.crt2,
					icon: 'success',
					showCancelButton: true,
					confirmButtonText: this.translates.go,
					cancelButtonText: this.translates.cancel
				}).then((result) => {

					if(result.isConfirmed){
						window.location.href = this.url + '/cart';
					}
					
				});
				
			},
			showError(){
				this.$swal({
					title: this.translates.stock,
					text: this.translates.stock2,
					icon: 'error',
				});
			},
			addCart(item){
				this.cart.push(item);
				localStorage.cart = JSON.stringify(this.cart);	
				this.modelSelected = null;	
				this.inventario = [];			
				this.cart = [];
				this.stock = 0;
				this.inventarioSelected = null;
				this.quantity = 0;
				this.showAlert();
				this.getCart();
			},
			removeCart(index){

				let cart = this.cart;

				cart.splice(index, 1);

				this.inventarioSelected = null;

				this.modelSelected = null;

				this.inventario = [];

				localStorage.removeItem('cart');

				localStorage.cart = JSON.stringify(cart);

				this.getCart();

			},
			modifyCart(index){

				let suma = this.quantity + this.cart[index].quantity;

				if(suma <= this.stock){

					this.cart[index].quantity = suma;

					localStorage.removeItem('cart');

					localStorage.cart = JSON.stringify(this.cart);

					this.modelSelected = null;	

					this.cart = [];

					this.stock = 0;

					this.inventarioSelected = null;

					this.quantity = 0;

					this.inventario = [];

					this.getCart();

					this.showAlert();

					return;

				}else{

					this.showError();

				}

				
			},
			isMobile() {
			if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
				return true
			} else {
				return false
			}
			},
			validateCart(){

				const item =  {	
					inventarioSelected: this.inventarioSelected,
					quantity: this.quantity
				};

				if(this.cart.length == 0){
					this.addCart(item);
					return;
				}

				//Primero validamos el producto si ya se encuentra				
				const product = this.cart.find(
					c => c.inventarioSelected.id  == item.inventarioSelected.id
				);

				let index = this.cart.indexOf(product);

				if(index >= 0){
					this.modifyCart(index);
					return;
				}

				this.addCart(item);

				this.getCart();
			}
		}
    }
</script>
<style>
	.color-rectangle{
		width: 35px;
		height: 35px;
	}
</style>
