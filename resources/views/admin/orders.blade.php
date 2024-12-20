<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style>
        td {
            width: 120px;
        }
        .change {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .change a {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                @foreach ($array as $group_index => $group)
                    <div class="div_design">
                        <table class="table_design">
                            @if (is_array($group))
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit status</th>
                                </tr>
                                @foreach ($group as $order)
                                    <tr>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->product->title }}</td>
                                        <td>${{ $order->product->price }}</td>
                                        <td>
                                            <img width="120" height="120"
                                                src="/products/{{ $order->product->image }}">
                                        </td>
                                        <td>
                                            @if ($order->status == 'Delivered')
                                                <span style="color:rgb(1, 201, 1);">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif($order->status == 'On The Way')
                                                <span style="color:yellow;">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif($order->status == 'Cancelled')
                                                <span style="color: red;">
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                {{ $order->status }}
                                            @endif
                                        </td>
                                        {{-- <td>
                                    <div class="change">
                                        <a href="{{ url('on_the_way', $order->id) }}">On the way</a>
                                        <a href="{{ url('delivered', $order->id) }}">Delivered</a>
                                        <a href="{{ url('cancelled', $order->id) }}">Cancelled</a>
                                    </div>
                                     </td> --}}
                                        <td>
                                            <div class="change">
                                                <a
                                                    href="{{ url('on_the_way', ['ids' => implode(',', collect($group)->pluck('id')->toArray())]) }}">On
                                                    the way</a>
                                                <a
                                                    href="{{ url('delivered', ['ids' => implode(',', collect($group)->pluck('id')->toArray())]) }}">Delivered</a>
                                                <a
                                                    href="{{ url('cancelled', ['ids' => implode(',', collect($group)->pluck('id')->toArray())]) }}">Cancelled</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('admin.js_files')
</body>

</html>
