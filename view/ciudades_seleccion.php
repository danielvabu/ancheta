<select name="ciudad_id" id="ciudad_id" class="form-control" tabindex="200"><?php
	if($this->valor[0]==0){
		echo '<option value="0" selected="selected">'.__('Seleccione primero el departamento').'</option>';
	}else{
		if($sale){ ?>
			<option value="0"><?php echo __('Seleccione una ciudad'); ?></option><?php
			while(!$sale->EOF){ ?>
				<option value="<?php echo $sale->fields['id']; ?>"><?php echo $sale->fields['ciudad']; ?></option><?php
				$sale->MoveNext();
			}$sale->Move(0);
		}
	} ?>
</select><img src="<?php echo PATO; ?>img/loading2.png" border="0" style="display:none" id="load-ciudad_id" />
<div id="errciudad_id" class="err" style="display:none;"><?php echo __('Por favor seleccione una Ciudad'); ?></div>

<script language="javascript" type="text/javascript">
$(function(){
	$('#ciudad_id').change(function(){
		if($('#ciudad_id').val()<0){$('#errciudad_id').hide();$('#errciudad').hide();$('#ciudad').show();}
		else{$('#ciudad').val('').hide();$('#errciudad').hide();}
		if($('#ciudad_id').val()==0)$('#errciudad_id').show();
		if($('#ciudad_id').val()>0){$('#errciudad_id').hide();$('#errciudad').hide();}
	});
	$('input, textarea').placeholder();
});
</script>