<?php 
include_once "config.php";

if (isset($_POST['action'])) {
	if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {

        switch ($_POST['action']) {
            case 'create':
                /*
$name, $code, $percentage_discount, $min_amount_required, 
$min_product_required,
$start_date, $end_date,$max_uses,$valid_only_first_purchase
                */
                if(isset($_POST['name']) &&
                isset($_POST['code']) &&
                isset($_POST['percentage_discount']) &&
                isset($_POST['min_amount_required']) &&
                isset($_POST['min_product_required']) &&
                isset($_POST['start_date']) &&
                isset($_POST['end_date']) &&
                isset($_POST['max_uses']) &&
                isset($_POST['valid_only_first_purchase'])){
                    $name =  strip_tags($_POST['name']);
                    $code =  strip_tags($_POST['code']);
                    $percentage_discount =  strip_tags($_POST['percentage_discount']);
                    $min_amount_required =  strip_tags($_POST['min_amount_required']);
                    $min_product_required =  strip_tags($_POST['min_product_required']);
                    $start_date =  strip_tags($_POST['start_date']);
                    $end_date =  strip_tags($_POST['end_date']);
                    $max_uses =  strip_tags($_POST['max_uses']);
                    $valid_only_first_purchase =  strip_tags($_POST['valid_only_first_purchase']);
                    
                    $amount_discount = 0;
                    if(isset($_POST['amount_discount'])){
                        $amount_discount = strip_tags($_POST['amount_discount']);
                    }
                    $status = 1;
                    if(isset($_POST['status'])){
                        $status = strip_tags($_POST['status']);
                    }
                    $res = validateCoupon($name, $code, $percentage_discount, $min_amount_required,
                    $min_product_required, $start_date, $end_date, $max_uses, $valid_only_first_purchase);

                    if(!$res){
                        header("Location: ".BASE_PATH."cupones/error");
                    }else{
                        CouponController::createCoupon($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],
                        $res[6],$res[7],$res[8], $amount_discount, $status);
                    }
                }else{
                    header("Location: ".BASE_PATH."cupones/error");
                }
                break;
            case 'update':
                if(isset($_POST['name']) &&
                isset($_POST['code']) &&
                isset($_POST['percentage_discount']) &&
                isset($_POST['min_amount_required']) &&
                isset($_POST['min_product_required']) &&
                isset($_POST['start_date']) &&
                isset($_POST['end_date']) &&
                isset($_POST['max_uses']) &&
                isset($_POST['valid_only_first_purchase']) &&
                isset($_POST['id'])){
                    $name =  strip_tags($_POST['name']);
                    $code =  strip_tags($_POST['code']);
                    $percentage_discount =  strip_tags($_POST['percentage_discount']);
                    $min_amount_required =  strip_tags($_POST['min_amount_required']);
                    $min_product_required =  strip_tags($_POST['min_product_required']);
                    $start_date =  strip_tags($_POST['start_date']);
                    $end_date =  strip_tags($_POST['end_date']);
                    $max_uses =  strip_tags($_POST['max_uses']);
                    $valid_only_first_purchase =  strip_tags($_POST['valid_only_first_purchase']);
                    $id = strip_tags($_POST['id']);

                    $status = 1;
                    if(isset($_POST['status'])){
                        $status = strip_tags($_POST['status']);
                    }

                    $amount_discount = null;
                    if(isset($_POST['amount_discount'])){
                        $amount_discount = strip_tags($_POST['amount_discount']);
                    }

                    $res = validateCoupon($name, $code, $percentage_discount, $min_amount_required,
                    $min_product_required, $start_date, $end_date, $max_uses, $valid_only_first_purchase, $id);                    
                    
                    if(!$res){
                        header("Location: ".BASE_PATH."cupones/error");
                    }else{
                        CouponController::updateCoupon($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],
                        $res[6],$res[7],$res[8], $res[9], $amount_discount, $status);
                    }
                }else{
                    header("Location: ".BASE_PATH."cupones/error");
                }
                break;
            case 'delete':
                if(isset($_POST['id'])){
                    $id = test_input($_POST['id']);

                    if(validateId($id)){
                        CouponController::deleteCoupon($id);
                    }else{
                        header("Location: ".BASE_PATH."cupones/error");
                    }
                }
                break;
        }
    }
}

