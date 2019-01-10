<div class="styled-select"><select name="ciudad_id" id="ciudad_id" class="sombrai w257" tabindex="200"><?php
	if($this->valor[0]==0){
		echo '<option value="0" selected="selected">'.__('Seleccione primero el departamento').'</option>';
	}else{
		if($sale){ ?>
			<option value="0"<?php echo ($cl==0)?' selected="selected"':''?>><?php echo __('Seleccione una ciudad'); ?></option><?php
			while(!$sale->EOF){ ?>
				<option value="<?php echo $sale->fields['id']; ?>"<?php if($sale->fields['id']==$cl){echo ' selected="selected"';} ?>><?php echo $sale->fields['ciudad']; ?></option><?php
				$sale->MoveNext();
			}$sale->Move(0); ?>
			<option value="-1"<?php if($this->valor[0]==-1 || $cl==-1){echo ' selected="selected"';} ?>><?php echo __('Otro'); ?></option><?php
		}
	} ?>
</select><img src="<?php echo PATO; ?>img/loading2.png" border="0" style="display:none" id="load-ciudad_id" /></div>
<div id="errciudad_id" class="err" style="display:none;"><?php echo __('Por favor seleccione una Ciudad'); ?></div>
<input type="text" name="ciudad" id="ciudad" style="display:none;" placeholder="<?php echo __('cual ciudad?'); ?>" class="sombrai w250" value="<?php echo $ciudad; ?>" />
<div id="errciudad" class="err"><?php echo __('Por favor escriba su ciudad'); ?></div>

<script language="javascript" type="text/javascript">
$(function(){
	<?php if($this->valor[0]==-1 || $cl==-1){ ?>$('#ciudad').show();$('#ciudad_id').hide();<?php } ?>
	$('#ciudad_id').change(function(){if($('#ciudad_id').val()<0){$('#ciudad').show();}else{$('#ciudad').val('').hide();}});
	$('input, textarea').placeholder();
});
</script>