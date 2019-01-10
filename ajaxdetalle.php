<?php
include 'conexion.php';
$rs = $mysql->Execute('SELECT presentaciones.*,productos.nombre,productos.descripcion FROM presentaciones LEFT JOIN productos ON productos.id=presentaciones.producto_id WHERE productos.id=' . $_POST["id"]);
?>
<!-- Button to close the overlay navigation -->
<a href="javascript:void(0)" class="backbtn fa fa-arrow-left btn" onclick="closeDetail()"></a>

<!-- Overlay content -->

<div class="content_detalle">
    <div class="row">
        <div class="col-12 text-center img_detail">
            <img class="img-fluid" src="http://artesabio.com/admin/img/productos/<?php echo $rs->fields["producto_id"]; ?>prod.jpg" alt="<?php echo $rs->fields["nombre"]; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12 detail_p">
            <h5 class="producto_name"><?php echo $rs->fields["nombre"]; ?></h5>
            <p class="producto_description"><?php echo $rs->fields["descripcion"]; ?></p>
        </div>
        <div class="col-12 presentation">
            <p class="to_include">Presentación</p>
            <?php
            $inc = 0;
            while (!$rs->EOF) {
                if ($rs->fields["stock"] > 0) {
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" <?php if ($inc == 0) { ?> checked="checked" <?php } ?>  name="presentacion" id="presentacion<?php echo $rs->fields["id"]; ?>" value="<?php echo $rs->fields["id"]; ?>" onclick="mostrarprecio('<?php echo $rs->fields["precio"]; ?>')">
                        <label class="form-check-label" for="inlineRadio1"><?php echo $rs->fields["presentacion"]; ?>   </label><span class="disponible"><?php echo $rs->fields["stock"]; ?>und. disponibles</span>
                    </div>
                    <?php
                }
                $inc++;
                $rs->MoveNext();
            }
            $rs->Move(0);
            ?>

        </div>

        <div class="col-6">
            <div class="form-group"><input type="hidden" name="cantidad" id="cantidad" value="1">
                <!--<label for="exampleFormControlSelect1">Cantidad</label>
                <select class="form-control form-control-sm" name="cantidad" id="cantidad">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>-->
                <p class="luks">Precio</p>
                <h3 class="precio_prod" id="preciom">$<?php echo number_format($rs->fields["precio"], 0); ?></h3>
            </div>
        </div>
        <div class="col-12" id="botonancheta">
            <a href="#" onclick="anadirancheta()" class="btn btn-primary btn-block main_action">Añadir a mi ancheta</a>
        </div>
    </div>
</div>
