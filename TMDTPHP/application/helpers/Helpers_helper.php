<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * Function Name
	 *
	 * Function description
	 *
	 * @access	public
	 * @param	type	name
	 * @return	type	
	 */
	 
	if ( ! function_exists('checkAuth')) {
		function checkAuth()
		{
			$ci = &get_instance();
			
      		$ci->load->library('session');
      		
			return $ci->session->has_userdata('username');
		}
	}
	if ( ! function_exists('ranKeys')) {
		function ranKeys(){
			return md5(uniqid(rand(), true));
		}
	}
	if (!function_exists('rewrite_url_seo'))
	{
		function rewrite_url_seo($url)
		{
			$url = strtolower($url);
			$newstr = preg_replace('/[^a-zA-Z0-9\']/', '-', $url);
			$newstr = str_replace("'", '', $newstr);
			return $newstr;
		}
	}
	// if ( ! function_exists('getJsonFromController')) {
	// 	function getJsonFromController($nameCtrl , $nameFunc){
	// 		$ci = &get_instance();
	// 		$ci->load->library('../controllers/Banner');
	// 		$ci->load->library('session');
			
	// 		$data = $ci->banner->get();
	// 		return $data;
	// 	}
	// }
	// if (!function_exists('load_controller'))
	// {
	// 	function load_controller($controller, $method = 'index')
	// 	{
	// 		$ci = &get_instance();
	// 		require_once(APPPATH . 'controllers/' . $controller . '.php');

	// 		// $ctrl = new Banner;

	// 		// return $controller->$method();
	// 	}
	// }
	if (! function_exists('apiCurl')) {

	    function apiCurl($url,$method="GET",$params)
	    {
	        $ch = curl_init();
	        if(count($params) > 0 && $method == 'GET'){
	        	$data_string = '';
	        	foreach ($params as $key => $value) {    
	                
	                $data_string .= '&' . $key .'=' . $value;
	                $data_string = substr($data_string, 1);
	        	}
	        	$url = $url.'?'.$data_string;
	        }
	        // die($url);

	        //set the url, number of POST vars, POST data
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
	        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

	        // curl_setopt($ch, CURLOPT_USERAGENT, get_server_var('HTTP_USER_AGENT'));
	        // curl_setopt($ch, CURLOPT_POST, true);
	        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	        $result = curl_exec($ch);     
	        $result = json_decode($result,JSON_UNESCAPED_UNICODE);

	        //close connection
	        
	        return $result;
	    }
	}

	if (! function_exists('trans')) {
		function trans($type,$need)
		{
			$type = strtolower($type);
			$need = strtolower($need);
			if($type == 'gender'){
				switch ($need) {
					case 'single':
						$need = 'Độc thân';
						break;
					case 'married':
						$need = 'Đã kết hôn';
						break;
					case 'in a relationship':
						$need = 'Đang trong một mối qh';
						break;
					case 'in an open relationship':
						$need = 'Đang trong một mối qh mở';
						break;
					case 'in a domestic partnership':
						$need = 'Đang trong một mối qh đối tác';
						break;
					case 'engaged':
						$need = 'Đã đính hôn';
						break;
					case "it's complicated":
						$need = 'Phức tạp';
						break;
					default:
						// code...
						break;
				}
			}
			return $need;
		}
	}
	

 ?>