<template>
    <div id="phonesBrowser">
        <input type="text" class="form-control m-2 w-90" placeholder="">
        <ul class="list-group">
            <li v-for="phone in phones" :key="index" class="list-group-item">
                <a class="text-dark" :href="`${url}/model/${phone.id}`">
                    <img style="width: 20%" class="img-thumbnail b-0" :src="`${url}/storage/${phone.thumbnail}`" :alt="`${phone.name}`">
                    {{phone.name}}
                </a>
            </li>
            </ul>
        </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return {
                phones:[]
            }
        },
        mounted() {
            this.getBrowser();
        },
        methods:{
            getBrowser(){
            axios.get(`${this.url}/api/model/browser`).then( res => {
                this.phones = res.data;
                console.log('Phones', this.phones);
            }).catch( res => console.warn );
          }
        }
    }
</script>
