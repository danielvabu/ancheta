<div class="container">
	<div class="row justify-content-md-center">
		<div class="col-12 col-md-6">
			<h3><?php echo __("Entrada"); ?></h3>
			<form method="post" action="<?php echo PATO; ?>entrada/" name="<?php echo MODULO; ?>-entrada" id="<?php echo MODULO; ?>-entrada">
				<div id="fguser" class="form-group">
					<label for="username" class="sr-only"><?php echo __("EMail"); ?></label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
						<input type="email" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="<?php echo __("EMail"); ?>" />
					</div>
				</div>
				<div id="fgclave" class="form-group">
					<label for="password" class="sr-only"><?php echo __("Clave"); ?></label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
						<input type="password" class="form-control" id="password" name="password" placeholder="<?php echo __("Clave"); ?>" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-12"><div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_CLAVE_SITIO; ?>"></div></div>
				</div>
				<button type="submit" class="btn btn-primary"><i class="fas fa-sign-in"></i> <?php echo __("Entrar"); ?></button>
				<input type="hidden" name="desde" id="desde" value="<?php echo MODULO; ?>" />
				<a href="JavaScript:;" class="btn btn-secondary" onclick="olvidoclc('<?php echo PATO; ?>entrada/olvidoclave/')"><?php echo __("Olvide mi clave"); ?></a>
			</form>
			<!--h3><?php echo __("Entrada con Facebook"); ?></h3-->
			<!--fb:login-button scope="<?php echo FB_SCOPE; ?>" onlogin="checkLoginState();"></fb:login-button>
			<div id="status"></div-->
			<!--a href="JavaScript:;" onclick="logInWithFacebook()"><img src="<?php echo PATO; ?>img/login_facebook.png" border="0" /></a-->
		</div>
		<div class="col-12 col-md-6">
			<h3><?php echo __("Formulario de registro"); ?></h3>
			<div class="form-group row">
				<label for="departamento_id" class="col-4"><?php echo __("Departamento"); ?></label>
				<div class="col-8"><select name="departamento_id" id="departamento_id" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Departamento"); ?>" required>
					<option value="0" selected="selected"><?php echo __("Seleccione Departamento"); ?></option><?php
					if(!$departamentos->EOF){
						while(!$departamentos->EOF){ ?>
							<option value="<?php echo $departamentos->fields["id"]; ?>"><?php echo $departamentos->fields["departamento"]; ?></option><?php
							$departamentos->MoveNext();
						}
						$departamentos->Move(0);
					} ?></select></div>
			</div>
			<div class="form-group row">
				<label for="ciudad_id" class="col-4"><?php echo __("Ciudad"); ?></label>
				<div id="tdciudad" class="col-8"><select name="ciudad_id" id="ciudad_id" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione la Ciudad"); ?>" required>
				<option value="0" selected="selected"><?php echo __("Seleccione primero Departamento"); ?></option>
				</select></div>
			</div>
		</div>
	</div>
</div>
<script language="javascript" type="text/javascript">
var pavem=0;
$(function(){
	//$('#username').focus();
	$('#<?php echo MODULO; ?>-entrada').submit(function(){
		var err=0;$('.has-warning').removeClass('has-warning');$('.form-control-warning').removeClass('form-control-warning');
		if($('#username').val()==''){
			$('#fguser').addClass('has-warning');$('#username').addClass('form-control-warning');if(err==0)$('#username').focus();err++;
		}
		if($('#password').val()==''){
			$('#fgclave').addClass('has-warning');$('#password').addClass('form-control-warning');if(err==0)$('#password').focus();err++;
		}
		if(err==0){return true;}else{return false;}
	});
	$('#departamento_id').change(function(){
		if($('#departamento_id').val()>0){
			$('#tdciudad').html('<img src="<?php echo PATO; ?>img/loading3.gif" border="0" />');
			$('#errdepartamento_id').hide();
			$('#ciudad').hide();
			$('#tdciudad').load('<?php echo PATO; ?>ciudades/seleccion/'+$('#departamento_id').val()+'/');
		}
	});
});
//--------------------------------------------------------
(function(d,s,id){
	var js, fjs=d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.fbAsyncInit=function(){
	FB.init({appId:'<?php echo YOUR_APP_ID; ?>',cookie:true,xfbml:true,version:'v2.8'});
	//FB.Event.subscribe('auth.login', function(response){$.ajax({type:'GET',url:'<?php echo PATO; ?>ajax/fbin/',success: function(a){if(a==1){window.location.reload();}}});});
	//FB.Event.subscribe('auth.logout', function(response){});
	//FB.AppEvents.logPageView();
	//FB.getLoginStatus(function(response){fbjc(response);});
};
//--------------------------------------------------------
function fbjc(response){
	$.ajax({type:'POST',url:'<?php echo PATO; ?>ajax/fb/',data:response.authResponse,success: function(a){}});
	//if(response.status === 'connected'){print_r(response.authResponse);}
}
logInWithFacebook = function(){
	FB.login(function(response){
		if(response.authResponse){
			alert('You are logged in &amp; cookie set!');
			window.location='<?php echo MIURL.PATO; ?>entrada/facebook/';
			// Now you can redirect the user or do an AJAX request to
			// a PHP script that grabs the signed request from the cookie.
		}else{
			alert('User cancelled login or did not fully authorize.');
		}
	});
	return false;
};
function checkLoginState(){FB.getLoginStatus(function(response){statusChangeCallback(response);});}
function statusChangeCallback(response){
	console.log('statusChangeCallback');console.log(response);
	if(response.status === 'connected'){testAPI();}else{document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';}
}
function testAPI(){
	console.log('Welcome!  Fetching your information.... ');
	FB.api('/me',function(response){
		console.log('Successful login for: ' + response.name);
		document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
	});
}
</script>
