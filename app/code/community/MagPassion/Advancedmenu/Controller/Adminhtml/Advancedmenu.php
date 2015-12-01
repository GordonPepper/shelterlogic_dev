<?php 
/**
 * MagPassion_Advancedmenu extension
 * 
 * @category   	MagPassion
 * @package		MagPassion_Advancedmenu
 * @copyright  	Copyright (c) 2013 by MagPassion (http://magpassion.com)
 * @license	http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * module base admin controller
 *
 * @category	MagPassion
 * @package		MagPassion_Advancedmenu
 * @author MagPassion.com
 */
class MagPassion_Advancedmenu_Controller_Adminhtml_Advancedmenu extends Mage_Adminhtml_Controller_Action{
	/**
	 * upload file and get the uploaded name
	 * @access public
	 * @param string $input
	 * @param string $destinationFolder
	 * @param array $data
	 * @return string
	 * @author MagPassion.com
	 */
	protected function _uploadAndGetName($input, $destinationFolder, $data){
		try{
			if (isset($data[$input]['delete'])){
				return '';
			}
			else{
				$uploader = new Varien_File_Uploader($input);
				$uploader->setAllowRenameFiles(true);
				$uploader->setFilesDispersion(true);
				$uploader->setAllowCreateFolders(true);
				$result = $uploader->save($destinationFolder);
				return $result['file'];
			}
		}
		catch (Exception $e){
			if ($e->getCode() != Varien_File_Uploader::TMP_NAME_EMPTY){
				throw $e;
			}
			else{
				if (isset($data[$input]['value'])){
					return $data[$input]['value'];
				}
			}
		}
		return '';
	}
}