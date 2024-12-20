<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @include('admin.css')
</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>Add Category</h1>
                <div class="div_design">
                    <form action="{{ url('add_category') }}" method="post">
                        @csrf
                        <div>
                            <input type="text" name="category" placeholder="Enter category name" required>

                            <input class="btn btn-primary" type="submit" value = "Add Category">
                        </div>
                    </form>
                </div>
                <div>
                    <table class="table_design">
                        <tr>
                            <th>Category Id</th>
                            <th>Category Name</th>
                            <th colspan="2">Options</th>
                        </tr>
                        @foreach ($data as $category)
                            <tr>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    {{ $category->category_name }}
                                </td>
                                <td>
                                    <a href="{{url('edit_category', $category->id)}}">
                                        <i class="fas fa-pencil-alt" style="color: rgb(0, 55, 255);"></i>
                                    </a>
                                </td>
                                <td>
                                    <a onclick="confirmation(event)" href="{{ url('delete_category', $category->id) }}">
                                        <i class="fas fa-trash" style="color: red;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();

            var urlToRedirect = ev.currentTarget.getAttribute('href');

            console.log(urlToRedirect);

            swal({
                    title: "Are You Sure to Delete This",
                    text: "this delete will be permenant",
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
        @include('admin.js_files')
</body>

</html>
