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
        /*
         * Explanation: Producing the JSON response is a 2 step process
         * First, we must find navigate the attribute tree based on the
         * posted selections.
         * Second, we encode the trunk of the selected sub tree.
         * We receive an ordered array of selected "options". The order
         * of these options need to be in the same order that the tree
         * is ordered in. This way, we can step into the tree one option
         * at a time, re-pointing the $tree var to the previously selected
         * point in the tree. We can then output the last "trunk" of the tree
         * as the next option list.
         * A Third step is being added to provide default values to the frontend.
         */
        try {
            $postVars = json_decode(file_get_contents('php://input'));

            $tree = Mage::helper('farmbuildings')->getTree($postVars->pid);
            // step 1: navigate to the currently selected branch:
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

            // step 2: encode the current "trunk" as the next option set
            $last = false;
            $keys = array_keys($nextAtt);
            foreach ($nextAtt[$keys[0]]['options'] as $id => $opt) {
                if(isset($opt['children']['id'])) {
                    $nextOpts[] = array('id' => $id, 'val' => $opt['val'], 'pid' => $opt['children']['id']);
                    $last = true;
                } else {
                    $nextOpts[] = array('id' => $id, 'val' => $opt['val']);
                }
            }

            // Sort the width selection
            $sortedOpts = array();
            foreach ($nextOpts as $key => $row)
            {
                $sortedOpts[$key] = $row['val'];
            }
            array_multisort($sortedOpts, SORT_ASC, $nextOpts);

            /*
             * new third step: the frontend will pre-select the first option in
             * the $nextOpts array as a sort of default value. we need to transmit
             * all remaining "first selection" options to the front end so that
             * if the user wants the first option and simply presses the forward
             * button, instead of changing the dropdown, the next choice will have
             * the appropriate option set available.
             */
            if(false) {
                $defaultOpts = array();

                $tree = $tree[$keys[0]]['options'][$nextOpts[0]['id']]['children'];
                $current = json_encode(array('attributeid' => $keys[0], 'options' => $nextOpts), JSON_PRETTY_PRINT);
                file_put_contents('/tmp/trunk2.json', sprintf("%s\n\n%s", $current,json_encode($tree, JSON_PRETTY_PRINT)));


            }

            echo json_encode(array('attributeid' => $keys[0], 'options' => $nextOpts));
        } catch (Exception $e) {
            echo json_encode(array('error' => $e->getMessage(),
                'stack' => $e->getTrace()
            ));
        }
    }

}