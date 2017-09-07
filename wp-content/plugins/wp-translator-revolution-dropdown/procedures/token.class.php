<?php
/**
 * Translator Revolution DropDown WP Plugin
 * http://goo.gl/xrxDo
 *
 * LICENSE
 *
 * You need to buy a license if you want use this script.
 * http://codecanyon.net/legal/market
 *
 * @package    Translator Revolution WP Plugin
 * @copyright  Copyright (c) 2016, SurStudio, www.surstudio.net
 * @license    http://codecanyon.net/licenses/standard
 * @version    2.0.6
 * @date       2016-11-04
 */

require_once dirname(__FILE__) . '/../classes/main.class.php';

SurStudioPluginTranslatorRevolutionDropDownCommon::printHeaders();

class SurStudioPluginTranslatorRevolutionDropDownTokenManage {
	
	public static function main() {

		try {
			return self::_auth();
		}
		catch(Exception $e) {
			return self::_fail($e);
		}

	}

	protected static function _auth() {

		try {

			$auth = new SurStudioPluginTranslatorRevolutionDropDownAuth();

			return self::_gen_response($auth->generate());

		}
		catch(Exception $e) {

			return self::_fail($e);

		}

	}

	protected static function _fail($_e) {

		return self::_gen_response(array(
			'error' => $_e->getMessage()
		));

	}

	protected static function _gen_response($_array) {

		echo json_encode($_array);
		
	}

}

SurStudioPluginTranslatorRevolutionDropDownTokenManage::main();