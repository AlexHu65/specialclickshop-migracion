<template>
    <div class="container">
        <div v-for="(item, index) in compras" :key="index" class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="pull-left m-1 p-1">
                            <p class="p-0 m-0"> <span class="font-weight-bold">Order:</span>  {{item.id}}</p>
                            <p class="font-weight-bold m-0 p-0">Shipping details:</p>
                            <p class="m-0 mt-1 p-2">
                                {{item.shipping.address.city}} {{item.shipping.address.state}} {{item.shipping.address.country}} <br>
                                {{item.shipping.address.line1}}, {{item.shipping.address.line2}}, CP: {{item.shipping.address.postal_code}}<br>
                                <a  target="_blank" :href="item.charges.data[0].receipt_url">View receipt</a>
                            </p>
                        </div>
                        <div class="pull-right m-1 p-1">
                            <a href="#" class="badge badge-dark float-right s25 p-2">{{item.currency.toUpperCase() + ' $' + total}}</a>                            
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>  
</template>
<script>

    export default {
        props:['url','cart', 'total', 'producto'],
        data(){
            return {
                compras: [],
                productos:[]
            }
        },
        mounted(){
            this.requestPaymentIntent();            
        },
        methods:{
            requestPaymentIntent(){                
                axios.get(`${this.url}/api/payments/intent/${this.cart}`).then( res => {
                    console.log(res);
                    this.compras.push(res.data);
                    console.log(this.compras, 'data para carrito');
                }).catch( res => console.warn );
            },
            requestProducts(){
                for(let i = 0; i < this.detalle.length; i++){
                    axios.get(`${this.url}/api/products/${this.detalle[i].articulo_id}/${this.detalle[i].cantidad}/${this.cart[i].model}`).then( res => {
                        console.log(res, 'detalle productos');
                        this.productos.push(res);
                    }).catch( res => console.warn );
                }
            },
        }
    }
</script>