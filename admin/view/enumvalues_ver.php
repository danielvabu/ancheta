<h4><?php echo __("Ver enumvalues"); ?></h4>

<div class="row">
	<div class="col-8" itemscope itemtype="">


<div class="row">
	<div class="col-5"><?php echo __("id"); ?></div>
	<div class="col-7"><?php echo $sale->fields["id"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Label"); ?></div>
	<div class="col-7"><?php echo $sale->fields["label"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Comment"); ?></div>
	<div class="col-7"><?php echo $sale->fields["comment"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Enumerationtype"); ?></div>
	<div class="col-7"><?php echo $sale->fields["enumerationtype"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("Supersedes"); ?></div>
	<div class="col-7"><?php echo $sale->fields["supersedes"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("SupersededBy"); ?></div>
	<div class="col-7"><?php echo $sale->fields["supersededBy"]; ?>	</div>
</div>


<div class="row">
	<div class="col-5"><?php echo __("IsPartOf"); ?></div>
	<div class="col-7"><?php echo $sale->fields["isPartOf"]; ?>	</div>
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

