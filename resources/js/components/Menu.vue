<template>
    <div class="shadow-lg bg-body rounded">
        <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-light p-4">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item d-flex justify-content-between align-items-center">
                    <a class="nav-link active link" aria-current="page" href="/dashboard">{{translates.account}}</a>
                    <a v-if="language" href="#">
                        <img :src="`${url}/img/${language.flag}`" style="width: 65%;">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active link" aria-current="page" href="/products">{{translates.shop}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active link" aria-current="page" href="/blog">{{translates.blog}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active link" aria-current="page" href="/offers">{{translates.special}}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{translates.categories}}
                    </a>
                    <ul class="dropdown-menu">                        
                        <li v-for="(category, index) in categories" :key="index"><a class="dropdown-item" :href="`${url}/products/categories/${category.slug}`">{{category.name}}</a></li>    
                        <li><a class="dropdown-item" :href="`${url}/products`">{{translates.todo}}</a></li>                    
                    </ul>
                </li>
                <li class="nav-item">
                    <form action="#" method="POST" class="form-inline my-2 my-lg-0">								
                        <input name="search" style="border-radius: 30px;
                        height: 30px;
                        border-color: #EEEEEE;
                        padding-left: 20px;
                        font-size: 14px;" class="form-control mr-sm-2" type="search" :placeholder="translates.search" aria-label="Search">
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-light">
        <div class="container-fluid p-2">
            <div class="d-flex justify-content-between align-items-center">   
                <div class="w-30">
                    <a class="navbar-brand logo_h m-0 p-0" :href="url"><img :src="url + '/img/logo.png'" style="width: 65%;"></a>
                </div>    
                <div class="w-30 d-flex justify-content-end pr-3">
                    <button class="navbar-toggler text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent">
                    <i class="ti-view-list"></i>
                </button>
                </div>     
            </div>
        </div>
    </nav>
    </div>
    
</template>

<script>

    export default {
        props:['url', 'locale'],
        mounted(){

            this.getTranslation();
            this.getCategories();
            this.getLanguages();
           
        },
        data(){
            return {
                translates:[],
                categories:[],
                language:null
            }
        },
        methods: {
          getTranslation(){            
            axios.get(`${this.url}/api/traducciones/menu/${this.locale}`).then( res => {
                this.translates = res.data;
            }).catch( res => console.warn );
          },
          getCategories(){
            axios.get(`${this.url}/api/categories/${this.locale}`).then( res => {
                this.categories = res.data;
            }).catch( res => console.warn );
          },
          getLanguages(){
            axios.get(`${this.url}/api/languages/${this.locale}`).then( res => {
                this.language = res.data;
            }).catch( res => console.warn );
          }
        },
    }
</script>
<style>
    .link{
        text-decoration: none;
        color: black !important;
    }

    .w-30{
        width: 30%;
    }
    .navbar-toggler span{
        background: none !important;
    }
</style>