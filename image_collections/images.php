<?php 
/**
 * Ajax Image Handler
 *
 * NOTICE OF LICENSE
 *
 * This script has been writen by Bryan Bielefeldt at Typoglyphic Studios and is meant for use with farmbuildings.com only.
 *
 * DISCLAIMER
 *
 * This script was written to be used with farmbuildings.com, adobe scene7 and the folder file structure for ShelterLogic Magento Instalation
 *
 * @category    ajax handler
 * @package     image_collections
 * @copyright   Copyright (c) 2014 Typoglyphic Studios
 * @license     http://www.typoglyphic.com 
 */
date_default_timezone_set('America/New_York');
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') { die("Direct Access Is Not Allowed"); }

	// Scene 7 Ajax for images

	class AjaxImage {

		public $data;
		public $local;
		public $remote;
		public $remoteBase = 'http://s7d2.scene7.com/is/image/';
		public $imagesURI;
		
		function __construct() {
			$base_dir  = __DIR__; // Absolute path to your installation, ex: /var/www/mywebsite
			$doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
			$base_url  = preg_replace("!^{$doc_root}!", '', $base_dir); # ex: '' or '/mywebsite'
			$protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
			$port      = $_SERVER['SERVER_PORT'];
			$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
			$domain    = $_SERVER['SERVER_NAME'];
			
			$this->data = (object)array(
				'success'	=> true,
				'message'	=> null,
				'folder'	=> null,
				'postData'	=> null,
				'save_as'	=> null,
				'url'		=> null
			);

			$this->data->folder = preg_replace('/\.php$/', '', __FILE__);

			if (!file_exists($this->data->folder)) {
			    mkdir($this->data->folder, 0755, true);
			}
			$this->imagesURI  = "$protocol://{$domain}{$disp_port}{$base_url}/".preg_replace('/\.php$/', '', basename(__FILE__))."/"; # Ex: 'http://example.com', 'https://example.com/mywebsite', etc.

			$this->data->postData = (object) array(
				'cover' 	=> $_POST['cover'],
				'logo'		=> $_POST['logo'],
				'inside'	=> $_POST['inside'],
				'color'		=> $_POST['color'],
				'guy'		=> $_POST['guy'],
				'offset'	=> $_POST['offset'],
				'width'		=> $_POST['width'],
			);
			

			foreach ($this->data->postData as $attribute) {
				if(empty($attribute) || $attribute == false) {
					$this->data->success = false;
					$this->data->message = 'NOT all atributes defined';
				}
			}
			if($this->data->success){
				$this->data->message = 'All atributes have been defined';
	        	$this->_check();
	        }else{
				$this->_return($this->data);
	        }
		}
	   
	    public function _get(){
		    $ch = curl_init ($this->remote);
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		    $raw=curl_exec($ch);
		    curl_close ($ch);
		    $this->_save($raw);

	    }
	   	
	   	public function _createUrl($company = 'ShelterLogic',$starter = 'blank_logo') {
			
			$postData = $this->data->postData;
			
			$this->remote = $this->remoteBase.$company.'/'.$starter.'?layer=1&src='.
				$postData->cover.'&$'.
				$postData->color.'$&posN='.
				$postData->offset.',0&layer=2&src='.
				$postData->inside.'&posN='.
				$postData->offset.',0&layer=3&src='.
				$postData->logo.'&$gray$&posN='.
				$postData->offset.',0&layer=4&src='.
				$postData->guy.'&posN='.
				$postData->offset.',0&fmt=png-alpha&wid='.
				$postData->width.'&hei='.
				$postData->width;

			$this->data->save_as = $postData->cover.'__'.$postData->color.'__'.$postData->width.'__'.$postData->guy.'.png';
			$this->local = $this->data->folder.'/'.$this->data->save_as;

	   	}

	    public function _check(){
	        
	        $this->_createUrl();
	        
	        if(file_exists($this->local)) {
	        	// echo "true";
	        	$localdate = new DateTime(date ("F d Y H:i:s.", filemtime($this->local)));
				$currentdate = new DateTime(date ("F d Y H:i:s."));
				$interval = $localdate->diff($currentdate);
				if(intval($interval->format('%a')) > 30) {
					unlink($this->local);
					$this->_get();
				} else {
					$this->data->url = $this->imagesURI.$this->data->save_as;
	        		$this->_return($this->data);
				}
	        	
	        } else {
	        	$this->_get();
	        }

	    }
	    /*
		|--------------------------------------------------------------------------
		| See http://php.net/manual/en/function.fopen.php for mode manual
		|--------------------------------------------------------------------------
		*/
	    public function _save($raw,$mode = 'w+') {
	    	if(file_exists($this->local) && file_exists($this->data->save_as)){
		        unlink($this->data->save_as);
		    }
		    file_put_contents($this->local, $raw);
		    $this->_check();
	    }

	    public function _return($pass) {
	    	echo json_encode($pass);
	    	die();
	    }

	}
$images = new AjaxImage;
?>