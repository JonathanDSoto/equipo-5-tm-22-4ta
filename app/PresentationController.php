<?php 
include_once "config.php";
// lista de presentaciones (crud de presentaciones)
var_dump(PresentationController::getSpecificPresentation(52));
if( isset($_POST['action']) ) {
    if ( isset($_POST['global_token']) && 
		$_POST['global_token'] == $_SESSION['global_token']) {
        switch ($_POST['action']) {
            case 'create':
          
                if( isset($_POST['description']) &&
                    isset($_POST['code']) &&
                    isset($_POST['weight_in_grams']) &&
                    isset($_POST['status']) &&
                    isset($_POST['stock']) &&
                    isset($_POST['stock_min']) &&
                    isset($_POST['stock_max']) &&
                    isset($_POST['product_id'])){

                        $cover = false;

                        if( isset($_FILES['cover'])){
                            $cover = true;
                        }
                        
                        $description = strip_tags($_POST['description']);
                        $code = strip_tags($_POST['code']);
                        $weight_in_grams = strip_tags($_POST['weight_in_grams']);
                        $status = strip_tags($_POST['status']);
                        $stock = strip_tags($_POST['stock']);
                        $stock_min = strip_tags($_POST['stock_min']);
                        $stock_max = strip_tags($_POST['stock_max']);
                        $product_id = strip_tags($_POST['product_id']);

                        $res = validate($description, $code, $weight_in_grams, $status,
                            $stock, $stock_min, $stock_max, $product_id);
                        
                        if(!$res){ 
                            header("Location: ../test.php");
                        }else{
                            PresentationController::createPresentation($description, $code, $weight_in_grams, $status,
                            $cover, $stock, $stock_min, $stock_max, $product_id);
                        }

                    }else{
                        header("Location: ../test.php");
					}
                break;
            case 'update':
                if( isset($_POST['description']) &&
                    isset($_POST['code']) &&
                    isset($_POST['weight_in_grams']) &&
                    isset($_POST['status']) &&
                    isset($_POST['stock']) &&
                    isset($_POST['stock_min']) &&
                    isset($_POST['stock_max']) &&
                    isset($_POST['product_id']) &&
                    isset($_POST['id'])){
                        
                        $description = strip_tags($_POST['description']);
                        $code = strip_tags($_POST['code']);
                        $weight_in_grams = strip_tags($_POST['weight_in_grams']);
                        $status = strip_tags($_POST['status']);
                        $stock = strip_tags($_POST['stock']);
                        $stock_min = strip_tags($_POST['stock_min']);
                        $stock_max = strip_tags($_POST['stock_max']);
                        $product_id = strip_tags($_POST['product_id']);
                        $id = strip_tags($_POST['id']);

                        $res = validate($description, $code, $weight_in_grams, $status,
                            $stock, $stock_min, $stock_max, $product_id, $id);
                        
                        if(!$res){ 
                            header("Location: ../test.php");
                        }else{ 
                            PresentationController::updatePresentation($res[0], $res[1], $res[2], $res[3], 
                            $res[4], $res[5], $res[6], $res[7], $res[8]);
                        }

                    }else{
                        header("Location: ../test.php");
					}
                break;
            case 'delete':
                if( isset($_POST['id']) ){
					
					$id = test_input($_POST['id']);

					if(validateId($id)){
                        PresentationController::deletePresentation($id);
                    }else{
                        header("Location: ".BASE_PATH."producto/error");
                    }
				}else{
					header("Location: ".BASE_PATH."producto/error");
				}

                break;
            default:
                break;
        }

    }
}

