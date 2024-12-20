<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Latest Products
            </h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img style="width:160px; height:180px;" src="/products/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6 class="title">{{ $product->title }}</h6>
                            <h6 class="price">
                                <span>${{ $product->price }}</span>
                            </h6>
                        </div>
                        <div class="detail-box">
                            <a style="display:inline-block;" href="{{ url('product_details', $product->id) }}">
                                <p style="color: #db4f66;">more details</p>
                            </a>
                            <a style="display:inline-block;" href="{{ url('add_to_cart', $product->id) }}">
                                <i style="color:blue;" class="fas fa-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn-box">
            <a href="">
                View All Products
            </a>
        </div>
    </div>
</section>