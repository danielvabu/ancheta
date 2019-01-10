<?php

$version = explode(".", phpversion());
define("PHPVER", ($version[0] * 10000 + $version[1] * 100 + $version[2]));

if (preg_match("/artesabio.com/i", $_SERVER["HTTP_HOST"])) {
    define("MIURL", "http://artesabio.com/");
    define("MIURLS", "https://artesabio.com/");
    define("PATO", "/");
    define("PATU", "/");
} else {
    define("MIURL", "http://localhost");
    define("MIURLS", "https://localhost");
    define("PATO", "/basicosistema/");
    define("PATU", "/basicosistema/");
}

//   Varios
define("PERFIL", "usuarios");
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
define("RPP", 10);
define("JQUERY", "/basicosistema/js/jquery-3.3.1.min.js");
define("LOGO", "/basicosistema/img/logo.png");
define("PATA", ROOT_PATH . PATO);
define("TEMP", PATA . "73mp0r4l/");
define("IDIOMA", "esco"); // para ingles: enus, para español: esco
//	============Google============
//	https://developers.google.com/recaptcha/
define("GOOGLE_CLAVE_SITIO", "6LeCxBkUAAAAAKWjglj_jfcl9jA7YPyr_u8NpiX7");
define("GOOGLE_CLAVE_SECRETA", "6LeCxBkUAAAAAHASAfko4kADQl15U3qjCn6GFFhx");

// Variables reutilizables
define("TITULO", "artesabio.com");
define("SEOKEYWORDS", "programacion, php, javascript, sistemas de informacion, crestron, redes, wi-fi, domotica, electroica");
define("SSEOKEYWORD", "programacion, php, javascript, sistemas de informacion");
define("SEODESCRIPT", "ingenioSoft.com es una compañia internacional que esta a la banguardia de todas las tecnologias que estan cambiando el mundo.");
define("SSEODESCRIP", ", compañia internacional que esta a la banguardia de todas las tecnologias que estan cambiando el mundo.");
define("ADDTHIS", "ra-51d580223317c3a0");
define("FIRMA", "asdf1234");
define("YALE", "4321fdsa");
$uuid = uniqid();

// Datos de PagosOnLine
define("POL_PRUEBA", 1); // Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("POL_LLAVE", "10a477913d0");
define("POL_ID", "11400");
define("POL_MONEDA", "COP");

// Datos de PayPal
define("PP_PRUEBA", 1); // Configurar el pago en modo prueba 1, para quitar el modo prueba se deja en cero 0.
define("PP_BUSINESS", "jcjavier@yahoo.com");
define("PP_CURRENCY_CODE", "USD");
define("PP_ALT", "PayPal - La forma más segura y fácil de pagar en línea"); //PayPal - The safer, easier way to pay online
define("PP_NN", "wYgQT7n_j7HmNluCEmnmA7pl7jw3PYIYYxqETBrY5gwweJJJTBvdRxYC_7C");
//Utilice el siguiente código personal de identidad al configurar Transferencia de datos de pago en su sitio Web
// FaceBook
define("YOUR_APP_ID", "112958333830352");
define("YOUR_SECRET", "8437e356e0c307777f91b0e411251e8e");
define("FB_SCOPE", "public_profile,email,user_birthday,user_location,user_photos");

// Datos de Servidor de correo para envio de correos en general
define("MAIL_SERVER", "Dominio.com");
define("MAIL_PORT", "25");
define("MAIL_AUTH", 1);
define("MAIL_USER", "info@dominio.com");
define("MAIL_PASS", "asdf1234");
define("MAIL_MAIL", "info@dominio.com");
define("MAIL_NAME", "Dominio.com");
define("MAIL_LOGO", PATA . "/img/logo.jpg");
define("MAIL_LOGO_NAME", "logo.jpg");
