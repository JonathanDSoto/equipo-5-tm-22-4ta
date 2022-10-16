<?php
include_once "config.php";

if (isset($_POST['action'])) {
	if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {
			
		switch ($_POST['action']) {
			case 'create':
                if( isset($_POST['name']) &&
					isset($_POST['description']) &&
					isset($_POST['slug']) ){

                    $name = strip_tags($_POST['name']);
                    $description = strip_tags($_POST['description']);
                    $slug = strip_tags($_POST['slug']);

                    $res = validate($name, $description, $slug);

                    if(!$res){ 
						header("Location: ".BASE_PATH."catalogos/etiquetas/error");
					}else{
						TagController::createTag($res[0], $res[1], $res[2]);
					}
                }else{
                    header("Location: ".BASE_PATH."catalogos/etiquetas/error");
                }
			break; 

			case 'update':
                if( isset($_POST['name']) &&
                isset($_POST['description']) &&
                isset($_POST['slug']) &&
                isset($_POST['id'])){
                    
                    $name = strip_tags($_POST['name']);
                    $description = strip_tags($_POST['description']);
                    $slug = strip_tags($_POST['slug']);
                    $id = strip_tags($_POST['id']);

                    $res = validate($name, $description, $slug, $id);

                    if(!$res){ 
						header("Location: ".BASE_PATH."catalogos/etiquetas/error");
					}else{
						TagController::updateTag($res[0], $res[1], $res[2], $res[3]);
					}
                }else{
                    header("Location: ".BASE_PATH."catalogos/etiquetas/error");
                }

				break;

			case 'delete':
				if( isset($_POST['id']) ){
					
					$id = test_input($_POST['id']);

					if(validateId($id)){
                        TagController::deleteTag($id);
                    }else{
                        header("Location: ".BASE_PATH."catalogos/etiquetas/error");
                    }
                }else{
                    header("Location: ".BASE_PATH."catalogos/etiquetas/error");
                }
				break; 

            default:
				header("Location: ".BASE_PATH."catalogos/etiquetas/error");
				break;
		}

	}
}
Class TagController
{
	public static function getTags(){
		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
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

	public static function createTag($name, $description, $slug){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $name,'description' => $description,'slug' => $slug),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token']
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
			header("Location: ".BASE_PATH."catalogos/etiquetas/success");
		}else{
			header("Location: ".BASE_PATH."catalogos/etiquetas/error");
		}
	}

	public static function updateTag($name, $description, $slug, $id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "name=$name&description=$description&slug=$slug&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code == 4) {
			header("Location: ".BASE_PATH."catalogos/etiquetas/success");
		}else{
			header("Location: ".BASE_PATH."catalogos/etiquetas/error");
		}
        
	}

	public static function deleteTag($id){
		$curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/tags/'.$id,
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
			header("Location: ".BASE_PATH."catalogos/etiquetas/success");
		}else{
			header("Location: ".BASE_PATH."catalogos/etiquetas/error");
		}

	}
}

//funcion de validacion de campos
function validate($name, $description, $slug, $id=0){
	//Variables 

	$nombre = $descripcion = $sluggy = "";
	$error = false;

	//Validacion de campos 
	
	//name
	if (empty($name)) {
		$_SESSION['errors']['nameError'] = "El campo nombre es requerido";
		$error = true;
	} 

	//description
	if (empty($description)) {
		$_SESSION['errors']['descriptionError'] = "El campo descripción es requerido";
		$error = true;
	} 

	//slug
	if (empty($slug)) {
		$_SESSION['errors']['slugError'] = "El campo slug es requerido";
		$error = true;
	} 

	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){

		$nombre = test_input($name);
		$descripcion = test_input($description);
		$sluggy = test_input($slug);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($nombre, $descripcion, $sluggy, $id);
		}
		//si no, retornamos los datos recibidos
		return array($nombre, $descripcion, $sluggy);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}
?>