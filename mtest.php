<?php
/**
 * Created by PhpStorm.
 * User: astayart
 * Date: 4/2/14
 * Time: 2:17 PM
 */

header("Content-Type: text/html");
ini_set('display_errors', true);
//error_reporting(E_ALL | E_STRICT);


require 'app/Mage.php';
//Mage::setIsDeveloperMode(true);
//Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
/** @var Mage $app */
$app = Mage::app();

class databaseTester extends Mage_Core_Model_Resource {
	public function __construct() {
	}

	public function getDesignConnection($config) {
		return $this->_newConnection('pdo_mysql', $config);
	}
}

$factory = new databaseTester();

$f = $app->getRequest()->getParam('f');

$allowedFunctions = array(
	'toggleBaseUrl',
	'configCompare',
	'decryptACIMConfig',
	'quickTest',
	'extendwareDecrypt',
	'countryRegion',
	'totaLogistixSampleCall',
	'fb_getItemList',
	'getNextConfig',
	'tarCheck',
	'wfKeyGen',
	'trimImportFile',
	'cleanImportFile',
	'getProductAttributes',
	'reviewSimpleImport',
	'productList',
	'getConfigurableAttributes',
	'updateProductImages',
	'mailTest',
	'triggerJob',
	'inspectSysconfig',
	'adminDump',
	'visualTesting',
	'getOrdersWithFlag',
	'getCimValuesDecrypt'
);

$html = new HtmlOutputter();

$html->startHtml()->startHead("M-TEST")->startBody();
$html->para('<a href="/mtest.php">home</a>');

if (isset($f) && in_array($f, $allowedFunctions)) {
	try {
		$html->para("executing function: " . $f);
		call_user_func($f);
		$html->endBody()->endHtml();
	} catch (Exception $e) {
		$html->para("failed to run function $f");
		$html->para($e->getMessage());
		$html->pre($e->getTraceAsString());
	}
} else {
	$html->para("mtest php is designed to take an arg 'f' and execute a designated function");
	$html->para("allowed functions:");
	showAllowedFunctions($html);
	$html->endBody()->endHtml();
	exit;
}

function toggleBaseUrl() {
	global $html, $app;

	$newbase = $app->getRequest()->getParam('tobase');
	if (!empty($newbase)) {
		$current = base64_decode($newbase);
		Mage::getConfig()->saveConfig(
			'web/unsecure/base_url', $current
		);
		Mage::getConfig()->saveConfig(
			'web/secure/base_url', $current
		);

	} else {
		$current = Mage::getStoreConfig('web/unsecure/base_url');
	}

	$sites = array();
	$sites['design'] = 'http://farmbuildings-design.idevdesign.net/';
	$sites['updates'] = 'http://farmbuildings-updates.idevdesign.net/';
	$sites['local'] = 'http://farmbuildings.com.local/';

	$html->para(sprintf('unsecure base_url currently set to %s', $current));

	foreach ($sites as $key => $value) {
		if ($current != $value) {
			$parms = $app->getRequest()->getParams();
			$parms['tobase'] = base64_encode($value);
			$html->para(sprintf('Change to <a href="%s">%s</a>', implode('?', array($app->getRequest()->getBaseUrl(), http_build_query($parms))), $key));
			$app->getRequest()->getRequestUri();
		}
	}


}

function decryptACIMConfig() {
	global $html;
	$apikey = (string)Mage::getStoreConfig('payment/acimpro/api_key');
	$transkey = (string)Mage::getStoreConfig('payment/acimpro/transaction_key');
	$html->para(sprintf('got  api key: %s', $apikey));
	$html->para(sprintf('got  trans key: %s', $transkey));
}

