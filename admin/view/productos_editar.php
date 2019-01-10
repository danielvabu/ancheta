<h4><?php echo __("Editar Producto"); ?></h4>

<form id="productos-editando" name="productos-editando" class="form-horizontal" method="post" action="<?php echo PATO; ?>productos/editando/<?php echo $this->valor[0]; ?>/" enctype="multipart/form-data">

    <div class="row"><div class="col-12">&nbsp;</div></div>

    <div class="row">
        <div class="col-12">


            <div class="form-group row">
                <label for="nombre" class="col-3"><?php echo __("Nombre"); ?></label>
                <div class="col-7"><input id="nombre" name="nombre" type="text" value="<?php echo $sale->fields["nombre"]; ?>" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Nombre"); ?>" required /></div>
            </div>


            <div class="form-group row">
                <label for="descripcion" class="col-3"><?php echo __("Descripción"); ?></label>
                <div class="col-7"><textarea id="descripcion" name="descripcion" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Descripción"); ?>" required><?php echo $sale->fields["descripcion"]; ?></textarea></div>
            </div>





            <div class="form-group row">
                <label for="vitrina" class="col-3"><?php echo __("Vitrina"); ?></label>
                <div class="col-7"><input type="number" class="form-control" id="vitrina" value="<?php echo $sale->fields["vitrina"]; ?>" name="vitrina" ></div>
            </div>
            <div class="form-group row">
                <label for="vitrina" class="col-3"><?php echo __("Estado"); ?></label>
                <div class="col-7"><select name="estado" id="estado" class="custom-select" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor seleccione el Producto"); ?>" required>
                        <option value="1"<?php if ($sale->fields["estado"] == 1) { ?> selected="selected"<?php } ?>><?php echo __("Activo"); ?></option>
                        <option value="0"<?php if ($sale->fields["estado"] == 0) { ?> selected="selected"<?php } ?>><?php echo __("Inactivo"); ?></option>                        </select></div>
            </div>
            <div class = "form-group row">
                <label for = "vitrina" class = "col-2"><?php echo __("Foto");
?></label>
                <div class="col-7"><input type="file" name="rutfile" id="rutfile" class="form-control"></div>
            </div>
            <div class="form-group row">
                <img class="img-thumbnail" src="http://artesabio.com/admin/img/productos/<?php echo $this->valor[0]; ?>prod.jpg"  alt="Foto">
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

    $("#productos-editando").submit(function(){
    var err=0;$(".has-error").removeClass("has-error");$(".popover").hide();$("[type=submit]").button("loading");


    if($("#nombre").val()==""){
    if(err==0)$("#nombre").focus();err++;$("#nombre").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if($("#descripcion").val()==""){
    if(err==0)$("#descripcion").focus();err++;$("#descripcion").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if($("#stock").val()==""){
    if(err==0)$("#stock").focus();err++;$("#stock").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if($("#vitrina").val()==""){
    if(err==0)$("#vitrina").focus();err++;$("#vitrina").addClass("has-error").popover("show").parent("div").addClass("has-error");}

    if(err==0){return true;}else{$("[type=submit]").button("reset");return false;}
    });
    });
</script>