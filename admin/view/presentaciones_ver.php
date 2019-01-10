<h4><?php echo __("Ver presentaciones"); ?></h4>

<div class="row">
	<div class="col-8" itemscope itemtype="">


<div class="row">
	<div class="col-5"><?php echo __("id"); ?></div>
	<div class="col-7"><?php echo $sale->fields["id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Producto"); ?></div>
	<div class="col-7"><?php echo $sale->fields["productos_nombre"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Presentación"); ?></div>
	<div class="col-7"><?php echo $sale->fields["presentacion"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Precio"); ?></div>
	<div class="col-7"><?php echo $sale->fields["precio"]; ?>	</div>
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