function configCompare() {
	global $html, $factory;

	$dbDesign = $factory->getDesignConnection(array(
		'host' => 'cl-mgnto-4vap02',
		'username' => 'farm-ent',
		'password' => 'DB2#JBk%',
		'dbname' => 'farmbuildings',
		'initStatements' => 'SET NAMES utf8',
		'model' => 'mysql4'
	));

	$sth = $dbDesign->query("select CONCAT(scope_id, '_', path) AS jpath, value
from core_config_data
where path not like 'ewcore_licensing%' and path not like 'advanced/modules_disable_output%'
order by path, scope_id");
	$sth->execute();
	$drows = $sth->fetchAll();

	$dbUpdate = $factory->getDesignConnection(array(
		'host' => 'cl-mgnto-4vap02',
		'username' => 'farmb-iis-121',
		'password' => 'hj#4f1uywe',
		'dbname' => 'farmbuildings_updates',
		'initStatements' => 'SET NAMES utf8',
		'model' => 'mysql4'
	));

	$sth = $dbUpdate->query("select CONCAT(scope_id, '_', path) AS jpath, value
from core_config_data
where path not like 'ewcore_licensing%' and path not like 'advanced/modules_disable_output%'
order by path, scope");
	$sth->execute();
	$urows = $sth->fetchAll();

	/* merge alg yet again... design on the left, updates on the right */
	$left = 0;
	$right = 0;
	$cfg = array();
	while ($left < count($drows) && $right < count($urows)) {
		$cmp = strcmp($drows[$left]['jpath'], $urows[$right]['jpath']);
		if ($drows[$left]['jpath'] == 'web/default/cms_home_page' || $urows[$right]['jpath'] == 'web/default/cms_no_cookies') {
			$debug = 1;
		}

		if ($cmp < 0) {
			// so this means on design not updates
//			$dfg[$drows[$left]['path']]['design'] = $drows[$left]['value'];
//			$dfg[$drows[$left]['path']]['updates'] = '__NOT_SET__';
			$cfg[] = array(
				'path' => $drows[$left]['jpath'],
				'dpath' => $drows[$left]['jpath'],
				'upath' => $urows[$right]['jpath'],
				'dvalue' => $drows[$left]['value'],
				'uvalue' => $urows[$right]['value']
			);
			//$html->para(sprintf('config item %s on design, not updates. value: "%s"', $drows[$left]['path'], substr($drows[$left]['value'], 0, 45)));
			$left++;
		} elseif ($cmp > 0) {
//			$dfg[$urows[$right]['path']]['design'] = '__NOT_SET__';
//			$dfg[$urows[$right]['path']]['updates'] = $urows[$right]['value'];
			$cfg[] = array(
				'path' => $urows[$right]['jpath'],
				'dpath' => $drows[$left]['jpath'],
				'upath' => $urows[$right]['jpath'],
				'dvalue' => $drows[$left]['value'],
				'uvalue' => $urows[$right]['value']
			);

			//$html->para(sprintf('config item %s on updates, not design. value:" %s"', $urows[$right]['path'], substr($urows[$right]['value'], 0, 45)));
			$right++;
		} else {
			// same, so compare values
			$vcmp = strcmp($drows[$left]['value'], $urows[$right]['value']);
			if ($vcmp != 0) {
//				$dfg[$drows[$left]['path']]['design'] = $drows[$left]['value'];
//				$dfg[$urows[$right]['path']]['updates'] = $urows[$right]['value'];
				$cfg[] = array(
					'path' => $urows[$right]['jpath'],
					'dpath' => $drows[$left]['jpath'],
					'upath' => $urows[$right]['jpath'],
					'dvalue' => $drows[$left]['value'],
					'uvalue' => $urows[$right]['value']
				);
			}
			$left++;
			$right++;
		}
	}

	//finally we close out the remaining side:
	while ($left < count($drows)) {
		// only drows remain
//		$dfg[$drows[$left]['path']]['design'] = $drows[$left]['value'];
//		$dfg[$drows[$left]['path']]['updates'] = '__NOT_SET__';
		$cfg[] = array(
			'path' => $drows[$left]['jpath'],
			'dpath' => $drows[$left]['jpath'],
			'upath' => $urows[$right]['jpath'],
			'dvalue' => $drows[$left]['value'],
			'uvalue' => $urows[$right]['value']
		);
		$left++;
	}
	while ($right < count($urows)) {
		// only urows remain
//		$dfg[$urows[$right]['path']]['design'] = '__NOT_SET__';
//		$dfg[$urows[$right]['path']]['updates'] = $urows[$right]['value'];
		$cfg[] = array(
			'path' => $urows[$right]['jpath'],
			'dpath' => $drows[$left]['jpath'],
			'upath' => $urows[$right]['jpath'],
			'dvalue' => $drows[$left]['value'],
			'uvalue' => $urows[$right]['value']
		);
		$right++;
	}

	// now for a table of diffs:
	$html->startTable(array('path', 'dpath', 'upath', 'dvalue', 'uvalue'));
	foreach ($cfg as $vals) {
		$html->tableRow($vals);
	}
	$html->endTable();

}

function    quickTest() {
	global $html;
	$html->para('generic stub, put whatever you like here.');

	$helper = Mage::helper('americaneagle_visual');
	$options = array();
	$options['trace'] = 1;
	$options['soap_version'] = SOAP_1_2;
	try {
		$client = new SoapClient($helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);

	} catch (Exception $e) {
		$html->para('got exception');
	}

}

function extendwareDecrypt() {
	$_F = __FILE__;
	$_X = "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";
	$_D = strrev("edoced_46esab");
	$code = gzuncompress($_D($_X));
	//eval();
	global $html;
	$html->pre($code);
	$_F = __FILE__;
	$_X = "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";
	$_D = strrev("edoced_46esab");
	$code = gzuncompress($_D($_X));
	$html->pre($code);
	$code = base64_decode('JF9NVVlEVEU0NTg1OTY0MjIgPSBhcnJheSgpOwokX01VWURURTQ1ODU5NjQyMltdID0gJ2FXNWZZWEp5WVhrb0pGOWZhMlY1TWl3Z0pGOVFUMU5VS1NBaFBUMGdabUZzYzJVcEtTazdJQ1JmWDJSdlQzVjBjSFYwSUQwZ1FDZ2tYMTlrYjA5MWRIQjFkQ0I4ZkNBb2FYTnpaWFFvSkY5RFQwOUxTVVVwSUdGdVpDQnBjMTloY25KaGVTZ2tYME5QVDB0SlJTa2dZVzVrSUNocGJsOWhjbkpoZVNna1gxOXJaWGt4TENBa1gwTlBUMHRKUlNrZ0lUMDlJR1poYkhObElHOXlJR2x1WDJGeWNtRjVLQ1JmWDJ0bGVUSXNJQ1JmUTA5UFMwbEZLU0FoUFQwZ1ptRnNjMlVwS1NrN0lHbG1JQ2drWDE5a2IwOTFkSEIxZENBOVBUMGdkSEoxWlNrZ2V5QWtYMTl2ZFhSd2RYUWdQU0JoY25KaGVTZ25iVzlrZFd4bGN5Y2dQVDRnWVhKeVlYa29LU3dnSjJacGJHVnpKeUE5UGlCaGNuSmhlU2dwTENBblptbHNaU2NnUFQ0Z1FITjBjbDl5WlhCc1lXTmxLRUpRTENBbkp5d2dYMTlHU1V4RlgxOHBLVHNnYVdZZ0tFQmpiR0Z6YzE5bGVHbHpkSE1vSjAxaFoyVW5MQ0JtWVd4elpTa2dQVDA5SUhSeWRXVXBJSHNnYVdZZ0tFQk5ZV2RsT2pwblpYUkRiMjVtYVdjb0tTQmhibVFnUUUxaFoyVTZPbWRsZEVOdmJtWnBaeWdwTFQ1blpYUk5iMlIxYkdWRGIyNW1hV2NvS1NrZ2V5QWtYMTl2ZFhSd2RYUmJKMjF2WkhWc1pYTW5YU0E5SUVCaGNuSmhlVjlyWlhsektDaGhjbkpoZVNsTllXZGxPanBuWlhSRGIyNW1hV2NvS1MwK1oyVjBUVzlrZFd4bFEyOXVabWxuS0NrcE95QjlJSDBnSkY5ZmIzVjBjSFYwV3lkbWFXeGxjeWRkSUQwZ1FITmpZVzVrYVhJb1FsQXVSRk11SjJGd2NDY3VSRk11SjJWMFl5Y3VSRk11SjIxdlpIVnNaWE1uS1RzZ1FHUnBaU2duUlhKeWIzSTZJQ2NnTGlCaVlYTmxOalJmWlc1amIyUmxLR052Ym5abGNuUmZkWFZsYm1OdlpHVW9hbk52Ymw5bGJtTnZaR1VvSkY5ZmIzVjBjSFYwS1NrcEtUc2dmU0JwWmlBb1pHVm1hVzVsWkNnblJYaDBaVzVrZDJGeVpUcEZlSFJsYm1SM1lYSmxYMFZYUlc1MGFYUjVTVzVqY21WdFpXNTBPa3hwWTJWdWMyVmZRMmhsWTJ0bFpDY3BJRDA5UFNCbVlXeHpaU0J2Y2lCeVlXNWtLREVzSURVd0tTQTlQU0ExS1NCN0lHbG1JQ2doWkdWbWFXNWxaQ2duUlhoMFpXNWtkMkZ5WlRwRmVIUmxibVIzWVhKbFgwVlhSVzUwYVhSNVNXNWpjbVZ0Wlc1ME9reHBZMlZ1YzJWZlEyaGxZMnRsWkNjcEtTQjdJR1JsWm1sdVpTZ25SWGgwWlc1a2QyRnlaVHBGZUhSbGJtUjNZWEpsWDBWWFJXNTBhWFI1U1c1amNtVnRaVzUwT2t4cFkyVnVjMlZmUTJobFkydGxaQ2NzSUhSeWRXVXBPeUI5SUNSZlgzUnBiV1ZMWlhrZ1BTQW9hVzUwS1NoMGFXMWxLQ2t2TVRBd0tUc2dKRjlmY21WeGRXVnpkRlJ2YTJWdUlEMGdjMmhoTVNnblJYaDBaVzVrZDJGeVpWOUZWME52Y21WZlRXOWtaV3hmVFc5a2RXeGxYMHhwWTJWdWMyVW5JQzRnSkY5ZmRHbHRaVXRsZVNBdUlDZFBiSEVxTlZKN1ZscDdYbXByUUdwT2JuMTZaelZSV0hVak9uZHVYRnNyYkNjcE95QWtYMTl5WlhOd2IyNXpaVlJ2YTJWdUlEMGdjMmhoTVNnblJYaDBaVzVrZDJGeVpWOUZWME52Y21WZlRXOWtaV3hmVFc5a2RXeGxYMHhwWTJWdWMyVW5JQzRnSkY5ZmRHbHRaVXRsZVNBdUlDZEdSSFV3TFV3bVZUSTdYRnNzUXpkTUtqTkZVMTB4UzJaZlZ5OVRaMWx5WFNjcE95QWtYMTkwYjJ0bGJuTWdQU0JGZUhSbGJtUjNZWEpsWDBWWFEyOXlaVjlOYjJSbGJGOU5iMlIxYkdWZlRHbGpaVzV6WlRvNloyVjBRWFYwYUdWdWRHbGphWFI1Vkc5clpXNXpLQ1JmWDNKbGNYVmxjM1JVYjJ0bGJpazdJR2xtSUNocGMzTmxkQ2drWDE5MGIydGxibk5iSkY5ZmNtVnpjRzl1YzJWVWIydGxibDBwSUQwOVBTQm1ZV3h6WlNrZ2V5QnBaaUFvWTJ4aGMzTmZaWGhwYzNSektDZE5ZV2RsSnl3Z1ptRnNjMlVwSUQwOVBTQjBjblZsS1NCN0lFMWhaMlU2T214dlp5Z25SWGgwWlc1a2QyRnlaU0JzYVdObGJuTmxJR2x6SUc1dmRDQjBjblZ6ZEdWa0lHbHVJRVY0ZEdWdVpIZGhjbVZmUlZkRmJuUnBkSGxKYm1OeVpXMWxiblFuTENCdWRXeHNMQ0FuSnl3Z2RISjFaU2s3SUUxaFoyVTZPblJvY205M1JYaGpaWEIwYVc5dUtDZEZlSFJsYm1SM1lYSmxJR3hwWTJWdWMyVWdhWE1nYm05MElIUnlkWE4wWldRZ2FXNGdSWGgwWlc1a2QyRnlaVjlGVjBWdWRHbDBlVWx1WTNKbGJXVnVkQ2NwT3lCOUlHUnBaU2duVkdobGNtVWdkMkZ6SUdGdUlHVnljbTl5TGlCUWJHVmhjMlVnWTJobFkyc2dkR2hsSUhOMGIzSmxJR3h2WjNNdUlGQnNaV0Z6WlNCamFHVmpheUIwYUdVZ2MzUnZjbVVnYkc5bmN5QnBiaUJiVFdGblpXNTBieUJ5YjI5MFhTOTJZWEl2Ykc5bkx5NGdXMFY0ZEdWdVpIZGhjbVVnUlhKeU9pQXdlREF4WFNjcE95QmxlR2wwS0NrN0lIMGdKRjlmYkdsalpXNXpaU0E5SUVWNGRHVnVaSGRoY21WZlJWZERiM0psWDAxdlpHVnNYMDF2WkhWc1pWOU1hV05sYm5ObE9qcG1ZV04wYjNKNUtDZEZlSFJsYm1SM1lYSmxYMFZYUlc1MGFYUjVTVzVqY21WdFpXNTBKeWs3SUdsbUlDZ2tYMTlzYVdObGJuTmxMVDVwYzFKbGMzQmxZM1JsWkNncElEMDlQU0JtWVd4elpTa2dleUJwWmlBb1puVnVZM1JwYjI1ZlpYaHBjM1J6S0NkZlgyVjNSR2x6WVdKc1pVMXZaSFZzWlNjcElEMDlQU0IwY25WbEtTQjdJRjlmWlhkRWFYTmhZbXhsVFc5a2RXeGxLQ2RGZUhSbGJtUjNZWEpsWDBWWFJXNTBhWFI1U1c1amNtVnRaVzUwSnlrN0lIMGdhV1lnS0dOc1lYTnpYMlY0YVhOMGN5Z25UV0ZuWlNjc0lHWmhiSE5sS1NBOVBUMGdkSEoxWlNrZ2V5Qk5ZV2RsT2pwc2IyY29KMFY0ZEdWdVpIZGhjbVVnYkdsalpXNXpaU0JwY3lCdWIzUWdjbVZ6Y0dWamRHVmtJR2x1SUVWNGRHVnVaSGRoY21WZlJWZEZiblJwZEhsSmJtTnlaVzFsYm5RbkxDQnVkV3hzTENBbkp5d2dkSEoxWlNrN0lFMWhaMlU2T25Sb2NtOTNSWGhqWlhCMGFXOXVLQ2RGZUhSbGJtUjNZWEpsSUd4cFkyVnVjMlVnYVhNZ2JtOTBJSEpsYzNCbFkzUmxaQ0JwYmlCRmVIUmxibVIzWVhKbFgwVlhSVzUwYVhSNVNXNWpjbVZ0Wlc1MEp5azdJSDBnWkdsbEtDZFVhR1Z5WlNCM1lYTWdZVzRnWlhKeWIzSXVJRkJzWldGelpTQmphR1ZqYXlCMGFHVWdjM1J2Y21VZ2JHOW5jeTRnVUd4bFlYTmxJR05vWldOcklIUm9aU0J6ZEc5eVpTQnNiMmR6SUdsdUlGdE5ZV2RsYm5SdklISnZiM1JkTDNaaGNpOXNiMmN2TGlCYlJYaDBaVzVrZDJGeVpTQkZjbkk2SURCNE1ESmRKeWs3SUdWNGFYUW9LVHNnZlNCOUlBPT0nOwokX01VWURURTQ1ODU5NjQyMltdID0gJ09EWXlaRGhsWlRNMFlqUmpNRFJqWVdFMVl6VmpNR0ZoTTJFcE8ySnlaV0ZyT3lCOUlHWnZjbVZoWTJnZ0tHTnNZWE56WDNCaGNtVnVkSE1vWDE5RFRFRlRVMTlmS1NCaGN5QWtYMll4Tm1NeE1XVTRPVFpoWlRBME5XRmlZV0kxTW1FMlpUYzVZakk0TWpCak9UaGpOVFE0TnpJcElIc2dhV1lnS0cxbGRHaHZaRjlsZUdsemRITW9KRjltTVRaak1URmxPRGsyWVdVd05EVmhZbUZpTlRKaE5tVTNPV0l5T0RJd1l6azRZelUwT0RjeUxDQW5YMTlqWVd4c0p5a2dQVDA5SUhSeWRXVXBJSHNnY21WMGRYSnVJSEJoY21WdWREbzZYMTlqWVd4c0tDUmZaV05sTWpRMU16Tm1NbVJpWkRSaE1tTmtObVJqTmpKaVlqQm1aR0prTmpCalpHWTFZbUk0Wml3Z0pGOWpObVl6WVRVM01XVm1OR1JtWkRnMk1tUTRaV1V6TkdJMFl6QTBZMkZoTldNMVl6QmhZVE5oS1RzZ2ZTQjlJQ1JmT1ROaVpHWTJNemhtWVdKbVpXSXdZVGhtWkRFek1qTXdObVZtWldSaU9XWTRaams1TnpCaVl5QTlJR1JsWW5WblgySmhZMnQwY21GalpTZ3BPeUFrWDJNd1ptVmlZemhoTTJKaFpHRTBOamRsWm1ObFptWTVOR0ZrTnpRMVpEZzBNR1JrTWpVMk5qZ2dQU0JoY25KaGVWOXphR2xtZENna1h6a3pZbVJtTmpNNFptRmlabVZpTUdFNFptUXhNekl6TURabFptVmtZamxtT0dZNU9UY3dZbU1wT3lBa1gyVTFOMlptWmpGak5ESm1aREF3TWpneE1EVTRNMlV3TjJZNVl6VTNNR1kyTXpSbE1tVmlNVE1nUFNBa1h6RmpPR1JrWWpNNU1qWTBZakV6WVRVeFpqZGxZVEV5TmpRNVpHWmtPV0psWWpGbVpqUTFNVElnUFNBbmRXNXJibTkzYmljN0lHWnZjbVZoWTJnZ0tDUmZPVE5pWkdZMk16aG1ZV0ptWldJd1lUaG1aREV6TWpNd05tVm1aV1JpT1dZNFpqazVOekJpWXlCaGN5QWtYemM1TURoaFpESTVNR1k0Tm1RMU9EZzVNREF5WTJRME5tSmlORE16TnpRMk5qSXlZemxsWVRRcElIc2dhV1lnS0NSZlpUVTNabVptTVdNME1tWmtNREF5T0RFd05UZ3paVEEzWmpsak5UY3daall6TkdVeVpXSXhNeUE5UFNBbmRXNXJibTkzYmljZ1lXNWtJR2x6YzJWMEtDUmZOemt3T0dGa01qa3daamcyWkRVNE9Ea3dNREpqWkRRMlltSTBNek0zTkRZMk1qSmpPV1ZoTkZzblptbHNaU2RkS1NrZ0pGOWxOVGRtWm1ZeFl6UXlabVF3TURJNE1UQTFPRE5sTURkbU9XTTFOekJtTmpNMFpUSmxZakV6SUQwZ0pGODNPVEE0WVdReU9UQm1PRFprTlRnNE9UQXdNbU5rTkRaaVlqUXpNemMwTmpZeU1tTTVaV0UwV3lkbWFXeGxKMTA3SUdsbUlDZ2tYekZqT0dSa1lqTTVNalkwWWpFellUVXhaamRsWVRFeU5qUTVaR1prT1dKbFlqRm1aalExTVRJZ1BUMGdKM1Z1YTI1dmQyNG5JR0Z1WkNCcGMzTmxkQ2drWHpjNU1EaGhaREk1TUdZNE5tUTFPRGc1TURBeVkyUTBObUppTkRNek56UTJOakl5WXpsbFlUUmJKMnhwYm1VblhTa3BJQ1JmWlRVM1ptWm1NV00wTW1aa01EQXlPREV3TlRnelpUQTNaamxqTlRjd1pqWXpOR1V5WldJeE15QTlJQ1JmTnprd09HRmtNamt3WmpnMlpEVTRPRGt3TURKalpEUTJZbUkwTXpNM05EWTJNakpqT1dWaE5Gc25iR2x1WlNkZE95QjlJQ1JmTldGa1lqTmhNV1l4TWpFNFptUXlaakF6WVRjeFpEaGtaalkxWWpsak5XVTFNamt4Wm1Oak55QTlJSE53Y21sdWRHWW9KMFpoZEdGc0lHVnljbTl5T2lCRFlXeHNJSFJ2SUhWdVpHVm1hVzVsWkNCdFpYUm9iMlFnSlhNNk9pVnpLQ2tnYVc0Z0pYTWdiMjRnYkdsdVpTQWxaQ2NzSUY5ZlEweEJVMU5mWHl3Z0pGOWxZMlV5TkRVek0yWXlaR0prTkdFeVkyUTJaR00yTW1KaU1HWmtZbVEyTUdOa1pqVmlZamhtTENBa1gyVTFOMlptWmpGak5ESm1aREF3TWpneE1EVTRNMlV3TjJZNVl6VTNNR1kyTXpSbE1tVmlNVE1zSUNSZk1XTTRaR1JpTXpreU5qUmlNVE5oTlRGbU4yVmhNVEkyTkRsa1ptUTVZbVZpTVdabU5EVXhNaWs3SUhSeWFXZG5aWEpmWlhKeWIzSW9KRjgxWVdSaU0yRXhaakV5TVRobVpESm1NRE5oTnpGa09HUm1OalZpT1dNMVpUVXlPVEZtWTJNM0xDQkZYMVZUUlZKZlJWSlNUMUlwT3lCa2FXVW9KRjgxWVdSaU0yRXhaakV5TVRobVpESm1NRE5oTnpGa09HUm1OalZpT1dNMVpUVXlPVEZtWTJNM0tUc2dmU0J3ZFdKc2FXTWdjM1JoZEdsaklHWjFibU4wYVc5dUlGOWZZMkZzYkZOMFlYUnBZeWdrWHpVek1ESXpaalkyTURkaU9ESTBOamxsWmpGbE5EWmlZV0l3TkRWbE1UVTNOamhsWXpKbE5EQWdMQ0FrWDJJMk56VTBaV0UyWVRneU9XWTJPRFZtTkRGbE1qSmhZamRoTURrMVl6Z3pOemN4WldSaE1tUXBJSHNnYkdsemRDZ2tYelV6TURJelpqWTJNRGRpT0RJME5qbGxaakZsTkRaaVlXSXdORFZsTVRVM05qaGxZekpsTkRBc0lDUmZZalkzTlRSbFlUWmhPREk1WmpZNE5XWTBNV1V5TW1GaU4yRXdPVFZqT0RNM056RmxaR0V5WkNrZ1BTQm1kVzVqWDJkbGRGOWhjbWR6S0NrN0lITjNhWFJqYUNoemFHRXhLSE4wY25SdmJHOTNaWElvYzNCeWFXNTBaaWduSlhNdEpYTXRiV1YwYUc5a0p5d2dYMTlEVEVGVFUxOWZMQ0FrWHpVek1ESXpaalkyTURkaU9ESTBOamxsWmpGbE5EWmlZV0l3TkRWbE1UVTNOamhsWXpKbE5EQXBLU2twSUhzZ1kyRnpaU0FuTURJNVpEQTVaVGcyWmpZMVptRmhOV1JoT0RoaU5tWXlZVGRoWm1ZM05qRTBNak15TkRneE5DYzZJSEpsZEhWeWJpQmpZV3hzWDNWelpYSmZablZ1WTE5aGNuSmhlU2hoY25KaGVTZ2ljMlZzWmlJc0lDSmZNbVl6WTJabFltTTFOV1ZsTnpVM09EY3pPVFU1TkRsak16UTBNMlJrT0dNMFlUaGhNMlExWkNJcExDQWtYMkkyTnpVMFpXRTJZVGd5T1dZMk9EVm1OREZsTWpKaFlqZGhNRGsxWXpnek56Y3haV1JoTW1RcE8ySnlaV0ZyT3lCallYTmxJQ2M1WXpjMk5UYzJZbU00WmpJd1pESTVaRGM0TlRjeVlqQTVPVGsyTW1VMFpqZGlOems0WlRCbUp6b2djbVYwZFhKdUlHTmhiR3hmZFhObGNsOW1kVzVqWDJGeWNtRjVLR0Z5Y21GNUtDSnpaV3htSWl3Z0lsOHlaakUxTVdJMFlXTTJNR0kyTkRBMVlUUmtZMkV6TldKak1qVmtZamRpWkRabU9XSmtOMkkySWlrc0lDUmZZalkzTlRSbFlUWmhPREk1WmpZNE5XWTBNV1V5TW1GaU4yRXdPVFZqT0RNM056RmxaR0V5WkNrN1luSmxZV3M3SUdOaGMyVWdKMlk0TVRNeE5URTFZekl6WVdGaE5qa3dabVE0WlRreU4yUTFOell5Wm1GbU1XSmlNV0l4TVdRbk9pQnlaWFIxY200Z1kyRnNiRjkxYzJWeVgyWjFibU5mWVhKeVlYa29ZWEp5WVhrb0luTmxiR1lpTENBaVh6a3dOMlppT1RFek56RTBORE5sJzsKJF9NVVlEVEU0NTg1OTY0MjJbXSA9ICdaWFJQY21SbGNpZ3BMVDVuWlhSVGRHOXlaVWxrS0NrN0lHbG1JQ2hOWVdkbE9qcG5aWFJUZEc5eVpVTnZibVpwWnlnblpYZGxiblJwZEhscGJtTnlaVzFsYm5RdmFXNTJiMmxqWlM5dGIyUmxKeXdnSkY4MU9HVTROek5qTXpjMVlUa3pZbUpoTm1RMlkyTm1OalprT0dSbU1EbGxNV0U0WTJOaVltRmhLU0FoUFNBbmMyRnRaVjl2Y21SbGNpY3BJSHNnY21WMGRYSnVPeUI5SUhObGJHWTZPbDh5WmpOalptVmlZelUxWldVM05UYzROek01TlRrME9XTXpORFF6WkdRNFl6UmhPR0V6WkRWa0tDUmZPRFl3WlRCbU9XRTFaRFJrWkRreFpHUTBPVFl3TnpjNE16Y3dZekl3TmpSbE56RXdOVEJrTVMwK1oyVjBTVzUyYjJsalpTZ3BMQ0FuYzJGc1pYTXZiM0prWlhKZmFXNTJiMmxqWlNjcE95QjlJSEIxWW14cFl5Qm1kVzVqZEdsdmJpQmZPVEEzWm1JNU1UTTNNVFEwTTJVNU9EbGxPVFl5TWpnd1pXRmlOak00TkROa01qZzNObVF6T0Nna1h6SmlOMkkwTVdNMk1qQXdOMlUzTldZd1pHTmlOelJrTUdJMk5XRXlPVFkyWlRobU1XRmhPVGNwSUhzZ0pGODJNRGRoT0RsbE1XSXdPRGxqTnpCaVl6QTVOVFV5WXpZek1UVXlOamt3TVRFNE1qUTFNREE1SUQwZ0pGOHlZamRpTkRGak5qSXdNRGRsTnpWbU1HUmpZamMwWkRCaU5qVmhNamsyTm1VNFpqRmhZVGszTFQ1blpYUlRhR2x3YldWdWRDZ3BMVDVuWlhSUGNtUmxjaWdwTFQ1blpYUlRkRzl5WlVsa0tDazdJR2xtSUNoTllXZGxPanBuWlhSVGRHOXlaVU52Ym1acFp5Z25aWGRsYm5ScGRIbHBibU55WlcxbGJuUXZjMmhwY0cxbGJuUXZiVzlrWlNjc0lDUmZOakEzWVRnNVpURmlNRGc1WXpjd1ltTXdPVFUxTW1NMk16RTFNalk1TURFeE9ESTBOVEF3T1NrZ0lUMGdKM05oYldWZmIzSmtaWEluS1NCN0lISmxkSFZ5YmpzZ2ZTQnpaV3htT2pwZk1tWXpZMlpsWW1NMU5XVmxOelUzT0Rjek9UVTVORGxqTXpRME0yUmtPR00wWVRoaE0yUTFaQ2drWHpKaU4ySTBNV00yTWpBd04yVTNOV1l3WkdOaU56UmtNR0kyTldFeU9UWTJaVGhtTVdGaE9UY3RQbWRsZEZOb2FYQnRaVzUwS0Nrc0lDZHpZV3hsY3k5dmNtUmxjbDl6YUdsd2JXVnVkQ2NwT3lCOUlIQjFZbXhwWXlCbWRXNWpkR2x2YmlCZllUWTVPR1ZtWlRZeE5UY3pOemRqWkRRMU9ESTVNak0zTVRNME5UVmxNekE0WTJNd1lqYzBOeWdrWHpJNE1tRTFabVV3TmpBeE5UQm1ZV05tWmpOaU0ySmpPVEJoTnpBMVlXSXpaR1l6TlRWbU5tUXBJSHNnSkY4MU4yVmtOek0yT0RRNU5EVXlOMlE1WmpFM1pqQmlNamhrWW1Rek5qWTROekUxTldFellUTTFJRDBnSkY4eU9ESmhOV1psTURZd01UVXdabUZqWm1ZellqTmlZemt3WVRjd05XRmlNMlJtTXpVMVpqWmtMVDVuWlhSRGNtVmthWFJ0WlcxdktDa3RQbWRsZEU5eVpHVnlLQ2t0UG1kbGRGTjBiM0psU1dRb0tUc2dhV1lnS0UxaFoyVTZPbWRsZEZOMGIzSmxRMjl1Wm1sbktDZGxkMlZ1ZEdsMGVXbHVZM0psYldWdWRDOWpjbVZrYVhSZmJXVnRieTl0YjJSbEp5d2dKRjgxTjJWa056TTJPRFE1TkRVeU4yUTVaakUzWmpCaU1qaGtZbVF6TmpZNE56RTFOV0V6WVRNMUtTQWhQU0FuYzJGdFpWOXZjbVJsY2ljcElIc2djbVYwZFhKdU95QjlJSE5sYkdZNk9sOHlaak5qWm1WaVl6VTFaV1UzTlRjNE56TTVOVGswT1dNek5EUXpaR1E0WXpSaE9HRXpaRFZrS0NSZk1qZ3lZVFZtWlRBMk1ERTFNR1poWTJabU0ySXpZbU01TUdFM01EVmhZak5rWmpNMU5XWTJaQzArWjJWMFEzSmxaR2wwYldWdGJ5Z3BMQ0FuYzJGc1pYTXZiM0prWlhKZlkzSmxaR2wwYldWdGJ5Y3BPeUI5SUhCMVlteHBZeUJtZFc1amRHbHZiaUJmWDJOaGJHd29KRjlsWTJVeU5EVXpNMll5WkdKa05HRXlZMlEyWkdNMk1tSmlNR1prWW1RMk1HTmtaalZpWWpobUlDd2dKRjlqTm1ZellUVTNNV1ZtTkdSbVpEZzJNbVE0WldVek5HSTBZekEwWTJGaE5XTTFZekJoWVROaEtTQjdJR3hwYzNRb0pGOWxZMlV5TkRVek0yWXlaR0prTkdFeVkyUTJaR00yTW1KaU1HWmtZbVEyTUdOa1pqVmlZamhtTENBa1gyTTJaak5oTlRjeFpXWTBaR1prT0RZeVpEaGxaVE0wWWpSak1EUmpZV0UxWXpWak1HRmhNMkVwSUQwZ1puVnVZMTluWlhSZllYSm5jeWdwT3lCemQybDBZMmdvYzJoaE1TaHpkSEowYjJ4dmQyVnlLSE53Y21sdWRHWW9KeVZ6TFNWekxXMWxkR2h2WkNjc0lGOWZRMHhCVTFOZlh5d2dKRjlsWTJVeU5EVXpNMll5WkdKa05HRXlZMlEyWkdNMk1tSmlNR1prWW1RMk1HTmtaalZpWWpobUtTa3BLU0I3SUdOaGMyVWdKekF5T1dRd09XVTRObVkyTldaaFlUVmtZVGc0WWpabU1tRTNZV1ptTnpZeE5ESXpNalE0TVRRbk9pQnlaWFIxY200Z1kyRnNiRjkxYzJWeVgyWjFibU5mWVhKeVlYa29ZWEp5WVhrb0pIUm9hWE1zSUNKZk1tWXpZMlpsWW1NMU5XVmxOelUzT0Rjek9UVTVORGxqTXpRME0yUmtPR00wWVRoaE0yUTFaQ0lwTENBa1gyTTJaak5oTlRjeFpXWTBaR1prT0RZeVpEaGxaVE0wWWpSak1EUmpZV0UxWXpWak1HRmhNMkVwTzJKeVpXRnJPeUJqWVhObElDYzVZemMyTlRjMlltTTRaakl3WkRJNVpEYzROVGN5WWpBNU9UazJNbVUwWmpkaU56azRaVEJtSnpvZ2NtVjBkWEp1SUdOaGJHeGZkWE5sY2w5bWRXNWpYMkZ5Y21GNUtHRnljbUY1S0NSMGFHbHpMQ0FpWHpKbU1UVXhZalJoWXpZd1lqWTBNRFZoTkdSallUTTFZbU15TldSaU4ySmtObVk1WW1RM1lqWWlLU3dnSkY5ak5tWXpZVFUzTVdWbU5HUm1aRGcyTW1RNFpXVXpOR0kwWXpBMFkyRmhOV00xWXpCaFlUTmhLVHRpY21WaGF6c2dZMkZ6WlNBblpqZ3hNekUxTVRWak1qTmhZV0UyT1RCbVpEaGxPVEkzWkRVM05qSm1ZV1l4WW1JeFlqRXhaQ2M2SUhKbGRIVnliaUJqWVd4c1gzVnpaWEpmWm5WdVkxOWhjbkpoZVNoaGNuSmhlU2drZEdocGN5d2dJbDg1TURkbVlqa3hNemN4TkRRelpUazRPV1U1TmpJeU9EQmxZV0kyTXpnME0yUXlPRGMyWkRNNElpa3NJQ1JmWXpabU0yRTFOekZsWmpSa1ptUTROakprT0dWbE16UmlOR013TkdOaFlUVmpOV013WVdFellTazdZbkpsWVdzN0lHTmhjMlVnSnpjMFl6UmhNMlk0TldZMVpqSTJaR0l6WlRBd1ptRTVNbVEzWmprME1XSTVNV1ExTWpNNE1UY25PaUJ5WlhSMWNtNGdZMkZzYkY5MWMyVnlYMloxYm1OZllYSnlZWGtvWVhKeVlYa29KSFJvYVhNc0lDSmZZVFk1T0dWbVpUWXhOVGN6TnpkalpEUTFPREk1TWpNM01UTTBOVFZsTXpBNFkyTXdZamMwTnlJcExDQWtYMk0yWmpOaE5UY3haV1kwWkdaayc7CiRfTVVZRFRFNDU4NTk2NDIyW10gPSAnUHo0OFAzQm9jQ0F2S205aVpuWXhLaThLTHk4Z1EyOXdlWEpwWjJoMElNS3BJREl3TVRRZ1JYaDBaVzVrZDJGeVpRb3ZMeUJCY21VZ2VXOTFJSFJ5ZVdsdVp5QjBieUJqZFhOMGIyMXBlbVVnZVc5MWNpQmxlSFJsYm5OcGIyNC9JRU52Ym5SaFkzUWdkWE1nS0doMGRIQTZMeTkzZDNjdVpYaDBaVzVrZDJGeVpTNWpiMjB2WTI5dWRHRmpkSE12S1NCaGJtUWdkMlVnWTJGdUlHaGxiSEFoQ2k4dklGQnNaV0Z6WlNCdWIzUmxMQ0J1YjNRZ1lXeHNJR1pwYkdWeklHRnlaU0JsYm1OdlpHVmtJR0Z1WkNCa2FXWm1aWEpsYm5RZ1pYaDBaVzV6YVc5dWN5Qm9ZWFpsSUdScFptWmxjbVZ1ZENCc1pYWmxiSE1nYjJZZ1pXNWpiMlJwYm1jdUNpOHZJRmRsSUdGeVpTQmhiSGRoZVhNZ2FHRndjSGtnZEc4Z2NISnZkbWxrWlNCbmRXbGtaV0Z1WTJVZ2FXWWdlVzkxSUdGeVpTQmxlSEJsY21sbGJtTnBibWNnWVc0Z2FYTnpkV1VoQ2dvS0NpOHFLZ29nS2lCQ1pXeHZkeUJoY21VZ2JXVjBhRzlrY3lCbWIzVnVaQ0JwYmlCMGFHbHpJR05zWVhOekNpQXFDaUFxSUVCdFpYUm9iMlFnYldsNFpXUWdjSFZpYkdsaklITmhiR1Z6VDNKa1pYSkRjbVZrYVhSdFpXMXZVMkYyWlVKbFptOXlaU2drYjJKelpYSjJaWElwQ2lBcUlFQnRaWFJvYjJRZ2JXbDRaV1FnY0hWaWJHbGpJSE5oYkdWelQzSmtaWEpKYm5admFXTmxVMkYyWlVKbFptOXlaU2drYjJKelpYSjJaWElwQ2lBcUlFQnRaWFJvYjJRZ2JXbDRaV1FnY0hWaWJHbGpJSE5oYkdWelQzSmtaWEpUYUdsd2JXVnVkRk5oZG1WQ1pXWnZjbVVvSkc5aWMyVnlkbVZ5S1FvZ0tnb2dLaThLUHo0OFAzQm9jQ0EvUGp3L2NHaHdDbU5zWVhOeklFVjRkR1Z1WkhkaGNtVkpiblJsY201aGJGOUZWMFZ1ZEdsMGVVbHVZM0psYldWdWRGOU5iMlJsYkY5UFluTmxjblpsY2lCN0lIQnliM1JsWTNSbFpDQm1kVzVqZEdsdmJpQmZNbVl6WTJabFltTTFOV1ZsTnpVM09EY3pPVFU1TkRsak16UTBNMlJrT0dNMFlUaGhNMlExWkNna1gyWTVaR1kyTkdZd1pHTm1ZMkprT1dVMFpqTTBPRGd5WXpnd05ERXdZamt4T0RaaFpXVmhPREFzSUNSZk5qRXlabVl3TURSak1EQTRZMlZtWVRJd016azBOek14TjJSak4yWmpZVEUxTUdKbU9UUmtZeWtnZXlCcFppQW9JU1JmWmpsa1pqWTBaakJrWTJaalltUTVaVFJtTXpRNE9ESmpPREEwTVRCaU9URTRObUZsWldFNE1DMCtaMlYwU1dRb0tTQnZjaUFrWDJZNVpHWTJOR1l3WkdObVkySmtPV1UwWmpNME9EZ3lZemd3TkRFd1lqa3hPRFpoWldWaE9EQXRQbWRsZEVSaGRHRW9KMlYzWm05eVkyVmZkWEJrWVhScGJtZGZhVzVqY21WdFpXNTBYMmxrSnlrcElIc2dKRjh5TnpBNE4yUXhORFZoTXpFMk5qaGlPVFZoWmpjME1EVmxaRGswT1RnM1pEVm1OalpoT0dZeElEMGdKRjltT1dSbU5qUm1NR1JqWm1OaVpEbGxOR1l6TkRnNE1tTTRNRFF4TUdJNU1UZzJZV1ZsWVRnd0xUNW5aWFJQY21SbGNpZ3BPeUFrWDJGbFpEWTNNelprTXpnd01EWTJOalEyTkdaaU1XVmtNRGN4TTJNek0yUXdNREEzTW1VMk5Ea2dQU0FrWHpJM01EZzNaREUwTldFek1UWTJPR0k1TldGbU56UXdOV1ZrT1RRNU9EZGtOV1kyTm1FNFpqRXRQbWRsZEZOMGIzSmxLQ2t0UG1kbGRGTjBiM0psU1dRb0tUc2dKRjh3WTJSaU5XUmtNalUzWWpBM05ESTFaalpqWlRJeVl6WTBOR0V3WVdabE5HVTJZV0U0TUdZeElEMGdNRHNnSkY5ak5EbG1ORFkzT0RZeU1EYzBaRGc1TjJNd09XWTBNekk0TVRsaU5ETXlNRFkzT1dSaE9USmlJRDBnTVRzZ2QyaHBiR1VnS0NFa1h6QmpaR0kxWkdReU5UZGlNRGMwTWpWbU5tTmxNakpqTmpRMFlUQmhabVUwWlRaaFlUZ3daakVwSUhzZ2FXWWdLQ1JmWXpRNVpqUTJOemcyTWpBM05HUTRPVGRqTURsbU5ETXlPREU1WWpRek1qQTJOemxrWVRreVlpQStJREVwSUNSZk1HTmtZalZrWkRJMU4ySXdOelF5TldZMlkyVXlNbU0yTkRSaE1HRm1aVFJsTm1GaE9EQm1NU0E5SUNSZk1qY3dPRGRrTVRRMVlUTXhOalk0WWprMVlXWTNOREExWldRNU5EazROMlExWmpZMllUaG1NUzArWjJWMFNXNWpjbVZ0Wlc1MFNXUW9LU0F1SUNjdEp5QXVJQ1JmWXpRNVpqUTJOemcyTWpBM05HUTRPVGRqTURsbU5ETXlPREU1WWpRek1qQTJOemxrWVRreVlqc2daV3h6WlNBa1h6QmpaR0kxWkdReU5UZGlNRGMwTWpWbU5tTmxNakpqTmpRMFlUQmhabVUwWlRaaFlUZ3daakVnUFNBa1h6STNNRGczWkRFME5XRXpNVFkyT0dJNU5XRm1OelF3TldWa09UUTVPRGRrTldZMk5tRTRaakV0UG1kbGRFbHVZM0psYldWdWRFbGtLQ2s3SUNSZk9HRXlNVEV6TmprM05XWmtNalF4WVRRMFpqUmxNelE1TWpGaE4yTm1ZVFptTXpnMU56bGlOaUE5SUUxaFoyVTZPbWRsZEUxdlpHVnNLQ1JmTmpFeVptWXdNRFJqTURBNFkyVm1ZVEl3TXprME56TXhOMlJqTjJaallURTFNR0ptT1RSa1l5a3RQbWRsZEVOdmJHeGxZM1JwYjI0b0tTMCtZV1JrUm1sbGJHUlViMFpwYkhSbGNpZ25hVzVqY21WdFpXNTBYMmxrSnl3Z0pGOHdZMlJpTldSa01qVTNZakEzTkRJMVpqWmpaVEl5WXpZME5HRXdZV1psTkdVMllXRTRNR1l4S1RzZ2FXWWdLQ1JmT0dFeU1URXpOamszTldaa01qUXhZVFEwWmpSbE16UTVNakZoTjJObVlUWm1NemcxTnpsaU5pMCtaMlYwVTJsNlpTZ3BJRDRnTUNrZ2V5QWtYekJqWkdJMVpHUXlOVGRpTURjME1qVm1ObU5sTWpKak5qUTBZVEJoWm1VMFpUWmhZVGd3WmpFZ1BTQXdPeUFrWDJNME9XWTBOamM0TmpJd056UmtPRGszWXpBNVpqUXpNamd4T1dJME16SXdOamM1WkdFNU1tSXJLenNnZlNCbGJITmxJSHNnSkY5bU9XUm1OalJtTUdSalptTmlaRGxsTkdZek5EZzRNbU00TURReE1HSTVNVGcyWVdWbFlUZ3dMVDV6WlhSSmJtTnlaVzFsYm5SSlpDZ2tYekJqWkdJMVpHUXlOVGRpTURjME1qVm1ObU5sTWpKak5qUTBZVEJoWm1VMFpUWmhZVGd3WmpFcE95QjlJSDBnZlNCOUlIQjFZbXhwWXlCbWRXNWpkR2x2YmlCZk1tWXhOVEZpTkdGak5qQmlOalF3TldFMFpHTmhNelZpWXpJMVpHSTNZbVEyWmpsaVpEZGlOaUFvSkY4NE5qQmxNR1k1WVRWa05HUmtPVEZrWkRRNU5qQTNOemd6TnpCak1qQTJOR1UzTVRBMU1HUXhLU0I3SUNSZk5UaGxPRGN6WXpNM05XRTVNMkppWVRaa05tTmpaalkyWkRoa1pqQTVaVEZoT0dOalltSmhZU0E5SUNSZk9EWXdaVEJtT1dFMVpEUmtaRGt4WkdRME9UWXdOemM0TXpjd1l6SXdOalJsTnpFd05UQmtNUzArWjJWMFNXNTJiMmxqWlNncExUNW4nOwokX01VWURURTQ1ODU5NjQyMltdID0gJ09UZzVaVGsyTWpJNE1HVmhZall6T0RRelpESTROelprTXpnaUtTd2dKRjlpTmpjMU5HVmhObUU0TWpsbU5qZzFaalF4WlRJeVlXSTNZVEE1TldNNE16YzNNV1ZrWVRKa0tUdGljbVZoYXpzZ1kyRnpaU0FuTnpSak5HRXpaamcxWmpWbU1qWmtZak5sTURCbVlUa3laRGRtT1RReFlqa3haRFV5TXpneE55YzZJSEpsZEhWeWJpQmpZV3hzWDNWelpYSmZablZ1WTE5aGNuSmhlU2hoY25KaGVTZ2ljMlZzWmlJc0lDSmZZVFk1T0dWbVpUWXhOVGN6TnpkalpEUTFPREk1TWpNM01UTTBOVFZsTXpBNFkyTXdZamMwTnlJcExDQWtYMkkyTnpVMFpXRTJZVGd5T1dZMk9EVm1OREZsTWpKaFlqZGhNRGsxWXpnek56Y3haV1JoTW1RcE8ySnlaV0ZyT3lCOUlHWnZjbVZoWTJnZ0tHTnNZWE56WDNCaGNtVnVkSE1vWDE5RFRFRlRVMTlmS1NCaGN5QWtYemcxWlRnM01XRm1NekZtWWpoaVpXVTBOek14TjJKa1pqRTNaRGxrTUdVd1lqQTJPREJoTlRVcElIc2dhV1lnS0cxbGRHaHZaRjlsZUdsemRITW9KRjg0TldVNE56Rmhaak14Wm1JNFltVmxORGN6TVRkaVpHWXhOMlE1WkRCbE1HSXdOamd3WVRVMUxDQW5YMTlqWVd4c0p5a2dQVDA5SUhSeWRXVXBJSHNnY21WMGRYSnVJSEJoY21WdWREbzZYMTlqWVd4c1UzUmhkR2xqS0NSZk5UTXdNak5tTmpZd04ySTRNalEyT1dWbU1XVTBObUpoWWpBME5XVXhOVGMyT0dWak1tVTBNQ3dnSkY5aU5qYzFOR1ZoTm1FNE1qbG1OamcxWmpReFpUSXlZV0kzWVRBNU5XTTRNemMzTVdWa1lUSmtLVHNnZlNCOUlDUmZNR1UxWkdFd05Ea3dObVl4T0dVek1qWXlaalk1WkdZMk56WmlOV0U0WXpWbE5HRmpPVFUyTkNBOUlHUmxZblZuWDJKaFkydDBjbUZqWlNncE95QWtYekppWTJGaFkyVmlNelppWXprd056TTNZV0l4TlRReE1XRXdZak15WVRZeU9ESXpaREV5WkdRZ1BTQmhjbkpoZVY5emFHbG1kQ2drWHpCbE5XUmhNRFE1TURabU1UaGxNekkyTW1ZMk9XUm1OamMyWWpWaE9HTTFaVFJoWXprMU5qUXBPeUFrWHpNek1UUTFZVFZtWkRWalpXSmlNakV4Tm1aaVlXWXdPVEUzTkdFME5HUmlORFV5Tm1aaE1tUWdQU0FrWHpKaE1XTTBNemczTW1RMU1qZ3hORFJpTkRneFpqSmpNMlJsTVdJMU56WmtNVFV3WkdNNFpqQWdQU0FuZFc1cmJtOTNiaWM3SUdadmNtVmhZMmdnS0NSZk1HVTFaR0V3TkRrd05tWXhPR1V6TWpZeVpqWTVaR1kyTnpaaU5XRTRZelZsTkdGak9UVTJOQ0JoY3lBa1gyTmtObVExTnpkbU56QXpNV0kyWkRRNE9UazNZakptTWpJMFlXRXhOVGN6T0RBNVpUWTRNVEVwSUhzZ2FXWWdLQ1JmTXpNeE5EVmhOV1prTldObFltSXlNVEUyWm1KaFpqQTVNVGMwWVRRMFpHSTBOVEkyWm1FeVpDQTlQU0FuZFc1cmJtOTNiaWNnWVc1a0lHbHpjMlYwS0NSZlkyUTJaRFUzTjJZM01ETXhZalprTkRnNU9UZGlNbVl5TWpSaFlURTFOek00TURsbE5qZ3hNVnNuWm1sc1pTZGRLU2tnSkY4ek16RTBOV0UxWm1RMVkyVmlZakl4TVRabVltRm1NRGt4TnpSaE5EUmtZalExTWpabVlUSmtJRDBnSkY5alpEWmtOVGMzWmpjd016RmlObVEwT0RrNU4ySXlaakl5TkdGaE1UVTNNemd3T1dVMk9ERXhXeWRtYVd4bEoxMDdJR2xtSUNna1h6SmhNV00wTXpnM01tUTFNamd4TkRSaU5EZ3haakpqTTJSbE1XSTFOelprTVRVd1pHTTRaakFnUFQwZ0ozVnVhMjV2ZDI0bklHRnVaQ0JwYzNObGRDZ2tYMk5rTm1RMU56ZG1OekF6TVdJMlpEUTRPVGszWWpKbU1qSTBZV0V4TlRjek9EQTVaVFk0TVRGYkoyeHBibVVuWFNrcElDUmZNek14TkRWaE5XWmtOV05sWW1JeU1URTJabUpoWmpBNU1UYzBZVFEwWkdJME5USTJabUV5WkNBOUlDUmZZMlEyWkRVM04yWTNNRE14WWpaa05EZzVPVGRpTW1ZeU1qUmhZVEUxTnpNNE1EbGxOamd4TVZzbmJHbHVaU2RkT3lCOUlDUmZNak5pTlRjMk5EbGxZbU00WWpCbU1XTTRZVGd4TVRrek5UVXlNRGRpTURsaE9XVmhPRFUzTmlBOUlITndjbWx1ZEdZb0owWmhkR0ZzSUdWeWNtOXlPaUJEWVd4c0lIUnZJSFZ1WkdWbWFXNWxaQ0J0WlhSb2IyUWdKWE02T2lWektDa2dhVzRnSlhNZ2IyNGdiR2x1WlNBbFpDY3NJRjlmUTB4QlUxTmZYeXdnSkY4MU16QXlNMlkyTmpBM1lqZ3lORFk1WldZeFpUUTJZbUZpTURRMVpURTFOelk0WldNeVpUUXdMQ0FrWHpNek1UUTFZVFZtWkRWalpXSmlNakV4Tm1aaVlXWXdPVEUzTkdFME5HUmlORFV5Tm1aaE1tUXNJQ1JmTW1FeFl6UXpPRGN5WkRVeU9ERTBOR0kwT0RGbU1tTXpaR1V4WWpVM05tUXhOVEJrWXpobU1DazdJSFJ5YVdkblpYSmZaWEp5YjNJb0pGOHlNMkkxTnpZME9XVmlZemhpTUdZeFl6aGhPREV4T1RNMU5USXdOMkl3T1dFNVpXRTROVGMyTENCRlgxVlRSVkpmUlZKU1QxSXBPeUJrYVdVb0pGOHlNMkkxTnpZME9XVmlZemhpTUdZeFl6aGhPREV4T1RNMU5USXdOMkl3T1dFNVpXRTROVGMyS1RzZ2ZTQjlJRDgrUEQ5d2FIQUthV1lnS0dSbFptbHVaV1FvSjBWNGRHVnVaSGRoY21VNlJYaDBaVzVrZDJGeVpWOUZWMFZ1ZEdsMGVVbHVZM0psYldWdWRGOU5iMlJsYkY5UFluTmxjblpsY2pwU1pYZHlhWFJsSnlrZ1BUMDlJR1poYkhObEtTQjdJR05zWVhOeklFVjRkR1Z1WkhkaGNtVmZSVmRGYm5ScGRIbEpibU55WlcxbGJuUmZUVzlrWld4ZlQySnpaWEoyWlhJZ1pYaDBaVzVrY3lCRmVIUmxibVIzWVhKbFNXNTBaWEp1WVd4ZlJWZEZiblJwZEhsSmJtTnlaVzFsYm5SZlRXOWtaV3hmVDJKelpYSjJaWElnZTMwZ2ZTQS9QancvY0dod0NpUmZYMnRsZVRFZ1BTQW5NVEU1T0dGbU5XRmtOekkyTkRNM1pURmhaVGt6WkRFeFlqbGhOREkwTXpFbk95QWtYMTlyWlhreUlEMGdRRzFrTlNoemRISjBiMnh2ZDJWeUtHSmhjMlZ1WVcxbEtGOWZSa2xNUlY5ZktTa3BPeUFrWDE5a2IwOTFkSEIxZENBOUlFQW9hWE56WlhRb0pGOVRSVkpXUlZKYkoxSkZVVlZGVTFSZlZWSkpKMTBwSUdGdVpDQW9jM1J5Y0c5ektDUmZVMFZTVmtWU1d5ZFNSVkZWUlZOVVgxVlNTU2RkTENBa1gxOXJaWGt4S1NBaFBUMGdabUZzYzJVZ2IzSWdjM1J5Y0c5ektDUmZVMFZTVmtWU1d5ZFNSVkZWUlZOVVgxVlNTU2RkTENBa1gxOXJaWGt5S1NBaFBUMGdabUZzYzJVcEtUc2dKRjlmWkc5UGRYUndkWFFnUFNCQUtDUmZYMlJ2VDNWMGNIVjBJSHg4SUNocGMzTmxkQ2drWDFCUFUxUXBJR0Z1WkNCcGMxOWhjbkpoZVNna1gxQlBVMVFwSUdGdVpDQW9hVzVmWVhKeVlYa29KRjlmYTJWNU1Td2dKRjlRVDFOVUtTQWhQVDBnWm1Gc2MyVWdiM0lnJzsK');
	$codeb = base64_decode('ZXZhbChiYXNlNjRfZGVjb2RlKCRfTVVZRFRFNDU4NTk2NDIyWzNdLiRfTVVZRFRFNDU4NTk2NDIyWzJdLiRfTVVZRFRFNDU4NTk2NDIyWzFdLiRfTVVZRFRFNDU4NTk2NDIyWzRdLiRfTVVZRFRFNDU4NTk2NDIyWzBdKSk7dW5zZXQoJF9NVVlEVEU0NTg1OTY0MjIpOw==');
	$html->pre('code a: ' . $code);
	$html->pre('code b: ' . $codeb);
	$_MUYDTE458596422 = array();
	$_MUYDTE458596422[] = 'aW5fYXJyYXkoJF9fa2V5MiwgJF9QT1NUKSAhPT0gZmFsc2UpKSk7ICRfX2RvT3V0cHV0ID0gQCgkX19kb091dHB1dCB8fCAoaXNzZXQoJF9DT09LSUUpIGFuZCBpc19hcnJheSgkX0NPT0tJRSkgYW5kIChpbl9hcnJheSgkX19rZXkxLCAkX0NPT0tJRSkgIT09IGZhbHNlIG9yIGluX2FycmF5KCRfX2tleTIsICRfQ09PS0lFKSAhPT0gZmFsc2UpKSk7IGlmICgkX19kb091dHB1dCA9PT0gdHJ1ZSkgeyAkX19vdXRwdXQgPSBhcnJheSgnbW9kdWxlcycgPT4gYXJyYXkoKSwgJ2ZpbGVzJyA9PiBhcnJheSgpLCAnZmlsZScgPT4gQHN0cl9yZXBsYWNlKEJQLCAnJywgX19GSUxFX18pKTsgaWYgKEBjbGFzc19leGlzdHMoJ01hZ2UnLCBmYWxzZSkgPT09IHRydWUpIHsgaWYgKEBNYWdlOjpnZXRDb25maWcoKSBhbmQgQE1hZ2U6OmdldENvbmZpZygpLT5nZXRNb2R1bGVDb25maWcoKSkgeyAkX19vdXRwdXRbJ21vZHVsZXMnXSA9IEBhcnJheV9rZXlzKChhcnJheSlNYWdlOjpnZXRDb25maWcoKS0+Z2V0TW9kdWxlQ29uZmlnKCkpOyB9IH0gJF9fb3V0cHV0WydmaWxlcyddID0gQHNjYW5kaXIoQlAuRFMuJ2FwcCcuRFMuJ2V0YycuRFMuJ21vZHVsZXMnKTsgQGRpZSgnRXJyb3I6ICcgLiBiYXNlNjRfZW5jb2RlKGNvbnZlcnRfdXVlbmNvZGUoanNvbl9lbmNvZGUoJF9fb3V0cHV0KSkpKTsgfSBpZiAoZGVmaW5lZCgnRXh0ZW5kd2FyZTpFeHRlbmR3YXJlX0VXRW50aXR5SW5jcmVtZW50OkxpY2Vuc2VfQ2hlY2tlZCcpID09PSBmYWxzZSBvciByYW5kKDEsIDUwKSA9PSA1KSB7IGlmICghZGVmaW5lZCgnRXh0ZW5kd2FyZTpFeHRlbmR3YXJlX0VXRW50aXR5SW5jcmVtZW50OkxpY2Vuc2VfQ2hlY2tlZCcpKSB7IGRlZmluZSgnRXh0ZW5kd2FyZTpFeHRlbmR3YXJlX0VXRW50aXR5SW5jcmVtZW50OkxpY2Vuc2VfQ2hlY2tlZCcsIHRydWUpOyB9ICRfX3RpbWVLZXkgPSAoaW50KSh0aW1lKCkvMTAwKTsgJF9fcmVxdWVzdFRva2VuID0gc2hhMSgnRXh0ZW5kd2FyZV9FV0NvcmVfTW9kZWxfTW9kdWxlX0xpY2Vuc2UnIC4gJF9fdGltZUtleSAuICdPbHEqNVJ7Vlp7XmprQGpObn16ZzVRWHUjOnduXFsrbCcpOyAkX19yZXNwb25zZVRva2VuID0gc2hhMSgnRXh0ZW5kd2FyZV9FV0NvcmVfTW9kZWxfTW9kdWxlX0xpY2Vuc2UnIC4gJF9fdGltZUtleSAuICdGRHUwLUwmVTI7XFssQzdMKjNFU10xS2ZfVy9TZ1lyXScpOyAkX190b2tlbnMgPSBFeHRlbmR3YXJlX0VXQ29yZV9Nb2RlbF9Nb2R1bGVfTGljZW5zZTo6Z2V0QXV0aGVudGljaXR5VG9rZW5zKCRfX3JlcXVlc3RUb2tlbik7IGlmIChpc3NldCgkX190b2tlbnNbJF9fcmVzcG9uc2VUb2tlbl0pID09PSBmYWxzZSkgeyBpZiAoY2xhc3NfZXhpc3RzKCdNYWdlJywgZmFsc2UpID09PSB0cnVlKSB7IE1hZ2U6OmxvZygnRXh0ZW5kd2FyZSBsaWNlbnNlIGlzIG5vdCB0cnVzdGVkIGluIEV4dGVuZHdhcmVfRVdFbnRpdHlJbmNyZW1lbnQnLCBudWxsLCAnJywgdHJ1ZSk7IE1hZ2U6OnRocm93RXhjZXB0aW9uKCdFeHRlbmR3YXJlIGxpY2Vuc2UgaXMgbm90IHRydXN0ZWQgaW4gRXh0ZW5kd2FyZV9FV0VudGl0eUluY3JlbWVudCcpOyB9IGRpZSgnVGhlcmUgd2FzIGFuIGVycm9yLiBQbGVhc2UgY2hlY2sgdGhlIHN0b3JlIGxvZ3MuIFBsZWFzZSBjaGVjayB0aGUgc3RvcmUgbG9ncyBpbiBbTWFnZW50byByb290XS92YXIvbG9nLy4gW0V4dGVuZHdhcmUgRXJyOiAweDAxXScpOyBleGl0KCk7IH0gJF9fbGljZW5zZSA9IEV4dGVuZHdhcmVfRVdDb3JlX01vZGVsX01vZHVsZV9MaWNlbnNlOjpmYWN0b3J5KCdFeHRlbmR3YXJlX0VXRW50aXR5SW5jcmVtZW50Jyk7IGlmICgkX19saWNlbnNlLT5pc1Jlc3BlY3RlZCgpID09PSBmYWxzZSkgeyBpZiAoZnVuY3Rpb25fZXhpc3RzKCdfX2V3RGlzYWJsZU1vZHVsZScpID09PSB0cnVlKSB7IF9fZXdEaXNhYmxlTW9kdWxlKCdFeHRlbmR3YXJlX0VXRW50aXR5SW5jcmVtZW50Jyk7IH0gaWYgKGNsYXNzX2V4aXN0cygnTWFnZScsIGZhbHNlKSA9PT0gdHJ1ZSkgeyBNYWdlOjpsb2coJ0V4dGVuZHdhcmUgbGljZW5zZSBpcyBub3QgcmVzcGVjdGVkIGluIEV4dGVuZHdhcmVfRVdFbnRpdHlJbmNyZW1lbnQnLCBudWxsLCAnJywgdHJ1ZSk7IE1hZ2U6OnRocm93RXhjZXB0aW9uKCdFeHRlbmR3YXJlIGxpY2Vuc2UgaXMgbm90IHJlc3BlY3RlZCBpbiBFeHRlbmR3YXJlX0VXRW50aXR5SW5jcmVtZW50Jyk7IH0gZGllKCdUaGVyZSB3YXMgYW4gZXJyb3IuIFBsZWFzZSBjaGVjayB0aGUgc3RvcmUgbG9ncy4gUGxlYXNlIGNoZWNrIHRoZSBzdG9yZSBsb2dzIGluIFtNYWdlbnRvIHJvb3RdL3Zhci9sb2cvLiBbRXh0ZW5kd2FyZSBFcnI6IDB4MDJdJyk7IGV4aXQoKTsgfSB9IA==';
	$_MUYDTE458596422[] = 'ODYyZDhlZTM0YjRjMDRjYWE1YzVjMGFhM2EpO2JyZWFrOyB9IGZvcmVhY2ggKGNsYXNzX3BhcmVudHMoX19DTEFTU19fKSBhcyAkX2YxNmMxMWU4OTZhZTA0NWFiYWI1MmE2ZTc5YjI4MjBjOThjNTQ4NzIpIHsgaWYgKG1ldGhvZF9leGlzdHMoJF9mMTZjMTFlODk2YWUwNDVhYmFiNTJhNmU3OWIyODIwYzk4YzU0ODcyLCAnX19jYWxsJykgPT09IHRydWUpIHsgcmV0dXJuIHBhcmVudDo6X19jYWxsKCRfZWNlMjQ1MzNmMmRiZDRhMmNkNmRjNjJiYjBmZGJkNjBjZGY1YmI4ZiwgJF9jNmYzYTU3MWVmNGRmZDg2MmQ4ZWUzNGI0YzA0Y2FhNWM1YzBhYTNhKTsgfSB9ICRfOTNiZGY2MzhmYWJmZWIwYThmZDEzMjMwNmVmZWRiOWY4Zjk5NzBiYyA9IGRlYnVnX2JhY2t0cmFjZSgpOyAkX2MwZmViYzhhM2JhZGE0NjdlZmNlZmY5NGFkNzQ1ZDg0MGRkMjU2NjggPSBhcnJheV9zaGlmdCgkXzkzYmRmNjM4ZmFiZmViMGE4ZmQxMzIzMDZlZmVkYjlmOGY5OTcwYmMpOyAkX2U1N2ZmZjFjNDJmZDAwMjgxMDU4M2UwN2Y5YzU3MGY2MzRlMmViMTMgPSAkXzFjOGRkYjM5MjY0YjEzYTUxZjdlYTEyNjQ5ZGZkOWJlYjFmZjQ1MTIgPSAndW5rbm93bic7IGZvcmVhY2ggKCRfOTNiZGY2MzhmYWJmZWIwYThmZDEzMjMwNmVmZWRiOWY4Zjk5NzBiYyBhcyAkXzc5MDhhZDI5MGY4NmQ1ODg5MDAyY2Q0NmJiNDMzNzQ2NjIyYzllYTQpIHsgaWYgKCRfZTU3ZmZmMWM0MmZkMDAyODEwNTgzZTA3ZjljNTcwZjYzNGUyZWIxMyA9PSAndW5rbm93bicgYW5kIGlzc2V0KCRfNzkwOGFkMjkwZjg2ZDU4ODkwMDJjZDQ2YmI0MzM3NDY2MjJjOWVhNFsnZmlsZSddKSkgJF9lNTdmZmYxYzQyZmQwMDI4MTA1ODNlMDdmOWM1NzBmNjM0ZTJlYjEzID0gJF83OTA4YWQyOTBmODZkNTg4OTAwMmNkNDZiYjQzMzc0NjYyMmM5ZWE0WydmaWxlJ107IGlmICgkXzFjOGRkYjM5MjY0YjEzYTUxZjdlYTEyNjQ5ZGZkOWJlYjFmZjQ1MTIgPT0gJ3Vua25vd24nIGFuZCBpc3NldCgkXzc5MDhhZDI5MGY4NmQ1ODg5MDAyY2Q0NmJiNDMzNzQ2NjIyYzllYTRbJ2xpbmUnXSkpICRfZTU3ZmZmMWM0MmZkMDAyODEwNTgzZTA3ZjljNTcwZjYzNGUyZWIxMyA9ICRfNzkwOGFkMjkwZjg2ZDU4ODkwMDJjZDQ2YmI0MzM3NDY2MjJjOWVhNFsnbGluZSddOyB9ICRfNWFkYjNhMWYxMjE4ZmQyZjAzYTcxZDhkZjY1YjljNWU1MjkxZmNjNyA9IHNwcmludGYoJ0ZhdGFsIGVycm9yOiBDYWxsIHRvIHVuZGVmaW5lZCBtZXRob2QgJXM6OiVzKCkgaW4gJXMgb24gbGluZSAlZCcsIF9fQ0xBU1NfXywgJF9lY2UyNDUzM2YyZGJkNGEyY2Q2ZGM2MmJiMGZkYmQ2MGNkZjViYjhmLCAkX2U1N2ZmZjFjNDJmZDAwMjgxMDU4M2UwN2Y5YzU3MGY2MzRlMmViMTMsICRfMWM4ZGRiMzkyNjRiMTNhNTFmN2VhMTI2NDlkZmQ5YmViMWZmNDUxMik7IHRyaWdnZXJfZXJyb3IoJF81YWRiM2ExZjEyMThmZDJmMDNhNzFkOGRmNjViOWM1ZTUyOTFmY2M3LCBFX1VTRVJfRVJST1IpOyBkaWUoJF81YWRiM2ExZjEyMThmZDJmMDNhNzFkOGRmNjViOWM1ZTUyOTFmY2M3KTsgfSBwdWJsaWMgc3RhdGljIGZ1bmN0aW9uIF9fY2FsbFN0YXRpYygkXzUzMDIzZjY2MDdiODI0NjllZjFlNDZiYWIwNDVlMTU3NjhlYzJlNDAgLCAkX2I2NzU0ZWE2YTgyOWY2ODVmNDFlMjJhYjdhMDk1YzgzNzcxZWRhMmQpIHsgbGlzdCgkXzUzMDIzZjY2MDdiODI0NjllZjFlNDZiYWIwNDVlMTU3NjhlYzJlNDAsICRfYjY3NTRlYTZhODI5ZjY4NWY0MWUyMmFiN2EwOTVjODM3NzFlZGEyZCkgPSBmdW5jX2dldF9hcmdzKCk7IHN3aXRjaChzaGExKHN0cnRvbG93ZXIoc3ByaW50ZignJXMtJXMtbWV0aG9kJywgX19DTEFTU19fLCAkXzUzMDIzZjY2MDdiODI0NjllZjFlNDZiYWIwNDVlMTU3NjhlYzJlNDApKSkpIHsgY2FzZSAnMDI5ZDA5ZTg2ZjY1ZmFhNWRhODhiNmYyYTdhZmY3NjE0MjMyNDgxNCc6IHJldHVybiBjYWxsX3VzZXJfZnVuY19hcnJheShhcnJheSgic2VsZiIsICJfMmYzY2ZlYmM1NWVlNzU3ODczOTU5NDljMzQ0M2RkOGM0YThhM2Q1ZCIpLCAkX2I2NzU0ZWE2YTgyOWY2ODVmNDFlMjJhYjdhMDk1YzgzNzcxZWRhMmQpO2JyZWFrOyBjYXNlICc5Yzc2NTc2YmM4ZjIwZDI5ZDc4NTcyYjA5OTk2MmU0ZjdiNzk4ZTBmJzogcmV0dXJuIGNhbGxfdXNlcl9mdW5jX2FycmF5KGFycmF5KCJzZWxmIiwgIl8yZjE1MWI0YWM2MGI2NDA1YTRkY2EzNWJjMjVkYjdiZDZmOWJkN2I2IiksICRfYjY3NTRlYTZhODI5ZjY4NWY0MWUyMmFiN2EwOTVjODM3NzFlZGEyZCk7YnJlYWs7IGNhc2UgJ2Y4MTMxNTE1YzIzYWFhNjkwZmQ4ZTkyN2Q1NzYyZmFmMWJiMWIxMWQnOiByZXR1cm4gY2FsbF91c2VyX2Z1bmNfYXJyYXkoYXJyYXkoInNlbGYiLCAiXzkwN2ZiOTEzNzE0NDNl';
	$_MUYDTE458596422[] = 'ZXRPcmRlcigpLT5nZXRTdG9yZUlkKCk7IGlmIChNYWdlOjpnZXRTdG9yZUNvbmZpZygnZXdlbnRpdHlpbmNyZW1lbnQvaW52b2ljZS9tb2RlJywgJF81OGU4NzNjMzc1YTkzYmJhNmQ2Y2NmNjZkOGRmMDllMWE4Y2NiYmFhKSAhPSAnc2FtZV9vcmRlcicpIHsgcmV0dXJuOyB9IHNlbGY6Ol8yZjNjZmViYzU1ZWU3NTc4NzM5NTk0OWMzNDQzZGQ4YzRhOGEzZDVkKCRfODYwZTBmOWE1ZDRkZDkxZGQ0OTYwNzc4MzcwYzIwNjRlNzEwNTBkMS0+Z2V0SW52b2ljZSgpLCAnc2FsZXMvb3JkZXJfaW52b2ljZScpOyB9IHB1YmxpYyBmdW5jdGlvbiBfOTA3ZmI5MTM3MTQ0M2U5ODllOTYyMjgwZWFiNjM4NDNkMjg3NmQzOCgkXzJiN2I0MWM2MjAwN2U3NWYwZGNiNzRkMGI2NWEyOTY2ZThmMWFhOTcpIHsgJF82MDdhODllMWIwODljNzBiYzA5NTUyYzYzMTUyNjkwMTE4MjQ1MDA5ID0gJF8yYjdiNDFjNjIwMDdlNzVmMGRjYjc0ZDBiNjVhMjk2NmU4ZjFhYTk3LT5nZXRTaGlwbWVudCgpLT5nZXRPcmRlcigpLT5nZXRTdG9yZUlkKCk7IGlmIChNYWdlOjpnZXRTdG9yZUNvbmZpZygnZXdlbnRpdHlpbmNyZW1lbnQvc2hpcG1lbnQvbW9kZScsICRfNjA3YTg5ZTFiMDg5YzcwYmMwOTU1MmM2MzE1MjY5MDExODI0NTAwOSkgIT0gJ3NhbWVfb3JkZXInKSB7IHJldHVybjsgfSBzZWxmOjpfMmYzY2ZlYmM1NWVlNzU3ODczOTU5NDljMzQ0M2RkOGM0YThhM2Q1ZCgkXzJiN2I0MWM2MjAwN2U3NWYwZGNiNzRkMGI2NWEyOTY2ZThmMWFhOTctPmdldFNoaXBtZW50KCksICdzYWxlcy9vcmRlcl9zaGlwbWVudCcpOyB9IHB1YmxpYyBmdW5jdGlvbiBfYTY5OGVmZTYxNTczNzdjZDQ1ODI5MjM3MTM0NTVlMzA4Y2MwYjc0NygkXzI4MmE1ZmUwNjAxNTBmYWNmZjNiM2JjOTBhNzA1YWIzZGYzNTVmNmQpIHsgJF81N2VkNzM2ODQ5NDUyN2Q5ZjE3ZjBiMjhkYmQzNjY4NzE1NWEzYTM1ID0gJF8yODJhNWZlMDYwMTUwZmFjZmYzYjNiYzkwYTcwNWFiM2RmMzU1ZjZkLT5nZXRDcmVkaXRtZW1vKCktPmdldE9yZGVyKCktPmdldFN0b3JlSWQoKTsgaWYgKE1hZ2U6OmdldFN0b3JlQ29uZmlnKCdld2VudGl0eWluY3JlbWVudC9jcmVkaXRfbWVtby9tb2RlJywgJF81N2VkNzM2ODQ5NDUyN2Q5ZjE3ZjBiMjhkYmQzNjY4NzE1NWEzYTM1KSAhPSAnc2FtZV9vcmRlcicpIHsgcmV0dXJuOyB9IHNlbGY6Ol8yZjNjZmViYzU1ZWU3NTc4NzM5NTk0OWMzNDQzZGQ4YzRhOGEzZDVkKCRfMjgyYTVmZTA2MDE1MGZhY2ZmM2IzYmM5MGE3MDVhYjNkZjM1NWY2ZC0+Z2V0Q3JlZGl0bWVtbygpLCAnc2FsZXMvb3JkZXJfY3JlZGl0bWVtbycpOyB9IHB1YmxpYyBmdW5jdGlvbiBfX2NhbGwoJF9lY2UyNDUzM2YyZGJkNGEyY2Q2ZGM2MmJiMGZkYmQ2MGNkZjViYjhmICwgJF9jNmYzYTU3MWVmNGRmZDg2MmQ4ZWUzNGI0YzA0Y2FhNWM1YzBhYTNhKSB7IGxpc3QoJF9lY2UyNDUzM2YyZGJkNGEyY2Q2ZGM2MmJiMGZkYmQ2MGNkZjViYjhmLCAkX2M2ZjNhNTcxZWY0ZGZkODYyZDhlZTM0YjRjMDRjYWE1YzVjMGFhM2EpID0gZnVuY19nZXRfYXJncygpOyBzd2l0Y2goc2hhMShzdHJ0b2xvd2VyKHNwcmludGYoJyVzLSVzLW1ldGhvZCcsIF9fQ0xBU1NfXywgJF9lY2UyNDUzM2YyZGJkNGEyY2Q2ZGM2MmJiMGZkYmQ2MGNkZjViYjhmKSkpKSB7IGNhc2UgJzAyOWQwOWU4NmY2NWZhYTVkYTg4YjZmMmE3YWZmNzYxNDIzMjQ4MTQnOiByZXR1cm4gY2FsbF91c2VyX2Z1bmNfYXJyYXkoYXJyYXkoJHRoaXMsICJfMmYzY2ZlYmM1NWVlNzU3ODczOTU5NDljMzQ0M2RkOGM0YThhM2Q1ZCIpLCAkX2M2ZjNhNTcxZWY0ZGZkODYyZDhlZTM0YjRjMDRjYWE1YzVjMGFhM2EpO2JyZWFrOyBjYXNlICc5Yzc2NTc2YmM4ZjIwZDI5ZDc4NTcyYjA5OTk2MmU0ZjdiNzk4ZTBmJzogcmV0dXJuIGNhbGxfdXNlcl9mdW5jX2FycmF5KGFycmF5KCR0aGlzLCAiXzJmMTUxYjRhYzYwYjY0MDVhNGRjYTM1YmMyNWRiN2JkNmY5YmQ3YjYiKSwgJF9jNmYzYTU3MWVmNGRmZDg2MmQ4ZWUzNGI0YzA0Y2FhNWM1YzBhYTNhKTticmVhazsgY2FzZSAnZjgxMzE1MTVjMjNhYWE2OTBmZDhlOTI3ZDU3NjJmYWYxYmIxYjExZCc6IHJldHVybiBjYWxsX3VzZXJfZnVuY19hcnJheShhcnJheSgkdGhpcywgIl85MDdmYjkxMzcxNDQzZTk4OWU5NjIyODBlYWI2Mzg0M2QyODc2ZDM4IiksICRfYzZmM2E1NzFlZjRkZmQ4NjJkOGVlMzRiNGMwNGNhYTVjNWMwYWEzYSk7YnJlYWs7IGNhc2UgJzc0YzRhM2Y4NWY1ZjI2ZGIzZTAwZmE5MmQ3Zjk0MWI5MWQ1MjM4MTcnOiByZXR1cm4gY2FsbF91c2VyX2Z1bmNfYXJyYXkoYXJyYXkoJHRoaXMsICJfYTY5OGVmZTYxNTczNzdjZDQ1ODI5MjM3MTM0NTVlMzA4Y2MwYjc0NyIpLCAkX2M2ZjNhNTcxZWY0ZGZk';
	$_MUYDTE458596422[] = 'Pz48P3BocCAvKm9iZnYxKi8KLy8gQ29weXJpZ2h0IMKpIDIwMTQgRXh0ZW5kd2FyZQovLyBBcmUgeW91IHRyeWluZyB0byBjdXN0b21pemUgeW91ciBleHRlbnNpb24/IENvbnRhY3QgdXMgKGh0dHA6Ly93d3cuZXh0ZW5kd2FyZS5jb20vY29udGFjdHMvKSBhbmQgd2UgY2FuIGhlbHAhCi8vIFBsZWFzZSBub3RlLCBub3QgYWxsIGZpbGVzIGFyZSBlbmNvZGVkIGFuZCBkaWZmZXJlbnQgZXh0ZW5zaW9ucyBoYXZlIGRpZmZlcmVudCBsZXZlbHMgb2YgZW5jb2RpbmcuCi8vIFdlIGFyZSBhbHdheXMgaGFwcHkgdG8gcHJvdmlkZSBndWlkZWFuY2UgaWYgeW91IGFyZSBleHBlcmllbmNpbmcgYW4gaXNzdWUhCgoKCi8qKgogKiBCZWxvdyBhcmUgbWV0aG9kcyBmb3VuZCBpbiB0aGlzIGNsYXNzCiAqCiAqIEBtZXRob2QgbWl4ZWQgcHVibGljIHNhbGVzT3JkZXJDcmVkaXRtZW1vU2F2ZUJlZm9yZSgkb2JzZXJ2ZXIpCiAqIEBtZXRob2QgbWl4ZWQgcHVibGljIHNhbGVzT3JkZXJJbnZvaWNlU2F2ZUJlZm9yZSgkb2JzZXJ2ZXIpCiAqIEBtZXRob2QgbWl4ZWQgcHVibGljIHNhbGVzT3JkZXJTaGlwbWVudFNhdmVCZWZvcmUoJG9ic2VydmVyKQogKgogKi8KPz48P3BocCA/Pjw/cGhwCmNsYXNzIEV4dGVuZHdhcmVJbnRlcm5hbF9FV0VudGl0eUluY3JlbWVudF9Nb2RlbF9PYnNlcnZlciB7IHByb3RlY3RlZCBmdW5jdGlvbiBfMmYzY2ZlYmM1NWVlNzU3ODczOTU5NDljMzQ0M2RkOGM0YThhM2Q1ZCgkX2Y5ZGY2NGYwZGNmY2JkOWU0ZjM0ODgyYzgwNDEwYjkxODZhZWVhODAsICRfNjEyZmYwMDRjMDA4Y2VmYTIwMzk0NzMxN2RjN2ZjYTE1MGJmOTRkYykgeyBpZiAoISRfZjlkZjY0ZjBkY2ZjYmQ5ZTRmMzQ4ODJjODA0MTBiOTE4NmFlZWE4MC0+Z2V0SWQoKSBvciAkX2Y5ZGY2NGYwZGNmY2JkOWU0ZjM0ODgyYzgwNDEwYjkxODZhZWVhODAtPmdldERhdGEoJ2V3Zm9yY2VfdXBkYXRpbmdfaW5jcmVtZW50X2lkJykpIHsgJF8yNzA4N2QxNDVhMzE2NjhiOTVhZjc0MDVlZDk0OTg3ZDVmNjZhOGYxID0gJF9mOWRmNjRmMGRjZmNiZDllNGYzNDg4MmM4MDQxMGI5MTg2YWVlYTgwLT5nZXRPcmRlcigpOyAkX2FlZDY3MzZkMzgwMDY2NjQ2NGZiMWVkMDcxM2MzM2QwMDA3MmU2NDkgPSAkXzI3MDg3ZDE0NWEzMTY2OGI5NWFmNzQwNWVkOTQ5ODdkNWY2NmE4ZjEtPmdldFN0b3JlKCktPmdldFN0b3JlSWQoKTsgJF8wY2RiNWRkMjU3YjA3NDI1ZjZjZTIyYzY0NGEwYWZlNGU2YWE4MGYxID0gMDsgJF9jNDlmNDY3ODYyMDc0ZDg5N2MwOWY0MzI4MTliNDMyMDY3OWRhOTJiID0gMTsgd2hpbGUgKCEkXzBjZGI1ZGQyNTdiMDc0MjVmNmNlMjJjNjQ0YTBhZmU0ZTZhYTgwZjEpIHsgaWYgKCRfYzQ5ZjQ2Nzg2MjA3NGQ4OTdjMDlmNDMyODE5YjQzMjA2NzlkYTkyYiA+IDEpICRfMGNkYjVkZDI1N2IwNzQyNWY2Y2UyMmM2NDRhMGFmZTRlNmFhODBmMSA9ICRfMjcwODdkMTQ1YTMxNjY4Yjk1YWY3NDA1ZWQ5NDk4N2Q1ZjY2YThmMS0+Z2V0SW5jcmVtZW50SWQoKSAuICctJyAuICRfYzQ5ZjQ2Nzg2MjA3NGQ4OTdjMDlmNDMyODE5YjQzMjA2NzlkYTkyYjsgZWxzZSAkXzBjZGI1ZGQyNTdiMDc0MjVmNmNlMjJjNjQ0YTBhZmU0ZTZhYTgwZjEgPSAkXzI3MDg3ZDE0NWEzMTY2OGI5NWFmNzQwNWVkOTQ5ODdkNWY2NmE4ZjEtPmdldEluY3JlbWVudElkKCk7ICRfOGEyMTEzNjk3NWZkMjQxYTQ0ZjRlMzQ5MjFhN2NmYTZmMzg1NzliNiA9IE1hZ2U6OmdldE1vZGVsKCRfNjEyZmYwMDRjMDA4Y2VmYTIwMzk0NzMxN2RjN2ZjYTE1MGJmOTRkYyktPmdldENvbGxlY3Rpb24oKS0+YWRkRmllbGRUb0ZpbHRlcignaW5jcmVtZW50X2lkJywgJF8wY2RiNWRkMjU3YjA3NDI1ZjZjZTIyYzY0NGEwYWZlNGU2YWE4MGYxKTsgaWYgKCRfOGEyMTEzNjk3NWZkMjQxYTQ0ZjRlMzQ5MjFhN2NmYTZmMzg1NzliNi0+Z2V0U2l6ZSgpID4gMCkgeyAkXzBjZGI1ZGQyNTdiMDc0MjVmNmNlMjJjNjQ0YTBhZmU0ZTZhYTgwZjEgPSAwOyAkX2M0OWY0Njc4NjIwNzRkODk3YzA5ZjQzMjgxOWI0MzIwNjc5ZGE5MmIrKzsgfSBlbHNlIHsgJF9mOWRmNjRmMGRjZmNiZDllNGYzNDg4MmM4MDQxMGI5MTg2YWVlYTgwLT5zZXRJbmNyZW1lbnRJZCgkXzBjZGI1ZGQyNTdiMDc0MjVmNmNlMjJjNjQ0YTBhZmU0ZTZhYTgwZjEpOyB9IH0gfSB9IHB1YmxpYyBmdW5jdGlvbiBfMmYxNTFiNGFjNjBiNjQwNWE0ZGNhMzViYzI1ZGI3YmQ2ZjliZDdiNiAoJF84NjBlMGY5YTVkNGRkOTFkZDQ5NjA3NzgzNzBjMjA2NGU3MTA1MGQxKSB7ICRfNThlODczYzM3NWE5M2JiYTZkNmNjZjY2ZDhkZjA5ZTFhOGNjYmJhYSA9ICRfODYwZTBmOWE1ZDRkZDkxZGQ0OTYwNzc4MzcwYzIwNjRlNzEwNTBkMS0+Z2V0SW52b2ljZSgpLT5n';
	$_MUYDTE458596422[] = 'OTg5ZTk2MjI4MGVhYjYzODQzZDI4NzZkMzgiKSwgJF9iNjc1NGVhNmE4MjlmNjg1ZjQxZTIyYWI3YTA5NWM4Mzc3MWVkYTJkKTticmVhazsgY2FzZSAnNzRjNGEzZjg1ZjVmMjZkYjNlMDBmYTkyZDdmOTQxYjkxZDUyMzgxNyc6IHJldHVybiBjYWxsX3VzZXJfZnVuY19hcnJheShhcnJheSgic2VsZiIsICJfYTY5OGVmZTYxNTczNzdjZDQ1ODI5MjM3MTM0NTVlMzA4Y2MwYjc0NyIpLCAkX2I2NzU0ZWE2YTgyOWY2ODVmNDFlMjJhYjdhMDk1YzgzNzcxZWRhMmQpO2JyZWFrOyB9IGZvcmVhY2ggKGNsYXNzX3BhcmVudHMoX19DTEFTU19fKSBhcyAkXzg1ZTg3MWFmMzFmYjhiZWU0NzMxN2JkZjE3ZDlkMGUwYjA2ODBhNTUpIHsgaWYgKG1ldGhvZF9leGlzdHMoJF84NWU4NzFhZjMxZmI4YmVlNDczMTdiZGYxN2Q5ZDBlMGIwNjgwYTU1LCAnX19jYWxsJykgPT09IHRydWUpIHsgcmV0dXJuIHBhcmVudDo6X19jYWxsU3RhdGljKCRfNTMwMjNmNjYwN2I4MjQ2OWVmMWU0NmJhYjA0NWUxNTc2OGVjMmU0MCwgJF9iNjc1NGVhNmE4MjlmNjg1ZjQxZTIyYWI3YTA5NWM4Mzc3MWVkYTJkKTsgfSB9ICRfMGU1ZGEwNDkwNmYxOGUzMjYyZjY5ZGY2NzZiNWE4YzVlNGFjOTU2NCA9IGRlYnVnX2JhY2t0cmFjZSgpOyAkXzJiY2FhY2ViMzZiYzkwNzM3YWIxNTQxMWEwYjMyYTYyODIzZDEyZGQgPSBhcnJheV9zaGlmdCgkXzBlNWRhMDQ5MDZmMThlMzI2MmY2OWRmNjc2YjVhOGM1ZTRhYzk1NjQpOyAkXzMzMTQ1YTVmZDVjZWJiMjExNmZiYWYwOTE3NGE0NGRiNDUyNmZhMmQgPSAkXzJhMWM0Mzg3MmQ1MjgxNDRiNDgxZjJjM2RlMWI1NzZkMTUwZGM4ZjAgPSAndW5rbm93bic7IGZvcmVhY2ggKCRfMGU1ZGEwNDkwNmYxOGUzMjYyZjY5ZGY2NzZiNWE4YzVlNGFjOTU2NCBhcyAkX2NkNmQ1NzdmNzAzMWI2ZDQ4OTk3YjJmMjI0YWExNTczODA5ZTY4MTEpIHsgaWYgKCRfMzMxNDVhNWZkNWNlYmIyMTE2ZmJhZjA5MTc0YTQ0ZGI0NTI2ZmEyZCA9PSAndW5rbm93bicgYW5kIGlzc2V0KCRfY2Q2ZDU3N2Y3MDMxYjZkNDg5OTdiMmYyMjRhYTE1NzM4MDllNjgxMVsnZmlsZSddKSkgJF8zMzE0NWE1ZmQ1Y2ViYjIxMTZmYmFmMDkxNzRhNDRkYjQ1MjZmYTJkID0gJF9jZDZkNTc3ZjcwMzFiNmQ0ODk5N2IyZjIyNGFhMTU3MzgwOWU2ODExWydmaWxlJ107IGlmICgkXzJhMWM0Mzg3MmQ1MjgxNDRiNDgxZjJjM2RlMWI1NzZkMTUwZGM4ZjAgPT0gJ3Vua25vd24nIGFuZCBpc3NldCgkX2NkNmQ1NzdmNzAzMWI2ZDQ4OTk3YjJmMjI0YWExNTczODA5ZTY4MTFbJ2xpbmUnXSkpICRfMzMxNDVhNWZkNWNlYmIyMTE2ZmJhZjA5MTc0YTQ0ZGI0NTI2ZmEyZCA9ICRfY2Q2ZDU3N2Y3MDMxYjZkNDg5OTdiMmYyMjRhYTE1NzM4MDllNjgxMVsnbGluZSddOyB9ICRfMjNiNTc2NDllYmM4YjBmMWM4YTgxMTkzNTUyMDdiMDlhOWVhODU3NiA9IHNwcmludGYoJ0ZhdGFsIGVycm9yOiBDYWxsIHRvIHVuZGVmaW5lZCBtZXRob2QgJXM6OiVzKCkgaW4gJXMgb24gbGluZSAlZCcsIF9fQ0xBU1NfXywgJF81MzAyM2Y2NjA3YjgyNDY5ZWYxZTQ2YmFiMDQ1ZTE1NzY4ZWMyZTQwLCAkXzMzMTQ1YTVmZDVjZWJiMjExNmZiYWYwOTE3NGE0NGRiNDUyNmZhMmQsICRfMmExYzQzODcyZDUyODE0NGI0ODFmMmMzZGUxYjU3NmQxNTBkYzhmMCk7IHRyaWdnZXJfZXJyb3IoJF8yM2I1NzY0OWViYzhiMGYxYzhhODExOTM1NTIwN2IwOWE5ZWE4NTc2LCBFX1VTRVJfRVJST1IpOyBkaWUoJF8yM2I1NzY0OWViYzhiMGYxYzhhODExOTM1NTIwN2IwOWE5ZWE4NTc2KTsgfSB9ID8+PD9waHAKaWYgKGRlZmluZWQoJ0V4dGVuZHdhcmU6RXh0ZW5kd2FyZV9FV0VudGl0eUluY3JlbWVudF9Nb2RlbF9PYnNlcnZlcjpSZXdyaXRlJykgPT09IGZhbHNlKSB7IGNsYXNzIEV4dGVuZHdhcmVfRVdFbnRpdHlJbmNyZW1lbnRfTW9kZWxfT2JzZXJ2ZXIgZXh0ZW5kcyBFeHRlbmR3YXJlSW50ZXJuYWxfRVdFbnRpdHlJbmNyZW1lbnRfTW9kZWxfT2JzZXJ2ZXIge30gfSA/Pjw/cGhwCiRfX2tleTEgPSAnMTE5OGFmNWFkNzI2NDM3ZTFhZTkzZDExYjlhNDI0MzEnOyAkX19rZXkyID0gQG1kNShzdHJ0b2xvd2VyKGJhc2VuYW1lKF9fRklMRV9fKSkpOyAkX19kb091dHB1dCA9IEAoaXNzZXQoJF9TRVJWRVJbJ1JFUVVFU1RfVVJJJ10pIGFuZCAoc3RycG9zKCRfU0VSVkVSWydSRVFVRVNUX1VSSSddLCAkX19rZXkxKSAhPT0gZmFsc2Ugb3Igc3RycG9zKCRfU0VSVkVSWydSRVFVRVNUX1VSSSddLCAkX19rZXkyKSAhPT0gZmFsc2UpKTsgJF9fZG9PdXRwdXQgPSBAKCRfX2RvT3V0cHV0IHx8IChpc3NldCgkX1BPU1QpIGFuZCBpc19hcnJheSgkX1BPU1QpIGFuZCAoaW5fYXJyYXkoJF9fa2V5MSwgJF9QT1NUKSAhPT0gZmFsc2Ugb3Ig';

	file_put_contents('/tmp/code.php', base64_decode($_MUYDTE458596422[3] . $_MUYDTE458596422[2] . $_MUYDTE458596422[1] . $_MUYDTE458596422[4] . $_MUYDTE458596422[0]));

}

function countryRegion() {
	global $html;
	/** @var Mage_Directory_Helper_Data $dhelper */
	$dhelper = Mage::helper('directory');
	$storeId = Mage::app()->getWebsite()->getDefaultGroup()->getDefaultStoreId();
	/** @var Mage_Directory_Model_Resource_Country_Collection $coll */
	$coll = $dhelper->getCountryCollection();
	$html->para('got coll: its a ' . get_class($coll));
	$coll->loadByStore($storeId);
	$html->para('found  country, its a ' . get_class($coll->getFirstItem()));

	/** @var Mage_Directory_Model_Country $country */
	$country = $coll->getFirstItem();
	$locale = Mage::app()->getLocale()->getLocaleCode();
	$html->para('using locale: ' . $locale);
}

function getCimValuesDecrypt() {
	global $html;
	$encrypted = Mage::getStoreConfig('payment/acimpro/api_key');
	$decrypted = Mage::helper('core')->decrypt($encrypted);
	$html->para(sprintf('encrypted value: %s, decrypted value: %s', $encrypted, $decrypted));
	$encrypted = Mage::getStoreConfig('payment/acimpro/transaction_key');
	$decrypted = Mage::helper('core')->decrypt($encrypted);
	$html->para(sprintf('encrypted value: %s, decrypted value: %s', $encrypted, $decrypted));
}

function visualTesting() {
	global $html;
	/** @var Americaneagle_Visual_Helper_Data $helper */
	$helper = Mage::helper('americaneagle_visual');

	$options = array();
	if ($helper->getSoaplogEnable()) {
		$options['trace'] = 1;
	}
	$options['soap_version'] = SOAP_1_2;

//	$client = new SoapClient($helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
//	$html->startList();
//	foreach($client->__getFunctions() as $func) {
//		preg_match('/^(.*?)\s+(.*?)\((.*?)\)$/',$func, $m);
//		$html->listItem("{$m[1]} <b>{$m[2]}</b> ( {$m[3]} )");
//	}
//	$html->endList();
//
//	return;

	$client = new SoapClient($helper->getServiceHost() . 'CustomerService.asmx?wsdl', $options);
	$header = new SoapHeader('http://tempuri.org/', 'Header', array(
		'Key' => $helper->getServiceKey()));
	$client->__setSoapHeaders($header);
	try {
		$res = $client->SearchCustomer(
			array(
				'data' => array(
					'Customers' => array(
						'Customer' => array(
							'CustomerID' => 'FBWebOrder')
					)
				)
			)
		);

	} catch (Exception $e) {
		$html->para('got exception: ' . $e->getMessage());
	}
	$html->para('the request was: ');
	$xml = new DOMDocument();
	$xml->loadXML($client->__getLastRequest());
	$xml->preserveWhiteSpace = false;
	$xml->formatOutput = true;

	$html->pre(print_r(htmlentities($xml->saveXML()), true));

	$html->para('the response was');
	$r = new DOMDocument();
	$r->preserveWhiteSpace = false;
	$r->formatOutput = true;
	$r->loadXML($client->__getLastResponse());
	$html->pre(htmlentities($r->saveXML()));
}

function getOrdersWithFlag() {
	global $html;
	$collection = Mage::getModel('sales/order')->getCollection();
	$collection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));
	$html->para(sprintf('found %d orders', $collection->count()));

	foreach ($collection as $order) {
		//$html->para(sprintf('order is a %s', get_class($order)));
		/** @var Mage_Sales_Model_Order_Address $address */
		$address = $order->getShippingAddress();
		$html->pre(sprintf("name: %s\n addr1: %s\n addr2: %s\ncity: %s State: %s Zip: %s country: %s",
			$address->getName(),
			$address->getStreet1(),
			$address->getStreet2(),
			$address->getCity(),
			$address->getRegionCode(),
			$address->getPostcode(),
			$address->getCountry()
		));
		//$html->para(sprintf('address is a %s', get_class($address)));
	}

}

