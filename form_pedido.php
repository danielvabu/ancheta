<?php
include 'conexion.php';
session_start();
$rsproductos = $mysql->Execute("SELECT presentaciones.id,presentaciones.precio,presentaciones.presentacion,ancheta.cantidad,productos.nombre FROM `ancheta` LEFT JOIN presentaciones ON (presentaciones.id=ancheta.presentacion_id) LEFT JOIN productos ON (productos.id=presentaciones.producto_id) WHERE ancheta.sessione_id='" . session_id() . "'");
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Anchetas artesanales</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datepicker.css" rel="stylesheet">


        <!-- Custom styles for this template -->
        <link href="css/thumbnail-gallery.css" rel="stylesheet">

        <!--fontawesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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

                <a href="index.php"><span class="fas fa-arrow-left"></span></a>

            </div>
        </nav>

        <!-- Page Content -->
        <div class="container pedido_cont">
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="resumenpedido">
                        <div class="card">
                            <div class="card-header header_resumen" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed btn_resumen" type="button" data-toggle="collapse" data-target="#resumen" aria-expanded="false" aria-controls="collapseTwo">
                                        Resumen de su pedido <i class="fas fa-plus"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="resumen" class="collapse" aria-labelledby="headingTwo" data-parent="#resumenpedido">
                                <div class="card-body resumen_list">
                                    <ul class="list-group list-group-flush">
                                        <?php while (!$rsproductos->EOF) { ?>
                                            <li class="list-group-item"><?php echo $rsproductos->fields["nombre"]; ?> <?php echo $rsproductos->fields["presentacion"]; ?> <?php echo $rsproductos->fields["cantidad"]; ?> </li>
                                            <?php
                                            $rsproductos->MoveNext();
                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><!--card-->
                </div><!--accordion-->
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-12">
                <p class="txt_pedido">Por favor diligencia todos los campos del formulario</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="Pedido_recibido.php" method="POST" id="formenvio">
                    <div class="form-row pedido">
                        <div class="col-12 campo_pedido">
                            <input type="text" name='nombre' class="form-control" placeholder="Nombre" required="">
                        </div>
                        <div class="col-12 campo_pedido">
                            <input type="text" name='email' class="form-control" placeholder="E-mail" required="">
                        </div>
                        <div class="col-12 campo_pedido">
                            <input type="text" name='celular' class="form-control" placeholder="Celular" required="">
                        </div>
                        <div class="col-12 campo_pedido">
                            <input type="text" name="fechaentrega" id="fechaentrega" class="form-control" placeholder="Fecha de entrega" required="">


                        </div>
                        <div class="col-12 campo_pedido">
                            <input type="text" name='direccion' class="form-control" placeholder="Dirección de entrega" required="">
                            <input type='hidden' value='1' name='fin'>
                            <small id="emailHelp" class="form-text text-muted msn_domicilio">El precio del envío corre por tu cuenta, te enviaremos el valor a tu correo electrónico una vez sepamos la dirección de entrega</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block main main_action">Enviar pedido</button>
                        <!-- <a class="btn btn-primary btn-block main main_action" href="#" onclick="enviarform()" role="button">Enviar pedido</a>-->
                    </div>
                </form>
            </div><!--col-->

        </div><!--Row-->

    </div><!--container-->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script>
            $('#fechaentrega').datepicker({format: 'yyyy-mm-dd'});
            function enviarform() {
                $("#formenvio").submit();
            }

    </script>
</body>

</html>
