<h4><?php echo __("Ver usuarios"); ?></h4>

<div class="row">
	<div class="col-8" itemscope itemtype="">


<div class="row">
	<div class="col-5"><?php echo __("id"); ?></div>
	<div class="col-7"><?php echo $sale->fields["id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Old"); ?></div>
	<div class="col-7"><?php echo $sale->fields["old_id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Constructora"); ?></div>
	<div class="col-7"><?php echo $sale->fields["constructora_id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Inmobiliaria"); ?></div>
	<div class="col-7"><?php echo $sale->fields["inmobiliaria_id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Email"); ?></div>
	<div class="col-7"><?php echo $sale->fields["email"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Clave"); ?></div>
	<div class="col-7"><?php echo $sale->fields["clave"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Drupal"); ?></div>
	<div class="col-7"><?php echo $sale->fields["drupal"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Nombre"); ?></div>
	<div class="col-7"><?php echo $sale->fields["nombre"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Apellidos"); ?></div>
	<div class="col-7"><?php echo $sale->fields["apellidos"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Tdocumento"); ?></div>
	<div class="col-7"><?php
					if(!$sale->fields["tdocumento"]){echo __("&nbsp;");}
					if($sale->fields["tdocumento"]==1){echo __("NIT");}
					if($sale->fields["tdocumento"]==2){echo __("CC");}
					if($sale->fields["tdocumento"]==3){echo __("CE");}
					if($sale->fields["tdocumento"]==4){echo __("Pasaporte");}
					?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Documento"); ?></div>
	<div class="col-7"><?php echo $sale->fields["documento"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Teléfono"); ?></div>
	<div class="col-7"><?php echo $sale->fields["telefono"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Celular"); ?></div>
	<div class="col-7"><?php echo $sale->fields["celular"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Celular2"); ?></div>
	<div class="col-7"><?php echo $sale->fields["celular2"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Departamento"); ?></div>
	<div class="col-7"><?php echo $sale->fields["departamento_id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Ciudad"); ?></div>
	<div class="col-7"><?php echo $sale->fields["ciudad_id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Dirección"); ?></div>
	<div class="col-7"><?php echo $sale->fields["direccion"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Resena"); ?></div>
	<div class="col-7"><?php echo $sale->fields["resena"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Web"); ?></div>
	<div class="col-7"><?php echo $sale->fields["web"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Img"); ?></div>
	<div class="col-7"><?php echo $sale->fields["img"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Origname"); ?></div>
	<div class="col-7"><?php echo $sale->fields["origname"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Estado"); ?></div>
	<div class="col-7"><?php if($sale->fields["estado"]){echo __("Activo");}else{echo __("Inactivo");} ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Creado"); ?></div>
	<div class="col-7"><?php echo $sale->fields["creado"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Editado"); ?></div>
	<div class="col-7"><?php echo $sale->fields["editado"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Login"); ?></div>
	<div class="col-7"><?php echo $sale->fields["login"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Biguser"); ?></div>
	<div class="col-7"><?php echo $sale->fields["biguser_id"]; ?>	</div>
</div>


<div class="form-group">
<div class="col-5">&nbsp;</div>
<div class="col-7"><button type="button" class="btn btn-primary btn-block mt-2" onClick="window.history.back();">
<i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("volver"); ?>
</button></div>
</div>

	</div>
	<div class="col-4">&nbsp;</div>
</div>