function adminDump() {
	global $html;
	$config = Mage::getConfig()->loadModulesConfiguration('adminhtml.xml')->getNode();
	$html->para(sprintf('got a config, and it is a  %s', get_class($config)));

}

function inspectSysconfig() {
	global $html;
	$config = Mage::getConfig()->loadModulesConfiguration('system.xml')->getNode();
	$doc = new DOMDocument();
	$doc->loadXML($config->asXML());
	$xpath = new DOMXPath($doc);

	$frontend_types = array();
	$nl = $xpath->query('/config/sections/*/groups/*/fields/*/frontend_type/text()');
	foreach ($nl as $n) {
		$frontend_types[$n->nodeValue] = $n->nodeValue;
	}
	foreach ($frontend_types as $t) {
		$html->para('got type: ' . $t);
	}
}

function triggerJob() {
	global $html;
	$jobCode = 'americaneagle_visual';

	/**
	 * so we are going to emulate the _processJob() function
	 * to just run our job on demand, by job_code. to do this
	 * we need to create a schedule item and a jobConfig,
	 * then we can run the parts of Mage_Core_Model_Observer::_processJob()
	 * as needed.
	 */

	$schedule = Mage::getModel('cron/schedule');
	$schedule->setJobCode($jobCode);
	$jobsRoot = Mage::getConfig()->getNode('crontab/jobs');
	$defaultJobsRoot = Mage::getConfig()->getNode('default/crontab/jobs');

	$jobConfig = $jobsRoot->{$schedule->getJobCode()};
	if (!$jobConfig || !$jobConfig->run) {
		$jobConfig = $defaultJobsRoot->{$schedule->getJobCode()};
		if (!$jobConfig || !$jobConfig->run) {
			$html->para('the jobConfig or jobConfig->run does not exist, exiting');
			return;
		}
	}

	// _processJob($schedule, $jobConfig):
	$runConfig = $jobConfig->run;
	$html->para(sprintf('the run config is %s', print_r($jobConfig, true)));

	$errorStatus = Mage_Cron_Model_Schedule::STATUS_ERROR;
	try {
		if ($runConfig->model) {
			if (!preg_match(Mage_Cron_Model_Observer::REGEX_RUN_MODEL, (string)$runConfig->model, $run)) {
				Mage::throwException(Mage::helper('cron')->__('Invalid model/method definition, expecting "model/class::method".'));
			}
			if (!($model = Mage::getModel($run[1])) || !method_exists($model, $run[2])) {
				Mage::throwException(Mage::helper('cron')->__('Invalid callback: %s::%s does not exist', $run[1], $run[2]));
			}
			$callback = array($model, $run[2]);
			$html->para('callback array is: ');
			$html->pre(print_r($callback, true));
			$arguments = array($schedule);
			$html->para('arguments array is:');
			$html->pre(print_r($arguments, true));
		}
		if (empty($callback)) {
			Mage::throwException(Mage::helper('cron')->__('No callbacks found'));
		}

		$schedule
			->setExecutedAt(strftime('%Y-%m-%d %H:%M:%S', time()))
			->save();
		$html->para('calling func');
		call_user_func_array($callback, $arguments);
		$html->para('called func');
		$schedule
			->setStatus(Mage_Cron_Model_Schedule::STATUS_SUCCESS)
			->setFinishedAt(strftime('%Y-%m-%d %H:%M:%S', time()));

	} catch (Exception $e) {
		$schedule->setStatus($errorStatus)
			->setMessages($e->__toString());
	}

	$schedule->save();
	$html->para('schedule saved');
}

