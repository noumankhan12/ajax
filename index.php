<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Product Information using ajax using git</h1>
        <div class="mb-4">
            <h2>Add New Product</h2>
            <form id="productForm" action="#" method="post">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="sell_price">Sell Price:</label>
                    <input type="number" class="form-control" id="sell_price" name="sell_price" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="purchase_price">Purchase Price:</label>
                    <input type="number" class="form-control" id="purchase_price" name="purchase_price" min="0" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div>
            <h2>Product List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Sell Price</th>
                        <th>Purchase Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {

            function displayProducts() {
                $.ajax({
                    type: 'GET',
                    url: 'fetch.php',
                    dataType: 'json',
                    success: function(data) {

                        $('#productTable').empty();

                        $.each(data, function(index, product) {
                            var row = '<tr>' +
                                '<td>' + product.title + '</td>' +
                                '<td>' + product.SPrice + '</td>' +
                                '<td>' + product.PPrice + '</td>' +
                                '<td>' +
                                '<button class="btn btn-sm btn-info" onclick="editProduct(' + product.id + ')">Edit</button> ' +
                                '<button class="btn btn-sm btn-danger" onclick="deleteProduct(' + product.id + ')">Delete</button>' +
                                '</td>' +
                                '</tr>';
                            $('#productTable').append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while fetching data.');
                    }
                });
            }


            displayProducts();

            $('#productForm').submit(function(e) {
                e.preventDefault();

                var formData = {
                    'title': $('#title').val(),
                    'sell_price': $('#sell_price').val(),
                    'purchase_price': $('#purchase_price').val()
                };

                $.ajax({
                    type: 'POST',
                    url: 'insert.php',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        alert('Data inserted successfully!');

                        displayProducts();

                        $('#title').val('');
                        $('#sell_price').val('');
                        $('#purchase_price').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while inserting data.');
                    }
                });
            });

            function deleteProduct(id) {
                console.log('Deleting product with ID:', id);
                if (confirm('Are you sure you want to delete this product?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'delete.php',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log('Success response:', data);
                            alert('Product deleted successfully!');
                            displayProducts();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Error occurred while deleting product.');
                        }
                    });
                }
            }



            function editProduct(id) {

                alert('Edit product with ID: ' + id);
            }
        });
    </script>
</body>

</html>