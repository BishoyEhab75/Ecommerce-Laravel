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
        <div>
            <table class="table_design">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->product->title}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>{{$order->status}}</td>
                    <td>
                        <img width="120px" height="120px" src="/products/{{$order->product->image}}">
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    
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
