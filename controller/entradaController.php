<?php
class entradaController extends baseControl {

	public $valor;
	public $obj;
	public $log;

	public function __construct(){
		include_once("model/entradaModel.php");$this->obj = new entradaModel();$this->obj->tabla=PERFIL;
		include_once("model/departamentosModel.php");
	}

	public function index(){
		$user=limpia($_POST['username']);
		$clave=limpia($_POST['password']);
		$data['secret'] = GOOGLE_CLAVE_SECRETA;
		$data['response'] = $_POST['g-recaptcha-response'];
		$data['remoteip'] = $_SERVER['REMOTE_ADDR'];
		$pave = $this->http_post('https://www.google.com/recaptcha/api/siteverify',$data);
		$llega = json_decode($pave['content'],true);
		if($llega['success']){
			if(isset($_POST['recordar']) && limpia($_POST['recordar'])==1){$recordar=1;}else{$recordar=0;}
			if($user!='' && $clave!=''){
				$rs = $this->obj->verificar($user,$clave);
				if(!$rs->EOF){
					$_SESSION['JC_UserID'] = $rs->fields['id'];
					$_SESSION['JC_Nombre'] = $rs->fields['nombre'];
					$_SESSION['JC_Apellido'] = $rs->fields['apellido'];
					$_SESSION['JC_Email'] = $rs->fields['email'];
					$_SESSION['JC_Grupo'] = PERFIL;
					$_SESSION['JC_Estado'] = $rs->fields['estado'];
					if($recordar){
						$llave = crypt($_SESSION['JC_UserID'].'~'.FIRMA.'~'.$_SESSION['JC_Email'], 'rl');
						setcookie("id", $_SESSION['JC_UserID'], time()+60*60*24*15, PATO);
						setcookie("email", $_SESSION['JC_Email'], time()+60*60*24*15, PATO);
						setcookie("carpeta", PERFIL, time()+60*60*24*15, PATO);
						setcookie("llave", $llave, time()+60*60*24*15, PATO);
					}
					if(isset($_SESSION['descripcionout']) && $_SESSION['descripcionout']!=''){
						header("Location: ".PATO."procesos/agregando/");
					}else{
						header("Location: ".PATO);
					}
				}else{
					$_SESSION["alertas"]='Los datos ingresados, no coinciden en la base de datos, por favor intente de nuevo';
					header("Location: ".PATO);
				}
			}else{
				$_SESSION["alertas"]=__('Por favor escriba el usuario y la contraseña.');
				header("Location: ".PATO);
			}
		}else{
			$_SESSION["alertas"]=__('Es ud un robot? por favor espere la verificación de Captcha.');
			header("Location: ".PATO);
		}
	}	

	public function salir(){
		setcookie('id', 0, time() - 9900, PATO);
		setcookie('email', '', time() - 9900, PATO);
		setcookie('llave', '', time() - 9900, PATO);
		unset($_SESSION['JC_UserID']);
		unset($_SESSION['JC_Nombre']);
		unset($_SESSION['JC_Apellido']);
		unset($_SESSION['JC_Email']);
		unset($_SESSION['JC_Grupo']);
		unset($_SESSION['JC_Estado']);
		header("Location: ".PATO);
	}

	public function registro(){
		$departamentosobj = new departamentosModel();$departamentos = $departamentosobj->listar();
		if(isset($_POST['departamento']) && limpia($_POST['departamento'])){$ciudad=limpia($_POST['departamento']);}else{$departamento='';}
		if(isset($_POST['cl']) && limpia($_POST['cl'])){$cl=limpia($_POST['cl']);}else{$cl=0;}
		include('view/_header.php');
		include('view/entrada_registro.php');
		include('view/_footer.php');
	}

	public function registro2(){
		$departamentosobj = new departamentosModel();$departamentos = $departamentosobj->listar();
		if(isset($_POST['departamento']) && limpia($_POST['departamento'])){$ciudad=limpia($_POST['departamento']);}else{$departamento='';}
		if(isset($_POST['cl']) && limpia($_POST['cl'])){$cl=limpia($_POST['cl']);}else{$cl=0;}
		include('view/_header.php');
		include('view/entrada_registro.php');
		include('view/_footer.php');
	}