Class CouponController{
    public static function getAllCoupons(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6IlRVNXBzbWFXUDJWMVp2dlZSYng4eEE9PSIsInZhbHVlIjoiMm5Qa0VZekRKaUp5QUxMUGdJWWxXQ3pUaTFGMjdYL0k2eUNBZG81bUxLcmd4ZEVkRnZpNFFrN3BMbE9SRU5LY3BJVXNJOUNaWWQ5d01NcWFlMzVoenpzd3NGS3BaWWVmMjBZVVFRUWxUc05VcStLYk1zYlZteHIxdk1odEFUMmwiLCJtYWMiOiI2YTYxOTYzYmM5MzI4MGExODlmMmEzOTRhZDM4OGI5YTQxMTFlODc2MjdlYTFkYzYyMWE1MDE5OGMyYmE4NzMzIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlZLZ0xiWWtpWGdxc29TTXdiLytiVGc9PSIsInZhbHVlIjoiamkvek0rYUtMRmE0YzhHcVUrblVhY0dJdFNITEtvcG8yVFo2UVdKWURqbE0rMVAzZE1Md3REMmp3bGc2bUpUSTRNRG5aaWV3aHpTRm5zUzRaczVpTTc2bnBCS0tHb2dqUXNvWjhLejZBOTVmSEplQjRGOG1WYWZFQUszUnJLZE0iLCJtYWMiOiIwMmZkNTBkZjZmYjQ5YzA2ZDAwY2FiMGU0M2M0YzFjMWUxYmQxY2YzZWIxMDhhY2FmM2E0NmI4ODc3M2JhNWVlIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
			
			return $response->data;
		}else{

			return array();
		}
    }

    // public static function getSpecificCoupon($id){
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'.$id,
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'GET',
    //     CURLOPT_HTTPHEADER => array(
    //         'Authorization: Bearer '.$_SESSION['token'],
    //         'Cookie: XSRF-TOKEN=eyJpdiI6Ikd6NjhZMGtucnNwcFRUNzVNSTltQ3c9PSIsInZhbHVlIjoiMXJJOVBkWTNFdjRzOHhvRGhTUmlDWDJsUG5tdFg4Tk1RT2xjYmZEUVJPWlJlaHJFYjIybUFNTTZHUERLeDNzWUcwQmtSanJ0UG01Zk8xd1ZkbDhHRmtUbjJOZWNYb292Y29wR3ZoSjduWnZCZmQzZ0ttZXBCVm5NL0MzR3pVQjIiLCJtYWMiOiJmZTI5ZTdjOGRjNTc3YTcwZGM4Y2UzOWIzNzcwMzI2N2UwODIyMGJmZDJkZmM3ZDIwYThiOTQ4MDEzNGViZWI1IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlpkVmJKTWJtcFpBM2tXaGZwTHZFbWc9PSIsInZhbHVlIjoiZWI1UllCTUIyeEtJekEzZnVBSTJiUzU0dXl0bDFsb1ZOZC9EOGtwTkJidjhkcm96cDBXMmIweXA2NXBzbUNyVllaY1IzSXV0VStVZlJ2V1NpeEsveW5BWWxpeDJzSVV2QnZhMFBOUWg2NXpSTGFNOGkvYmhZeTN4aDJDMlVRNkYiLCJtYWMiOiI0YThiNDg2Y2FkNmFkNTU3ZWJiNzNjOTM5OWUwMGQ2YTI4NzI5NTMyYjlhZmIxZTE2OTAzYjJjOWIwODgzYzA3IiwidGFnIjoiIn0%3D'
    //     ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);
    //     $response = json_decode($response);

	// 	if ( isset($response->code) && $response->code == 4) {
			
	// 		return $response->data;
	// 	}else{

	// 		return array();
	// 	}

    // }

    public static function createCoupon($name, $code, $percentage_discount, $min_amount_required, $min_product_required,
        $start_date, $end_date,$max_uses,$valid_only_first_purchase, $amount_discount, $status){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name,'code' => $code,'percentage_discount' => $percentage_discount,'min_amount_required' => $min_amount_required,'min_product_required' => $min_product_required,
        'start_date' => $start_date,'end_date' => $end_date,'max_uses' => $max_uses,'count_uses' => '0','valid_only_first_purchase' => $valid_only_first_purchase,'status' => $status, 'amount_discount' => $amount_discount),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Ikd6NjhZMGtucnNwcFRUNzVNSTltQ3c9PSIsInZhbHVlIjoiMXJJOVBkWTNFdjRzOHhvRGhTUmlDWDJsUG5tdFg4Tk1RT2xjYmZEUVJPWlJlaHJFYjIybUFNTTZHUERLeDNzWUcwQmtSanJ0UG01Zk8xd1ZkbDhHRmtUbjJOZWNYb292Y29wR3ZoSjduWnZCZmQzZ0ttZXBCVm5NL0MzR3pVQjIiLCJtYWMiOiJmZTI5ZTdjOGRjNTc3YTcwZGM4Y2UzOWIzNzcwMzI2N2UwODIyMGJmZDJkZmM3ZDIwYThiOTQ4MDEzNGViZWI1IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlpkVmJKTWJtcFpBM2tXaGZwTHZFbWc9PSIsInZhbHVlIjoiZWI1UllCTUIyeEtJekEzZnVBSTJiUzU0dXl0bDFsb1ZOZC9EOGtwTkJidjhkcm96cDBXMmIweXA2NXBzbUNyVllaY1IzSXV0VStVZlJ2V1NpeEsveW5BWWxpeDJzSVV2QnZhMFBOUWg2NXpSTGFNOGkvYmhZeTN4aDJDMlVRNkYiLCJtYWMiOiI0YThiNDg2Y2FkNmFkNTU3ZWJiNzNjOTM5OWUwMGQ2YTI4NzI5NTMyYjlhZmIxZTE2OTAzYjJjOWIwODgzYzA3IiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            header("Location: ".BASE_PATH."cupones/success");
        }else{
            header("Location: ".BASE_PATH."cupones/error");
        }
    }
    public static function updateCoupon($name,$code,$percentage_discount,$min_amount_required,$min_product_required,$start_date,$end_date,$max_uses,$valid_only_first_purchase,$id, $amount_discount, $status){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "name=$name&code=$code&percentage_discount=$percentage_discount&min_amount_required=$min_amount_required&min_product_required=$min_product_required&start_date=$start_date&end_date=$end_date&max_uses=$max_uses&valid_only_first_purchase=$valid_only_first_purchase&status=$status&id=$id&amount_discount=$amount_discount",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: XSRF-TOKEN=eyJpdiI6Ikd6NjhZMGtucnNwcFRUNzVNSTltQ3c9PSIsInZhbHVlIjoiMXJJOVBkWTNFdjRzOHhvRGhTUmlDWDJsUG5tdFg4Tk1RT2xjYmZEUVJPWlJlaHJFYjIybUFNTTZHUERLeDNzWUcwQmtSanJ0UG01Zk8xd1ZkbDhHRmtUbjJOZWNYb292Y29wR3ZoSjduWnZCZmQzZ0ttZXBCVm5NL0MzR3pVQjIiLCJtYWMiOiJmZTI5ZTdjOGRjNTc3YTcwZGM4Y2UzOWIzNzcwMzI2N2UwODIyMGJmZDJkZmM3ZDIwYThiOTQ4MDEzNGViZWI1IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlpkVmJKTWJtcFpBM2tXaGZwTHZFbWc9PSIsInZhbHVlIjoiZWI1UllCTUIyeEtJekEzZnVBSTJiUzU0dXl0bDFsb1ZOZC9EOGtwTkJidjhkcm96cDBXMmIweXA2NXBzbUNyVllaY1IzSXV0VStVZlJ2V1NpeEsveW5BWWxpeDJzSVV2QnZhMFBOUWg2NXpSTGFNOGkvYmhZeTN4aDJDMlVRNkYiLCJtYWMiOiI0YThiNDg2Y2FkNmFkNTU3ZWJiNzNjOTM5OWUwMGQ2YTI4NzI5NTMyYjlhZmIxZTE2OTAzYjJjOWIwODgzYzA3IiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            header("Location: ".BASE_PATH."cupones/success");
        }else{
            header("Location: ".BASE_PATH."cupones/error");
        }

    }
    public static function deleteCoupon($id){
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/coupons/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Ikd6NjhZMGtucnNwcFRUNzVNSTltQ3c9PSIsInZhbHVlIjoiMXJJOVBkWTNFdjRzOHhvRGhTUmlDWDJsUG5tdFg4Tk1RT2xjYmZEUVJPWlJlaHJFYjIybUFNTTZHUERLeDNzWUcwQmtSanJ0UG01Zk8xd1ZkbDhHRmtUbjJOZWNYb292Y29wR3ZoSjduWnZCZmQzZ0ttZXBCVm5NL0MzR3pVQjIiLCJtYWMiOiJmZTI5ZTdjOGRjNTc3YTcwZGM4Y2UzOWIzNzcwMzI2N2UwODIyMGJmZDJkZmM3ZDIwYThiOTQ4MDEzNGViZWI1IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IlpkVmJKTWJtcFpBM2tXaGZwTHZFbWc9PSIsInZhbHVlIjoiZWI1UllCTUIyeEtJekEzZnVBSTJiUzU0dXl0bDFsb1ZOZC9EOGtwTkJidjhkcm96cDBXMmIweXA2NXBzbUNyVllaY1IzSXV0VStVZlJ2V1NpeEsveW5BWWxpeDJzSVV2QnZhMFBOUWg2NXpSTGFNOGkvYmhZeTN4aDJDMlVRNkYiLCJtYWMiOiI0YThiNDg2Y2FkNmFkNTU3ZWJiNzNjOTM5OWUwMGQ2YTI4NzI5NTMyYjlhZmIxZTE2OTAzYjJjOWIwODgzYzA3IiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if ( isset($response->code) && $response->code == 2) {
          header("Location: ".BASE_PATH."cupones/success");
        }else{
          header("Location: ".BASE_PATH."cupones/error");
        }
    }
}