Class PresentationController{

    public static function getPresentations($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/product/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token']
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

    public static function getSpecificPresentation($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token']
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
    public static function createPresentation($description, $code, $weight_in_grams, $status, $cover, $stock, $stock_min, $stock_max, $product_id){ 
        
        if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ../test.php");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }

        $curl = curl_init();
        if($cover){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('description' => $description,'code' => $code,'weight_in_grams' => $weight_in_grams,'status' => $status,
            'cover'=> new CURLFILE($imagen),'stock' => $stock,'stock_min' => $stock_min,
            'stock_max' => $stock_max,'product_id' => $product_id),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token']
            ),
            ));
        }else{
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('description' => $description,'code' => $code,'weight_in_grams' => $weight_in_grams,'status' => $status,
            'stock' => $stock,'stock_min' => $stock_min,
            'stock_max' => $stock_max,'product_id' => $product_id),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token']
            ),
            ));
        }

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            header("Location: ".$_SERVER['HTTP_REFERER']."/success");
        }else{
            header("Location: ../test.php");
        }

    }

    public static function updatePresentation($description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $product_id, $id){
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "description=$description&code=$code&weight_in_grams=$weight_in_grams&status=$status&stock=$stock&stock_min=$stock_min&stock_max=$stock_max&product_id=$product_id&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));
    
        $response = curl_exec($curl);

        $response = json_decode($response);

        if( isset($response->code) && $response->code == 4){
            header("Location: ".$_SERVER['HTTP_REFERER']."/success");
        }else{
            header("Location: ../test.php");
        }
        

    }

    public static function deletePresentation($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/presentations/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token']
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 2) {
			
			return true;
		}else{

			return false;
		}

    }
}


//funcion de validacion de campos
function validate($description, $code, $weight_in_grams, $status, $stock, $stock_min, $stock_max, $product_id, $id=0){
	//Variables 

	$descripcion = $codigo = $peso = $estatus = $stockk = $stockmin = $stockmax = $productid = "";
	$error = false;

	//Validacion de campos  
	
	//description
	if (empty($description)) {
		$_SESSION['errors']['descriptionError'] = "El campo descripción es requerido";
		$error = true;
	} 

	//code
	if (empty($code)) {
		$_SESSION['errors']['codeError'] = "El campo código es requerido";
		$error = true;
	} 

	//weight_in_grams 
	if (empty($weight_in_grams)) {
		$_SESSION['errors']['weightError'] = "El campo peso es requerido";
		$error = true;
	} 
    //filter_var($id, FILTER_VALIDATE_FLOAT) && $id > 0
    if(!filter_var($weight_in_grams, FILTER_VALIDATE_INT) && $weight_in_grams > 0){
        $_SESSION['errors']['weightError'] = "El campo peso no es valido";
        $error = true;
    }

	//stock 
	if (empty($stock)) {
		$_SESSION['errors']['stockError'] = "El campo stock es requerido";
		$error = true;
	} 
    if(!filter_var($stock, FILTER_VALIDATE_INT) && $stock > 0){
        $_SESSION['errors']['stockError'] = "El campo stock no es valido";
        $error = true;
    }
    //stock_min
    if (empty($stock_min)) {
		$_SESSION['errors']['stockMinError'] = "El campo stock minimo es requerido";
		$error = true;
	} 

    if(!filter_var($stock_min, FILTER_VALIDATE_INT) && $stock_min > 0){
        $_SESSION['errors']['stockMinError'] = "El campo stock minimo no es valido";
        $error = true;
    }
    //stock_max
    if (empty($stock_max)) {
		$_SESSION['errors']['stockMaxError'] = "El campo stock maximo es requerido";
		$error = true;
	} 
    if(!filter_var($stock_max, FILTER_VALIDATE_INT) && $stock_max > 0){
        $_SESSION['errors']['stockMaxError'] = "El campo stock maximo no es valido";
        $error = true;
    }
    //product_id
    if (empty($product_id)) {
		$_SESSION['errors']['productError'] = "El campo producto es requerido";
		$error = true;
	} 
    if(!filter_var($product_id, FILTER_VALIDATE_INT) && $product_id > 0){
        $_SESSION['errors']['productError'] = "El producto no es valido";
        $error = true;
    }
	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){
        // $descripcion = $codigo = $peso = $estatus = $img =
        //  $stockk = $stockmin = $stockmax = $productid

		$descripcion = test_input($description);
		$codigo = test_input($code);
		$peso = test_input($weight_in_grams);
        $estatus = test_input($status);
        $stockk = test_input($stock);
        $stockmin = test_input($stock_min);
        $stockmax = test_input($stock_max);
        $productid = test_input($product_id);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($descripcion, $codigo, $peso, $estatus, $stockk, $stockmin, $stockmax, $productid, $id);
		}
		//si no, retornamos los datos recibidos
		return array($descripcion, $codigo, $peso, $estatus, $stockk, $stockmin, $stockmax, $productid);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}

?>