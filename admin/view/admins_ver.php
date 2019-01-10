<h4><?php echo __("Ver admins"); ?></h4>

<div class="row">
	<div class="col-8">


<div class="row">
<div class="col-5"><?php echo __("Id"); ?></div>
<div class="col-7"><?php echo $sale->fields["id"]; ?>
</div>
</div>


<div class="row">
<div class="col-5"><?php echo __("Nombre"); ?></div>
<div class="col-7"><?php echo $sale->fields["nombre"]; ?>
</div>
</div>


<div class="row">
<div class="col-5"><?php echo __("Email"); ?></div>
<div class="col-7"><?php echo $sale->fields["email"]; ?>
</div>
</div>


<div class="row">
<div class="col-5"><?php echo __("Usuario"); ?></div>
<div class="col-7"><?php echo $sale->fields["usuario"]; ?>
</div>
</div>


<div class="row">
<div class="col-5"><?php echo __("Clave"); ?></div>
<div class="col-7"><?php echo $sale->fields["clave"]; ?>
</div>
</div>


<div class="row">
<div class="col-5"><?php echo __("Estado"); ?></div>
<div class="col-7"><?php if($sale->fields["estado"]){echo __("Activo");}else{echo __("Inactivo");} ?>
</div>
</div>


<div class="form-group">
<div class="col-5">&nbsp;</div>
<div class="col-7"><button type="button" class="btn btn-primary btn-block" onClick="window.history.back();" style="margin-top:10px;">
<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("volver"); ?>
</button></div>
</div>

	</div>
	<div class="col-4">&nbsp;</div>
</div>

