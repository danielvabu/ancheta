<h4><?php echo __("Editar Presentacion"); ?></h4>

<form id="presentaciones-editando" name="presentaciones-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>presentaciones/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

    <div class="row"><div class="col-12">&nbsp;</div></div>

    <div class="row">
        <div class="col-12">


            <div class="form-group row">
                <label for="producto_id" class="col-3"><?php echo __("Producto"); ?></label>
                <div class="col-7"><select name="producto_id" id="producto_id" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Producto"); ?>" required>
                        <option value="0"<?php if (!$sale->fields["producto_id"]) { ?> selected="selected"<?php } ?>><?php echo __("Seleccione Producto"); ?></option><?php
                        if (!$productos->EOF) {
                            while (!$productos->EOF) {
                                ?>
                                <option value="<?php echo $productos->fields["id"]; ?>"<?php if ($productos->fields["id"] == $sale->fields["producto_id"]) { ?> selected="selected"<?php } ?>><?php echo $productos->fields["nombre"]; ?></option><?php
                                $productos->MoveNext();
                            }
                            $productos->Move(0);
                        }
                        ?></select></div>
            </div>


            <div class="form-group row">
                <label for="presentacion" class="col-3"><?php echo __("Presentación"); ?></label>
                <div class="col-7"><input id="presentacion" name="presentacion" type="text" value="<?php echo $sale->fields["presentacion"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Presentación"); ?>" required /></div>
            </div>

            <div class="form-group row">
                <label for="stock" class="col-3"><?php echo __("Stock"); ?></label>
                <div class="col-7"><input id="stock" name="stock" type="text" value="<?php echo $sale->fields["stock"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Stock"); ?>" required /></div>
            </div>
            <div class="form-group row">
                <label for="precio" class="col-3"><?php echo __("Precio"); ?></label>
                <div class="col-7"><input id="precio" name="precio" type="text" value="<?php echo $sale->fields["precio"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Precio"); ?>" required /></div>
            </div>


            <div class="form-group row">
                <div class="col-3"><button type="button" class="btn btn-secondary btn-block mt-2" onClick="window.history.back();"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
                <div class="col-5"><button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="Verificando..."><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
            </div>

        </div>
    </div>

</form>

<script type="application/javascript">
    var pavem=0;
    $(function(){

    $("#presentaciones-editando").submit(function(){
    var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");



    if($("#producto_id").val()==0){
    if(err==0)$("#producto_id").focus();err++;$("#producto_id").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if($("#presentacion").val()==""){
    if(err==0)$("#presentacion").focus();err++;$("#presentacion").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if($("#precio").val()==""){
    if(err==0)$("#precio").focus();err++;$("#precio").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
    });
    });
</script>