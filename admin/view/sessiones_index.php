
<div>
    <h4><?php echo __("Pedidos"); ?> <span class="badge badge-primary"><?php
            if (isset($sale->_numOfRows)) {
                echo $sale->_numOfRows;
            } else {
                echo "0";
            }
            ?></span></h4>

    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">

            <form action="<?php echo PATO; ?>sessiones/filtrar/" method="post" name="sessiones-filtrar" id="sessiones-filtrar" class="form-inline navbar-text">
                <div class="form-group">

                    <input id="nombre" name="nombre" placeholder="<?php echo __("Nombre"); ?>" type="text" value="<?php
                    if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {
                        echo $_POST["nombre"];
                    }
                    ?>" class="form-control" /><input id="email" name="email" placeholder="<?php echo __("Email"); ?>" type="text" value="<?php
                           if (isset($_POST["email"]) && $_POST["email"] != "") {
                               echo $_POST["email"];
                           }
                           ?>" class="form-control" />
                    <button type="submit" class="btn btn-primary form-control"><i class="fas fa-search"></i> <?php echo __("Buscar"); ?></button>
                </div>

            </form>

        </div>
    </nav>

    <?php if ($sale->EOF) { ?><div class="row"><div class="col-12" align="left"><?php
        if ($msg == 1)
            echo __("No hay Sessiones");
        if ($msg == 2)
            echo __("Para ver resultados por favor filtre primero");
        ?></div></div><?php }else { ?>
        <div class="table-responsive"><table border="0" id="tb_sale_sessiones" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                    <tr class="hidden">
                        <th align="left" valign="top"><?php echo __("Nombre"); ?></th>
                        <th align="left" valign="top"><?php echo __("Email"); ?></th>
                        <th align="left" valign="top"><?php echo __("Celular"); ?></th>
                        <th align="left" valign="top"><?php echo __("Fecha de Entrega"); ?></th>
                        <th align="left" valign="top"><?php echo __("Estado"); ?></th>
                        <th class="acciones" align="center" width="130"><?php echo __("Acciones"); ?></th>
                    </tr>
                </thead>
                <tbody><?php
                    $j = 1;
                    $i = 0;
                    while (!$sale->EOF) {
                        ?>
                        <tr id="trtr<?php echo $sale->fields["id"]; ?>" itemscope itemtype="">
                            <td align="left" valign="top"><?php echo $sale->fields["nombre"]; ?></td>
                            <td align="left" valign="top"><?php echo $sale->fields["email"]; ?></td>
                            <td align="left" valign="top"><?php echo $sale->fields["celular"]; ?></td>
                            <td align="left" valign="top"><?php echo $sale->fields["fechaentrega"]; ?></td>
                            <td align="left" valign="top"><?php
                                if ($sale->fields["estado"] == 0) {
                                    echo "<div style='color:red'>Pendiente</div>";
                                }
                                ?><?php
                                if ($sale->fields["estado"] == 2) {
                                    echo "<div style='color:blue'>Entregado</div>";
                                }
                                ?><?php
                                if ($sale->fields["estado"] == 1) {
                                    echo "<div style='color:#d4d402'>En transito</div>";
                                }
                                ?></td>
                            <td align="center" valign="top">

                                <a href="<?php echo PATO; ?>sessiones/ver/<?php echo $sale->fields["id"]; ?>/" data-toggle="tooltip" title="<?php echo __("Ver"); ?>" class="btn btn-default"><i class="fas fa-eye"></i></a>


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
            $("#tb_sale_sessiones").tablesorter({headers: {2: {sorter: false}}, widgets: ["zebra"]});
            $("#tb_sale_sessiones").tablesorterPager({container:$(".pager2"),ajaxUrl:null,output:"{startRow} <?php echo __("a"); ?> {endRow} <?php echo __("de un total de"); ?> {totalRows}",updateArrows:true,page:0,size:<?php echo RPP; ?>,fixedHeight:false,removeRows:true,cssNext:".next",cssPrev:".prev",cssFirst:".first",cssLast:".last",cssPageDisplay:".pagedisplay",cssPageSize:".pagesize",cssDisabled:"disabled"});
            });
            function eliminarsessiones(a){
            confirma1('<?php echo iinterro() . __("Esta seguro de eliminar Session?"); ?>','<?php echo __("Si"); ?>','eliminandosessiones',a)}
            function eliminandosessiones(a){window.location.href = "<?php echo PATO; ?>sessiones/eliminar/"+a+"/";}
        </script><?php } ?>


</div>

