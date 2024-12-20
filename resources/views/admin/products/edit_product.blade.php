<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    @include('admin.products.product_style')
</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>Update Product</h1>
                <div class ="div_design">
                    <form action="{{ url('update_product', $product->id) }}" method="post" enctype="multipart/form-data"
                        class="addProduct">
                        @csrf
                        <div>
                            <label>Title</label>
                            <input name="title" type="text" value="{{ $product->title }}">
                        </div>
                        <div>
                            <label>Description</label>
                            <textarea name="description">{{ $product->description }}</textarea>
                        </div>
                        <div>
                            <label>Price</label>
                            <input type="text" name="price" value="{{ $product->price }}">
                        </div>
                        <div>
                            <label>Quantity</label>
                            <input type="number" name="quantity" value="{{ $product->quantity }}">
                        </div>
                        <div>
                            <label>Category</label>
                            <select name="category">
                                <option value="{{$product->category}}">{{$product->category}}</option>
                                @foreach ($category as $category)
                                    @if ($product->category != $category->category_name)
                                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Current Image</label>
                            <img width="150" src="/products/{{ $product->image }}">
                        </div>
                        <div>
                            <label>New Image</label>
                            <input style="margin-left:10px;" type="file" name="image">
                        </div>
                        <div class="button">
                            <input class="btn btn-primary" type="submit" value = "Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.js_files')
</body>

</html>
