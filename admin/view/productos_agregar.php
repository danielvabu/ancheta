
<h4><?php echo __("Nuevo Producto"); ?></h4>

<form id="productos-agregando" name="productos-agregando" class="form-horizontal" method="post" action="<?php echo PATO; ?>productos/agregando/" enctype="multipart/form-data">

    <div class="row"><div class="col-12">&nbsp;</div></div>

    <div class="row">
        <div class="col-12">


            <div class="form-group row">
                <label for="nombre" class="col-2"><?php echo __("Nombre"); ?></label>
                <div class="col-7"><input id="nombre" name="nombre" type="text" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Nombre"); ?>" required /></div>
            </div>


            <div class="form-group row">
                <label for="descripcion" class="col-2"><?php echo __("Descripción"); ?></label>
                <div class="col-7"><textarea id="descripcion" name="descripcion" class="form-control" data-placement="right" data-original-title="<?php echo __("Dato requerido"); ?>" data-content="<?php echo __("Por favor escriba el Descripción"); ?>" required></textarea></div>
            </div>





            <div class="form-group row">
                <label for="vitrina" class="col-2"><?php echo __("Vitrina"); ?></label>
                <div class="col-7"><input type="number" class="form-control" id="vitrina"  name="vitrina" ></div>
            </div>
            <div class="form-group row">
                <label for="vitrina" class="col-2"><?php echo __("Foto"); ?></label>
                <div class="col-7"><input type="file" name="rutfile" id="rutfile" class="form-control"></div>
            </div>


            <div class="form-group row">
                <div class="col-2"><button type="button" class="btn btn-secondary btn-block mt-2" onClick="window.history.back();"><i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("Volver"); ?></button></div>
                <div class="col-5"><button type="submit" class="btn btn-primary btn-block mt-2" data-loading-text="Verificando..."><i class="fas fa-save"></i>&nbsp;&nbsp;<?php echo __("Guardar"); ?></button></div>
            </div>

        </div>
    </div>

</form>

<script type="application/javascript">
    var pavem=0;
    $(function(){

    $("#productos-agregando").submit(function(){
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