//funcion de validacion de campos
function validateCoupon($name, $code, $percentage_discount, $min_amount_required, $min_product_required,
$start_date, $end_date,$max_uses,$valid_only_first_purchase, $id=-1){
	//Variables 

	$nombre = $codigo = $descuento = $precioMin = $productoMin = $fechaStart = $fechaEnd = $usoMax = $validPrimerCompra = "";
	$error = false;

	//Validacion de campos  
	
	//description
	if (empty($name)) {
		$_SESSION['errors']['nameError'] = "El campo nombre es requerido";
		$error = true;
	} 

	//code
	if (empty($code)) {
		$_SESSION['errors']['codeError'] = "El campo código es requerido";
		$error = true;
	} 

	//percentage_discount 
	if (empty($percentage_discount)) {
		$_SESSION['errors']['percentageError'] = "El campo descuento en porcentaje es requerido";
		$error = true;
	} 
    //min_amount_required
    if(empty($min_amount_required)){
        $_SESSION['errors']['minAmountError'] = "El campo costo minimo es requerido";
        $error = true;
    }

	//min_product_required 
	if (empty($min_product_required)) {
		$_SESSION['errors']['minProductError'] = "El minimo de productos es requerido";
		$error = true;
	} 
    //start_date
    if(empty($start_date)){
        $_SESSION['errors']['startDateError'] = "El campo fecha de inicio es requerido";
        $error = true;
    }
    //end_date
    if (empty($end_date)) {
		$_SESSION['errors']['endDateError'] = "El campo fecha final es requerido";
		$error = true;
	} 

    if(empty($max_uses)){
        $_SESSION['errors']['maxUsesError'] = "El campo maximo de uso es requerido";
        $error = true;
    }
    //stock_max
    if (empty($valid_only_first_purchase)) {
		$_SESSION['errors']['valid_only_first_purchaseError'] = "El campo valido en primer compra es requerido";
		$error = true;
	} 
    

    //id
    if (empty($id)) {
		$error = true;
	} 
	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){
        // $descripcion = $codigo = $peso = $estatus = $img =
        //  $stockk = $stockmin = $stockmax = $productid
		$nombre = test_input($name);
        $codigo = test_input($code);
        $descuento = test_input($percentage_discount);
        $precioMin = test_input($min_amount_required);
        $productoMin = test_input($min_product_required);
        $fechaStart = test_input($start_date);
        $fechaEnd = test_input($end_date);
        $usoMax = test_input($max_uses);
        $validPrimerCompra = test_input($valid_only_first_purchase);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($nombre, $codigo, $descuento, $precioMin, $productoMin, $fechaStart, $fechaEnd, $usoMax, $validPrimerCompra, $id);
		}
		//si no, retornamos los datos recibidos
		return array($nombre, $codigo, $descuento, $precioMin, $productoMin, $fechaStart, $fechaEnd, $usoMax, $validPrimerCompra);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}

?>