	public function registrando(){
		$entra = limpia2($_POST);
		if($entra['clave']==$entra['clave2']){
			$ret = $this->obj->registrando($entra);
			if($ret>0){
				$_POST['username'] = $entra['email'];
				$_POST['password'] = $entra['clave'];
				$this->index();
			}else{
				$_SESSION["alertas"]=__("Problema al registrar");
				header("Location: ".PATO.MODULO."/");exit;
			}
		}else{
			$_SESSION["alertas"]=__("Las Claves no coinciden");
			header("Location: ".PATO.MODULO."/");exit;
		}
	}

	public function verificaEmail(){
		$sale = $this->obj->verificaEmail($this->valor[0]);
		echo ($sale==0)?'1':'0';exit;
	}

	public function olvidoclave(){
		include('view/entrada_olvidoclave.php');
	}

	public function recordando(){
		$email = limpia($_POST['email']);
		$rs = $this->obj->olvidopass($email);
		if(!$rs->EOF){
			$mail  = new PHPMailer();
			$mail->IsSMTP();$mail->SMTPAuth = MAIL_AUTH;$mail->Host = MAIL_SERVER;
			$mail->Port = MAIL_PORT;$mail->Username = MAIL_USER;$mail->Password = MAIL_PASS;
			$body  = file_get_contents(MIURL.PATO.'mails/recordar/'.$_SESSION['JC_PaisJX'].'/'.$email.'/'.$rs->fields['clave'].'/'.urlencode($rs->fields['nombre']).'/');
			$mail->SetFrom(MAIL_MAIL,MAIL_NAME);$mail->AddReplyTo(MAIL_MAIL,MAIL_NAME);
			$mail->AddAddress($email,$rs->fields['nombre']);
			$mail->Subject = __('Clave de '.TITULO);
			$mail->MsgHTML($body);
			$mail->AddAttachment(MAIL_LOGO,MAIL_LOGO_NAME);
			if(!$mail->Send()){echo "Mailer Error: " . $mail->ErrorInfo;}
			$_SESSION['alertas'] = __('Se ha enviado su clave a su correo electronico');
			header("Location: ".PATO);exit;
		}else{
			$_SESSION['alertas'] = __('Su EMail no esta en nuestra base de datos de personas');
			header("Location: ".PATO);exit;
		}
	}

	// Lee la info para prellenar el form
	public function registrofb(){
		$facebook = new Facebook(array('appId'  => YOUR_APP_ID,'secret' => YOUR_SECRET));$userId = $facebook->getUser();
		$userInfo = $facebook->api('/' + $userId);
		$fb['fbid'] = $userInfo['id'];
		$fb['nombre'] = $userInfo['name'];
		$fb['fbusername'] = $userInfo['username'];
		$fb['email'] = $userInfo['email'];
		$_SESSION['FB_User'] = $fb['username'];
		$cad = explode(' ',$fb['nombre']);
		if(count($cad)==1){$fb['nombre']=$cad[0];}
		if(count($cad)==2){$fb['nombre']=$cad[0];$fb['apellido']=$cad[1];}
		if(count($cad)==3){$fb['nombre']=$cad[0];$fb['apellido']=$cad[1].' '.$cad[2];}
		if(count($cad)>=4){$fb['nombre']=$cad[0].' '.$cad[1];$fb['apellido']=$cad[2].' '.$cad[3];}
	}

