<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div>
                    <h1>
                        Update Category
                    </h1>
                    <div class = "div_design">
                        <form action="{{ url('update_category', $data->id) }}" method="POST">
                            @csrf
                            <input type="text" name="category" value="{{ $data->category_name }}">
                            <input class="btn btn-primary" type="submit" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.js_files')
</body>

</html>
