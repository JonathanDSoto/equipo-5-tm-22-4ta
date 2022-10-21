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
    
    <form action="app/AddressController.php" method="post">
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
        <input type="text" placeholder="first_name" name="first_name">
        <input type="text" placeholder="last_name" name="last_name">
        <input type="text" placeholder="street_and_use_number" name="street_and_use_number">
        <input type="text" placeholder="postal_code" name="postal_code">
        <input type="text" placeholder="city" name="city">
        <input type="text" placeholder="province" name="province">
        <input type="text" placeholder="phone_number" name="phone_number">
        <input type="text" placeholder="client_id" name="client_id">
        <input type="text" placeholder="id" name="id">
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

        <input type="hidden" name="action" value="update">
        <input type="hidden" name="global_token" value="<?= $_SESSION['global_token'] ?>">
        <input type="submit" value="send">
    </form>
</body>
</html>