	public function facebook(){
		include_once('admin/inc/facebook/autoload.php');
		$fb = new Facebook\Facebook(['app_id'=>YOUR_APP_ID,'app_secret'=>YOUR_SECRET,'default_graph_version'=>'v2.8']);
		$helper = $fb->getRedirectLoginHelper();//getRedirectLoginHelper,getJavaScriptHelper,getCanvasHelper,getPageTabHelper
		try{$accessToken = $helper->getAccessToken();}
		catch(Facebook\Exceptions\FacebookResponseException $e){echo 'Graph returned an error: '.$e->getMessage();exit;}
		catch(Facebook\Exceptions\FacebookSDKException $e){echo 'Facebook SDK returned an error: '.$e->getMessage();exit;}
		if(!isset($accessToken)){echo 'No cookie set or no OAuth data could be obtained from cookie.';exit;}
		//echo '<h3>Access Token</h3>';
		//var_dump($accessToken->getValue());
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);
		echo '<h3>Metadata</h3>';
		print_r($tokenMetadata);
		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId(YOUR_APP_ID); // Replace {app-id} with your app id
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();
		if(! $accessToken->isLongLived()){
			// Exchanges a short-lived access token for a long-lived one
			try{$accessToken=$oAuth2Client->getLongLivedAccessToken($accessToken);}
			catch(Facebook\Exceptions\FacebookSDKException $e){echo "<p>Error getting long-lived access token: ".$helper->getMessage()."</p>\n\n";exit;}
			echo '<h3>Long-lived</h3>';
			var_dump($accessToken->getValue());
		}
		$_SESSION['fb_access_token'] = (string) $accessToken;
		// User is logged in with a long-lived access token.
		// You can redirect them to a members-only page.
		//header('Location: https://example.com/members.php');
	}

	// Logeo con FB
	public function facebookOLD(){
		include_once('admin/inc/facebook.php');
		$facebook = new Facebook(array('appId'  => YOUR_APP_ID,'secret' => YOUR_SECRET));
		$userId = $facebook->getUser();
		$userInfo = $facebook->api('/' + $userId);
		print_r($userInfo);exit;
		$fb['fbid'] = $userInfo['id'];
		$fb['nombre'] = $userInfo['name'];
		$fb['fbusername'] = $userInfo['username'];
		$fb['email'] = $userInfo['email'];
		$cad = explode(' ',$fb['nombre']);
		if(count($cad)==1){$fb['nombre']=$cad[0];}
		if(count($cad)==2){$fb['nombre']=$cad[0];$fb['apellido']=$cad[1];}
		if(count($cad)==3){$fb['nombre']=$cad[0];$fb['apellido']=$cad[1].' '.$cad[2];}
		if(count($cad)>=4){$fb['nombre']=$cad[0].' '.$cad[1];$fb['apellido']=$cad[2].' '.$cad[3];}
		$rs = $this->obj->fbverifica($fb['fbid']);
		if(!$rs->EOF){
			$_POST['username']=$rs->fields['email'];
			$_POST['password']=$rs->fields['clave'];
			$_SESSION['FB'] = $userInfo['id'];
			$_SESSION['FB_User'] = $fb['fbusername'];
			$this->index();
		}else{
			$rs2 = $this->obj->fbverificamail($fb['email']);
			if(!$rs2->EOF){
				$id = $rs2->fields['id'];
				$this->obj->editando($id,$fb);
				$_POST['username']=$rs2->fields['email'];
				$_POST['password']=$rs2->fields['clave'];
				$_SESSION['FB'] = $userInfo['id'];
				$_SESSION['FB_User'] = $fb['fbusername'];
				$this->index();
			}else{
				$fb['clave']=$this->creaClave(10);
				$id=$this->obj->registrando($fb);
				$_POST['username']=$fb['email'];
				$_POST['password']=$fb['clave'];
				$_SESSION['FB'] = $userInfo['id'];
				$_SESSION['FB_User'] = $fb['fbusername'];
				$this->index();
			}
		}
	}

	public function creaClave($tamano){
		$cad="[^A-Z0-9]";
		return substr(eregi_replace($cad,"",md5(rand())).eregi_replace($cad,"",md5(rand())).eregi_replace($cad,"",md5(rand())),0,$tamano);
	}

	public function http_post($url,$data){
		$data_url = http_build_query($data);
		$data_len = strlen($data_url);
		return array (
			'content'=>file_get_contents (
				$url,
				false,
				stream_context_create(
					array (
						'http'=>array (
							'method'=>'POST',
							'header'=>"Content-Type: application/x-www-form-urlencoded\r\nConnection: close\r\nContent-Length: $data_len\r\n",
							'content'=>$data_url
						)
					)
				)
			),
			'headers'=>$http_response_header
		);
	}


}

