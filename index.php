<?php
include 'conexion.php';

function getRealIP() {

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}

session_start();
$verificarip = $mysql->Execute("select count(*) as numero from sessiones WHERE ip='" . getRealIP() . "'");
if ($verificarip->fields["numero"] > 0) {

} else {
    header("location: pre_home.html");
}

$verificarsession = $mysql->Execute("select count(*) as numero from sessiones WHERE session_id='" . session_id() . "'");
if ($verificarsession->fields["numero"] > 0) {

} else {

    $mysql->Execute("INSERT INTO sessiones (id,session_id, ip)VALUES ('','" . session_id() . "', '" . getRealIP() . "')");
    // echo "INSERT INTO sessiones (id,sessione_id, ip)VALUES ('','" . session_id() . "', '" . getRealIP() . "')";
}


$rstotal = $mysql->Execute("select count(*) as numero from ancheta WHERE sessione_id='" . session_id() . "'");
$rsproductos = $mysql->Execute("SELECT presentaciones.id,presentaciones.precio,presentaciones.presentacion,ancheta.cantidad,productos.nombre FROM `ancheta` LEFT JOIN presentaciones ON (presentaciones.id=ancheta.presentacion_id) LEFT JOIN productos ON (productos.id=presentaciones.producto_id) WHERE ancheta.sessione_id='" . session_id() . "'");
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Anchetas</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/thumbnail-gallery.css" rel="stylesheet">

        <!--fuentes-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Serif|Open+Sans" rel="stylesheet">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130789742-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-130789742-1');
        </script>
    </head>

    <body>

        <div class="big_screen"></div>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mi_navegacion">
            <div class="container">
                <button type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-question-circle"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="pre_home.html">¿Cómo funciona?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Contacto.html">Contáctanos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <p class="my-4 text-center text-lg-left text_intro_2">Preparados de manera natural con mucha dedicación y amor</p>

            <div class="row">
                <?php
                $rs = $mysql->Execute('select * from productos WHERE estado=1 ORDER BY vitrina');
