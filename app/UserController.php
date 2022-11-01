<?php
include_once "config.php";

if (isset($_POST['action'])) {
    if ( isset($_POST['global_token']) && 
	$_POST['global_token'] == $_SESSION['global_token']) {

        switch ($_POST['action']) {
			case 'create':
                
                if(isset($_POST['name']) &&
                    isset($_POST['lastname']) &&
                    isset($_POST['email']) &&
                    isset($_POST['phone_number']) &&
                    isset($_POST['created_by']) &&
                    isset($_POST['role']) && 
                    isset($_POST['password']) ) {
                        $cover = false;

                        if( isset($_FILES['cover'])){
                            $cover = true;
                        }

                        $name = strip_tags($_POST['name']);
                        $lastname = strip_tags($_POST['lastname']);
                        $email = strip_tags($_POST['email']);
                        $phone_number = strip_tags($_POST['phone_number']);
                        $created_by = strip_tags($_POST['created_by']);
                        $role = strip_tags($_POST['role']);
                        $password = strip_tags($_POST['password']);

                        $res = validateUser($name,$lastname,$email,$phone_number,$created_by,$role,$password);
                        if(!$res){
                            header("Location: ".BASE_PATH."usuarios/error");
                        }else{
                            UserController::newUser($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],$res[6], $cover);
                        }
                    }else{
                        header("Location: ".BASE_PATH."usuarios/error");
                    }
                break;

            case 'update':
                if(isset($_POST['name']) &&
                    isset($_POST['lastname']) &&
                    isset($_POST['email']) &&
                    isset($_POST['phone_number']) &&
                    isset($_POST['created_by']) &&
                    isset($_POST['role']) && 
                    isset($_POST['password']) &&
                    isset($_POST['id'])) {

                        //$name,$lastname,$email,
                        //$phone_number,$created_by,$role,$password,$id

                        $name = strip_tags($_POST['name']);
                        $lastname = strip_tags($_POST['lastname']);
                        $email = strip_tags($_POST['email']);
                        $phone_number = strip_tags($_POST['phone_number']);
                        $created_by = strip_tags($_POST['created_by']);
                        $role = strip_tags($_POST['role']);
                        $password = strip_tags($_POST['password']);
                        
                        $res = validateUser($name,$lastname,$email,$phone_number,$created_by,$role,$password, $id);
                        if(!$res){
                            header("Location: ".BASE_PATH."usuarios/error");
                        }else{
                            UserController::editUser($res[0],$res[1],$res[2],$res[3],$res[4],$res[5],$res[6], $res[7]);
                        }
                    }else{
                        header("Location: ".BASE_PATH."usuarios/error");
                    }
                break;

            case 'delete':
                if( isset($_POST['id']) ){
					
					$id = test_input($_POST['id']);

					if(validateId($id)){
                        UserController::deleteUser($id);
                    }else{
                        header("Location: ".BASE_PATH."usuarios/error");
                    }
				}else{
					header("Location: ".BASE_PATH."usuarios/error");
				}
                break;
            case 'updatePhoto':
                if(isset($_POST['id'])){
                    $cover = false;
    
                    if( isset($_FILES['cover'])){
                        $cover = true;
                    }

                    $id = test_input($_POST['id']);

					if(validateId($id)){
                        UserController::updatePhoto($id, $cover);
                    }else{
                        header("Location: ".BASE_PATH."usuarios/info/$id/error");
                    }
                    
                }else{
                    header("Location: ".BASE_PATH."usuarios/info/$id/error");
                }

                break;
            }
    }
}
Class UserController{

    public static function getUsers(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
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

    public static function newUser($name, $lastname, $email, $phone_number, $created_by, $role, $password, $cover){
        
        if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ../test.php");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }


        $curl = curl_init();
        if($cover){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('name' => $name,'lastname' => $lastname,'email' => $email,'phone_number' => $phone_number,
            'created_by' => $created_by,'role' => $role,'password' => $password,
            'profile_photo_file'=> new CURLFILE($imagen)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token'],
                'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
            ),
            ));
        }else{
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => $name,'lastname' => $lastname,'email' => $email,'phone_number' => $phone_number,
                'created_by' => $created_by,'role' => $role,'password' => $password),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$_SESSION['token'],
                    'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
                ),
                ));
        }

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			header("Location: ".BASE_PATH."usuarios/success");
		}else{ 
			header("Location: ".BASE_PATH."usuarios/error");
		}
    }

    public static function getSpecificUser($id){
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {
			
			return $response->data;
		}else{

			return array();
		}

    }

    public static function editUser($name,$lastname,$email,$phone_number,$created_by,$role,$password,$id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => "name=$name&lastname=$lastname&email=$email&phone_number=$phone_number&created_by=$created_by&role=$role&password=$password&id=$id",
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Content-Type: application/x-www-form-urlencoded',
            'Cookie: XSRF-TOKEN=eyJpdiI6ImxTc2hpYXV6S05XRGF4S0JyUk56cVE9PSIsInZhbHVlIjoiS0RnczQzUHlybzVGa05IeGxIRTFZS1FjcU9XRFM3ZXdicTFYL2FkVmFXd3BLWGxkWDZvcjlyc2NndFhoVHE0ZGxOOEhycWszKzhqSGxkWGJBeElMOEJ2OThQdVR1S1loWmhHVFFaOWZaek1LU3A2U2c4eWhFcjEvQXJNOWNjM1giLCJtYWMiOiJlM2I5NzkxNGM3OWIxOTI2YWE1MWM0NGVhZWVjMGNkZTFkNzIxYWM5MzE1MWNmY2JhYzI0Njk4MGE1NDA4ZjhiIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImxWYnFFSldsT2U3bjVublR3cUxIckE9PSIsInZhbHVlIjoiaEsxZjcxZFY1Y2dhTEY3ZE5ESWtEaS9YRnlDaU5jSC9IZjhDVGg5VlFoeW5jWTE4UVY5V1UySVdPK0JrYTRpYm1aZlpyREdpd0hGZDZseUJNLzhkdUdJMGxVcndBUlZ3c0VjUjVKaVRHVmtCRDNFZFRFMHgxV0xuOEd0MTJJQjIiLCJtYWMiOiI0Y2ViMGU5OWZhNTQxNzE3NWM1NzdiZWVhZTcxYmIyNjBjN2FhMTIwNDQ2MzI2M2I4NmEzZDNlMmE5ZGRkNzFkIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			header("Location: ".BASE_PATH."usuarios/success");
		}else{ 
			header("Location: ".BASE_PATH."usuarios/error");
		}
    }

    public static function deleteUser($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/'.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['token'],
            'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {
			
			return true;
		}else{

			return false;
		}
    }

    public static function updatePhoto($id, $cover){
        if($cover){
            if($_FILES["cover"]["error"] > 0){
                header("Location: ../test.php");
            }
            $imagen = $_FILES["cover"]["tmp_name"];
        }
        $curl = curl_init();

        if($cover){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id' => $id,'profile_photo_file'=> new CURLFILE($imagen)),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token'],
                'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
            ),
            ));
        }else{
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crud.jonathansoto.mx/api/users/avatar',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id' => $id),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$_SESSION['token'],
                'Cookie: XSRF-TOKEN=eyJpdiI6Iko2S0JzL1gvb0Z0QkgyZGFMSzgxbXc9PSIsInZhbHVlIjoiWldrYTEzc2FDekUxTlpHNFBKQVlQZ25NT3I3TzRKNmh5QkNxYUpROWc2QW0xZk54ekpWZ2xOZ3NwN2pqRWE1ekJLR2VvZFdPbi9ZeDRPTkJYY3R5dVRCdmhqb1hvV1hwM3lYVWd6QkR0dWNtOGJuVHJZWWpQYzJMNU5ibXZYU28iLCJtYWMiOiI4NDRmMDNlM2IzNTlkYjEwMGI5YWEwODI2OTAxMDlhYzIxYjJhZTZhNTk0Y2ZjZGViNTZhM2E4NDAwY2Y3Y2MyIiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImZEWjlrNytRcGtIT0pkM3RrbVpBMWc9PSIsInZhbHVlIjoiSW5jUDdoWFBocVFRR2pXTStwbUx2czdCT3RyOEtVQ2VIOTJnQm9UdjZMa2dYbWtpQUJIM1dTYk9GSU5xOTNhT1FBR081LzhhVkR4Z1l5N2NOT0dBbEhzQ2hRM3BiOHNaS2xBUHkzQUM1aDRUeDhaMGpxTzgvVFdZQ3ZtZG93dngiLCJtYWMiOiJhODU4YWVlZGRjOTY5NTBkODJkNzdkZWZiZTY5ODI0OTIwM2Q2MTM4NWFmM2Y3YTc1YTM4YzM0M2FjMDlkZDhjIiwidGFnIjoiIn0%3D'
            ),
            ));

        }

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);

		if ( isset($response->code) && $response->code > 0) {

			header("Location: ".BASE_PATH."usuarios/info/$id/success");
		}else{ 
			header("Location: ".BASE_PATH."usuarios/info/$id/error");
		}
    }
}

