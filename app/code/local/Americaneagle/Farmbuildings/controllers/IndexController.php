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
			foreach($tree->children as $aeatt) {
				if($aeatt->id == $attid) {
					foreach($aeatt->options as $opts) {
						if($att->value == $opts->id) {
							$tree = $opts;
							break;;
						}
					}
					break;
				}
			}
		}
		$nextAtt = $tree->children[0];
		$nextOpts = array();

		foreach ($nextAtt->options as $opt) {
			$nextOpts[] = array('id' => $opt->id, 'val' => $opt->val);
		}
		echo json_encode(array('attributeid' => $nextAtt->id, 'options' => $nextOpts));
	}

}