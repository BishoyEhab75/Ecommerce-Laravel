<!DOCTYPE html>
<html>

<head>
    @include ('home.css')
    <style>
        .div_center{
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        section{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .detail-box{
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include ('home.header')
        <!-- end header section -->
    </div>
    <!-- end hero area -->


    <!-- header section strats -->
    <section class="shop_section layout_padding">
        <div class="container">
            {{-- <div class="heading_container heading_center">
                <h2>
                    Latest Products
                </h2>
            </div> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="div_center">
                            <img style="width:320px; height:360px;" src="/products/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>{{ $product->title }}</h5>
                            <h6>Price : 
                                <span>${{ $product->price }}</span>
                            </h6>
                        </div>
                        <h6 class="detail-box">{{$product->description}}</h6>
                        
                        <div class="detail-box">
                            <h6>Category : {{ $product->category }}</h6>
                            <h6>Available Quantity : 
                                <span>{{ $product->quantity}}</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- header section ends-->



    <!-- info section -->
    @include ('home.footer')



</body>

</html>
