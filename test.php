<?php include "app/config.php"; 
 foreach($_SESSION['errors'] as $error){
    echo $error;
 }
unset($_SESSION['errors']);
var_dump(!filter_var('asd',FILTER_VALIDATE_INT));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="app/OrderController.php" method="post">
        <!--    
            first_name
            last_name
            street_and_use_number
            postal_code
            city
            province
            phone_number
            client_id
        -->
        <input type="checkbox" name="presentations[0][id]" value="1">id
        <input type="text" name="presentations[0][quantity]" value="2">quantity
        <input type="checkbox" name="presentations[1][id]" value="3">id
        <input type="text" name="presentations[1][quantity]" value="4">quantity
        <!-- <input type="checkbox" value="3" name="categories[]">valor 1
        <input type="checkbox" value="4" name="categories[]">valor 2

        <input type="checkbox" value="3" name="tags[]">valor 1
        <input type="checkbox" value="4" name="tags[]">valor 2 -->
<!-- 
        <input type="text" placeholder="name" name="name">
        <input type="text" placeholder="slug" name="slug">
        <input type="text" placeholder="description" name="description">
        <input type="text" placeholder="features" name="features">
        <input type="text" placeholder="brand_id" name="brand_id">
        <input type="text" placeholder="id product" name="id"> -->
<!-- 
        <input type="hidden" name="action" value="create">
        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>"> -->
        <input type="submit" value="send">
    </form>
</body>
</html>