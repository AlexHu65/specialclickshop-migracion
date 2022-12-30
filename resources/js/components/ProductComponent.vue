<template>
    <div class="pt-2 pb-2">
         <div class="d-flex align-items-center justify-content-around text-dark" v-for="(item, index) in productos" :key="index">
             <div class="pull-left font-weight-bold s18 pt-4 pb-4">{{item.name + ' ' + item.models.name}}</div>             
             <img style="width:10%" class="pull-right" :src="url + `/storage/` + item.thumbnail" :alt="item.name">
        </div>
    </div>       
                           
</template>
<script>

    export default {
        props:['url','producto', 'modelo', 'cantidad'],
        data(){
            return {
                productos:[]
            }
        },
        mounted(){
            this.requestProducts();            
        },
        methods:{
            requestProducts(){

                const data = {}

                    axios.post(`${this.url}/api/detail/product/`, data).then( res => {
                        console.log(res, 'detalle productos');
                        this.productos.push(res.data);
                    }).catch( res => console.warn );
            },
        }
    }
</script>