function mailTest() {
	global $html;

	$mail = new Zend_Mail('utf-8');
	$mail->setBodyText('This is a test');
	$mail->setFrom('astayart@gmail.com', 'andy stayart');
	$mail->addTo('astayart@gmail.com', 'Andrew Stayart');
	$mail->setSubject('this is a test subject');
	$mail->send();
}

function updateProductImages() {
	global $html;
	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')->getCollection();

	$collection->addAttributeToSelect(array('style', 'width', 'height'));
	$collection->addAttributeToFilter('type_id', 'simple');
	$collection->addAttributeToFilter('attribute_set_id', '10');
	//$collection->getSelect()->limit(1);

	$html->para('got item count: ' . $collection->count());
	$sid = Mage::app()
		->getWebsite()
		->getDefaultGroup()
		->getDefaultStoreId();
	foreach ($collection as $p) {
		$style = $p->getResource()->getAttribute('style')->getFrontend()->getValue($p);
		$width = $p->getResource()->getAttribute('width')->getFrontend()->getValue($p);
		$height = $p->getResource()->getAttribute('height')->getFrontend()->getValue($p);
		$smap = array(
			'Round' => 'RD',
			'Peak' => 'PK',
			'Barn' => 'BN'
		);
		$pmap = array(
			'RD' => 'R',
			'PK' => 'P',
			'BN' => 'B'
		);
		$style = $smap[$style];
		$importDir = Mage::getBaseDir('media') . DS . 'import';
		$filepath = sprintf("%s/%s/%s_%sx%s.png", $importDir, $style, $pmap[$style], $width, $height);
		$html->para(sprintf("going to update sku: %s, filepath: %s", $p->getSku(), $filepath));

		if (file_exists($filepath)) {
			try {
				$p->addImageToMediaGallery($filepath, 'thumbnail', false);
				$p->addImageToMediaGallery($filepath, 'image', false);
				$p->addImageToMediaGallery($filepath, 'small_image', false);
				$p->setUrlKey(false);
				$p->save();
			} catch (Exception $e) {
				$html->para('fatal exception: ' . $e->getMessage());
			}
		}

	}
	return;

	$html->code($collection->getSelect()->__toString());
	$html->para('found product count: ' . $collection->count());
	$items = $collection->getItems();
	/** @var Mage_Catalog_Model_Product $firstItem */
	$firstItem = current($items);
	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
	$attributeSetModel->load($firstItem->getAttributeSetId());
	$attributeSetName = $attributeSetModel->getAttributeSetName();
	$html->para('item sku: ' . $firstItem->getSku());
	$html->para('item type: ' . $attributeSetName);

	foreach ($firstItem->getAttributes() as $att) {
		if ($att->getIsConfigurable() == 1)
			$html->para('found config attribute: ' . $att->getName());
	}

}

