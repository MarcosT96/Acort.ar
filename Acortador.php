<?php 
/**
 * @package AcortarLinks
 * @author Acortar (https://acort.ar)
 * @copyright 2020 Acortar
 * @license https://acort.ar/page/terms
 * @link https://acort.ar
 * @since 1.0
 */

namespace acortar;

class Acortador{
	/**
	 * API Key
	 * @var null
	 */
	protected $key = NULL;
	/**
	 * API URL
	 * @var null
	 */
	protected $url = NULL;
	/**
	 * Alias Personalizado
	 * @var null
	 */
	protected $custom = NULL;
	/**
	 * Tipo Personalizado
	 * @var null
	 */
	protected $tipo = NULL;
	/**
	 * Contraseña Variable
	 * @var null
	 */
	protected $pass = NULL;
	/**
	 * Formato: json o texto
	 * @var [tipo]
	 */
	protected $format = "json";
	/**
	 * Obtener directamente URL
	 * @var boolean
	 */
	protected $getShort = FALSE;

	/**
	 * [__construct descripcion]
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 */
	public function __construct(){}
	/**
	 * Establecer API URL
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $url The URL to the API
	 * @example http://mysite.com/api The URL to the API without trailing slash
	 */
	public function setURL(string $url){
		$this->url = rtrim($url, "/");		
	}
	/**
	 * Establecer API key
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $key Su API Key
	 */
	public function setKey(string $key){
		$this->key = trim($key);	
	}
	/**
	 * Alias Personalizado
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $alias [descripcion]
	 */
	public function setCustom(string $alias){
		$this->custom = trim($alias);	
	}
	/**
	 * Establecer Tipo
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $tipo [descripcion]
	 */
	public function setType(string $tipo){
		$this->tipo = trim($tipo);	
	}
	/**
	 * Establecer Contraseña
	 * @author Acortar <https://acort.ar>
	 * @version 1.1
	 * @param   string $password [descripcion]
	 */
	public function setPassword(string $password){
		$this->password = trim($password);	
	}	
	/**
	 * Respuesta a Formato
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $alias [descripcion]
	 */
	public function setFormat(string $format){
		if(in_array($format, ["text","json"])){
			$this->format = trim($format);	
		}
	}	
	/**
	 * Obtener URL directamente
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @return  [tipo] [descripcion]
	 */
	public function toText(){
		$this->getShort = TRUE;
		return $this;
	}
	/**
	 * Solicitar acortar
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $url [descripcion]
	 * @return  [tipo]      [descripcion]
	 */
	public function acortar(string $url){
		$url = trim($url);

		// Validar URL
		if(!filter_var($url,FILTER_VALIDATE_URL)) die(json_encode(["error" => "1", "msg" => "Ingrese una URL valida."]));

		$url = urlencode($url);

		$apicall = "{$this->url}?key={$this->key}&url={$url}";

		if(!is_null($this->custom)){
			$apicall .= "&custom={$this->custom}";
		}

		if(!is_null($this->tipo)){
			$apicall .= "&tipo={$this->tipo}";
		}

		if(!is_null($this->password)){
			$apicall .= "&pass={$this->password}";
		}

		if($this->format != "json"){
			$apicall .= "&format={$this->format}";
		}
		
		$Response = $this->http($apicall);

		if($this->getShort && $this->format == "json"){
			$reponse_decoded = json_decode($Response);
			if(isset($reponse_decoded->short)){
				return $reponse_decoded->short;
			}
		}

		return $Response;
	}
	/**
	 * Detalles y Estadisticas de URL
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $alias [descripcion]
	 * @return  [tipo]        [descripcion]
	 */
	public function details(string $alias){
		
		if(empty($alias)) die(json_encode(["error" => "1", "msg" => "Ingrese un alias valido."]));

		$apicall = "{$this->url}/details?key={$this->key}&alias={$alias}";

		$Response = $this->http($apicall);

		$reponse_decoded = json_decode($Response);

		return $reponse_decoded;		
	}

	/**
	 * Obtener todas las URLs desde tu Cuenta
	 * @author Acortar <https://acort.ar>
	 * @version 1.1
	 * @return  [tipo] [descripcion]
	 */
	public function urls($order = "date", $limit = NULL){		

		$apicall = "{$this->url}/urls?key={$this->key}";

		if($order != "date") $apicall .= $apicall."&order={$order}";
		if($limit) $apicall .= $apicall."&limit={$limit}";

		$Response = $this->http($apicall);

		$reponse_decoded = json_decode($Response);

		return $reponse_decoded;		
	}
	/**
	 * Hacer un request Call
	 * @author Acortar <https://acort.ar>
	 * @version 1.0
	 * @param   string $url
	 * @return  string 
	 */
  private function http(string $url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
  }

}
