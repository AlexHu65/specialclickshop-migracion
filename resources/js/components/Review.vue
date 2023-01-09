<template>
    <div class="row">
        <div class="col-lg-6">
            <div class="row total_rate">
                <div class="col-6">
                    <div class="box_total">                        
                        <h5>{{translates.overall}}</h5>
                        <h4>{{average}}</h4>
                    </div>
                </div>
                <div class="col-6">
                    <div class="rating_list">
                        <h3>{{translates.basado}} {{reviews.length}}</h3>
                        <ul class="list">
                            <li>
                                <a href="#">
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    {{stars.five}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    {{stars.four}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    {{stars.three}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    {{stars.two}}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-star text-warning"></i>
                                    {{stars.one}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="review_box">
                <div v-if="msg" class="alert alert-info" role="alert">
                    {{msg}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <h4>{{translates.review}}</h4>
                <p>{{translates.rating}}</p>  
                <ul class="list">
                    <li>  
                        {{ rating }}                      
                        <i @mouseenter="rating = 5" @mouseleave="rating = 0" class="fa fa-star star-value"></i>
                        <i @mouseenter="rating = 4" @mouseleave="rating = 0" class="fa fa-star star-value"></i>
                        <i @mouseenter="rating = 3" @mouseleave="rating = 0" class="fa fa-star star-value"></i>
                        <i @mouseenter="rating = 2" @mouseleave="rating = 0" class="fa fa-star star-value"></i>
                        <i @mouseenter="rating = 1" @mouseleave="rating = 0" class="fa fa-star star-value"></i>
                    </li>
                </ul>              
                <form @submit.prevent="saveReviews" class="form-contact form-review mt-3">
                <div class="form-group">                    
                    <input class="form-control" name="name" type="text" v-model="name" :placeholder="translates.name">
                </div>
                <div class="form-group">
                    <input class="form-control" name="email" type="email" v-model="email" :placeholder="translates.email">
                </div>
                <div class="form-group">
                    <input class="form-control" name="subject" type="text" v-model="subject" :placeholder="translates.subject">
                </div>
                <div class="form-group">
                    <textarea class="form-control different-control w-100" v-model="message" name="message" id="textarea" cols="30" rows="5" :placeholder="translates.mensaje"></textarea>
                </div>
                <div class="form-group text-center text-md-right mt-3">
                    <button type="submit" class="button button--active button-review">{{translates.submit}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import StarRating from 'vue-star-rating';

    export default {
        props:['url', 'locale', 'product'],
        mounted() {
            this.getTranslation();
            this.getReviews();
        },
        data(){
            return {
                translates:[],
                reviews:[],
                rating:0,
                msg: '',
                name: '',
                email: '',
                message: '',
                subject: '',
                stars: {
                    five: 0,
                    four: 0,
                    three: 0,
                    two: 0,
                    one: 0,
                },
                average:0,
                total: 0
            }
        },
        components: {
            StarRating
        },
        methods:{
            getTranslation(){            
                axios.get(`${this.url}/api/traducciones/review/${this.locale}`).then( res => {
                    this.translates = res.data;
                }).catch( res => console.warn );
            },
            selectStart(value){
                console.log('OK', value);
            },
            getReviews(){ 

                axios.get(`${this.url}/api/reviews/${this.product}`).then( res => {
                    this.reviews =  res.data;
                    for(let i = 0; i < this.reviews.length;i++){

                        this.total += this.reviews[i].value; 

                        if(this.reviews[i].value == 5){
                            this.stars.five++;
                        }

                        if(this.reviews[i].value == 4){
                            this.stars.four++;
                        }

                        if(this.reviews[i].value == 3){
                            this.stars.three++;
                        }

                        if(this.reviews[i].value == 2){
                            this.stars.two++;
                        }

                        if(this.reviews[i].value == 1){
                            this.stars.one++;
                        }

                        this.average = Math.round(this.total / this.reviews.length);


                    }
                }).catch( res => console.warn(res) );
            },
            saveReviews(){

                let payload = {
                    article_id: this.product,
                    rating: this.rating,
                    name: this.name,
                    email: this.email,
                    message: this.message,
                    subject: this.subject,
                };

                axios.post(`${this.url}/api/reviews/save`, payload).then( res => {
                    this.msg = res.data.msg;                    
                    this.rating = 0;
                    this.name = '';
                    this.email = '';
                    this.message = '';
                    this.subject = '';
                }).catch( res => console.warn(res) );
            }
        }
    }
</script>
