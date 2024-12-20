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
                <h1>Add Product</h1>
                <div class="div_design">
                    <form action="{{url('upload_product')}}" method="POST" class="addProduct" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Product Title</label>
                            <input type="text" name="title" required>
                        </div>
                        <div>
                            <label>Description</label>
                            <textarea name="description" required></textarea>
                        </div>
                        <div>
                            <label>Price</label>
                            <input type="text" name="price">
                        </div>
                        <div class="quantity">
                            <label>Quantity</label>
                            <input type="number" name="quantity">
                        </div>
                        <div>
                            <label>Category</label>
                            <select name="category" required>
                                <option disabeled selected>Select an option</option>
                                @foreach($category as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image">
                        </div>
                        <div class="button">
                            <input class="btn btn-primary" type="submit" value="Add Product">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.js_files')
</body>

</html>
