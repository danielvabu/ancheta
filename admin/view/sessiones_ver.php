<h4><?php echo __("Ver Pedido"); ?></h4>

<div class="row">
    <div class="col-8" itemscope itemtype="">


        <div class="row">
            <div class="col-5"><?php echo __("id"); ?></div>
            <div class="col-7"><?php echo $sale->fields["id"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Ip"); ?></div>
            <div class="col-7"><?php echo $sale->fields["ip"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Nombre"); ?></div>
            <div class="col-7"><?php echo $sale->fields["nombre"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Email"); ?></div>
            <div class="col-7"><?php echo $sale->fields["email"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Celular"); ?></div>
            <div class="col-7"><?php echo $sale->fields["celular"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Fechaentrega"); ?></div>
            <div class="col-7"><?php echo $sale->fields["fechaentrega"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Dirección"); ?></div>
            <div class="col-7"><?php echo $sale->fields["direccion"]; ?>	</div>
        </div>


        <div class="row">
            <div class="col-5"><?php echo __("Estado"); ?></div>
            <div class="col-7"><select name="estado" onchange="cambiarestado()" id="estado" class="form-control"><option value="0" <?php if ($sale->fields["estado"] == 0) { ?> selected=""<?php } ?>>Pendiente</option><option value="1" <?php if ($sale->fields["estado"] == 1) { ?> selected=""<?php } ?>>En transito</option><option value="2" <?php if ($sale->fields["estado"] == 2) { ?> selected=""<?php } ?>>Entregado</option></select></div>
        </div>

        <div class="table-responsive"><table border="0" id="tb_sale_ancheta" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                    <tr class="hidden">
                        <th align="left" valign="top"><?php echo __("Producto"); ?></th>
                        <th align="left" valign="top"><?php echo __("Presentacion"); ?></th>
                        <th align="left" valign="top"><?php echo __("Cantidad"); ?></th>
                        <th align="left" valign="top"><?php echo __("Total Precio"); ?></th>
                    </tr>
                </thead>
                <tbody><?php
                    $j = 1;
                    $preciototal = 0;
                    $i = 0;
                    while (!$saleancheta->EOF) {
                        ?>
                        <tr id="trtr<?php echo $saleancheta->fields["id"]; ?>" itemscope itemtype="">
                            <td align="left" valign="top"><?php echo $saleancheta->fields["nombre"]; ?></td>
                            <td align="left" valign="top"><?php echo $saleancheta->fields["presentacion"]; ?></td>
                            <td align="left" valign="top"><?php echo $saleancheta->fields["cantidad"]; ?></td>
                            <td align="left" valign="top"><?php echo number_format($saleancheta->fields["precio"], 0); ?></td>

                        </tr><?php
                        if ($j == 1) {
                            $j = 2;
                        } else {
                            $j = 1;
                        }
                        $preciototal = $preciototal + $saleancheta->fields["precio"];
                        $saleancheta->MoveNext();
                        $i++;
                    }$saleancheta->Move(0);
                    ?>
                </tbody></table></div>
        <div class="row">
            <div class="col-5"><?php echo __("Numero de Anchetas"); ?></div>
            <div class="col-7"><?php echo $sale->fields["numero"]; ?></div>
        </div>
        <div class="row">
            <div class="col-5"><?php echo __("Total"); ?></div>
            <div class="col-7"><?php echo number_format($preciototal * $sale->fields["numero"], 0); ?></div>
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
<script>
    function cambiarestado() {
        $.ajax({type: "POST", url: "<?php echo PATO; ?>sessiones/editando/<?php echo $this->valor[0] ?>", data: "estado=" + $("#estado").val(),

                    success: function(datos) {
                        alert("estado cambio con exito");
                        // window.location.reload(true);
                    }


                });


            }
</script>

