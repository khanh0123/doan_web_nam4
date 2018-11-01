<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("Access-Control-Allow-Origin:*");
class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Friend_model');
	}
	public function index()
	{
		
	}
	public function getToken()
	{
		
		$this->load->view('khanh/view_get_token');

	}
	public function getFullToken(){
		$username = !empty($this->input->post('user')) ? $this->input->post('user') : '';
		$password = !empty($this->input->post('pass')) ? $this->input->post('pass') : '';
		$type = "ios";
		$res = [];
		if(empty($username) || empty($password)){
			$res['error'] = true;
			$res['message'] = 'Username or password is empty';

		} else{
			$token = $this->get_token($username , $password,$type);
			if(!$token){
				$res['error'] = true;
				$res['message'] = 'Username or password is\'t correct ';
			} else {
				$res['success'] = true;
				$res['token'] = $token;
			}
		}
		echo json_encode($res);
	}
	public function getInfoFriendList()
	{
		$res = ['messages' => []];
		$token = !empty($this->input->get('access_token')) ? $this->input->get('access_token') : '';
		$name = !empty($this->input->get('full_name')) ? $this->CheckLetters(strtolower($this->input->get('full_name'))) : '';

		$need = $this->input->get('need') ? strtolower($this->input->get('need')) : 'id';
		if(empty($token) || strpos($token, 'EAA') !== 0){
			$text = ['text' => "Token không hợp lệ"];
			array_push($res['messages'], $text);
		} else if(empty($name)){
			$text = ['text' => "Bạn chưa nhập tên cần tìm"];
			array_push($res['messages'], $text);
		} else {
			$url = "https://graph.facebook.com/me/friends";
			$params = [
				'limit' => '5000',
				'summary' => '1',
				'fields' => 'name,'.$need,
				'access_token' => $token,
			];
			$success = false;
			$data = apiCurl($url,'GET',$params);
			$count = 0;
			if(isset($data['error'])){
				$text = ['text' => $data['error']['message']];
				array_push($res['messages'], $text);
			} else if(isset($data['data'])) {


				foreach ($data['data'] as $value) {
					$string = $this->CheckLetters(strtolower($value['name']));
					if(strpos($string, $name) > -1){
						if($need == 'mobile_phone' && isset($value['mobile_phone'])){
							$text = ['text' => $value['name'].' => '.$need.' : '.$value['mobile_phone']];
							array_push($res['messages'], $text);
							$count++;
						}
						if($need == 'email' && isset($value['email'])){
							$text = ['text' => $value['name'].' => '.$need.' : '.$value['email']];
							array_push($res['messages'], $text);
							$count++;
						}
						if($need == 'id' && isset($value['id'])){
							$text = ['text' => $value['name'].' => '.$need.' : '.$value['id']];
							array_push($res['messages'], $text);
							$count++;
						}
					}
				}
			}
			$text = ['text' => 'Có '.$count.' kết quả tìm kiếm'];
			array_push($res['messages'], $text);
			$temp = $res['messages'][0];
			$res['messages'][0] = $res['messages'][$count];
			$res['messages'][$count] = $temp;
		}
		if(empty($text['text'])) {
			$text = ['text' => 'Không tìm thấy dữ liệu'];
			array_push($res['messages'], $text);
		}

		die(json_encode($res));

	}
	private function tao_sig($postdata){
		global $secretkey;
		$textsig = "";
		foreach($postdata as $key => $value){
			$textsig .= "$key=$value";
		}
		$textsig .= $secretkey;
		$textsig = md5($textsig);

		return $textsig;
	}

	private function getpage($url, $postdata='')
	{
		$c = curl_init();
		curl_setopt($c, CURLOPT_URL, $url);
		curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0');

		if($postdata != "")
		{
			curl_setopt($c, CURLOPT_POST, 1);
			curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
		}

		$page = curl_exec($c);
		curl_close($c);
		return $page;
	}
	private function get_token($username, $password, $type = 'android')
		{
			$linklist = 'https://api.facebook.com/restserver.php';
			if ($type == 'android')	{
				$data = array(
					'api_key' => '882a8490361da98702bf97a021ddc14d',
					'email' => $username,
					'format' => 'JSON',
			//'generate_machine_id' => '1',
			//'generate_session_cookies' => '1',
					'locale' => 'vi_vn',
					'method' => 'auth.login',
					'password' => $password,
					'return_ssl_resources' => '0',
					'v' => '1.0'
				);
				$sig = '62f8ce9f74b12f84c123cc23437a4a32';
			}
			elseif ($type == 'ios') {
				$data = array(
					'api_key' => '3e7c78e35a76a9299309885393b02d97',
					'email' => $username,
					'format' => 'JSON',
			//'generate_machine_id' => '1',
			//'generate_session_cookies' => '1',
					'locale' => 'vi_vn',
					'method' => 'auth.login',
					'password' => $password,
					'return_ssl_resources' => '0',
					'v' => '1.0'
				);
				$sig = 'c1e620fa708a1d5696fb991c1bde5662';
			}
			$sig = '';
			foreach($data as $key => $value){
				$sig .= "$key=$value";
			}
			if ($type == 'android')	{
				$sig .= '62f8ce9f74b12f84c123cc23437a4a32';
			}
			elseif ($type == 'ios') {
				$sig .= 'c1e620fa708a1d5696fb991c1bde5662';
			}
			$data['sig'] = md5($sig);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $linklist);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			if ($type == 'android') {
				curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 4.4.2; SMART 3.5'' Touch+ Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36");	
			}
			elseif ($type == 'iphone') {
				curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1");
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$page = curl_exec($ch);
			curl_close($ch);
			$infotoken = json_decode($page,true);			
			if(!empty($infotoken['access_token'])){
				return $infotoken['access_token'];
			}
			return null;
		}
	public function shield_avatar_facebook()
	{
		$res = ['messages' => []];

		$token = isset($_GET['access_token']) ? $this->input->get('access_token') : '';
		$action = isset($_GET['action']) ? strtolower($this->input->get('action')) : 'on';
		if($action !== 'on' && $action !== 'off'){
			$action = 'on';
		}

		if(!empty($token)){
			$idfb = '';
			try {
				$idfb = json_decode(file_get_contents("https://graph.facebook.com/me?access_token=".$token),true);
			} catch (Exception $e) {
				
			}
			

			if(empty($idfb['id']))
			{
				$text = ['text' => "Token không hợp lệ"];
				array_push($res['messages'], $text);
			}
			else
			{
				$headers2 = array();
				$headers2[] = 'Authorization: OAuth '.$token;
				$data = 'variables={"0":{"is_shielded":'.($action == 'on' ? 'true' : 'false' ).',"session_id":"9b78191c-84fd-4ab6-b0aa-19b39f04a6bc","actor_id":"'.$idfb['id'].'","client_mutation_id":"b0316dd6-3fd6-4beb-aed4-bb29c5dc64b0"}}&method=post&doc_id=1477043292367183&query_name=IsShieldedSetMutation&strip_defaults=true&strip_nulls=true&locale=en_US&client_country_code=US&fb_api_req_friendly_name=IsShieldedSetMutation&fb_api_caller_class=IsShieldedSetMutation';
				$c = curl_init();
				curl_setopt($c, CURLOPT_URL, "https://graph.facebook.com/graphql");
				curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
				curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
				curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);  
				curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($c, CURLOPT_HTTPHEADER, $headers2);
				curl_setopt($c,CURLOPT_POST, 1);
				curl_setopt($c,CURLOPT_POSTFIELDS,$data);
				$page = curl_exec($c);
				curl_close($c);

				$text = ['text' => $action == 'on' ? 'Bật shield avatar thành công' : 'Tắt shield avatar thành công'];
				array_push($res['messages'], $text);
			}
		} else {
			$text = ['text' => "Token không hợp lệ"];
			array_push($res['messages'], $text);
		}
		die(json_encode($res));

	}
	public function view_getFriend()
	{
		$this->load->view('input_token_get_friend');
	}
	private function CheckLetters($string){
		$replace = [
			'&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
			'&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
			'&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
			'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
			'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
			'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
			'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
			'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
			'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
			'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
			'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
			'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
			'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
			'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
			'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
			'&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
			'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
			'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
			'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a', 
			'ắ' => 'a', 'ấ' => 'a', 'ằ' => 'a', 'ầ' => 'a', 
			'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
			'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
			'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
			'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
			'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
			'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
			'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
			'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
			'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
			'&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
			'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
			'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
			'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
			'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
			'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
			'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
			'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
			'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
			'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
			'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
			'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
			'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
			'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
			'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
			'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
			'ю' => 'yu', 'я' => 'ya'
		];

		return str_replace(array_keys($replace), $replace, $string);  
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */