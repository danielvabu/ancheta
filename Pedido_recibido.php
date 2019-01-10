<?php
include 'conexion.php';
session_start();
$mysql->Execute("UPDATE sessiones set nombre='" . $_POST["nombre"] . "',email='" . $_POST["email"] . "',celular='" . $_POST["celular"] . "',fechaentrega='" . $_POST["fechaentrega"] . "',direccion='" . $_POST["direccion"] . "',fin=1 WHERE session_id='" . session_id() . "'");
$rsproductos = $mysql->Execute("SELECT presentaciones.id,presentaciones.precio,presentaciones.presentacion,ancheta.cantidad,productos.nombre FROM `ancheta` LEFT JOIN presentaciones ON (presentaciones.id=ancheta.presentacion_id) LEFT JOIN productos ON (productos.id=presentaciones.producto_id) WHERE ancheta.sessione_id='" . session_id() . "'");
$htmlprod = '<ul>';

while (!$rsproductos->EOF) {

    $htmlprod .= '<li>' . $rsproductos->fields["nombre"] . ' ' . $rsproductos->fields["presentacion"] . ' ' . $rsproductos->fields["cantidad"];
    $htmlprod .= '</li>';
    $rsproductos->MoveNext();
}
$htmlprod .= '</ul>';

session_regenerate_id();

$html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>[SUBJECT]</title>
  <style type='text/css'>
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1,ul,ol,li,div{
  margin:0;
  padding:0;
}

td,table{
  vertical-align: top;
}
td.middle{
  vertical-align: middle;
}

a.link1{
  color:#D0021B;
  text-decoration:none;
}

.link2{
font-size:13px;
color:#999999;
text-decoration:none;
line-height:19px;
}

@media only screen and (max-width:480px)

{

table[class='MainContainer'], td[class='cell']
	{
		width: 100% !important;
		height:auto !important;
	}
td[class='specbundle']
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:15px !important;
	}
td[class='specbundle2']
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-bottom:10px !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}

td[class='spechide']
	{
		display:none !important;
	}
	    img[class='banner']
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad']
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}

}

@media only screen and (max-width:540px)

{

table[class='MainContainer'], td[class='cell']
	{
		width: 100% !important;
		height:auto !important;
	}
td[class='specbundle']
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:15px !important;
	}
td[class='specbundle2']
	{
		width:90% !important;
		float:left !important;
		font-size:14px !important;
		line-height:18px !important;
		display:block !important;
		padding-bottom:10px !important;
		padding-left:5% !important;
		padding-right:5% !important;
	}

td[class='spechide']
	{
		display:none !important;
	}
	    img[class='banner']
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class='left_pad']
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}

}


</style>

</head>
<body paddingwidth='0' paddingheight='0' bgcolor='#d1d3d4'  style='padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
  <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent' align='center' bgcolor='#4d4545' style='font-family:helvetica, sans-serif;'>
    <!-- ================ header=============== -->
  <tbody>
    <tr>
      <td><table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='MainContainer'>

      <!-- END HEAD -->

          <!-- BODY -->
  <tbody>
    <tr>
      <td class='movableContentContainer'><div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                      <td bgcolor='#B57801'>
                        <div class='contentEditableContainer contentImageEditable'>
                      <div class='contentEditable' >
                        <img class='banner' src='http://artesabio.com/img/bigImg.jpg' data-default='placeholder' data-max-width='600' width='600' height='292' alt='Happy Christmas!' border='0'>
                      </div>
                    </div>
                      </td>
                    </tr>
                </table>
      </div>
        <div class='movableContent' style='border: 0px; padding-top: 0px; position: relative;'>
        	<table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#FFF'>
                  <tr><td height='55' colspan='3'></td></tr>
                  <tr>
                    <td width='125'></td>
                    <td>
                      <table width='350' border='0' cellspacing='0' cellpadding='0'>
                        <tr>
                          <td>
                            <div class='contentEditableContainer contentTextEditable'>
                              <div style='font-family:Georgia;font-size:36px;color:#D0021B;text-align:center;' class='contentEditable' >
                                <p >¡Hola!</p>
                                <p >" . $_POST["nombre"] . " hemos recibido tu pedido</p>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr><td height='25'></td></tr>
                        <tr>
                          <td>
                            <div class='contentEditableContainer contentTextEditable'>
                              <div style='font-family:Georgia;font-size:15px;color:#D0021B;line-height:17px;text-align:center;' class='contentEditable' >
                                <p >Gracias por apoyar el esfuerzo de productores artesanales en estas fechas.
                                  <br>
                                  <br>
                                  Pronto nos comunicaremos contigo a través de whatsapp para ultimar detalles respecto de la entrega y forma de pago.
                                  <br>
                                  <br>
                                  Para cualquier información adicional contáctanos:</p>
                                <p >Carolina López</p> <a href='https://wa.me/573053693525'>3053693525</a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td width='125'></td>
                    </tr>
                    <tr><td height='55' colspan='3'></td></tr>
                  </table>
        </div>
        <!-- END BODY --></td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
  </body>
  </html>";