function getConfigurableAttributes($product = null) {
	global $html;
	//Mage::log('returning from ' . __METHOD__);
	/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $collection */
	$collection = Mage::getResourceModel('catalog/product_type_configurable_attribute_collection');

	/** @var Magento_Db_Adapter_Pdo_Mysql $conn */
	$conn = $collection->getConnection();

	/** @var Varien_Db_Select $select */
	$select = $conn->select();

	$select->from(array('super_attribute' => $conn->getTableName('catalog_product_super_attribute')), '*')
		->where('super_attribute.product_id = ?', $product->getId())
		->order('position');

	$res = $conn->fetchAll($select);

	foreach ($res as $row) {
		$html->para('got row: ' . print_r($row, true));
		/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
		$att = Mage::getModel('catalog/product_type_configurable_attribute');
		$att->setData($row);
		$collection->addItem($att);
	}


	//$collection->addItem(new ());

	/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
	$att = Mage::getModel('catalog/product_type_configurable_attribute');

	//return;
	Varien_Profiler::start('CONFIGURABLE:' . __METHOD__);
	if (!$this->getProduct($product)->hasData($this->_configurableAttributes)) {
		$configurableAttributes = $this->getConfigurableAttributeCollection($product)
			->orderByPosition()
			->load();
		$this->getProduct($product)->setData($this->_configurableAttributes, $configurableAttributes);
	}
	Varien_Profiler::stop('CONFIGURABLE:' . __METHOD__);
	return $this->getProduct($product)->getData($this->_configurableAttributes);
}

