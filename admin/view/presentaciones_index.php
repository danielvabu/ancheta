
<div>
    <h4><?php echo __("Presentaciónes"); ?> <span class="badge badge-primary"><?php
            if (isset($sale->_numOfRows)) {
                echo $sale->_numOfRows;
            } else {
                echo "0";
            }
            ?></span></h4>

    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">

            <form action="<?php echo PATO; ?>presentaciones/filtrar/" method="post" name="presentaciones-filtrar" id="presentaciones-filtrar" class="form-inline navbar-text">
                <div class="form-group">

                    <select name="producto_id" id="producto_id" class="custom-select">
                        <option value="0"<?php if (isset($_POST["producto_id"]) && !$_POST["producto_id"]) { ?> selected="selected"<?php } ?>><?php echo __("Producto"); ?></option><optgroup label="Activos"><?php
                            if (!$productos->EOF) {
                                while (!$productos->EOF) {
                                    if ($productos->fields["estado"]) {
                                        ?>
                                        <option value="<?php echo $productos->fields["id"]; ?>"<?php if (isset($_POST["producto_id"]) && $productos->fields["id"] == $_POST["producto_id"]) { ?> selected="selected"<?php } ?>><?php echo $productos->fields["nombre"]; ?></option><?php
                                    }$productos->MoveNext();
                                }
                                $productos->Move(0);
                            }
                            ?>
                        </optgroup><optgroup label="Inactivos"><?php
                            if (!$productos->EOF) {
                                while (!$productos->EOF) {
                                    if (!$productos->fields["estado"]) {
                                        ?>
                                        <option value="<?php echo $productos->fields["id"]; ?>"<?php if (isset($_POST["producto_id"]) && $productos->fields["id"] == $_POST["producto_id"]) { ?> selected="selected"<?php } ?>><?php echo $productos->fields["nombre"]; ?></option><?php
                                    }$productos->MoveNext();
                                }
                                $productos->Move(0);
                            }
                            ?>
                        </optgroup></select>
                    <button type="submit" class="btn btn-primary form-control"><i class="fas fa-search"></i> <?php echo __("Buscar"); ?></button>
                </div>

            </form>

        </div>
    </nav>

    <?php if ($sale->EOF) { ?><div class="row"><div class="col-12" align="left"><?php
        if ($msg == 1)
            echo __("No hay Presentaciónes");
        if ($msg == 2)
            echo __("Para ver resultados por favor filtre primero");
        ?></div></div><?php }else { ?>
        <div class="table-responsive"><table border="0" id="tb_sale_presentaciones" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                    <tr class="hidden">
                        <th align="left" valign="top"><?php echo __("Producto"); ?></th>
                        <th align="left" valign="top"><?php echo __("Presentacion"); ?></th>
                        <th align="left" valign="top"><?php echo __("Precio"); ?></th>
                        <th align="left" valign="top"><?php echo __("Stock"); ?></th>
                        <th class="acciones" align="center" width="130"><?php echo __("Acciones"); ?></th>
                    </tr>
                </thead>
                <tbody><?php
                    $j = 1;
                    $i = 0;
                    while (!$sale->EOF) {
                        ?>
                        <tr id="trtr<?php echo $sale->fields["id"]; ?>" itemscope itemtype="">
                            <td align="left" valign="top"><?php echo $sale->fields["productos_nombre"]; ?></td>
                            <td align="left" valign="top"><?php echo $sale->fields["presentacion"]; ?></td>
                            <td align="left" valign="top"><?php echo $sale->fields["precio"]; ?></td>
                            <td align="left" valign="top"><?php echo $sale->fields["stock"]; ?></td>


                            <td align="center" valign="top">

                                <a href="<?php echo PATO; ?>presentaciones/ver/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Ver"); ?>" class="btn btn-default"><i class="fas fa-eye"></i></a>

                                <a href="<?php echo PATO; ?>presentaciones/editar/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Editar"); ?>" class="btn btn-default"><i class="fas fa-edit"></i></a>

                                <a href="JavaScript:;" onClick="eliminarpresentaciones(<?php echo $sale->fields["id"]; ?>)" data-toggle="tooltip" title="<?php echo __("Eliminar"); ?>" class="btn btn-default"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr><?php
                        if ($j == 1) {
                            $j = 2;
                        } else {
                            $j = 1;
                        }$sale->MoveNext();
                        $i++;
                    }$sale->Move(0);
                    ?>
                </tbody></table></div>


        <div id="pager2" class="pager2 my-2 mx-0">
            <form class="form-inline">
                <div class="btn-group">
                    <button type="button" class="btn btn-default first"><i class="fas fa-fast-backward"></i></button>
                    <button type="button" class="btn btn-default prev"><i class="fas fa-backward"></i></button>
                    <button type="button" class="btn btn-default"><span class="pagedisplay">&nbsp;</span></button>
                    <button type="button" class="btn btn-default next"><i class="fas fa-forward"></i></button>
                    <button type="button" class="btn btn-default last"><i class="fas fa-fast-forward"></i></button>
                </div>
                <div class="form-group" data-placement="right" data-toggle="tooltip" title="<?php echo __("Registros por pagina"); ?>"><select id="rpp" class="custom-select pagesize"><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="100">100</option>
                    </select></div>
            </form>
        </div>

        <script type="application/javascript">
            $(function(){
            $("#rpp").val(<?php echo RPP; ?>);
            $("#tb_sale_presentaciones").tablesorter({headers: {1: {sorter: false}}, widgets: ["zebra"]});
            $("#tb_sale_presentaciones").tablesorterPager({container:$(".pager2"),ajaxUrl:null,output:"{startRow} <?php echo __("a"); ?> {endRow} <?php echo __("de un total de"); ?> {totalRows}",updateArrows:true,page:0,size:<?php echo RPP; ?>,fixedHeight:false,removeRows:true,cssNext:".next",cssPrev:".prev",cssFirst:".first",cssLast:".last",cssPageDisplay:".pagedisplay",cssPageSize:".pagesize",cssDisabled:"disabled"});
            });
            function eliminarpresentaciones(a){
            confirma1('<?php echo iinterro() . __("Esta seguro de eliminar Presentacion?"); ?>','<?php echo __("Si"); ?>','eliminandopresentaciones',a)}
            function eliminandopresentaciones(a){window.location.href = "<?php echo PATO; ?>presentaciones/eliminar/"+a+"/";}
        </script><?php } ?>

    <form class="form-inline">

        <div class="form-group"><button type="button" class="btn btn-primary form-control" onClick="location.href = '<?php echo PATO; ?>presentaciones/agregar/';"><i class="fas fa-plus"></i>&nbsp;&nbsp;<?php echo __("Nuevo"); ?></button></div>

        <div class="form-group"><button type="button" class="btn btn-primary form-control" onClick="location.href = '<?php echo PATO; ?>';"><i class="fas fa-home"></i>&nbsp;&nbsp;<?php echo __("Inicio"); ?></button></div>

    </form>
</div>

