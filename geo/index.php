<?php
/*
|--------------------------------------------------------------------------
| Geo IP 2 ajax handler
|--------------------------------------------------------------------------
*/

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') { die("Direct Access Is Not Allowed"); }

	class AjaxGeo {

		public $remoteBase = 'https://geoip.maxmind.com/geoip/v2.1/insights/';
		public $userID;// = "98836";
		public $password;// = "k4FKoWiSreou";
		public $key;
		public $data;
		
		function __construct() {
			$this->data = (object)array(
				'success'	=> 1,
				'response'	=> null,
				'country'	=> null
			);

			if(!isset($_POST['key'])) {
				$this->data = (object)array(
					'success'	=> 0,
					'response'	=> "You must provide a valid api key"
				);
				$this->_return($this->data);

			} else {
				$this->key = $_POST['key'];

				$_array = explode(":",$this->key);
				
				$this->userID = $_array[0];
				$this->password = $_array[1];
				
				if($this->_get()) {
					$this->_return($this->data);
				}				
			}

			
		}
	    
	    public function _get(){
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->remoteBase.$this->get_ip_address());
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, $this->userID.":".$this->password);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			$curl_data = curl_exec($ch);
			curl_close($ch);
			
			$jsonObj = json_decode($curl_data);

			if(isset($jsonObj->code)) {
				$this->data->success = 0;
				$this->data->response = $jsonObj;
			} else {
				$this->data->success = 1;
				$this->data->response = $jsonObj;
				$this->data->country = $jsonObj->country->iso_code;
			}
			return true;
	    }
	   	
	   	public function get_ip_address() {
		    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
		    foreach ($ip_keys as $key) {
		        if (array_key_exists($key, $_SERVER) === true) {
		            foreach (explode(',', $_SERVER[$key]) as $ip) {
		            	
		                // trim for safety measures
		                $ip = trim($ip);
		                // attempt to validate IP
		                if ($ip == "127.0.0.1") {
		                	return "207.239.64.66";
		                } else if ($this->validate_ip($ip) && $ip != "127.0.0.1") {
		                    return $ip;
		                }
		            }
		        }
		    }

		    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
		}


		/**
		 * Ensures an ip address is both a valid IP and does not fall within
		 * a private network range.
		 */
		public function validate_ip($ip)
		{
		    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
		        return false;
		    }
		    return true;
		}

	    public function _return($pass) {
	    	echo json_encode($pass);
	    	die();
	    }

	}
$geo = new AjaxGeo;

?>