$html2 = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns = 'http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv = 'Content-Type' content = 'text/html; charset=utf-8' />
<title>[SUBJECT]</title>
<style type = 'text/css'>
body {
padding-top: 0!important;
padding-bottom: 0!important;
padding-top: 0!important;
padding-bottom: 0!important;
margin:0!important;
width: 100%!important;
-webkit-text-size-adjust: 100%!important;
-ms-text-size-adjust: 100%!important;
-webkit-font-smoothing: antialiased!important;
}
.tableContent img {
border: 0!important;
display: block!important;
outline: none!important;
}
a{
color:#382F2E;
}

p, h1, ul, ol, li, div{
margin:0;
padding:0;
}

td, table{
vertical-align: top;
}
td.middle{
vertical-align: middle;
}

a.link1{
color:#D0021B;
text-decoration:none;
}

.link2{
font-size:13px;
color:#999999;
text-decoration:none;
line-height:19px;
}

@media only screen and (max-width:480px)

{

table[class = 'MainContainer'], td[class = 'cell']
{
width: 100%!important;
height:auto!important;
}
td[class = 'specbundle']
{
width: 100%!important;
float:left!important;
font-size:13px!important;
line-height:17px!important;
display:block!important;
padding-bottom:15px!important;
}
td[class = 'specbundle2']
{
width:90%!important;
float:left!important;
font-size:14px!important;
line-height:18px!important;
display:block!important;
padding-bottom:10px!important;
padding-left:5%!important;
padding-right:5%!important;
}

td[class = 'spechide']
{
display:none!important;
}
img[class = 'banner']
{
width: 100%!important;
height: auto!important;
}
td[class = 'left_pad']
{
padding-left:15px!important;
padding-right:15px!important;
}

}

@media only screen and (max-width:540px)

{

table[class = 'MainContainer'], td[class = 'cell']
{
width: 100%!important;
height:auto!important;
}
td[class = 'specbundle']
{
width: 100%!important;
float:left!important;
font-size:13px!important;
line-height:17px!important;
display:block!important;
padding-bottom:15px!important;
}
td[class = 'specbundle2']
{
width:90%!important;
float:left!important;
font-size:14px!important;
line-height:18px!important;
display:block!important;
padding-bottom:10px!important;
padding-left:5%!important;
padding-right:5%!important;
}

td[class = 'spechide']
{
display:none!important;
}
img[class = 'banner']
{
width: 100%!important;
height: auto!important;
}
td[class = 'left_pad']
{
padding-left:15px!important;
padding-right:15px!important;
}

}


</style>

</head>
<body paddingwidth = '0' paddingheight = '0' bgcolor = '#d1d3d4' style = 'padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset = '0' toppadding = '0' leftpadding = '0'>
<table width = '100%' border = '0' cellspacing = '0' cellpadding = '0' class = 'tableContent' align = 'center' bgcolor = '#4d4545' style = 'font-family:helvetica, sans-serif;'>
<!-- === === === === === = header === === === === === -->
<tbody>
<tr>
<td><table width = '600' border = '0' cellspacing = '0' cellpadding = '0' align = 'center' class = 'MainContainer'>

