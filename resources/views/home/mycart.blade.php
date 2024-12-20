<!DOCTYPE html>
<html>

<head>
    @include ('home.css')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include ('home.header')
        <!-- end header section -->

    </div>
    <h2>Your Cart</h2>
    <div class="container">
        <table class="table_design">
            <tr>
                <th>Product Title</th>
                <th>Product Price</th>
                <th>Product Image</th>
            </tr>
            <?php
            $value = 0;
            ?>
            @foreach ($cart as $cart)
                <tr>
                    <td>{{ $cart->product->title }}</td>
                    <td>${{ $cart->product->price }}</td>
                    <td>
                        <img width="120" height="120" src="/products/{{ $cart->product->image }}">
                    </td>
                    <td>
                        <a onclick="confirmation(event)" href="{{ url('delete_cart', $cart->id) }}">
                            {{-- <i class="fas fa-minus" style="color: red;"></i> --}}
                            <i class="material-icons" style="color: red;">remove</i>
                        </a>
                    </td>
                </tr>
                <?php
                $value += $cart->product->price;
                ?>
            @endforeach
        </table>
        <h3 style="margin-bottom: 20px;">The total price of your cart is: ${{$value}}</h3>
        {{-- 

		   -> label (receiver phone)
		   -> input (type = text, name=phone)

		   -> label (receiver name)
		   -> input (type = submit, value = "place order" class = "btn btn-primary)) --}}
           <div class="design">
            <form action="{{url('make_order')}}" method="POST">
                @csrf
                <div>
                    <label>Customer Name</label>
                    <input type="text" name="name" value="{{Auth::user()->name}}">
                </div>
                <div class="address">
                    <label>Customer Address</label>
                    <textarea name="address">{{Auth::user()->adress}}</textarea>
                </div>
                <div>
                    <label>Customer Phone</label>
                    <input type="text" name="phone" value="{{Auth::user()->phone}}">
                </div>
                <div>
                    <input style="background-color: #db4f66; border: none;" type="submit" value="Order now" class="btn btn-primary">
                </div>
            </form>
           </div>
    </div>
    {{-- @foreach ($cart as $cart)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="box">
                <div class="img-box">
                    <img style="width:160px; height:180px;" src="/products/{{ $cart->product->image }}" alt="">
                </div>
                <div class="detail-box">
                    <h6 class="title">{{ $cart->product->title }}</h6>
                    <h6 class="price">
                        <span>${{ $cart->product->price }}</span>
                    </h6>
                </div>
                <div class="detail-box">
                    <a style="display:inline-block;" href="{{ url('product_details', $cart->product->id) }}">
                        <p style="color: #db4f66;">more details</p>
                    </a>
                    <a style="display:inline-block;" href="{{ url('add_to_cart', $cart->product->id) }}">
                        <i style="color:blue;" class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach --}}
    <!-- info section -->
    @include ('home.footer')

    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();

            var urlToRedirect = ev.currentTarget.getAttribute('href');

            console.log(urlToRedirect);

            swal({
                    title: "Are You Sure to remove this product from cart",
                    // text: "this delete will be permenant",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>

</html>