/*
helper
Access Token</h3>Facebook\Helpers\FacebookJavaScriptHelper Object
(
    [signedRequest:protected] => Facebook\SignedRequest Object
        (
            [app:protected] => Facebook\FacebookApp Object
                (
                    [id:protected] => 1799762110353575
                    [secret:protected] => cfe31c14deac2d77bad9ab0ca2dc1f7d
                )

            [rawSignedRequest:protected] => 61ELsFQDYH90mJy5GSu5LTq-NN-84aJes6mZjqNjJt8.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUUN5YnRKd1JxNlk2V2JBVnVPaGZRSi1zYXNybWxEWGpQcWYzT2NUOGYzVjZVcHRzRHQtZ0FwSXBOVEFQSndDVTRCajZISVBweVhZb1lOa3FiWU9BdHFWNGJpeFVudElyTmlJTURlRXkxeGpXY1NDZ1JMUjM3UWtVM3U3b2RoSWpESktodVhkblJ6QWJtWm5obzhuaVNlTXc5akdTaUthSWNoMHI0YWg5emtxaWczUDRSVWJqOFZLV1FLcklEaVlSMnlGVlRPNU43WFg5dXJjY2IxcnJZSDJZQ0ZfbFhVZXBQaWpORVV6ZEo3ZEhpdzlXNUYzRGtQUHJoNXN3N1BPQkx2ZHN1dXZDalluQjhlcE5FLXN1UkJhd1NhV2FoUUhxaVZaVWJkcmxsWXVpa0dYcFRLdTcyQ3ZCQ3NVR1JZQnRIdGNJM2gyZkd5SzBfNzRzU3RLYUxINyIsImlzc3VlZF9hdCI6MTQ5NzkzNDIyNCwidXNlcl9pZCI6IjEwMTU1NTYwODI4ODM5ODgwIn0
            [payload:protected] => Array
                (
                    [algorithm] => HMAC-SHA256
                    [code] => AQCybtJwRq6Y6WbAVuOhfQJ-sasrmlDXjPqf3OcT8f3V6UptsDt-gApIpNTAPJwCU4Bj6HIPpyXYoYNkqbYOAtqV4bixUntIrNiIMDeEy1xjWcSCgRLR37QkU3u7odhIjDJKhuXdnRzAbmZnho8niSeMw9jGSiKaIch0r4ah9zkqig3P4RUbj8VKWQKrIDiYR2yFVTO5N7XX9urccb1rrYH2YCF_lXUepPijNEUzdJ7dHiw9W5F3DkPPrh5sw7POBLvdsuuvCjYnB8epNE-suRBawSaWahQHqiVZUbdrllYuikGXpTKu72CvBCsUGRYBtHtcI3h2fGyK0_74sStKaLH7
                    [issued_at] => 1497934224
                    [user_id] => 10155560828839880
                )

        )

    [app:protected] => Facebook\FacebookApp Object
        (
            [id:protected] => 1799762110353575
            [secret:protected] => cfe31c14deac2d77bad9ab0ca2dc1f7d
        )

    [oAuth2Client:protected] => Facebook\Authentication\OAuth2Client Object
        (
            [app:protected] => Facebook\FacebookApp Object
                (
                    [id:protected] => 1799762110353575
                    [secret:protected] => cfe31c14deac2d77bad9ab0ca2dc1f7d
                )

            [client:protected] => Facebook\FacebookClient Object
                (
                    [enableBetaMode:protected] => 
                    [httpClientHandler:protected] => Facebook\HttpClients\FacebookCurlHttpClient Object
                        (
                            [curlErrorMessage:protected] => 
                            [curlErrorCode:protected] => 0
                            [rawResponse:protected] => HTTP/1.1 200 OK
Access-Control-Allow-Origin: *
Pragma: no-cache
Cache-Control: private, no-cache, no-store, must-revalidate
x-fb-rev: 3101850
Content-Type: application/json; charset=UTF-8
x-fb-trace-id: Dk85eDN1osB
facebook-api-version: v2.8
Expires: Sat, 01 Jan 2000 00:00:00 GMT
Vary: Accept-Encoding
X-FB-Debug: /2yiUhmlRMGgS71MgQUqxddS4dGqaqK2z+RwTB1uyU5hQFi5s3AtdbnWpSUM6Oihb5WypZdGux1VrluQUIsQ5Q==
Date: Tue, 20 Jun 2017 04:50:28 GMT
Connection: keep-alive
Content-Length: 256

{"access_token":"EAAZAk38VEkKcBALUzsFAPY4UIrtxR0fdBlZAu0OmASFe7fIWq7ExCXnssTk3Ra52moPy3aiKe8kNbGTAsZCsFFv8197qcyOfnaudzvUY1XQBa2WxU6N04CYdXhzErUvwxTZAyovNXLsyTzZA6ocekZCCvrdkUcQ6sCJqwaDcSJWlbx9hnRZAnN1kxVdJxkQvHIZD","token_type":"bearer","expires_in":4172}
                            [facebookCurl:protected] => Facebook\HttpClients\FacebookCurl Object
                                (
                                    [curl:protected] => Resource id #43
                                )

                        )

                )

            [graphVersion:protected] => v2.8
            [lastRequest:protected] => Facebook\FacebookRequest Object
                (
                    [app:protected] => Facebook\FacebookApp Object
                        (
                            [id:protected] => 1799762110353575
                            [secret:protected] => cfe31c14deac2d77bad9ab0ca2dc1f7d
                        )

                    [accessToken:protected] => 1799762110353575|cfe31c14deac2d77bad9ab0ca2dc1f7d
                    [method:protected] => GET
                    [endpoint:protected] => /oauth/access_token
                    [headers:protected] => Array
                        (
                            [Content-Type] => application/x-www-form-urlencoded
                        )

                    [params:protected] => Array
                        (
                            [code] => AQCybtJwRq6Y6WbAVuOhfQJ-sasrmlDXjPqf3OcT8f3V6UptsDt-gApIpNTAPJwCU4Bj6HIPpyXYoYNkqbYOAtqV4bixUntIrNiIMDeEy1xjWcSCgRLR37QkU3u7odhIjDJKhuXdnRzAbmZnho8niSeMw9jGSiKaIch0r4ah9zkqig3P4RUbj8VKWQKrIDiYR2yFVTO5N7XX9urccb1rrYH2YCF_lXUepPijNEUzdJ7dHiw9W5F3DkPPrh5sw7POBLvdsuuvCjYnB8epNE-suRBawSaWahQHqiVZUbdrllYuikGXpTKu72CvBCsUGRYBtHtcI3h2fGyK0_74sStKaLH7
                            [redirect_uri] => 
                            [client_id] => 1799762110353575
                            [client_secret] => cfe31c14deac2d77bad9ab0ca2dc1f7d
                        )

                    [files:protected] => Array
                        (
                        )

                    [eTag:protected] => 
                    [graphVersion:protected] => v2.8
                )

        )

)

//-----------------------------------------------------------------------
fb

Access Token</h3>Facebook\Facebook Object
(
    [app:protected] => Facebook\FacebookApp Object
        (
            [id:protected] => 1799762110353575
            [secret:protected] => cfe31c14deac2d77bad9ab0ca2dc1f7d
        )

    [client:protected] => Facebook\FacebookClient Object
        (
            [enableBetaMode:protected] => 
            [httpClientHandler:protected] => Facebook\HttpClients\FacebookCurlHttpClient Object
                (
                    [curlErrorMessage:protected] => 
                    [curlErrorCode:protected] => 0
                    [rawResponse:protected] => HTTP/1.1 200 OK
Access-Control-Allow-Origin: *
Pragma: no-cache
Cache-Control: private, no-cache, no-store, must-revalidate
x-fb-rev: 3101850
Content-Type: application/json; charset=UTF-8
x-fb-trace-id: FvH+UEdgADi
facebook-api-version: v2.8
Expires: Sat, 01 Jan 2000 00:00:00 GMT
Vary: Accept-Encoding
X-FB-Debug: +Y3tAh19GiLCflZ2tOqrMLV208r61Zi9jYS/ySfP9fkgqr6WtTWgCmmO3ED+Bz9m8cwl2zVVoZ98rKpVwg/1AA==
Date: Tue, 20 Jun 2017 04:47:50 GMT
Connection: keep-alive
Content-Length: 255

{"access_token":"EAAZAk38VEkKcBAJSRxTRYjrSqzDMzZBJvVQmYVTQmQzz1HNUuKUWEb229LVilwsAvevZAB1olbH47T9VQ5eRdpTSV67uvPhYHVhVqXoZA4aiXnAikVDw69HHXqtZAIJkAi8XV8GZABLLyW1vjPXwOOdCPhYUoYP75vWJQxDzTmBokLpTOu7CXRCTOyTE8JrJwZD","token_type":"bearer","expires_in":4330}
                    [facebookCurl:protected] => Facebook\HttpClients\FacebookCurl Object
                        (
                            [curl:protected] => Resource id #43
                        )

                )

        )

    [oAuth2Client:protected] => 
    [urlDetectionHandler:protected] => Facebook\Url\FacebookUrlDetectionHandler Object
        (
        )

    [pseudoRandomStringGenerator:protected] => Facebook\PseudoRandomString\McryptPseudoRandomStringGenerator Object
        (
        )

    [defaultAccessToken:protected] => 
    [defaultGraphVersion:protected] => v2.8
    [persistentDataHandler:protected] => Facebook\PersistentData\FacebookSessionPersistentDataHandler Object
        (
            [sessionPrefix:protected] => FBRLH_
        )

    [lastResponse:protected] => 
)

*/