//funcion de validacion de campos
function validateUser($name, $lastname, $email, $phone_number, $created_by, $role, $password, $id=-1){
	//Variables 

	$nombre = $apellido = $correo = $telefono = $creado_por =  $rol = $contra = "";
	$error = false;

	//Validacion de campos 
	
	//name
	if (empty($name)) {
		$_SESSION['errors']['nameError'] = "El campo nombre es requerido";
		$error = true;
	} 

	//lastname
	if (empty($lastname)) {
		$_SESSION['errors']['lastError'] = "El campo apellido es requerido";
		$error = true;
	} 

	//email
	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['errors']['emailError'] = "El campo correo electrónico no es valido";
		$error = true;
	} 

	//phone_number
	if (empty($phone_number)) {
		$_SESSION['errors']['phoneError'] = "El campo telefono no es valido";
		$error = true;
	} 

	//created_by
	if (empty($created_by)) {
		$_SESSION['errors']['createdError'] = "Es necesario indicar quien esta creando al usuario";
		$error = true;
	} 

    //$role, $password
    if (empty($role)) {
		$_SESSION['errors']['roleError'] = "El campo rol es requerido";
		$error = true;
	} 
    if (empty($password)) {
		$_SESSION['errors']['passwordError'] = "El campo contraseña es requerido";
		$error = true;
	} 
    
	//id
	if (empty($id)) {
		$error = true;
	} 

	//Si no hay error asignamos los campos para retornarlos
	
	if(!$error){

		$nombre = test_input($name);
        $apellido = test_input($lastname);
        $correo = test_input($email);
        $telefono = test_input($phone_number);
        $creado_por =  test_input($created_by);
        $rol = test_input($role);
        $contra = test_input($password);

		//Si existe el id quiere decir que es un update y retornamos los datos + el id
		if (validateId($id)) {
			return array($nombre, $apellido, $correo, $telefono, $creado_por, $rol,
            $contra, $id);
		}
		//si no, retornamos los datos recibidos
		return array($nombre, $apellido, $correo, $telefono, $creado_por, $rol,
            $contra);
	}
	else{
		//si existe un error retornamos false
		return false;
	}
}

?>