<template>
	<div v-if="this.cart.length > 0" class="row justify-content-center pt-3 pb-3">
			<div class="col-sm-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item roboto" aria-current="page"> <a :href="`${url}`">{{ translates.home }}</a></li>
						<li class="breadcrumb-item roboto" aria-current="page"> <a :href="`${utrl}/shop`">{{ translates.shop }}</a></li>
						<li class="breadcrumb-item roboto active" aria-current="page">{{ translates.myShopping }}</li>
					</ol>
				</nav>
				<ul class="list-group pt-3">
					<li v-for="(p, index) in cart" class="list-group-item">	
						<div class="d-flex justify-content-between align-items-center">
							<div class="m-3" :style="{
							'background-image':`url(${url}/storage/${p.inventarioSelected.article.thumb})`,
								backgroundRepeat: 'no-repeat',
								backgroundSize: 'contain',
								backgroundPosition: 'center center',
								width: '100px',
								height: '100px',
								}">
							</div>
							<div :style="{width: '250px', minHeight: '100px'}">
								<small> <a :href="`${this.url}/products/${p.inventarioSelected.article.slug}`">{{ p.inventarioSelected.article.name }}</a> </small><br>
								<small> {{ p.inventarioSelected.modelo.name}} </small><br>
								<small>Color: </small> 
								<div class="color-rectangle p-3 bg-body rounded border  rounded-circle" 
									:style="{
										'background': (p.inventarioSelected.color_secundario ? `linear-gradient(to right, ${p.inventarioSelected.color.hexadecimal} 0%,${p.inventarioSelected.color.hexadecimal} 50%,${p.inventarioSelected.color_secundario.hexadecimal} 50%,${p.inventarioSelected.color_secundario.hexadecimal} 100%)` : `${p.inventarioSelected.color.hexadecimal}`),
										cursor:'pointer'
									}">
				    			</div>
							</div>
							<div class="d-flex flex-column bd-highlight mb-3">
								<h4  v-if="p.inventarioSelected.article.offer > 0" class="text-danger tachado roboto"> <strong>${{ this.currency(p.inventarioSelected.article.price) }}</strong></h4>
								<h4 class="roboto"> <strong>${{ this.currency(p.inventarioSelected.article.offer > 0 ? p.inventarioSelected.article.offer : p.inventarioSelected.article.price) }}</strong> x {{ p.quantity }}</h4>
								<button @click="removeCart(index)" class="btn btn-danger btn-sm float-end">
									<i class="ti-trash"></i>
								</button>
							</div>	
						</div>	
					</li>
					<li class="list-group-item roboto">
						<div class="d-flex justify-content-between">							
							<div class="creat_account s15">
								<input v-model="conditions" type="checkbox" id="f-option4" name="selector">
								<label class="p-0 m-0 mx-2" for="f-option4"> {{ translates.read1 }} <a target="_blank" href=""> {{ translates.read2 }}</a></label>
								<br>
								<small v-if="!conditions" class="text-danger">{{ translates.read3 }}</small>
							</div>
							<hr>
						    <small class="s25 bold roboto">${{ total.toFixed(2) }}</small>
						</div>
					</li>
				</ul>
				<div v-if="conditions" class="float-end mt-4 mb-4 roboto">
					<button @click="checkout()" class="btn btn-danger">{{ translates.checkout }}</button>
				</div>
			</div>
			
		</div>
</template>

<script>
    export default {
		props: ['url', 'user'],
		data(){
			return {
				translates:[],
				cart: [],
				numbers: [],
				total: 0.0,
				loggedUser:null,
				conditions:false
			}
		},
        mounted() {
			this.getTranslation();
			this.getCart();
			this.totalCalc();
			
			if(this.user){

				const user = JSON.parse(this.user);

				this.loggedUser = user.id;
			}

			console.log('User', this.loggedUser);
        },
		methods: {
			getTranslation(){
				axios.get(`${this.url}/api/traducciones/cart/${this.locale}`).then( res => {
					this.translates = res.data;
				}).catch( res => console.warn );
			},
			getCart(){
				if(localStorage.cart){
					this.cart = JSON.parse(localStorage.cart);
				}
			},
			removeCart(index){
				
				let cart = this.cart;

				cart.splice(index, 1);

				localStorage.removeItem('cart');

				localStorage.cart = JSON.stringify(cart);

				this.getCart();

				window.location.reload();

			},
			currency(float){
				return float.toFixed(2);
			},
			totalCalc(){			

				this.cart.map( p => {
					this.numbers.push( (p.quantity *  (p.inventarioSelected.article.offer > 0 ? p.inventarioSelected.article.offer : p.inventarioSelected.article.price).toFixed(2)));
				});

				this.total = this.numbers.reduce((sum, num) => sum + num);

			},
			checkout(){

				let data = {
					cart: this.cart,
					user_id: this.loggedUser,
					total: this.total,
					carritoId: null
				}

				if(this.loggedUser){
					axios.post(`${this.url}/api/cart/save`, data).then( res => {
						
						if(res.data.status){

							data.carritoId = res.data.id;
							//Una vez tengamos el guardado del carrito, lo vamos a enviar de vuelta ahora al servicio de checkout
							axios.post(`${this.url}/api/create-checkout-session`, data).then( res => {
								if(res.data.status){
									window.location.href = res.data.urlRedirect;
								}
							});
						}
					});
				}else{
					this.showAlert();
				}		

			},
			showAlert(){
				this.$swal({
					title: this.translates.pleaseLogin,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: this.translates.goLogin,
					cancelButtonText: this.translates.cancel
				}).then((result) => {
					if(result.isConfirmed){
						window.location.href = `${this.url}/login`
					}					
				});
			},
		},
    }
</script>
