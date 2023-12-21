<?php
include "./back/connexion/host.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any form data is present
    if (isset($_POST["name"]) && isset($_POST["role"]) && isset($_POST["city"]) && isset($_POST["country"]) && isset($_POST["price"])) {
        // Loop through the array of products
        foreach ($_POST["name"] as $key => $value) {
            $name = $value;
            $role = $_POST["role"][$key];
            $city = $_POST["city"][$key];
            $country = $_POST["country"][$key];
            $new_price = $_POST["price"][$key];
            $imageToUpload = $_FILES["photo"]["name"][$key];

            move_uploaded_file($_FILES["photo"]["tmp_name"][$key], "assets/image/" . $imageToUpload);

            $sql3 = "SELECT id FROM category WHERE name = '$role'";
            $result3 = $conn->query($sql3);

            if ($result3->num_rows > 0) {
                $row3 = $result3->fetch_assoc();
                $id_category = $row3['id'];
            } else {
                $id_category = null;
            }

            $sql = "INSERT INTO product (name, new_price, category, city, country, image) 
                    VALUES ('$name', '$new_price', '$id_category', '$city', '$country', '$imageToUpload')";

            if ($conn->query($sql) === TRUE) {
                // echo "Data inserted successfully for product $name<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        // print_r($_POST);
    }
}
// include('header.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
<div class="container text-center bg-dark text-light my-5 p-3">
    <h1>Add Products</h1>
</div>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Country</th>
                <th scope="col">City</th>
                <th scope="col">Photo</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id="dynamicadd">
            <tr>
                <td><input type="text" name="name[]" class="form-control"></td>
                <td>
                    <select id="roleSelect" value="1" name="role[]">
                        <?php
                        $sql2 = "SELECT * FROM category";
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                echo '<option value="' . $row2['name'] . '">' . $row2['name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
                <td><input type="text" name="country[]" class="form-control"></td>
                <td><input type="text" name="city[]" class="form-control"></td>
                <td><input type="file" name="photo[]" class="form-control"></td>
                <td><input type="number" name="price[]" class="form-control"></td>
                <td><button type="button" id="add" class="btn btn-success">+</button></td>
            </tr>
            </tbody>
        </table>
        <button type="submit" name="submit" class="btn btn-primary">Add All</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var i = 1;
        $('#add').click(function () {
            i++;
            $('#dynamicadd').append('<tr id="row' + i + '"><td><input type="text" name="name[]" class="form-control"></td><td><select id="roleSelect" value="1" name="role[]"><?php
                $sql2 = "SELECT * FROM category";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        echo '<option value="' . $row2['name'] . '">' . $row2['name'] . '</option>';
                    }
                }
                ?></select></td><td><input type="text" name="country[]" class="form-control"></td><td><input type="text" name="city[]" class="form-control"></td><td><input type="file" name="photo[]" class="form-control"></td><td><input type="number" name="price[]" class="form-control"></td><td><button type="button" id="' + i + '" class="btn btn-danger remove_row">-</button></td></tr>');
        });

        $(document).on('click', '.remove_row', function () {
            var row_id = $(this).attr("id");
            $('#row' + row_id).remove();
        });
    });
</script>
</body>
</html>
