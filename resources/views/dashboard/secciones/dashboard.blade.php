<section class="product_description_area">
    
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">            
            <li class="nav-item">
                <a class="nav-link active" id="carrito-tab" data-toggle="tab" href="#carrito" role="tab" aria-controls="carrito"
                 aria-selected="false">Active orders</a>
            </li>
            
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="carrito" role="tabpanel" aria-labelledby="carrito-tab">
                @include('dashboard.secciones.orders')                   
            </div>                                     
        </div>        
    </div>
</section>