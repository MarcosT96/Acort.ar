# Acort.ar
Construye y protege su marca usando un poderoso y reconocible acortador de links.

==================

La API oficial desde [Acort.ar](https://acort.ar/)

## Ayuda a Contribuir
Envíenos pull requests y ayude a mejorar el código.

## Tu primera integracion
El siguiente ejemplo muestra cómo acortar una URL sin ningún otro parámetro. Debe obtener su clave API de la página de configuración del panel de control del usuario

```php
include("Acortador.php");

$Acortador = new acortar\Acortador();

// Establece la URL y la API Key
$Acortador->setURL("http://acort.ar/api");
$Acortador->setKey("APIKEY");

// Llamada simple
echo $Acortador->acortar("https://acort.ar");
```
## Obtener URL corta directamente
Para obtener la URL corta directamente sin tener que lidiar con json, puede encadenar el método toText() de la siguiente manera

```php
// Obtener URL corta directamente
echo $Acortador->toText()->acortar("https://acort.ar");
```

## Llamadas Avanzadas
Para personalizar la URL, puede usar lo siguiente para establecer un alias personalizado y el formato, que en este caso está en texto

```php
// Alias Personalizado
$Acortador->setCustom("acortar");

// Establecer Tipo: Frame, Splash, Direct
$Acortador->setType("frame");

// Establecer Contraseña
$Acortador->setPassword("123456");

// Format: text or json
$Acortador->setFormat("text");

echo $Acortador->acortar("https://acort.ar");
```
## Obtenga detalles o datos para una URL corta
Este ejemplo le permite acortar una URL y algunos datos

```php
var_dump($Acortador->details("acortar"));
```
## Obtenga todas sus URL en su cuenta
Este ejemplo le permite obtener todas sus URL en su cuenta. Tiene dos parámetros: ordenar [fecha o clic] y límite (número de URL)

```php
var_dump($Acortador->urls());
```
