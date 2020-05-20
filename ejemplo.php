<?php
/**
 * Incluir la clase principal
 */
include("Acortador.php");
/**
 * Instanciarlo
 * @var acortar
 */
$Acortador = new acortar\Acortador();
/**
 * Establece la URL y la API Key
 */
$Acortador->setURL("https://acort.ar/api");
$Acortador->setKey("Fgvsld81Hvex");
/**
 * Llamada simple
 */
echo $Acortador->acortar("https://acort.ar");

/**
 * Obtner URL acortada directamente
 */
echo $Acortador->toText()->acortar("https://gempixel.com");

/**
 * Llamadas avanzandas
 */
// Alias Personalizado
$Acortador->setCustom("acortar");

// Establecer Tipo: Direct, Splash o Frame
$Acortador->setType("direct");

// Establecer Contraseña
$Acortador->setPassword("123456");

// Formato: text o json
$Acortador->setFormat("text");

echo $Acortador->acortar("https://acort.ar");


/**
 * Obtener detalles y estadisticas
 */

var_dump($Acortador->details("acortar"));

/**
 * Obtener todas tus URLs
 * @param string $sort Organiza tus URLs entre "date" o "click" (opcional - por defecto = date)
 * @param integer $limit Limita el numero de URLs
 */
var_dump($Acortador->urls());