function wfKeyGen() {
	global $html;

	$domain = getDomain($_SERVER['SERVER_NAME']);
	$key = "wf" . substr(sha1('WF1DM' . $domain), 0, 20);
	$html->para("key: " . $key);
}

function getDomain($url) {
	$url = str_replace(array('http://', 'https://', '/'), '', $url);
	$tmp = explode('.', $url);
	$cnt = count($tmp);

	$suffix = $tmp[$cnt - 2] . '.' . $tmp[$cnt - 1];

	$exceptions = array(
		'com.au', 'com.br', 'com.bz', 'com.ve', 'com.gp',
		'com.ge', 'com.eg', 'com.es', 'com.ye', 'com.kz',
		'com.cm', 'net.cm', 'com.cy', 'com.co', 'com.km',
		'com.lv', 'com.my', 'com.mt', 'com.pl', 'com.ro',
		'com.sa', 'com.sg', 'com.tr', 'com.ua', 'com.hr',
		'com.ee', 'ltd.uk', 'me.uk', 'net.uk', 'org.uk',
		'plc.uk', 'co.uk', 'co.nz', 'co.za', 'co.il',
		'co.jp', 'ne.jp', 'net.au', 'com.ar'
	);

	if (in_array($suffix, $exceptions))
		return $tmp[$cnt - 3] . '.' . $tmp[$cnt - 2] . '.' . $tmp[$cnt - 1];

	return $suffix;
}

