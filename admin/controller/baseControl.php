<?php
class baseControl {

	public $letr;
	public $hea;
	public $pie;

	public function condiciones(){
	}

	public function cuatrocerocuatro(){ //404
		include('view/_header.php');
		if(ifaut()){include('view/index_interno.php');}else{include('view/index_index.php');}
		include('view/_footer.php');
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