<!--END HEAD -->

<!--BODY -->
<tbody>
<tr>
<td class = 'movableContentContainer'><div class = 'movableContent' style = 'border: 0px; padding-top: 0px; position: relative;'>
<table width = '100%' border = '0' cellspacing = '0' cellpadding = '0'>
<td bgcolor = '#B57801'>
<div class = 'contentEditableContainer contentImageEditable'>
<div class = 'contentEditable' >
<img class = 'banner' src = 'http://artesabio.com/img/bigImg.jpg' data-default = 'placeholder' data-max-width = '600' width = '600' height = '292' alt = 'Happy Christmas!' border = '0'>
</div>
</div>
</td>
</tr>
</table>
</div>
<div class = 'movableContent' style = 'border: 0px; padding-top: 0px; position: relative;'>
<table width = '100%' border = '0' cellspacing = '0' cellpadding = '0' bgcolor = '#FFF'>
<tr><td height = '55' colspan = '3'></td></tr>
<tr>
<td width = '125'></td>
<td>
<table width = '350' border = '0' cellspacing = '0' cellpadding = '0'>
<tr>
<td>
<div class = 'contentEditableContainer contentTextEditable'>
<div style = 'font-family:Georgia;font-size:36px;color:#D0021B;text-align:center;' class = 'contentEditable' >
<p >Nuevo pedido:</p>

</div>
</div>
</td>
</tr>
<tr><td height = '25'></td></tr>
<tr>
<td>
<div class = 'contentEditableContainer contentTextEditable'>
<div style = 'font-family:Georgia;font-size:15px;color:#D0021B;line-height:17px;text-align:center;' class = 'contentEditable' >
<p >Nombre: " . $_POST["nombre"] . " <br>
<br>
Email: " . $_POST["email"] . " <br> <br>
<br>
Celular: " . $_POST["celular"] . " <br> <br>
<br>
Fecha de entrega: " . $_POST["fechaentrega"] . " <br> <br>
<br>
Direccion: " . $_POST["direccion"] . " <br> <br>
<br>
<br>




</p>
" . $htmlprod . "
</div>
</div>
</td>
</tr>
</table>
</td>
<td width = '125'></td>
</tr>
<tr><td height = '55' colspan = '3'></td></tr>
</table>
</div>
<!--END BODY --></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</body>
</html>";

$correo_destinatario = $_POST["email"];
$nombre_remitente = "info@artesabio.com";
$correo_remitente = "info@artesabio.com";
$asunto = "hemos recibido tu pedido";
$mensaje = $html;

$headers = "From: " . $nombre_remitente . "\r\n" . "Reply-To: " . $correo_remitente . "\r\n" . "X-Mailer: PHP/" . phpversion();

function mailutf8($correo_destinatario, $asunto, $mensaje = "", $header = "") {
    $header_on = "MIME-Version: 1.0" . "\r\n" . "Content-type: text/html; charset=UTF-8" . "\r\n";
    if (mail($correo_destinatario, "=?UTF-8?B?" . base64_encode($asunto) . "?=", $mensaje, $header_on . $header)) {
        //  echo "Mensaje enviado";
    } else {
        echo "Error en el envío";
    }
}

mailutf8($correo_destinatario, $asunto, $mensaje, $headers);
mailutf8('danielvabu2015@gmail.com,digchavez@gmail.com,calomi323@gmail.com', 'nuevo pedido', $html2, $headers);
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

    <body class="fin_preceso">

        <div class="big_screen"></div>

        <!-- Page Content -->
        <div class="container fin">
            <div class="row">
                <div class="col-12 text-center mensaje_pedido">
                    <h3 class="great">¡Hemos recibido tu pedido!</h3>
                    <p class="great_P">Te enviaremos un mensaje a tu correo electrónico para contarte mas detalles.</p>
                    <a class="btn btn-primary btn-block main_action" href="index.php" role="button">Hacer un nuevo pedido</a>
                </div>
            </div>

        </div>
        <!-- Page Content -->

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
