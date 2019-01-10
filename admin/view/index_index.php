<div class="container">
	<form action="<?php echo PATO; ?>entrada/" method="post" name="<?php echo MODULO; ?>-entrada" class="form-horizontal" id="<?php echo MODULO; ?>-entrada">
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-6"><?php
				if(isset($_GET['error'])){ ?><div align="center" class="alert alert-danger"><?php
				if($_GET['error']==1){echo __('Nombre de usuario o contraseña inválido. Por favor intente nuevamente');}
				if($_GET['error']==2){echo __('Falta el nombre de usuario o contraseña. Por favor intente nuevamente');}
				if($_GET['error']==3){echo __('Por favor verifique que usted no es un robot.');}
				?></div><?php }else{echo '&nbsp;';} ?>
			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-12 col-md-5">
				<div id="fguser" class="form-group">
					<label for="username" class="sr-only"><?php echo __('Nombre de usuario'); ?></label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
						<input type="text" class="form-control" id="username" name="username" placeholder="<?php echo __("Usuario"); ?>" />
					</div>
				</div>
				<div id="fgclave" class="form-group">
					<label for="password" class="sr-only"><?php echo __('Contraseña'); ?></label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
						<input type="password" class="form-control" id="password" name="password" placeholder="<?php echo __("Clave"); ?>" />
					</div>
				</div>
				<div class="form-group">
				<div class="col-12"><div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_CLAVE_SITIO; ?>"></div></div>
				</div>
				<div class="form-group">
					<div class="col-12"><button id="btentrar" type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in"></i> <?php echo __('Entrar'); ?></button></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script language="javascript" type="text/javascript">
var pavem=0;
$(function(){
	$('#username').focus();
	$('#<?php echo MODULO; ?>-entrada').submit(function(){
		var err=0;$('.has-warning').removeClass('has-warning');$('.form-control-warning').removeClass('form-control-warning');
		$("#btentrar").html('<?php echo __('Entrando...'); ?> <i class="fas fa-circle-o-notch fa-spin"></i>');
		if($('#username').val()==''){
			$('#fguser').addClass('has-warning');$('#username').addClass('form-control-warning');if(err==0)$('#username').focus();err++;
		}
		if($('#password').val()==''){
			$('#fgclave').addClass('has-warning');$('#password').addClass('form-control-warning');if(err==0)$('#password').focus();err++;
		}
		if(err==0){return true;}else{$("#btentrar").html('<i class="fas fa-sign-in"></i> <?php echo __('Entrar'); ?>');return false;}
	});
});
</script>