// echo $rs->fields["numero"];
                while (!$rs->EOF) {
                    ?>
                    <div class="col-6">
                        <img class="img-fluid" src="http://artesabio.com/admin/img/productos/<?php echo $rs->fields["id"]; ?>prod.jpg" alt="" onclick="openDetail(<?php echo $rs->fields["id"]; ?>)">
                        <p class="name_prod"><?php echo $rs->fields["nombre"]; ?></p>
                    </div>
                    <?php
                    $rs->MoveNext();
                }
                ?>
            </div><!--Row-->

        </div><!--container-->
        <!-- /.container -->
        <div class="container">
            <div class="row">
                <div class="col-12 fixed-bottom btn_miancheta">
                    <button type="button" class="btn btn-primary btn-block main_action" onclick="openNav()">Mi Ancheta
                        <span class="badge badge-light" id="numerocantidadprod"> <?php echo $rstotal->fields["numero"]; ?></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="myNav" class="overlay">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fas fa-times"></i></a>
                        <h3 class="head_ancheta">Mi Ancheta</h3>
                        <div class="overlay-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="msn">
                                        <p class="msn_4prod" id="min4" style="display:none">Tienes que poner almenos cuatro productos en tu ancheta para realizar el pedido</p>
                                        <p class="msn_4prod" id="minprod">Aun no has agregado productos a tu ancheta</p>

                                    </div><!--mensajes al usuario-->
                                    <ul class="list-group list-group-flush products_in list_go">
                                        <?php
                                        $sumatotal = 0;
                                        $cantidadprod = 0;
                                        while (!$rsproductos->EOF) {
                                            ?>
                                            <li id="prod<?php echo $rsproductos->fields["id"]; ?>" class="list-group-item"><span class="cuantos">(<?php echo $rsproductos->fields["cantidad"]; ?>) </span><?php echo $rsproductos->fields["nombre"]; ?> <?php echo $rsproductos->fields["presentacion"]; ?> <span class="quit_list" aria-hidden="true" onclick="borrar(<?php echo $rsproductos->fields["id"]; ?>, '<?php echo $rsproductos->fields["precio"]; ?>');">&times;</span></li>
                                            <?php
                                            $cantidadprod++;
                                            $sumatotal = $sumatotal + $rsproductos->fields["precio"] * $rsproductos->fields["cantidad"];
                                            $rsproductos->MoveNext();
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div><!--overlay-content-->
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group n-ancheta">
                                    <label for="exampleFormControlSelect1">Nº de anchetas<input type="hidden" name="sumatotal" id="sumatotal" value="<?php echo $sumatotal; ?>"></label>
                                    <select class="form-control form-control-sm" id="numeroanchetas" onchange="cambiarnumeroanch()">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-7">
                                <p class="text-left">Precio de ancheta</p>
                                <h3 id="totalsuma1">$<?php echo number_format($sumatotal, 2) ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            <a class="btn btn-primary btn-block main_action"  <?php if ($cantidadprod < 4) { ?>onclick="javascript:alert('Tienes que poner almenos cuatro productos en tu ancheta para realizar el pedido');return false;" <?php } ?> href="form_pedido.php" role="button">Hacer pedido</a>
                        </div>
                    </div><!--mynav-->
                </div><!--col-->
            </div><!--row-->
        </div><!--container-->

        <!-- Footer -->
        <footer class="py-5 bg_grey">
            <div class="container">
                <p class="m-0 text-center">Al elegirlos apoyas diferentes emprendimientos y empoderamientos femeninos y humanos.</p>
            </div>
            <!-- /.container -->
        </footer>

        <!-- Detalle de producto -->
        <div class="container">
            <div class="row">
                <div id="detalle" class="overlay_detalle">



                </div>
            </div>
        </div>

        <!-- Detalle de producto -->

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!--Open mi ancheta-->

        <script>
                                if (<?php echo $cantidadprod; ?> > 0) {
                                    $("#minprod").hide();
                                    $("#min4").show();

                                }
                                if (<?php echo $cantidadprod; ?> > 3) {
                                    $("#min4").hide();

                                }
                                function openNav() {
                                    document.getElementById("myNav").style.height = "100%";
                                }

                                function closeNav() {
                                    document.getElementById("myNav").style.height = "0%";
                                }

                                /* Open when someone clicks on the span element */
                                function openDetail(id) {

                                    $.ajax({type: "POST", url: "http://artesabio.com/ajaxdetalle.php", data: "id=" + id,

                                        success: function(datos) {
                                            //  window.location.reload(true);
                                            //   location.href = '../'+datos;
                                            $("#detalle").html(datos);
                                            document.getElementById("detalle").style.width = "100%";
                                        }


                                    });



                                }

                                function anadirancheta() {
                                    $.ajax({type: "POST", url: "http://artesabio.com/ajaxanchetaadd.php", data: "presentacion=" + $('input:radio[name=presentacion]:checked').val() + "&cantidad=" + $("#cantidad").val(),

                                        success: function(datos) {
                                            window.location.reload(true);
                                        }


                                    });


                                }

                                function cambiarnumeroanch() {

                                    $.ajax({type: "POST", url: "http://artesabio.com/ajaxanchetaduplicar.php", data: "numero=" + $('#numeroanchetas').val(),

                                        success: function(datos) {
                                            val1 = $("#sumatotal").val() * $('#numeroanchetas').val();

                                            $("#totalsuma1").html("$" + number_format(val1, 0));

                                            // window.location.reload(true);
                                        }


                                    });
                                }

                                /* Close when someone clicks on the "x" symbol inside the overlay */
                                function closeDetail() {
                                    document.getElementById("detalle").style.width = "0%";
                                }
                                function number_format(amount, decimals) {

                                    amount += ''; // por si pasan un numero en vez de un string
                                    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

                                    decimals = decimals || 0; // por si la variable no fue fue pasada

                                    // si no es un numero o es igual a cero retorno el mismo cero
                                    if (isNaN(amount) || amount === 0)
                                        return parseFloat(0).toFixed(decimals);

                                    // si es mayor o menor que cero retorno el valor formateado como numero
                                    amount = '' + amount.toFixed(decimals);

                                    var amount_parts = amount.split('.'),
                                            regexp = /(\d+)(\d{3})/;

                                    while (regexp.test(amount_parts[0]))
                                        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

                                    return amount_parts.join('.');
                                }

                                function mostrarprecio(precio) {

                                    $("#preciom").html("$" + number_format(precio, 0));


                                }
                                function borrar(id, precio) {

                                    $.ajax({type: "POST", url: "http://artesabio.com/ajaxanchetaborrar.php", data: "id=" + id,

                                        success: function(datos) {
                                            val1 = $("#sumatotal").val() - precio;

                                            $("#totalsuma1").html("$" + number_format(val1, 0));
                                            $("#sumatotal").val(val1);
                                            $("#numerocantidadprod").html(<?php echo $rstotal->fields["numero"] - 1; ?>);
                                            $("#prod" + id).remove();
                                            // window.location.reload(true);
                                        }


                                    });
                                }

        </script>

    </body>

</html>
