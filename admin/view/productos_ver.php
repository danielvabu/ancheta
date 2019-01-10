<h4><?php echo __("Ver productos"); ?></h4>

<div class="row">
    <div class="col-8" itemscope itemtype="">


        <div class="row">
            <div class="col-5"><?php echo __("id"); ?></div>
            <div class="col-7"><?php echo $sale->fields["id"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Nombre"); ?></div>
            <div class="col-7"><?php echo $sale->fields["nombre"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Descripción"); ?></div>
            <div class="col-7"><?php echo $sale->fields["descripcion"]; ?>	</div>
        </div>




        <div class="row">
            <div class="col-5"><?php echo __("Vitrina"); ?></div>
            <div class="col-7"><?php
                echo $sale->fields["vitrina"];
                ?>	</div>
        </div>
        <img class="img-thumbnail" src="http://artesabio.com/admin/img/productos/<?php echo $this->valor[0]; ?>prod.jpg"  alt="Foto">


        <div class="form-group">
            <div class="col-5">&nbsp;</div>
            <div class="col-7"><button type="button" class="btn btn-primary btn-block mt-2" onClick="window.history.back();">
                    <i class="fas fa-chevron-left"></i>&nbsp;&nbsp;<?php echo __("volver"); ?>
                </button></div>
        </div>

    </div>
    <div class="col-4">&nbsp;</div>
</div>