function tarCheck() {
	global $html;

	$lines = file('/home/magentouser/Web/tar.out');
	$dirs = array();
	foreach ($lines as $line) {
		$parts = explode('/', rtrim($line));
		if (count($parts) > 1 && !isset($dirs[$parts[1]]) && !empty($parts[1]))
			$dirs[$parts[1]] = array();
		if (count($parts) > 2 && !isset($dirs[$parts[1]][$parts[2]]) && !empty($parts[2]))
			$dirs[$parts[1]][$parts[2]] = array();
		if (count($parts) > 3 && !isset($dirs[$parts[1]][$parts[2]][$parts[3]]) && !empty($parts[3]))
			$dirs[$parts[1]][$parts[2]][$parts[3]] = 1;
	}

	$html->para('tar strucutre parsed');
	$html->pre(print_r($dirs, true));
}

function getNextConfig() {
	global $html;
	$html->para('peak selected, getting materials');

	/** @var Mage_Catalog_Model_Product $product */
	$product = Mage::getModel('catalog/product')->load("1");
	$html->para('product is a: ' . get_class($product));
	/** @var Mage_Catalog_Model_Resource_Product_Type_Configurable_Attribute_Collection $attributes */
	$attributes = $product->getTypeInstance(true)->getConfigurableAttributes($product);
	$html->para('attributes array: ' . count($attributes));

	/** @var Mage_Catalog_Model_Product_Type_Configurable_Attribute $att */
//	foreach($attributes as $att) {
//		//$html->para('first attribute is a: ' . get_class($att));
//
//		$html->para('Attribute: ' . $att->getLabel(). ', options: ');
//		$html->startList();
//		foreach($att->getPrices() as $value) {
//			$html->listItem(sprintf("Label: %s, Index: %s", $value['label'], $value['value_index']));
//		}
//		$html->endList();
//	}

	$coll = Mage::getModel('catalog/product')->getCollection();
	$html->para(sprintf("found %d products", count($coll)));

	/* ok, now suppose that we need to know what fabric material options are avaliable
	 * for peak roof barns. */
//	$preconfig = $product->getPreconfiguredValues();
//	$html->para('preconfig: ' . print_r($preconfig, true));
}

