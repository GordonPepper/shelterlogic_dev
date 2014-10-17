<?php

/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/10/14
 * Time: 4:24 PM
 */
class Americaneagle_Farmbuildings_IndexController
	extends Mage_Core_Controller_Front_Action {

	public function indexAction() {


		$tree = Mage::helper('farmbuildings')->getTree();

		$postVars = json_decode(file_get_contents('php://input'));
		//echo sprintf("tree root: '%s', root id: '%s'", $tree->val, $tree->id);
		foreach($postVars as $att) {
			$attid = substr($att->id, 9); //strlen('attribute') = 9
			foreach($tree as $id => $attval) {
				if($id == $attid) {
					foreach($attval['options'] as $optid => $opt) {
						if($att->value == $optid) {
							$tree = $opt['children'];
							break;
						}
					}
					break;
				}
			}
		}
		$nextAtt = $tree;
		$nextOpts = array();

		$keys = array_keys($nextAtt);
		foreach ($nextAtt[$keys[0]]['options'] as $id => $opt) {
			$nextOpts[] = array('id' => $id, 'val' => $opt['val']);
		}
		echo json_encode(array('attributeid' => $keys[0], 'options' => $nextOpts));
	}

}