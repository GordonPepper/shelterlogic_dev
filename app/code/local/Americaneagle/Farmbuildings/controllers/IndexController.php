<?php

class Americaneagle_Farmbuildings_IndexController
	extends Mage_Core_Controller_Front_Action {


	public function productAction() {
		try {
			$params = json_decode(file_get_contents('php://input'));
			$vals = Mage::helper('farmbuildings')->getAdditionalData($params[0]->pid, $params[0]->spid);
			echo json_encode($vals);
		} catch (Exception $e) {
			echo json_encode(array('error' => $e->getMessage(),
				'stack' => $e->getTrace()
			));
		}
	}

	public function indexAction() {
		try {
			$postVars = json_decode(file_get_contents('php://input'));

			$tree = Mage::helper('farmbuildings')->getTree($postVars->pid);
			foreach($postVars->options as $att) {
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
				if(isset($opt['children']['id'])) {
					$nextOpts[] = array('id' => $id, 'val' => $opt['val'], 'pid' => $opt['children']['id']);
				} else {
					$nextOpts[] = array('id' => $id, 'val' => $opt['val']);
				}
			}
			echo json_encode(array('attributeid' => $keys[0], 'options' => $nextOpts));
		} catch (Exception $e) {
			echo json_encode(array('error' => $e->getMessage(),
				'stack' => $e->getTrace()
			));
		}
	}

}