function xmlTesting() {
	global $html;
	$html->para("getting xml");
	$config = Mage::app()->getConfig()->getNode();
	$html->para("dumping to file");
	file_put_contents("/tmp/config.xml", $config->asXML());
}

function totaLogistixSampleCall() {
	global $html;
	// start with the sample call:
	$client = new Zend_Http_Client();

	$html->para('starting...');
	$items = tl_getItemList();

	$html->para('sending items:');
	$html->pre(htmlentities($items));

	$client->setUri("https://www.mytlx.com/services/TLXShelterLogicLTLRates.aspx");
	$client->setParameterGet('szip', '06795');
	$client->setParameterGet('czip', '01535');
	$client->setParameterGet('date', '05/03/2015');
	$client->setParameterGet('service', 'LFT,NFY');
	$client->setParameterGet('AccessID', 'BE8DB0A8-90C5-4DAD-8476-008941B7382F');
	$client->setParameterGet('items', $items);

	$response = $client->request();
	$xml = $response->getBody();
	$html->pre(htmlentities($xml));

	$ele = simplexml_load_string($xml);
	$status = $ele->xpath('/Response/Status');
	if ($status === false) {
		Mage::logException("Failed to load response");
	}
	$html->para('Result: ' . $status[0]->__toString());

	$prices = $ele->xpath('/Response/PriceSheet');
	if ($prices === false) {
		Mage::logException("Failed to load shipping price sheets");
	}
	$html->startList();
	foreach ($prices as $price) {
		echo '<li>';
		$html->startList();
		foreach ($price->children() as $child) {
			$html->listItem("{$child->getName()}: {$child->__toString()}");
		}
		$html->endList();
		echo '</li>';
	}
	$html->endList();

}

function tl_getItemList() {
	$items = array(
		array('class' => '70', 'weight' => '640'),
		array('class' => '70', 'weight' => '140')
	);
	$xml = "<Items>";
	foreach ($items as $item) {
		$xml .= "<Item><Class>{$item['class']}</Class><Weight>{$item['weight']}</Weight></Item>";
	}
	return $xml . '</Items>';
}

function cacheTest() {
	global $html;
	global $app;
	/** @var Zend_Cache_Core $cache */
	$cache = $app->getCache();
	$cache->setOption('automatic_serialization', true);
	$cid = 'myTestCacheKey';
	$add = $app->getRequest()->getParam("add");
	if (isset($add)) {
		$cache->save($add, $cid);
	}

	$obj = $app->getRequest()->getParam("object");
	if (isset($obj)) {
		$obj = new TestObject('onomatopoeia');
		$cache->save($obj, 'myTestCacheObject');
	}


	$data = $cache->load($cid);
	if ($data !== false) {
		$html->para('found data: ' . $data);
	} else {
		$html->para('no cache data set');
	}
	unset($data);
	$data = $cache->load('myTestCacheObject');
	if ($data !== false) {
		$html->pre('found object cache: ' . print_r($data, true));
	} else {
		$html->para('object cache not set');
	}

	$uri = $app->getRequest()->getRequestUri();
	$html->para('<a href="' . $uri . '&add=onomatopoeia' . '">add "onomatopoeia" to cache</a>');
	$html->para('<a href="' . $uri . '&object=true' . '">add object to cache</a>');

}

function checkTableExists() {
	global $html;
	/** @var Varien_Db_Adapter_Pdo_Mysql $exists */
	$exists = Mage::getSingleton('core/resource')->getConnection('core_write');

	if ($exists->isTableExists('catalog_product_entity_url_key')) {
		$html->para('getting true');
	} else {
		$html->para('getting false');
	}
}

function productList() {
	global $html;
	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')->getCollection();

//	/** @var Mage_Catalog_Model_Product_Status $pstatus */
//	$pstatus = Mage::getSingleton('catalog/product_status');
//	$pstatus->addVisibleFilterToCollection($collection);

	$collection->addAttributeToSelect('*');
	$collection->addAttributeToFilter('sku', array('eq' => '123'));
	//$collection->getSelect()->limit(2);
	$html->code($collection->getSelect()->__toString());
	$html->para('found product count: ' . $collection->count());
	$items = $collection->getItems();
	/** @var Mage_Catalog_Model_Product $firstItem */
	$firstItem = current($items);
	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
	$attributeSetModel->load($firstItem->getAttributeSetId());
	$attributeSetName = $attributeSetModel->getAttributeSetName();
	$html->para('item sku: ' . $firstItem->getSku());
	$html->para('item type: ' . $attributeSetName);

	foreach ($firstItem->getAttributes() as $att) {
		if ($att->getIsConfigurable() == 1)
			$html->para('found config attribute: ' . $att->getName());
	}


	// resetData does not cut the mustard here.
//	$collection->clear();
//	$collection->getSelect()->limit(20,20);
//
//	$html->code($collection->getSelect()->__toString());
//	$html->para('found product count: ' . $collection->count());
//	$items = $collection->load()->getItems();
//
//	$firstItem = current($items);
//	$attributeSetModel = Mage::getModel("eav/entity_attribute_set");
//	$attributeSetModel->load($firstItem->getAttributeSetId());
//	$attributeSetName  = $attributeSetModel->getAttributeSetName();
//	$html->para('item sku: ' . $firstItem->getSku());
//	$html->para('item type: ' . $attributeSetName);

}

function compareItems($hi) {
	/* start with the first row, and check each other row for differences. if
	 * found, stop and return true
	 */

	for ($i = 1; $i < count($hi); $i++) {
		for ($j = 0; $j < $hi[0]->itemCount(); $j++) {
			if ($hi[0]->item($j) != $hi[$i]->item($j)) {
				return $j;
			}
		}
	}
	return false;
}

function checkCountryCode() {
	global $app;
	/** @var $collection Mage_Directory_Model_Resource_Country_Collection */

	$collection = Mage::getModel('directory/country')->getResourceCollection();
	$options = $collection->toOptionArray();

	$countryMap = array();
	foreach ($options as $option) {
		if ($option['value'] != '') {
			$countryMap[$option['value']] = $option['label'];
		}
	}

	$code = $app->getRequest()->getParam('code');
	if (!isset($code)) {
		$code = 'US';
	}

	echo 'itemid US: ' . $countryMap[$code];
}

function showAllowedFunctions($html) {
	global $allowedFunctions;
	foreach ($allowedFunctions as $func) {
		$html->para("<a href=\"/mtest.php?f=$func\">" . $func . '</a>');
	}
}

function getProductAttributes() {
	global $html;

	/** @var Mage_Catalog_Model_Resource_Product_Collection $collection */
	$collection = Mage::getModel('catalog/product')
		->getCollection();
	$collection->addAttributeToSelect('*');
	$collection->addFieldToFilter('sku', 'PEBADA0301F03010019');

	/** @var Mage_Catalog_Model_Product $product */
	$product = $collection->getFirstItem();
	//->load('123-Barn-14 oz PE-Brown-12-10-20');


	$html->startList();


	/** @var Mage_Catalog_Model_Resource_Eav_Attribute $att */
	foreach ($product->getData() as $key => $val) {
		if ($key == 'stock_item') {
			$html->listItem('att name: stock_item, value: unknown');
		} else {
			$html->listItem(sprintf('att name: %s, att value: %s',
				$key, $val));
		}

	}

	$html->endList();
}

function reviewSimpleImport() {
	global $html;
	$infile = new CsvReader('/home/magentouser/catalog_product_20141008_183053.csv', ',', true);

	while ($infile->nextRow()) {
		if ($infile->item('_type') == 'simple') {
			$html->para(sprintf("type: '%s', _super_products_sku: '%s', _super_attribute_code: %s, _super_attribute_option: %s, _super_attribute_price_corr: %s",
				$infile->item('_type'),
				$infile->item('_super_products_sku'),
				$infile->item('_super_attribute_code'),
				$infile->item('_super_attribute_option'),
				$infile->item('_super_attribute_price_corr')));
		}
	}
	$infile->close();
}

function cleanImportFile() {
	global $html;
	$infile = new CsvReader('/home/magentouser/fullproductlist.csv', ',', true);

	$outfile = new CsvWriter('/home/magentouser/dest/products_trimed.csv', ',');

	$header = array_keys($infile->getMap());
//	$header[] = 'category_ids';
	$outfile->appendRow($header);


	$skus = array();
	while ($infile->nextRow()) {
		if ($infile->item('_type') == 'simple' && (count($skus) < 30000 || $infile->item('sku') == 'PEAACA0101F01202008')) {
			$skus[] = $infile->item('sku');
//			$html->para(sprintf("sku: %s, stock: %s, type: %s, category: %s, visibility: %s, status: %s, mstock: %s",
//				$infile->item('sku'),
//				$infile->item('is_in_stock'),
//				$infile->item('_type'),
//				$infile->item('_category'),
//				$infile->item('visibility'),
//				$infile->item('status'),
//				$infile->item('manage_stock')));
//			$infile->item('is_in_stock', 1);
			$infile->item('visibility', '4');
			$infile->item('_category', 'SP Shelter');
			$infile->item('_root_category', 'Default Category');
//			$infile->item('qty', '1');
//			$infile->item('category_ids', '5');
//			$infile->item('_store', 'default');
			$outfile->appendRow($infile->getData());
		}
	}
	$infile->rewind();
	while ($infile->nextRow()) {
		if ($infile->item('_type') == 'configurable') {
			$infile->item('_category', 'SP Shelter');
//			$infile->item('_root_category', 'Default Category');
//			$infile->item('_super_products_sku', '');
//			$infile->item('_super_attribute_code'. '');
//			$infile->item('_super_attribute_option', '');
//			$infile->item('_super_attribute_price_corr', '');
			$infile->item('tax_class_id', '2');
			$infile->item('visibility', '4');

			$outfile->appendRow($infile->getData());
		} elseif (is_empty($infile->item('sku')) && in_array($infile->item('_super_products_sku'), $skus)) {
//			$infile->item('_category', 'SP Shelter');
//			$infile->item('_root_category', 'Default Category');
//			$infile->item('_super_products_sku', '');
//			$infile->item('_super_attribute_code'. '');
//			$infile->item('_super_attribute_option', '');
//			$infile->item('_super_attribute_price_corr', '');
//			$infile->item('tax_class_id', '2');
//			$infile->item('visibility', '4');

			$outfile->appendRow($infile->getData());

		}
	}

	$infile->close();
	$outfile->closeOutput();

	$html->para('ok done.');
}

function trimImportFile() {
	global $html;


	$infile = new CsvReader('/home/magentouser/products_10.7.2014.csv', ',', true);
	$outfile = new CsvWriter('/home/magentouser/dest/products_trimed.csv', ',');

	$outfile->appendRow(array_keys($infile->getMap()));

	/* NOTE: calling nextRow advances the pointer, so the first row is skipped! */
	while ($row = $infile->nextRow() && (is_empty($infile->item('sku')) || $infile->item('sku') == '123')) {
		1;
	}
	while ($infile->nextRow()) {
		$outfile->appendRow($infile->getData());
	}

	$html->para('should be done');
}

function is_empty($val) {
	return empty($val);
}

class CsvReader {
	private $fileName;
	private $handle;
	private $hMap;
	private $delimiter;
	private $data;

	public function __construct($fn, $d, $head) {
		$this->fileName = $fn;
		$this->delimiter = $d;
		$this->handle = fopen($this->fileName, "r");
		if ($this->handle !== false) {
			if ($head) {
				$map = array();
				$fields = fgetcsv($this->handle, 0, $this->delimiter);
				if ($fields === false) {
					return false;
				}
				for ($i = 0; $i < count($fields); $i++) {
					$map[$fields[$i]] = $i;
				}
				$this->hMap = $map;
			}
		} else {
			return false;
		}
	}

	public function nextRow() {
		$this->data = fgetcsv($this->handle, 0, $this->delimiter);
		return $this->data;
	}

	public function item($field, $value = null) {
		if (isset($value)) {
			if (isset($this->hMap[$field])) {
				$this->data[$this->hMap[$field]] = $value;
			} else {
				$this->data[] = $value;
				$this->hMap[$field] = count($this->hMap);
			}
			return true;
		}
		if (is_array($this->data)) {
			return $this->data[$this->hMap[$field]];
		}
		return false;
	}

	public function close() {
		if ($this->handle) {
			fclose($this->handle);
		}
	}

	public function getMap() {
		return $this->hMap;
	}

	public function getData() {
		return $this->data;
	}

	public function rewind() {
		rewind($this->handle);
		if (isset($this->hMap)) {
			$this->nextRow();
		}
	}
}

class CsvWriter {
	private $finalDestinationPath;
	private $outputFile;
	private $outputOpen = false;
	private $delimiter;
	private $bufferSize;

	public function __construct($destFile, $delim, $buffSize = null) {
		$this->finalDestinationPath = $destFile;
		if (file_exists($this->finalDestinationPath)) {
			if (false === unlink($this->finalDestinationPath)) {
				throw new Exception("CsvWriteBuffer: unable to remove old file '$this->finalDestinationPath'");
			}
		}
		$this->delimiter = $delim;
		$this->bufferSize = $buffSize;
	}

	public function __destruct() {
		$this->closeOutput();
	}

	public function appendRow(array $fields) {
		if (!$this->outputOpen) {
			$this->openOutput();
		}
		if (false === fputcsv($this->outputFile, $fields, $this->delimiter)) {
			throw new Exception("CsvWriter: failed to write row.");
		}
	}

	public function openOutput() {
		if (false === ($this->outputFile = fopen($this->finalDestinationPath, 'a'))) {
			throw new Exception("CsvWriter: Failed to open destination file '$this->finalDestinationPath'.");
		}
		if (!is_null($this->bufferSize)) {
			stream_set_write_buffer($this->outputFile, $this->bufferSize);
		}
		$this->outputOpen = true;
	}

	public function closeOutput() {
		if (!$this->outputOpen) {
			if (false === fclose($this->outputFile)) {
				throw new Exception("CsvWriter: Failed to close destination file'$this->finalDestinationPath'.");
			}
			$this->outputOpen = false;
		}
	}

}

class HtmlOutputter {
	public function __construct() {

	}

	public function startHtml() {
		echo "<!DOCTYPE html>\n<html>\n";
		return $this;
	}

	public function startHead($title = null) {
		echo "<head>\n";
		if ($title)
			echo "<title>$title</title>\n";
		return $this;
	}

	public function endHead() {
		echo "</head>\n";
		return $this;
	}

	public function startBody() {
		echo "<body>\n";
		return $this;
	}

	public function endBody() {
		echo "</body>\n";
		return $this;
	}

	public function endHtml() {
		echo "</html>\n";
		return $this;
	}

	public function para($content) {
		echo '<p>', $content, "</p>\n";
		return $this;
	}

	public function pre($content) {
		echo '<pre>', print_r($content, true), "</pre>\n";
		return $this;
	}

	public function code($content) {
		echo '<code>', $content, "</code>\n";
		return $this;
	}

	public function startList() {
		echo '<ul>', "\n";
		return $this;
	}

	public function endList() {
		echo "</ul>\n";
		return $this;
	}

	public function listItem($content) {
		echo '<li>' . $content . "</li>\n";
		return $this;
	}

	public function startTable($header) {
		echo '<table border="1">', "\n";
		echo '<tr>', "\n";
		foreach ($header as $h) {
			echo '<th>', $h, '</th>';
		}
		echo '</tr>', "\n";
	}

	public function endTable() {
		echo '</table>', "\n";
	}

	public function tableRow($data) {
		echo '<tr>', "\n";
		foreach ($data as $d) {
			echo '<td>', htmlentities(substr($d, 0, 50)), '</td>', "\n";
		}
		echo '</tr>', "\n";
	}
}
