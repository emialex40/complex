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

class SurStudioPluginTranslatorRevolutionDropDownConfig {

	const NAME = 'TranslatorRevolutionDropDown';
	const VERSION = '2.0.6';
	const UI_NAME = 'Auto Translation';
	const WIDGET_NAME = 'Translator Revolution DropDown';
	const WELCOME_NAME = 'Dashboard';
	const UI_WELCOME_NAME = 'Dashboard';
	const SETTINGS_NAME = 'Settings';
	const UI_SETTINGS_NAME = 'Settings';
	const WIDGET_INTERNAL_NAME = 'surstudio-translator-revolution-dropdown';
	const ADMIN_LANGUAGE_DOMAIN = 'translator_revolution_dropdown';
	const ADMIN_WELCOME_NAME = 'translator-revolution-dropdown-plugin-dashboard';
	const ADMIN_SETTINGS_NAME = 'translator-revolution-dropdown-plugin-settings';
	const ADMIN_SETTINGS_IMPORT_EXPORT_NAME = 'translator-revolution-dropdow-plugin-import-export-settings';
	const DB_MAIN_NAME = 'translator-revolution-dropdown-main';
	const DB_SETTINGS_NAME = 'translator-revolution-dropdown-settings';
	const DB_CACHE_WRITABLE_FLAG_NAME = 'translator-revolution-dropdown-cache-validate';
	const ENABLE_SUPPORT_TAB = true;

	protected static $_settings = null;
	protected static $_main_settings = null;

	public static function getName($_to_lower=false, $_ui=false) {
		
		if ($_ui)
			return $_to_lower ? strtolower(self::UI_NAME) : self::UI_NAME;
		else
			return $_to_lower ? strtolower(self::NAME) : self::NAME;
		
	}

	public static function getWelcomeName($_to_lower=false, $_ui=false) {

		if ($_ui)
			return $_to_lower ? strtolower(self::UI_WELCOME_NAME) : self::UI_WELCOME_NAME;
		else
			return $_to_lower ? strtolower(self::WELCOME_NAME) : self::WELCOME_NAME;
		
	}
	
	public static function getSettingsName($_to_lower=false, $_ui=false) {

		if ($_ui)
			return $_to_lower ? strtolower(self::UI_SETTINGS_NAME) : self::UI_SETTINGS_NAME;
		else
			return $_to_lower ? strtolower(self::SETTINGS_NAME) : self::SETTINGS_NAME;
		
	}

	public static function getWidgetName($_internal=false) {
	
		return $_internal ? self::WIDGET_INTERNAL_NAME : self::WIDGET_NAME;
		
	}
	
	public static function getVersion() {
	
		return self::VERSION;
		
	}	

	public static function getAdminLanguageDomain() {
		
		return self::ADMIN_LANGUAGE_DOMAIN;
		
	}

	public static function getAdminPageTitle() {
		
		return __('Plugin Settings', SURSTUDIO_TRD_TEXTDOMAIN);
		
	}

	public static function getWelcomeHandle() {
		
		return self::ADMIN_WELCOME_NAME;
		
	}
	
	public static function getAdminHandle() {
		
		return self::ADMIN_SETTINGS_NAME;
		
	}

	public static function getAdminImportExportHandle() {
		
		return self::ADMIN_SETTINGS_IMPORT_EXPORT_NAME;
		
	}

	public static function isSupportTabEnabled() {
		
		return self::ENABLE_SUPPORT_TAB;
		
	}

	public static function getDbCacheWritableName() {
		
		return self::DB_CACHE_WRITABLE_FLAG_NAME;
		
	}

	public static function getDbMainName() {
		
		return self::DB_MAIN_NAME;
		
	}

	public static function getDbSettingsName() {
		
		return self::DB_SETTINGS_NAME;
		
	}

	public static function setCacheFlag($_value) {
		
		$name = SurStudioPluginTranslatorRevolutionDropDownConfig::getDbCacheWritableName();
		
		$value = $_value ? 'true' : 'false';
		
		if (!get_option($name))
			add_option($name, $value);
		else
			update_option($name, $value);
		
	}

	public static function getCacheFlag() {

		$option = get_option(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbCacheWritableName());
		
		if (!$option)
			return false;
			
		return $option == 'true';
		
	}

	public static function _get_main_settings() {
		
		$option = get_option(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbMainName());
		return !$option ? array() : $option;
		
	}

	public static function _get_settings() {
		
		$option = get_option(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName());
		return !$option ? array() : $option;
		
	}
	
	public static function getMainSettings($_force=false) {
		
		if (is_array(self::$_main_settings) && $_force == false)
			return self::$_main_settings;
		
		$defaults = self::getMainDefaults();

		$current = self::_get_main_settings();

		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::mergeArrays($defaults, $current);

		return self::$_settings = $result;
		
	}
	
	public static function getSettings($_force=false) {
		
		if (is_array(self::$_settings) && $_force == false)
			return self::$_settings;
		
		$defaults = self::getDefaults();

		$current = self::_get_settings();

		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::mergeArrays($defaults, $current);

		$result = self::_adjust_languages($result, $current);
		
		return self::$_settings = $result;
		
	}

	protected static function _adjust_languages($_settings, $_current) {
		
		$result = $_settings;
		
		if (array_key_exists('languages', $_current))
			$result['languages']['value'] = $_current['languages']['value'];
		
		return $result;
		
	}
	
	public static function getMainSetting($_name, $_force=false) {

		$settings = self::getMainSettings($_force);
		
		return array_key_exists($_name, $settings) ? $settings[$_name] : null;
		
	}
	
	public static function getSetting($_name, $_force=false) {
		
		$settings = self::getSettings($_force);
		
		return array_key_exists($_name, $settings) ? $settings[$_name] : null;
		
	}

	protected static function _compare_settings($_id, $_setting_1, $_setting_2) {
		
		if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($_id, '_template'))
			return SurStudioPluginTranslatorRevolutionDropDownCommon::stripBreakLinesAndTabs($_setting_1['value']) == SurStudioPluginTranslatorRevolutionDropDownCommon::stripBreakLinesAndTabs($_setting_2['value']);
		
		if ($_id == 'override')
			if ($_setting_1['value'] != $_setting_2['value'] && SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($_setting_1['value']))
				return true;
		
		if ($_id == 'languages')
			return $_setting_1['value'] === $_setting_2['value'];
			
		return $_setting_1['value'] == $_setting_2['value'];
		
	}
	
	protected static function _get_settings_values_for_export() {
		
		$settings = self::_get_settings();
		
		return count($settings) > 0 ? base64_encode(serialize($settings)) : __('No settings to export. The current settings are the default ones.', SURSTUDIO_TRD_TEXTDOMAIN);
		
	}
	
	public static function getSettingsValues($_force=false, $_new=true) {
		
		$result = array();
		$settings = self::getSettings($_force);
				
		$defaults = self::getDefaults();
				
		foreach ($settings as $key => $setting)
			if ($_new == false || !self::_compare_settings($key, $setting, $defaults[$key]))
				$result[$key] = array(
					'value' => $setting['value'],
					'option_id' => array_key_exists('option_id', $setting) ? $setting['option_id'] : null
				);
			
		return $result;

	}

	public static function getMainSettingValue($_name, $_force=false) {
		
		$setting = self::getMainSetting($_name, $_force);
		$result = $setting['value'];
		
		if (SurStudioPluginTranslatorRevolutionDropDownValidator::isBool($result))
			$result = $result == 'true' || $result === true;
		
		return $result;
		
	}
	
	public static function getSettingValue($_name, $_force=false) {
		
		$setting = self::getSetting($_name, $_force);
		
		if (is_null($setting))
			return $setting;
		
		$result = $setting['value'];
		
		if (SurStudioPluginTranslatorRevolutionDropDownValidator::isBool($result))
			$result = $result == 'true' || $result === true;
		
		return $result;
		
	}

	public static function isVerified() {
		
		$settings = self::_get_main_settings();
		return array_key_exists('verify', $settings) ? (!empty($settings['verify']['value']['email']) && !empty($settings['verify']['value']['item_purchase_code']) && !empty($settings['verify']['value']['verification_code']) && !empty($settings['verify']['value']['support_pin'])) : false;
		
	}
	
	public static function getMainDefaults() {
		
		$is_verified = self::isVerified();
		
		$result = array(

			'version' => array(
				'title_message' => __('Version information', SURSTUDIO_TRD_TEXTDOMAIN),
				'current_message' => __('Installed version:', SURSTUDIO_TRD_TEXTDOMAIN),
				'latest_message' => __('Latest available version:', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_1_message' => __('Check Version', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_2_message' => __('Update', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_3_message' => __('Get verified below, and update the plugin with a single click!', SURSTUDIO_TRD_TEXTDOMAIN),
				'whats_new_message' => __('What\'s new?', SURSTUDIO_TRD_TEXTDOMAIN),
				'up_to_date_message' => __('The latest version of the plugin is already installed on this site.', SURSTUDIO_TRD_TEXTDOMAIN),
				'update_message' => __('You\'re about to update the plugin. Do you want to continue?', SURSTUDIO_TRD_TEXTDOMAIN),
				'is_verified' => $is_verified,
				'id' => 'surstudio_version',
				'type' => 'version',
				'value' => '',
				'group' => 1
			),
		
			'verify' => array(
				'title_message' => sprintf(__('Would you like %s, %s and %s?', SURSTUDIO_TRD_TEXTDOMAIN), '<em>' . __('Online Backups', SURSTUDIO_TRD_TEXTDOMAIN) . '</em>', '<em>' . __('Priority Support', SURSTUDIO_TRD_TEXTDOMAIN) . '</em>', '<em>' . __('Live Updates', SURSTUDIO_TRD_TEXTDOMAIN) . '</em>'),
				'button_1_message' => __('Activate Now | Why?', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_2_message' => __('Register', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_3_message' => __('Verify', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_4_message' => __('Back', SURSTUDIO_TRD_TEXTDOMAIN),
				'why_message' => sprintf(__('On September 2015, Envato launched the %s. This means you\'re entitled to have 6 or 12 months of support on your purchased Items. After this period you won\'t be able to activate these extended features unless you purchase an extension package. Once activated, the extended features will still be available even after the support period is finished.', SURSTUDIO_TRD_TEXTDOMAIN), '<a href="https://forums.envato.com/t/item-support-policy-and-functionality-launched/3619" target="_blank">' . __('Item Support Policy', SURSTUDIO_TRD_TEXTDOMAIN) . '</a>'),
				'sub_title_message' => __('Get verified to unlock the following features:', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_1_message' => sprintf(__('%s: Backup your settings and custom translations online with a single click.', SURSTUDIO_TRD_TEXTDOMAIN), '<strong>' . __('Online Backups', SURSTUDIO_TRD_TEXTDOMAIN) . '</strong>'),
				'description_2_message' => sprintf(__('%s: Have the upper hand and get your support delieverd even faster. Weekends included!', SURSTUDIO_TRD_TEXTDOMAIN), '<strong>' . __('Priority Support', SURSTUDIO_TRD_TEXTDOMAIN) . '</strong>'),
				'description_3_message' => sprintf(__('%s: Get the latest version of our plugin. New features and bug fixes are available regularly.', SURSTUDIO_TRD_TEXTDOMAIN), '<strong>' . __('Live Updates', SURSTUDIO_TRD_TEXTDOMAIN) . '</strong>'),
				'complete_1_title_message' => __('Online Backups', SURSTUDIO_TRD_TEXTDOMAIN),
				'complete_1_description_message' => sprintf(__('Backing up your settings and translations has never been easier. Find the %s tab in the plugin\'s admin settings.', SURSTUDIO_TRD_TEXTDOMAIN), '<em>' . __('Online Backup', SURSTUDIO_TRD_TEXTDOMAIN) . '</em>'),
				'complete_2_title_message' => __('Priority Support', SURSTUDIO_TRD_TEXTDOMAIN),
				'complete_2_description_message' => sprintf(__('Include your priotiry PIN when asking for support in %s', SURSTUDIO_TRD_TEXTDOMAIN), '<a href="http://codecanyon.net/user/surstudio#contact" target="_blank">http://codecanyon.net/user/surstudio#contact</a>'),
				'complete_2_priority_pin' => __('Priority PIN:', SURSTUDIO_TRD_TEXTDOMAIN),
				'complete_3_title_message' => __('Live Updates', SURSTUDIO_TRD_TEXTDOMAIN),
				'complete_3_description_message' => sprintf(__('Now you can update the plugin in no time and no effort! Check the above %s section, a new <em>Update</em> button is displayed.', SURSTUDIO_TRD_TEXTDOMAIN), '<em>' . __('Version information', SURSTUDIO_TRD_TEXTDOMAIN) . '</em>'),
				'email_title_message' => __('E-mail address', SURSTUDIO_TRD_TEXTDOMAIN),
				'email_description_message' => __('An activation e-mail will be sent immediately', SURSTUDIO_TRD_TEXTDOMAIN),
				'item_purchase_code_title_message' => __('Item Purchase Code', SURSTUDIO_TRD_TEXTDOMAIN),
				'item_purchase_code_description_message' => sprintf(__('You can find your code by following the instructions on %s', SURSTUDIO_TRD_TEXTDOMAIN), '<a target="_blank" href="http://www.surstudio.net/translator-revolution-dropdown/item-purchase-code/">' . __('this page', SURSTUDIO_TRD_TEXTDOMAIN) . '</a>'),
				'verification_code_title_message' => __('Verification code', SURSTUDIO_TRD_TEXTDOMAIN),
				'verification_code_sub_title_message' => __('Enter the 32 characters verification code', SURSTUDIO_TRD_TEXTDOMAIN),
				'complete_title_message' => __('Congratulations, the extended features are activated!', SURSTUDIO_TRD_TEXTDOMAIN),
				'verification_code_description_message' => sprintf(__('An email has been sent to your %s e-mail address.%sIf you don\'t see it in your INBOX, make sure to check your SPAM folder.', SURSTUDIO_TRD_TEXTDOMAIN), '<em></em>', '<br />'),
				'id' => 'surstudio_verify',
				'type' => 'verify',
				'value' => array(
					'email' => '',
					'item_purchase_code' => '',
					'verification_code' => '',
					'support_pin' => ''
				),
				'group' => 1
			),

			'newsletter' => array(
				'title_message' => __('Newsletter', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_1_message' => __('Why subscribe?', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_2_message' => __('Subscribe', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_3_message' => __('Verify', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_4_message' => __('Back', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_5_message' => __('Unsubscribe', SURSTUDIO_TRD_TEXTDOMAIN),
				'subscribe_title_message' => __('Subscribe', SURSTUDIO_TRD_TEXTDOMAIN),
				'subscribe_description_message' => __('Enter your e-mail address', SURSTUDIO_TRD_TEXTDOMAIN),
				'verification_code_title_message' => __('Verification code', SURSTUDIO_TRD_TEXTDOMAIN),
				'verification_code_description_message' => sprintf(__('An email has been sent to your %s e-mail address.<br />If you don\'t see it in your INBOX, make sure to check your SPAM folder.', SURSTUDIO_TRD_TEXTDOMAIN), '<em></em>'),
				'sub_title_message' => __('Subscribe to our newsletter and be notified on:', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_1_message' => __('Information about new plugin releases.', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_2_message' => __('Polls and surveys that help us increase the quality of our plugin.', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_3_message' => __('You may unsubscribe any time!', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_newsletter',
				'type' => 'newsletter',
				'value' => array(
					'email' => '',
					'verification_code' => ''
				),
				'group' => 1
			)

		);
		
		return $result;
		
	}
	
	public static function getDefaults() {
		
		$result = array(

			'api_key' => array(
				'title_message' => __('Item Purchase Code', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('
			Enter your Item Purchase Code. To find it see the <a href="http://www.surstudio.net/translator-revolution-dropdown-widget-wordpress-plugin/installation/" target="_blank">Installation Guide</a>.
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_api_key',
				'type' => 'text',
				'value' => '',
				'group' => 1
			),
			
			'from' => array(
				'title_message' => __('Website\'s language', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the website\'s source language.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_from',
				'option_id' => 'from',
				'type' => 'select',
				'values' => SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguages(),
				'value' => 'en',
				'group' => 1
			),
			
			'languages' => array(
				'title_message' => __('Available languages', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the available languages.', SURSTUDIO_TRD_TEXTDOMAIN),
				'title_order_message' => __('Languages order', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_order_message' => __('Defines the order to display the languages.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_languages',
				'option_id' => 'languages',
				'values' => SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguages(),
				'value' => array('en', 'es', 'fr', 'de', 'da', 'ja', 'it', 'pt'),
				'type' => 'language',
				'columns' => 4,
				'group' => 1
			),

			'native_languages' => array(
				'title_message' => __('Languages in their own language', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether to display the languages names in their own language, or not. To define custom names, use the following setting:<br /><br /><div class=\"surstudio_plugin_translator_revolution_dropdown_code_container\"><code>Advanced &gt; General &gt; Other customizations &gt; Custom languages names</code></div>', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_native_languages',
				'type' => 'toggle',
				'value' => 'false',
				'values' => array(
					'true' => __('Yes, display languages in their own language', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, display languages in English', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'group' => 1
			),
			
			'ui_heading' => array(
				'title_message' => __('Interface', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_ui_heading',
				'type' => 'heading',
				'group' => 1
			),

			'scroll' => array(
				'title_message' => __('Enable scroll', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the scroll functionality should be enabled or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_scroll',
				'option_id' => 'scroll',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, enable the scroll functionality', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t enable the scroll functionality', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),

			'scroll_bar_languages' => array(
				'title_message' => __('Languages quantity', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets how many languages will be visible within the scrolling viewport.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '1',
				'max' => '37',
				'step' => '1',
				'unit' => __('languages', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_scroll_bar_languages',
				'option_id' => 'scrollBarLanguages',
				'value' => '5',
				'type' => 'range',
				'dependence' => array('ui_heading', 'scroll'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),

			'scroll_bar_width' => array(
				'title_message' => __('Scroll bar width', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the scroll bar width.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '1',
				'max' => '20',
				'step' => '1',
				'unit' => __('pixels', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_scroll_bar_width',
				'option_id' => 'scrollBarWidth',
				'value' => '5',
				'type' => 'range',
				'dependence' => array('ui_heading', 'scroll'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),

			'scroll_bar_opacity' => array(
				'title_message' => __('Scroll bar opacity', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the scroll bar opacity.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '0',
				'max' => '100',
				'step' => '5',
				'unit' => __('%', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_scroll_bar_opacity',
				'option_id' => 'scrollBarOpacity',
				'value' => '40',
				'type' => 'range',
				'dependence' => array('ui_heading', 'scroll'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),

			'scroll_bar_wheel_step' => array(
				'title_message' => __('Mouse wheel step', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the mouse wheel step.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '1',
				'max' => '30',
				'step' => '1',
				'unit' => __('units', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_scroll_bar_wheel_step',
				'option_id' => 'scrollBarWheelStep',
				'value' => '10',
				'type' => 'range',
				'dependence' => array('ui_heading', 'scroll'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),

			'cookie' => array(
				'title_message' => __('Remember the selected language for auto-translate', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the selected language should be remembered (in a cookie) after a page is refreshed or not. If it\'s set and the visitor continues browsing, the website will be automatically translated.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_cookie',
				'option_id' => 'cookie',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, remember the selected language to auto-translate', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t remember the selected language and don\'t auto-translate', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),
			
			'cookie_persistency' => array(
				'title_message' => __('Remember even after the browser is closed', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the <code>Remember the selected language for auto-translate</code> should be kept after the visitor\'s browser is closed or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_cookie_persistency',
				'option_id' => 'cookiePersistency',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, remember even after the browser is closed', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t remember after the browser is closed', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => array('ui_heading', 'cookie'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),
			
			'flags' => array(
				'title_message' => __('Flags', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the languages flags should be displayed or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_flags',
				'option_id' => 'flags',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, display the images flags', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t display the images flags', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),
			
			'names' => array(
				'title_message' => __('Names', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the languages names should be displayed or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_names',
				'option_id' => 'names',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, display the languages names', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t display the languages names', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),
			
			'short_names' => array(
				'title_message' => __('Short names', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the languages names should be displayed in short mode or not.<br />For instance: EN, ES, DA.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_short_names',
				'option_id' => 'shortNames',
				'type' => 'toggle',
				'value' => 'false',
				'values' => array(
					'true' => __('Yes, display the languages names in short mode', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, display the languages full names', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => array('ui_heading', 'names'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),

			'show_low_resolution' => array(
				'title_message' => __('Hide name or flag', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether to hide the language name or the language flag for lower resolutions, or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_show_low_resolution',
				'option_id' => 'hideLanguage',
				'type' => 'radio',
				'value' => 'false',
				'values' => array(
					'name' => __('Hide the language name', SURSTUDIO_TRD_TEXTDOMAIN),
					'flag' => __('Hide the language flag', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('Don\'t hide anything', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),

			'low_resolution' => array(
				'title_message' => __('Hide on screen width', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Defines a maximum width in pixels to trigger the above setting.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '200',
				'max' => '1600',
				'step' => '20',
				'unit' => __('pixels', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_low_resolution',
				'option_id' => 'lowResolution',
				'type' => 'range',
				'value' => '640',
				'dependence' => array('ui_heading', 'show_low_resolution', 'show_low_resolution'),
				'dependence_show_value' => array('true', 'name', 'flag'),
				'group' => 1
			),

			'loading' => array(
				'title_message' => __('Loading image', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the loading class should be set or not. If it\'s set, a style class (defined in the <code>Loading class</code> setting) will be added to the clicked language\'s link. By default, the class displays an animated image indicating the loading.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_loading',
				'option_id' => 'loading',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, display the loading animated image', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t display the loading animated image', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),

			'complete' => array(
				'title_message' => __('Highlight the selected language', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the completed class should be set or not. If it\'s set, a style class (defined in the <code>Completed class</code> setting) will be added to the clicked language. By default, the class highlights the selected language at the end of the translation process.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_complete',
				'option_id' => 'complete',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, highlight the selected language', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t highlight the selected language', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'ui_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),

			'auto_select' => array(
				'title_message' => __('Auto highlight the selected language', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('
			Automatically highlight the page\'s language when it\'s loaded, just to provide visual aids.
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_auto_select',
				'option_id' => 'autoSelect',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, auto highlight the language option', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t auto highlight the language option', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => array('ui_heading', 'complete'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 1
			),
			
			'selector_heading' => array(
				'title_message' => __('Select and exclude sections', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_selector_heading',
				'type' => 'heading',
				'group' => 1
			),

			'target_selector' => array(
				'title_message' => __('Target selector (jQuery)', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Select those elements to be translated. In jQuery format. For more info, check the <a href=\"http://api.jquery.com/category/selectors/\">jQuery selector guide</a>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_target_selector',
				'option_id' => 'targetSelector',
				'type' => 'text',
				'value' => 'body',
				'dependence' => 'selector_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),
			
			'exclude_selector' => array(
				'title_message' => __('Exclude selector (jQuery)', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Select those elements to NOT be translated. In jQuery format. For more info, check the <a href=\"http://api.jquery.com/category/selectors/\">jQuery selector guide</a>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_exclude_selector',
				'option_id' => 'excludeSelector',
				'type' => 'text',
				'value' => 'code, #wpadminbar, input:hidden, .do-not-translate-me, .dont-translate',
				'dependence' => 'selector_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),
			
			'display_heading' => array(
				'title_message' => __('Hide on pages, posts and categories', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_display_heading',
				'type' => 'heading',
				'group' => 1
			),
			
			'exclude_pages' => array(
				'title_message' => __('Pages', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Selects the pages where the translator should not be displayed.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_exclude_pages',
				'value' => array(''),
				'type' => 'expage',
				'dependence' => 'display_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),

			'exclude_posts' => array(
				'title_message' => __('Posts', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Selects the posts where the translator should not be displayed.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_exclude_posts',
				'value' => array(''),
				'type' => 'expost',
				'dependence' => 'display_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),
			
			'exclude_categories' => array(
				'title_message' => __('Categories', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Selects the categories where the translator should not be displayed.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_exclude_categories',
				'value' => array(''),
				'type' => 'excategory',
				'dependence' => 'display_heading',
				'dependence_show_value' => 'true',
				'group' => 1
			),

			'test_mode' => array(
				'title_message' => __('Test mode', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('
			Sets whether the translator is in test mode or not. In "test mode", the translator will be displayed only if the current logged in user has admin privileges.<br />
			Is useful for setting up the translator without letting visitors to see the changes while the plugin is being implemented.
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_test_mode',
				'type' => 'toggle',
				'value' => 'false',
				'values' => array(
					'true' => __('Yes, enable test mode', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, disable test mode', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'group' => 2
			),

			'location_widget' => array(
				'title_message' => __('Location', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('
			Sets translator location.
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_location_widget',
				'option_id' => 'locationWidget',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => sprintf(__('Widget (see <a href="%s">Appearance > Widgets</a>)', SURSTUDIO_TRD_TEXTDOMAIN), SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminWidgetsUrl()),
					'false' => __('Custom', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'group' => 2
			),

			'widget_class' => array(
				'title_message' => __('Widget class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class used on the widget\'s placeholder.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_widget_class',
				'type' => 'text',
				'value' => 'translator-dropdown-main-container',
				'dependence' => 'location_widget',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'dropdown_container_id' => array(
				'title_message' => __('Widget container id', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the internal widget\'s container <code>id</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_dropdown_container_id',
				'option_id' => 'dropdownContainerId',
				'type' => 'text',
				'value' => 'translator-dropdown-jquery-container',
				'dependence' => 'location_widget',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'location_custom' => array(
				'title_message' => __('Custom location (jQuery)', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Specifies a location to place the translator. In jQuery format. For more info, check the <a href=\"http://api.jquery.com/category/selectors/\">jQuery selector guide</a>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_location_custom',
				'option_id' => 'location',
				'type' => 'text',
				'value' => '',
				'dependence' => 'location_widget',
				'dependence_show_value' => 'false',
				'group' => 2
			),

			'custom_location_insert_mode' => array(
				'title_message' => __('Insert mode', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Specifies how the translator (or the <code>Custom parent</code>) will be inserted into the <code>Custom location</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_custom_location_insert_mode',
				'option_id' => 'customLocationAppendMode',
				'type' => 'select',
				'values' => array(
					'append' => 'Append',
					'prepend' => 'Prepend',
					'before' => 'Insert before',
					'after' => 'Insert after'
				),
				'value' => 'append',
				'dependence' => 'location_widget',
				'dependence_show_value' => 'false',
				'group' => 2
			),

			'custom_parent' => array(
				'title_message' => __('Custom parent', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Specifies a custom parent element container (or set) to hold the translator.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_custom_parent',
				'option_id' => 'customParent',
				'type' => 'select',
				'values' => array(
					'' => '',
					'div' => 'div',
					'span' => 'span',
					'li' => 'li',
					'ul-li' => 'ul > li',
					'ol-li' => 'ol > li',
					'td' => 'td',
					'tr-td' => 'tr > td',
					'table-tr-td' => 'table > tr > td'
				),
				'value' => '',
				'group' => 2
			),

			'custom_css' => array(
				'title_message' => __('Custom CSS', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Defines custom CSS rules.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_custom_css',
				'type' => 'textarea',
				'value' => '',
				'group' => 2
			),

			'cache_heading' => array(
				'title_message' => __('Local storage', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_cache_heading',
				'type' => 'heading',
				'group' => 2
			),

			'local_storage' => array(
				'title_message' => __('Enable local storage', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the translations should be stored in the visitor\'s browser to speed up the plugin, or not. This feature is available on modern browsers only, it won\'t cause any impact on old browsers. However, it forces the visitor\'s browser to use an extra amount of memory, therefore, it might slow it down depending on how many translations are being stored.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_local_storage',
				'option_id' => 'localStorage',
				'type' => 'toggle',
				'value' => 'false',
				'values' => array(
					'true' => __('Yes, enable local storage', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t enable local storage', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'cache_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'local_storage_expires' => array(
				'title_message' => __('Expiration period', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets an expiration period for the stored translations, in days.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '1',
				'max' => '365',
				'step' => '1',
				'unit' => __('days', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_local_storage_expires',
				'option_id' => 'localStorageExpires',
				'value' => '30',
				'type' => 'range',
				'dependence' => array('cache_heading', 'local_storage'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 2
			),
			
			'clear_local_storage' => array(
				'title_message' => __('Clear local storage', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether to force the visitor\'s browser to clear up the stored translations and retrieve them again from the server, or not. This setting is useful when writing custom translations.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_clear_local_storage',
				'option_id' => 'clearLocalStorage',
				'type' => 'toggle',
				'value' => 'false',
				'values' => array(
					'true' => __('Yes, force browsers to clear up the stored translations', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t force browsers to clear up the stored translations', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => array('cache_heading', 'local_storage'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 2
			),

			'style_classes_heading' => array(
				'title_message' => __('Style classes', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_style_classes_heading',
				'type' => 'heading',
				'group' => 2
			),

			'container_class' => array(
				'title_message' => __('Container class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s container.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_container_class',
				'option_id' => 'containerClass',
				'type' => 'text',
				'value' => 'translator-dropdown-container',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'container_custom_class' => array(
				'title_message' => __('Container class (custom location)', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s container. Only applies if Custom Location is set.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_container_custom_class',
				'option_id' => 'containerCustomClass',
				'type' => 'text',
				'value' => 'translator-dropdown-container-custom',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'sub_container_class' => array(
				'title_message' => __('Sub container class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s sub container.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_sub_container_class',
				'option_id' => 'subContainerClass',
				'type' => 'text',
				'value' => 'translator-dropdown-sub-container',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'floating_left_class' => array(
				'title_message' => __('Floating left class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s container when the <code>Floating mode</code> setting is set to <code>Float left</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_floating_left_class',
				'option_id' => 'floatingLeftClass',
				'type' => 'text',
				'value' => 'translator-dropdown-floating-left',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'floating_right_class' => array(
				'title_message' => __('Floating right class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s container when the <code>Floating mode</code> setting is set to <code>Float right</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_floating_right_class',
				'option_id' => 'floatingRightClass',
				'type' => 'text',
				'value' => 'translator-dropdown-floating-right',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'body_class' => array(
				'title_message' => __('Body class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s body.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_body_class',
				'option_id' => 'bodyClass',
				'type' => 'text',
				'value' => 'translator-dropdown-body',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'current_language_container_class' => array(
				'title_message' => __('Current language container class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the current selected language.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_current_language_container_class',
				'option_id' => 'currentLanguageContainerClass',
				'type' => 'text',
				'value' => 'translator-dropdown-current-language',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'current_language_container_arrow_class' => array(
				'title_message' => __('Current language arrow container class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the arrow container.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_current_language_container_arrow_class',
				'option_id' => 'currentLanguageContainerArrowClass',
				'type' => 'text',
				'value' => 'translator-dropdown-current-language-arrow',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'languages_list_class' => array(
				'title_message' => __('Language list class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the languages list container.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_languages_list_class',
				'option_id' => 'languagesListClass',
				'type' => 'text',
				'value' => 'translator-dropdown-languages-list',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'languages_list_opened_class' => array(
				'title_message' => __('Language opened list class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the languages list container when is unfolded.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_languages_list_opened_class',
				'option_id' => 'languagesListOpenedClass',
				'type' => 'text',
				'value' => 'translator-dropdown-languages-list-opened',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'scroll_class' => array(
				'title_message' => __('Scroll enabled class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s container, if the <code>Scroll</code> setting is enabled.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_scroll_class',
				'option_id' => 'scrollClass',
				'type' => 'text',
				'value' => 'translator-dropdown-scroll-enabled',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'hover_enabled_class' => array(
				'title_message' => __('Hover enabled class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the translator\'s container, if the visitor\'s browser supports hovering, unlike a touch device.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_hover_enabled_class',
				'option_id' => 'hoverEnabledClass',
				'type' => 'text',
				'value' => 'translator-dropdown-hover-enabled',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'languages_list_scroll_class' => array(
				'title_message' => __('Language list scroll class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the languages list container parent, if the <code>Scroll</code> setting is enabled.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_languages_list_scroll_class',
				'option_id' => 'languagesListScrollClass',
				'type' => 'text',
				'value' => 'translator-dropdown-languages-list-scroll',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'languages_list_scroll_bar_class' => array(
				'title_message' => __('Language list scroll bar class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the scroll bar, if the <code>Scroll</code> setting is enabled.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_languages_list_scroll_bar_class',
				'option_id' => 'languagesListScrollBarClass',
				'type' => 'text',
				'value' => 'translator-dropdown-languages-list-scroll-bar',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'loading_class' => array(
				'title_message' => __('Loading class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the clicked language\'s link while the translation takes place.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_loading_class',
				'option_id' => 'loadingClass',
				'type' => 'text',
				'value' => 'translator-dropdown-loading',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'completed_class' => array(
				'title_message' => __('Completed class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class to be added to the clicked language\'s link when the translation is completed.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_completed_class',
				'option_id' => 'completedClass',
				'type' => 'text',
				'value' => 'translator-dropdown-completed',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'flags_class' => array(
				'title_message' => __('Flags class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Adds a style class to the translator\'s main container when is showing only languages flags.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_flags_class',
				'option_id' => 'flagsClass',
				'type' => 'text',
				'value' => 'translator-dropdown-flags',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'flags_and_names_class' => array(
				'title_message' => __('Flags and names class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Adds a style class to the translator\'s main container when is showing languages flags and names.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_flags_and_names_class',
				'option_id' => 'flagsAndNamesClass',
				'type' => 'text',
				'value' => 'translator-dropdown-flags-and-names',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'flags_and_short_names_class' => array(
				'title_message' => __('Flags and short names class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Adds a style class to the translator\'s main container when is showing languages flags and short names.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_flags_and_short_names_class',
				'option_id' => 'flagsAndShortNamesClass',
				'type' => 'text',
				'value' => 'translator-dropdown-flags-and-short-names',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'names_class' => array(
				'title_message' => __('Names class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Adds a style class to the translator\'s main container when is showing only languages names.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_names_class',
				'option_id' => 'namesClass',
				'type' => 'text',
				'value' => 'translator-dropdown-names',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),
			
			'short_names_class' => array(
				'title_message' => __('Short names class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Adds a style class to the translator\'s main container when is showing only languages short names.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_short_names_class',
				'option_id' => 'shortNamesClass',
				'type' => 'text',
				'value' => 'translator-dropdown-short-names',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'hidden_class' => array(
				'title_message' => __('Hide class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the style class used to hide elements.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_hidden_class',
				'option_id' => 'hiddenClass',
				'type' => 'text',
				'value' => 'translator-dropdown-hidden',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'language_selector_class' => array(
				'title_message' => __('Language selector class', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('
			Sets the style class used to identify the selected language. The language code will be concatenated:<br />
			<div class="surstudio_plugin_translator_revolution_dropdown_code_container"><code>&lt;a class="<b>translator-language-</b>en" title="English" href="javascript:;"&gt;&lt;img alt="English" src="../translator/images/English.gif"&gt;&lt;span&gt;English&lt;/span&gt;&lt;/a&gt;</code></div>
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_language_selector_class',
				'option_id' => 'languageSelectorClass',
				'type' => 'text',
				'value' => 'translator-dropdown-language-',
				'dependence' => 'style_classes_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'templates_heading' => array(
				'title_message' => __('Templates', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_templates_heading',
				'type' => 'heading',
				'group' => 2
			),

			'flag_template' => array(
				'title_message' => __('Flag template', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the language\'s flag template. New templates can be created if the provided one doesn\'t fit the web page requirements.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_flag_template',
				'option_id' => 'flagTemplate',
				'type' => 'textarea',
				'value' => '<img src="{{ src }}" alt="{{ name }}" {{ class }}/>',
				'dependence' => 'templates_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),
			
			'link_template' => array(
				'title_message' => __('Link template', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the language\'s link template. New templates can be created if the provided one doesn\'t fit the web page requirements.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_link_template',
				'option_id' => 'linkTemplate',
				'type' => 'textarea',
				'value' => '<p>
	<a href="javascript:;" title="{{ name }}" class="{{ language_selector_class }}">{{ content }}</a>
</p>',
				'dependence' => 'templates_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'links_container_template' => array(
				'title_message' => __('Links container template', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the languages links container template. New templates can be created if the provided one doesn\'t fit the web page requirements.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_links_container_template',
				'option_id' => 'linksContainerTemplate',
				'type' => 'textarea',
				'value' => '<div class="{{ sub_container_class }}">
	<div class="{{ body_class }}">
		<p class="{{ current_language_container_class }}"></p>
		<em class="{{ current_language_container_arrow_class }}" />
		<div class="{{ languages_list_class }}">{{ content }}</div>
	</div>
</div>',
				'dependence' => 'templates_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'name_template' => array(
				'title_message' => __('Name template', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the language\'s name template. New templates can be created if the provided one doesn\'t fit the web page requirements.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_name_template',
				'option_id' => 'nameTemplate',
				'type' => 'textarea',
				'value' => '<span {{ class }}>{{ name }}</span>',
				'dependence' => 'templates_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'callbacks_heading' => array(
				'title_message' => __('Javascript callbacks', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_callbacks_heading',
				'type' => 'heading',
				'group' => 2
			),

			'on_before_initialize' => array(
				'title_message' => __('On before initialize callback', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets a callback function that runs before the translator is initialized. Receives two arguments: <code>translator, options</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_on_before_initialize',
				'option_id' => 'onBeforeInitialize',
				'type' => 'textarea',
				'value' => 'function(translator, options) {}',
				'dependence' => 'callbacks_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'on_initialize' => array(
				'title_message' => __('On initialize callback', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets a callback function that runs when the translator is being initialized. Receives two arguments: <code>translator, options</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_on_initialize',
				'option_id' => 'onInitialize',
				'type' => 'textarea',
				'value' => 'function(translator, options) {}',
				'dependence' => 'callbacks_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'on_start' => array(
				'title_message' => __('On start callback', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets a callback function that runs when the translation starts. Receives five arguments: <code>filtered_elements, source, from, to, options</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_on_start',
				'option_id' => 'onStart',
				'type' => 'textarea',
				'value' => 'function(filtered_elements, source, from, to, options) {}',
				'dependence' => 'callbacks_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'on_complete' => array(
				'title_message' => __('On complete callback', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets a callback function that runs when the translation is completed. Receives seven arguments: <code>filtered_elements, translation, source, from, to, options, restore</code>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_on_complete',
				'option_id' => 'onComplete',
				'type' => 'textarea',
				'value' => 'function(filtered_elements, translation, source, from, to, options, restore) {}',
				'dependence' => 'callbacks_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'on_before_load' => array(
				'title_message' => __('On before load', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Defines a javascript routine that runs before the translator is loaded.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_on_before_load',
				'type' => 'textarea',
				'value' => '',
				'dependence' => 'callbacks_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'other_customizations_heading' => array(
				'title_message' => __('Other customizations', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => '',
				'value' => 'false',
				'id' => 'surstudio_other_customizations_heading',
				'type' => 'heading',
				'group' => 2
			),

			'id' => array(
				'title_message' => __('Id', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('
			Sets the internal <code>id</code> unique value.
			It could also be used for custom styling purposes, since the translator id will be placed in the container\'s class attribute:<br /><br />
			<div class="surstudio_plugin_translator_revolution_dropdown_code_container"><code>&lt;div class="translator translator-container <b>&lt;id&gt;</b> translator-names"&gt;</code></div>
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_id',
				'option_id' => 'id',
				'type' => 'text',
				'value' => 'translator-dropdown-jquery',
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'requests' => array(
				'title_message' => __('Requests', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the maximum number of requests sent to the API at the same time. A high number of requests will translate the page faster, but might hang or even crash the internet browser.', SURSTUDIO_TRD_TEXTDOMAIN),
				'min' => '1',
				'max' => '10',
				'step' => '1',
				'unit' => __('requests', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_requests',
				'option_id' => 'requests',
				'value' => '5',
				'type' => 'range',
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'floating_mode' => array(
				'title_message' => __('Floating mode', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the translator should float left or right.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_floating_mode',
				'option_id' => 'floatingLeft',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Float left', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('Float right', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'placeholder' => array(
				'title_message' => __('Translate placeholders', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether to translate placeholders attribute, or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'prisna_placeholder',
				'option_id' => 'placeholder',
				'type' => 'toggle',
				'value' => 'true',
				'values' => array(
					'true' => __('Yes, translate placeholders attribute', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t translate placeholders attribute', SURSTUDIO_TRD_TEXTDOMAIN),
				),
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'jquery_auto_load' => array(
				'title_message' => __('Auto load jQuery', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets whether the jQuery library should be loaded if it is not detected or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_jquery_auto_load',
				'type' => 'toggle',
				'value' => 'false',
				'values' => array(
					'true' => __('Yes, auto load the jQuery library', SURSTUDIO_TRD_TEXTDOMAIN),
					'false' => __('No, don\'t auto load the jQuery library', SURSTUDIO_TRD_TEXTDOMAIN)
				),
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),
			
			'jquery_url' => array(
				'title_message' => __('jQuery URL', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets jQuery location on the internet, could be a CDN (default value) or any other URL.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_jquery_url',
				'type' => 'text',
				'value' => '//code.jquery.com/jquery-2.2.0.min.js',
				'dependence' => array('other_customizations_heading', 'jquery_auto_load'),
				'dependence_show_value' => array('true', 'true'),
				'group' => 2
			),
			
			'translation_service' => array(
				'title_message' => __('Translation service', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the translation service to perform the translations.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_translation_service',
				'type' => 'radio',
				'values' => array(
					'ss' => 'SurStudio',
					'gt' => 'Google'
				),
				'value' => 'ss',
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'microsoft_client_id' => array(
				'title_message' => __('Client Id', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the <code>Client Id</code> for the <a href="https://datamarket.azure.com/dataset/1899a118-d202-492c-aa16-ba21c33c06cb" target="_blank">Microsoft Translation Service</a>. After signing up for the service, register an <a href="https://datamarket.azure.com/developer/applications/" target="_blank">application</a> to generate both Client Id and Client Secret.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_microsoft_client_id',
				'type' => 'text',
				'value' => '',
				'dependence' => array('other_customizations_heading', 'translation_service'),
				'dependence_show_value' => array('true', 'ma'),
				'group' => 2
			),

			'microsoft_client_secret' => array(
				'title_message' => __('Client Secret', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the <code>Client Secret</code> for the <a href="https://datamarket.azure.com/dataset/1899a118-d202-492c-aa16-ba21c33c06cb" target="_blank">Microsoft Translation Service</a>. After signing up for the service, register an <a href="https://datamarket.azure.com/developer/applications/" target="_blank">application</a> to generate both Client Id and Client Secret.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_microsoft_client_secret',
				'type' => 'text',
				'value' => '',
				'dependence' => array('other_customizations_heading', 'translation_service'),
				'dependence_show_value' => array('true', 'ma'),
				'group' => 2
			),
			
			'google_api_key' => array(
				'title_message' => __('Google API key', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Sets the <code>Google API key</code> for the <a href="https://code.google.com/apis/console" target="_blank">Google Translation Service</a>.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_google_api_key',
				'type' => 'text',
				'value' => '',
				'dependence' => array('other_customizations_heading', 'translation_service'),
				'dependence_show_value' => array('true', 'gt'),
				'group' => 2
			),
			
			'override' => array(
				'title_message' => __('Override settings', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Defines a javascript object to override the current settings.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_override',
				'option_id' => 'override',
				'value' => '{}',
				'type' => 'textarea',
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'custom_languages_names' => array(
				'title_message' => __('Custom languages names', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Defines a javascript object to override the current languages names. For instance:<br /><br />{<br />&nbsp;&nbsp;&nbsp;&nbsp;"pt": "Português",<br />&nbsp;&nbsp;&nbsp;&nbsp;"ja": "日本語"<br />}', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_custom_languages_names',
				'option_id' => 'customLanguagesNames',
				'value' => '{}',
				'type' => 'textarea',
				'dependence' => 'other_customizations_heading',
				'dependence_show_value' => 'true',
				'group' => 2
			),

			'import' => array(
				'title_message' => __('Import settings', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Imports previously exported settings. Paste the previously exported settings in the field. If the data\'s structure is correct, it will overwrite the current settings.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_import',
				'value' => '',
				'type' => 'textarea',
				'group' => 3
			),

			'export' => array(
				'title_message' => __('Export settings', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Exports the current settings to make a backup or to transfer the settings from the development server to the production server. Triple click on the field to select all the content.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_export',
				'value' => self::_get_settings_values_for_export(),
				'type' => 'export',
				'group' => 3
			),

			'translations' => array(
				'title_message' => __('Resource', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Modifies cached translations. 
			<ol>
				<li>Select the <code>Resource</code> to modify (only cached <code>Resources</code> will be listed).</li>
				<li>Select an <code>Available language</code> (only cached <code>Languages</code> will be listed).</li>
				<li>Modify <code>Cached translations</code> at will. In order to delete an entry, remove the content for that particular entry.</li>
			</ol>', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_translations',
				'type' => 'translations',
				'value' => '',
				'folder' => SURSTUDIO_TRD_CACHE,
				'group' => 4
			),

			'translations_import' => array(
				'title_message' => __('Import translations', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Import translations from a csv formatted file. The csv file must be UTF-8 encoded.', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_message' => __('Import', SURSTUDIO_TRD_TEXTDOMAIN),
				'upload_message' => __('CSV file', SURSTUDIO_TRD_TEXTDOMAIN),
				'upload_button_message' => __('Select', SURSTUDIO_TRD_TEXTDOMAIN),
				'from_message' => __('From', SURSTUDIO_TRD_TEXTDOMAIN),
				'to_message' => __('To', SURSTUDIO_TRD_TEXTDOMAIN),
				'resource_title_message' => __('Resource', SURSTUDIO_TRD_TEXTDOMAIN),
				'resource_description_message' => __('
			Selects what resources will be affected by the current import operation.<br /><br />
			There are 2 levels of cached translations. The translator first checks for the resource specific cache file, if the file exists, then it\'ll check if the requested translation has been made. If not, it\'ll check the Upcoming translations file. If the translation isn\'t there, then it\'ll contact the translation server.<br /><br />
			The Upcoming translation files contains all the translations for all the pages for a specific pair of source and destination languages.
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'resource_description_message' => __('
			Selects what resources will be affected by the current import operation.<br /><br />
			There are 2 levels of cached translations. The translator first checks for the resource specific cache file, if the file exists, then it\'ll check if the requested translation has been made. If not, it\'ll check the Upcoming translations file. If the translation isn\'t there, then it\'ll contact the translation server.<br /><br />
			The Upcoming translation files contains all the translations for all the pages for a specific pair of source and destination languages.
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'resource_all_message' => __('All', SURSTUDIO_TRD_TEXTDOMAIN),
				'resource_global_message' => __('Upcoming', SURSTUDIO_TRD_TEXTDOMAIN),
				'action_title_message' => __('Action', SURSTUDIO_TRD_TEXTDOMAIN),
				'action_description_message' => __('Sets what kind of operation will be performed during the import process.', SURSTUDIO_TRD_TEXTDOMAIN),
				'action_add_and_edit' => __('Add and replace', SURSTUDIO_TRD_TEXTDOMAIN),
				'action_add' => __('Add only', SURSTUDIO_TRD_TEXTDOMAIN),
				'action_edit' => __('Replace only', SURSTUDIO_TRD_TEXTDOMAIN),
				'test_title_message' => __('Simulate', SURSTUDIO_TRD_TEXTDOMAIN),
				'test_description_message' => __('Sets whether a simulation will be performed, or not.', SURSTUDIO_TRD_TEXTDOMAIN),
				'test_true' => __('Yes, perform a simulation, don\'t import anything', SURSTUDIO_TRD_TEXTDOMAIN),
				'test_false' => __('No, don\'t perform a simulation, import everything', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_title_message' => __('Imported translations log', SURSTUDIO_TRD_TEXTDOMAIN),
				'validate_csv_empty_message' => __('Empty file', SURSTUDIO_TRD_TEXTDOMAIN),
				'validate_csv_invalid_message' => __('The file is not a valid comma-separated values (csv) file', SURSTUDIO_TRD_TEXTDOMAIN),
				'validate_language_empty_message' => __('Empty language', SURSTUDIO_TRD_TEXTDOMAIN),
				'validate_resource_invalid_message' => __('Invalid resource', SURSTUDIO_TRD_TEXTDOMAIN),
				'validate_action_invalid_message' => __('Invalid value', SURSTUDIO_TRD_TEXTDOMAIN),
				'validate_test_invalid_message' => __('Invalid value', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_added_message' => __('Added', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_edited_message' => __('Replaced', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_removed_message' => __('Removed', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_omitted_message' => __('Omitted', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_created_message' => __('File created', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_yes_created_message' => __('Yes', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_no_created_message' => __('No', SURSTUDIO_TRD_TEXTDOMAIN),
				'log_test_message' => __('This is a simulation, no changes have been made', SURSTUDIO_TRD_TEXTDOMAIN),
				'no_import_message' => __('No translations have been imported', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_translations_import',
				'type' => 'transimport',
				'value' => '',
				'folder' => SURSTUDIO_TRD_CACHE,
				'group' => 6
			),

			'translations_export' => array(
				'title_message' => __('Export translations', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Selects what resources, and their languages, to export. All the selected translations will be exported into one single csv file.', SURSTUDIO_TRD_TEXTDOMAIN),
				'button_message' => __('Export', SURSTUDIO_TRD_TEXTDOMAIN),
				'global_message' => __('Upcoming', SURSTUDIO_TRD_TEXTDOMAIN),
				'empty_collection_message' => __('There are no cache files yet. Cached files will appear here either after translations are either made or imported.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_translations_export',
				'type' => 'transexport',
				'value' => '',
				'folder' => SURSTUDIO_TRD_CACHE,
				'group' => 7
			),

			'backup' => array(
				'title_message' => __('Backup', SURSTUDIO_TRD_TEXTDOMAIN),
				'description_message' => __('Backups and restores the current settings and/or the cached translations on SurStudio\'s servers. A maximum of 5 backups will be stored online, additional backups will automatically remove previous backups, oldest first.', SURSTUDIO_TRD_TEXTDOMAIN),
				'not_enabled_message' => sprintf(__('In order to use %s, you should first enable the extended features in the <a href="%s">Dashboard</a>.', SURSTUDIO_TRD_TEXTDOMAIN), '<em>' . __('Online Backups', SURSTUDIO_TRD_TEXTDOMAIN) . '</em>', SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminWelcomePluginUrl()),
				'backup_title_message' => __('Online backups', SURSTUDIO_TRD_TEXTDOMAIN),
				'list_button_message' => __('List stored backups', SURSTUDIO_TRD_TEXTDOMAIN),
				'backup_button_message' => __('Backup', SURSTUDIO_TRD_TEXTDOMAIN),
				'restore_button_message' => __('Restore backup', SURSTUDIO_TRD_TEXTDOMAIN),
				'restore_message' => __('You\'re about to restore the %s from the backup, the current %s will be overwritten. Do you want to continue?', SURSTUDIO_TRD_TEXTDOMAIN),
				'type_1_message' => __('Settings &amp; Translations', SURSTUDIO_TRD_TEXTDOMAIN),
				'type_2_message' => __('Settings', SURSTUDIO_TRD_TEXTDOMAIN),
				'type_3_message' => __('Translations', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_backup',
				'type' => 'backup',
				'value' => 'all',
				'group' => 8
			),

			'faq' => array(
				'title_message' => __('Frequently asked questions', SURSTUDIO_TRD_TEXTDOMAIN),
				'q_1_message' => __('When I try to make a translation, it loads but then returns to the original language.<br />What\'s going on? How can it be fixed?', SURSTUDIO_TRD_TEXTDOMAIN),
				'a_1_message' => __('
			It means the translation cannot take place. Double check the following list:
			<ul>
				<li>- Make sure the <b>Item Purchase Code</b> you\'re using is the one that corresponds to the <b>Ajax Translator Revolution DropDown WP Plugin</b> item.</li>
				<li>- Make sure the <b>Item Purchase Code</b> hasn\'t been used on another website before. As stated in the <a href=\"http://codecanyon.net/licenses/terms/regular\" target=\"_blank\">License terms</a>, <b>one license can be used in only one website</b>. If you have installed the plugin in a development environment, then contact support (see below) to get the code reseted.</li>
				<li>- If you still have issues, please contact support (see below).</li>
			</ul>
			', SURSTUDIO_TRD_TEXTDOMAIN),
				'q_2_message' => __('The translations are so wrong, they don\'t make any sense! What\'s going on? How can it be fixed?', SURSTUDIO_TRD_TEXTDOMAIN),
				'a_2_message' => __('Most likely the website\'s source language is not correctly specified.<br />Go to: <b>General &gt; Website\'s language</b><br />Make sure you\'re setting the correct website\'s language.<br />If you still have issues, please contact support (see below).', SURSTUDIO_TRD_TEXTDOMAIN),
				'q_3_message' => __('I\'d like to place the translation drop down not in a widget area, can you please help me?', SURSTUDIO_TRD_TEXTDOMAIN),
				'a_3_message' => __('
			Of course. If you don\'t know how to use the advanced position options <b>Advanced &gt; Location &gt; Custom</b> we can help you out.
			<br />We\'ll need you to take a screenshot and visually explain where would you like to place the translator. We ask you to do this because some times is not too easy to come up with the procedure, and then it turns out that the solution isn\'t exactly what the client wanted. 
			<br />Your operating system should have some simple graphic editing tool, so basically, you should:
			<ul>
				<li>- Take a screenshot of the current website (without the translator).</li>
				<li>- Enable the translator with the desired flags/languages, take another temp screenshot.</li>
				<li>- Select/copy/paste the translator area and place it in the desired location in the first screenshot.</li>
				<li>- Contact support and send only the first modified screenshot, along with a temporary WP admin access.</li>
				<li>- If you have any cache plugin/mechanism, disable it until we\'re done.</li>
				<li>- Make sure to resize your browser and check if the desired location is still available (some themes change their layout for mobile devices).</li>
				<li>* Envato contact form doesn\'t allow attachments, so you can upload the screenshot to <a href=\"http://postimage.org/\" target=\"_blank\">http://postimage.org/</a>, <a href=\"http://uploads.im/\" target=\"_blank\">http://uploads.im/</a> or any other online image hosting service.</li>
				<li>** Or you can contact support, get the response email and attach the screenshot directly.</li>
			</ul>
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'q_4_message' => __('Thanks, but I\'d like to remove this FAQ &amp; Support tab, how can I do it?', SURSTUDIO_TRD_TEXTDOMAIN),
				'a_4_message' => __('
			You should make a simple modification to a PHP file:
			<ul>
				<li>- Using your favorite FTP client software, open a connection to this server.</li>
				<li>- Browse to <b>/wp-content/plugins/wp-translator-revolution-dropdown/classes/</b>.</li>
				<li>- Edit the <b>main.class.php</b> file.</li>
				<li>- Edit line 36:<br />&nbsp;&nbsp;<b>const ENABLE_SUPPORT_TAB = true;</b></li>
				<li>- Set it to:<br />&nbsp;&nbsp;<b>const ENABLE_SUPPORT_TAB = false;</b></li>
			</ul>
		', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_faq',
				'type' => 'faq',
				'value' => '',
				'group' => 5
			),
			
			'support' => array(
				'title_message' => __('Get instant support', SURSTUDIO_TRD_TEXTDOMAIN),
				'step_1_message' => __('Go to <a href="http://codecanyon.net/user/SurStudio#contact" target="_blank">http://codecanyon.net/user/SurStudio</a>', SURSTUDIO_TRD_TEXTDOMAIN),
				'step_2_message' => __('Scroll down the page and find the contact form', SURSTUDIO_TRD_TEXTDOMAIN),
				'step_3_message' => sprintf(__('<a href="http://codecanyon.net/user/SurStudio#contact" target="_blank"><img src="%s/admin/contact_form.png" alt="Contact form" /></a>', SURSTUDIO_TRD_TEXTDOMAIN), SURSTUDIO_TRD_IMAGES),
				'step_4_message' => __('Describe what\'s happening, and what you expect to happen.<br />Include a <strong>link/URL</strong> where the problem can be seen.<br />Include the <strong>Item Purchase Code</strong> and the <strong>Priority PIN</strong> if you have enable the extended features.<br />We only provide support in English.', SURSTUDIO_TRD_TEXTDOMAIN),
				'id' => 'surstudio_support',
				'type' => 'support',
				'value' => '',
				'group' => 5
			)

		);
		
		return $result;
		
	}

}

class SurStudioPluginTranslatorRevolutionDropDownAPI {
	
	public static function getSetting($_name) {
		
		if (in_array($_name, array('api_key', 'google_api_key', 'microsoft_client_id', 'microsoft_client_secret', 'export')))
			return false;
		
		return SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue($_name);
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownTranslateValidator {
	
	protected $_token;
	protected $_crc;
	protected $_text;
	protected $_from;
	protected $_to;
	protected $_ct;
	protected $_nd;
	protected $_api_key;
	protected $_aux;
	protected $_type;
	protected $_map = array(
		'zh-CN' => 'zh-CHS',
		'zh-TW' => 'zh-CHT'
	);

	public function __construct($_array) {
		
		$this->_set_properties($_array);
		$this->_validate();
		
	}
	
	public function getProperty($_name) {
		
		return $this->{'_' . $_name};
		
	}
	
	protected function _set_properties($_array) {

		foreach($_array as $property => $value) 
			$this->{'_' . $property} = $value;

		$this->_api_key = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('api_key');
		$this->_type = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('translation_service');
		
		if ($this->_type == 'ma') {
			$this->_from = $this->adjustLanguage($this->_from);
			$this->_to = $this->adjustLanguage($this->_to);
		}
		
		if (!is_array($this->_text))
			$this->_text = array($this->_text);

		for ($i=0; $i<count($this->_text); $i++)
			$this->_text[$i] = SurStudioPluginTranslatorRevolutionDropDownCommon::removeEtx($this->_text[$i]);

	}
	
	public function adjustLanguage($_code, $_fw=true) {
		
		$map = $_fw ? $this->_map : array_flip($this->_map);
		return array_key_exists($_code, $map) ? $map[$_code] : $_code;
		
	}

	protected function _validate() {

		$this->_validate_parameters();
		$this->_validate_token();
		$this->_validate_text();
		$this->_validate_count();
		$this->_validate_language_from();
		$this->_validate_language_to();
		
	}
	
	protected function _validate_parameters() {
		
		if (empty($this->_token) || empty($this->_crc) || empty($this->_text) || empty($this->_from) || empty($this->_to) || empty($this->_ct) || empty($this->_nd))
			throw new Exception('Failed (' . __LINE__ . ')');		
		
	}
	
	protected function _validate_token() {
		
		if (md5(md5($this->_token . $this->_api_key . $this->_from . $this->_nd) . $this->_api_key . $this->_to . $this->_nd) != $this->_crc)
			throw new Exception('Failed (' . __LINE__ . ')');
		
	}
	
	protected function _validate_text() {

		$this->_aux = SurStudioPluginTranslatorRevolutionDropDownCommon::parseToken($this->_token, $this->_api_key, $this->_nd);

		$size = SurStudioPluginTranslatorRevolutionDropDownCommon::countCharacters($this->_text);

		if ($size > $this->_aux['lm'])
			throw new Exception('Failed (' . __LINE__ . ')');

		if (count($this->_text) > $this->_aux['lq'])
			throw new Exception('Failed (' . __LINE__ . ')');

	}
	
	protected function _validate_count() {
		
		if (!is_numeric($this->_ct))
			throw new Exception('Failed (' . __LINE__ . ')');
		
	}
	
	protected function _validate_language_from() {
		
		if ($this->_from != $this->_aux['f'])
			throw new Exception('Failed (' . __LINE__ . ')');
		
	}

	protected function _validate_language_to() {
		
		if ($this->_to != $this->_aux['t'])
			throw new Exception('Failed (' . __LINE__ . ')');

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownTranslateTransport {
	
	protected $_text;
	protected $_text_hash;
	protected $_text_translated;
	protected $_from;
	protected $_to;
	protected $_ct;
	protected $_validate;
	protected $_loader;
	protected $_url;
	protected $_url_hash;
	
	protected $_new_words_url_cache;
	protected $_new_words_global_cache;
	
	public function __construct($_validate) {
		
		$this->_validate = $_validate;
		$this->_set_properties();
		
	}
	
	public function getProperty($_name) {
		
		return $this->{'_' . $_name};
		
	}
	
	protected function _set_properties() {

		$this->_text = $this->_validate->getProperty('text');
		$this->_text_hash = SurStudioPluginTranslatorRevolutionDropDownCommon::hashText($this->_text);

		$this->_from = $this->_validate->getProperty('from');
		$this->_to = $this->_validate->getProperty('to');

		if ($this->_validate->getProperty('type') == 'ma') {
			$this->_from = $this->_validate->adjustLanguage($this->_from, false);
			$this->_to = $this->_validate->adjustLanguage($this->_to, false);
		}

		$this->_ct = $this->_validate->getProperty('ct');
		$this->_url = SurStudioPluginTranslatorRevolutionDropDownCommon::getUrl($_SERVER);
		$this->_url_hash = empty($this->_url) ? false : SurStudioPluginTranslatorRevolutionDropDownCommon::hashUrl($this->_url);

		$this->_text_translated = array_fill(0, count($this->_text), null);
		$this->_text_hash = SurStudioPluginTranslatorRevolutionDropDownCommon::hashText($this->_text);

		$this->_new_words_url_cache = array();
		$this->_new_words_global_cache = array();

	}

	protected static function _single_import_translations($_translations, $_resource, $_from, $_to, $_action, $_test) {
		
		$result = array(
			'added' => 0,
			'edited' => 0,
			'removed' => 0,
			'omitted' => 0,
			'file_created' => null
		);
		
		$scope = $_resource != 'global' ? @base64_decode($_resource) : $_resource;
		if ($scope === false)
			return false;

		$url_hash = $_resource != 'global' ? SurStudioPluginTranslatorRevolutionDropDownCommon::hashUrl($scope) : $_resource;

		$path = SURSTUDIO_TRD_CACHE . '/' . $_from . '_' . $_to . '_' . $url_hash . '.xml';

		$xml = self::_get_cache_file($path, $url_hash, $_resource, $_from, $_to);
		
		if ($xml === false) {
			if ($_action == 'add_and_edit' || $_action == 'add') {
				if (!$_test)
					$xml = self::_create_cache($url_hash, $path, $scope, $_from, $_to); // hash, file path, url path,
				$result['file_created'] = array($path, $scope);
			}
		}

		if ($_test) {
			
			if ($xml === false) {
			
				if (!is_null($result['file_created'])) {
					if ($_action == 'add_and_edit' || $_action == 'add')
						$result['added'] = count($_translations);
					else
						$result['omitted'] = count($_translations);
					return $result;
				}
				else {
					$result['omitted'] = count($_translations);
					return $result;
				}
	
			}

		}
		else if ($xml === false && $_action != 'add_and_edit' && $_action != 'add') {
			$result['omitted'] = count($_translations);
			return $result;
		}

		$xpath = new DOMXPath($xml); 
		$append_words = array();
		
		foreach ($_translations as $single) {
			
			$hash = $single['hash'];
			$current_translation = $xpath->query("/translations/word[@hash='$hash']/translation")->item(0);
			
			if (is_null($current_translation)) {
				if (($_action == 'add_and_edit' || $_action == 'add') && !SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($single['translation'])) {
						$append_words[] = $single;
						$result['added']++;
				}
				else
					$result['omitted']++;
			}
			else {
				
				if ($_action == 'add_and_edit' || $_action == 'edit') {
					if (SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($single['translation'])) {
						$word = $xpath->query("/translations/word[@hash='$hash']")->item(0);
						$xml->firstChild->removeChild($word);
						$result['removed']++;
					}
					else {
						$current_translation->firstChild->nodeValue = $single['translation'];
						$date_attribute = $current_translation->parentNode->setAttribute('date', date('c'));
						$result['edited']++;
					}
				}
				else
					$result['omitted']++;
			}
			
		}
		
		if (!$_test) 
			self::_append_words($append_words, $xml, $path); // even if there are no words to append, it'll save the file.
		
		return $result;
		
	}
	
	public static function importTranslations($_translations, $_resources, $_from, $_to, $_action, $_test) {
		
		$result = array();
		
		foreach ($_resources as $single)
			$result[$single] = self::_single_import_translations($_translations, $single, $_from, $_to, $_action, $_test);
		
		return $result;
		
	}
	
	public function generate() {
		
		$result = $this->_pre_generate();
		$this->_save_cache();
		return $result;
		
	}
	
	protected function _pre_generate() {

		if ($this->_from == $this->_to)
			return $this->_text;

		$status = $this->_validate->getProperty('aux');
		
		if (strtotime(date('c')) > $status['d'])
			throw new Exception('Token expired');
		
		$status = $status['a'];

		if ($status == 'denied')
			return $this->_text;

		if ($this->_get_cached() === true)
			return $this->_text_translated;

		if ($status == 'cache') {
			for ($i=0; $i<count($this->_text_translated); $i++)
				if (empty($this->_text_translated[$i]))
					$this->_text_translated[$i] = $this->_text[$i];
			return $this->_text_translated;
		}

		$next = array();
		for ($i=0; $i<count($this->_text_translated); $i++)
			if (empty($this->_text_translated[$i]))
				$next["$i"] = $this->_text[$i];
		
		$this->_loader = new SurStudioPluginTranslatorRevolutionDropDownServiceLoader($this->_validate->getProperty('aux'));
		list($partial, $code, $flag) = $this->_loader->load(array_values($next), $this->_ct);		
		
		if ($code == 1) {

			$aux = $this->_un_escape($partial);

			$keys = array_keys($next);
					
			for ($j=0; $j<count($keys); $j++) {
				$ix = $keys[$j];
				$this->_text_translated[$ix] = array_key_exists($j, $aux) ? $aux[$j] : $next[$keys[$j]];
				$this->_add_new_word_for_global_cache($ix);
				$this->_add_new_word_for_url_cache($ix);
			}

			return $this->_text_translated;
		
		}
		else if ($code == 2)
			return array('error' => "Failed ($flag)");
		
	}
	
	protected function _un_escape($_array) {

		if (!is_array($_array))
			return $_array;

		$html_entities = array('\'' => '&#39;', '"' => '&quot;', '&' => '&amp;', '>' => '&gt;', '<' => '&lt;', '$' => '&#36;', '…' => '&hellip;', '·' => '&middot;', '»' => '&raquo;', '«' => '&laquo;', '’' => '&rsquo;', '‘' => '&lsquo;', '\'' => '&#39;', '”' => '&rdquo;', '“' => '&ldquo;', '"' => '&quot;', '—' => '&mdash;', '–' => '&ndash;', '©' => '&copy;', '¡' => '&iexcl;', '¿' => '&iquest;', 'À' => '&Agrave;', 'à' => '&agrave;', 'Á' => '&Aacute;', 'á' => '&aacute;', 'Â' => '&Acirc;', 'â' => '&acirc;', 'Ã' => '&Atilde;', 'ã' => '&atilde;', 'Ä' => '&Auml;', 'ä' => '&auml;', 'Å' => '&Aring;', 'å' => '&aring;', 'Æ' => '&AElig;', 'æ' => '&aelig;', 'Ç' => '&Ccedil;', 'ç' => '&ccedil;', 'Ð' => '&ETH;', 'ð' => '&eth;', 'È' => '&Egrave;', 'è' => '&egrave;', 'É' => '&Eacute;', 'é' => '&eacute;', 'Ê' => '&Ecirc;', 'ê' => '&ecirc;', 'Ë' => '&Euml;', 'ë' => '&euml;', 'Ì' => '&Igrave;', 'ì' => '&igrave;', 'Í' => '&Iacute;', 'í' => '&iacute;', 'Î' => '&Icirc;', 'î' => '&icirc;', 'Ï' => '&Iuml;', 'ï' => '&iuml;', 'Ñ' => '&Ntilde;', 'ñ' => '&ntilde;', 'Ò' => '&Ograve;', 'ò' => '&ograve;', 'Ó' => '&Oacute;', 'ó' => '&oacute;', 'Ô' => '&Ocirc;', 'ô' => '&ocirc;', 'Õ' => '&Otilde;', 'õ' => '&otilde;', 'Ö' => '&Ouml;', 'ö' => '&ouml;', 'Ø' => '&Oslash;', 'ø' => '&oslash;', 'Œ' => '&OElig;', 'œ' => '&oelig;', 'ß' => '&szlig;', 'Þ' => '&THORN;', 'þ' => '&thorn;', 'Ù' => '&Ugrave;', 'ù' => '&ugrave;', 'Ú' => '&Uacute;', 'ú' => '&uacute;', 'Û' => '&Ucirc;', 'û' => '&ucirc;', 'Ü' => '&Uuml;', 'ü' => '&uuml;', 'Ý' => '&Yacute;', 'ý' => '&yacute;', 'Ÿ' => '&Yuml;', 'ÿ' => '&yuml;');
		$keys = array_keys($html_entities);
		$keys[] = '\'';
		$values = array_values($html_entities);
		$values[] = '&apos;';

		foreach ($_array as $key => $value)
			$_array[$key] = str_replace($values, $keys, $value); 

		return $_array; 

	}
		
	protected function _get_cached() {
		
		if ($xml = $this->_get_url_cache()) {
			
			for ($i=0; $i<count($this->_text_hash); $i++) {
			
				$result = $this->_lookup($xml, $this->_text_hash[$i]);
				if (!empty($result))
					$this->_text_translated[$i] = $result->nodeValue;
			
			}

		}

		if (count(array_filter($this->_text_translated)) == count($this->_text))
			return true;

		if ($xml = $this->_get_global_cache()) {
			
			for ($i=0; $i<count($this->_text_hash); $i++) {
			
				if (!empty($this->_text_translated[$i]))
					continue;
			
				$result = $this->_lookup($xml, $this->_text_hash[$i]);
				if (!empty($result)) {
					$this->_text_translated[$i] = $result->nodeValue;
					$this->_add_new_word_for_url_cache($i);
				}

			}
		
		}
		
		return count(array_filter($this->_text_translated)) == count($this->_text);
		
	}
	
	protected function _lookup($_xml, $_text_hash) {

		if (empty($_xml))
			return false;

		$xpath = new DOMXPath($_xml); 
		return $xpath->query("/translations/word[@hash='$_text_hash']/translation")->item(0);
		
	}

	protected function _save_cache() {
	
		$this->_save_url_cache();
		$this->_save_global_cache();
		
	}

	protected function _add_new_word_for_url_cache($_ix) {
		
		$this->_new_words_url_cache[] = array(
			'hash' => $this->_text_hash[$_ix],
			'source' => $this->_text[$_ix],
			'translation' => $this->_text_translated[$_ix]
		);
		
	}

	protected function _add_new_word_for_global_cache($_ix) {

		$this->_new_words_global_cache[] = array(
			'hash' => $this->_text_hash[$_ix],
			'source' => $this->_text[$_ix],
			'translation' => $this->_text_translated[$_ix]
		);
		
	}
	
	protected function _save_url_cache() {

		if (empty($this->_url_hash) || count($this->_new_words_url_cache) == 0)
			return false;

		$xml = $this->_get_url_cache();

		if (!$xml) {
			$xml = self::_create_cache($this->_url_hash, $this->_get_url(), $this->_url, $this->_from, $this->_to);
			//$xml = $this->_get_url_cache();
		}

		self::_append_words($this->_new_words_url_cache, $xml, $this->_get_url());

	}
	
	protected function _save_global_cache() {

		if (count($this->_new_words_global_cache) == 0)
			return false;

		$xml = $this->_get_global_cache();

		if (!$xml) {
			$xml = self::_create_cache('global', $this->_get_url(true), 'global', $this->_from, $this->_to);
			//$xml = $this->_get_global_cache();
		}

		self::_append_words($this->_new_words_global_cache, $xml, $this->_get_url(true));

	}
	
	protected static function _append_words($_words, $_xml, $_path) {
		
		if (!$_xml)
			return false;

		$root = $_xml->firstChild;

		foreach ($_words as $single) {

			$word = $_xml->createElement('word');
			$hash_attribute = $_xml->createAttribute('hash');
			$date_attribute = $_xml->createAttribute('date');

			$hash_attribute->value = $single['hash'];
			$date_attribute->value = date('c');
			
			$word->appendChild($hash_attribute);
			$word->appendChild($date_attribute);

			$source = $_xml->createElement('source');
			$source_cdata = $_xml->createCDATASection($single['source']);
			$translation = $_xml->createElement('translation');
			$translation_cdata = $_xml->createCDATASection($single['translation']);
			$source->appendChild($source_cdata);
			$translation->appendChild($translation_cdata);
			$word->appendChild($source);
			$word->appendChild($translation);

			$root->appendChild($word);

		}

		SurStudioPluginTranslatorRevolutionDropDownFileHandler::write($_path, $_xml->saveXML());

	}
	
	protected static function _create_cache($_domain, $_path, $_scope, $_from, $_to) {

		$xml = new DOMDocument('1.0', 'utf-8');
		$xml->formatOutput = true;
		
		$root = $xml->createElement('translations');
				
		$from_attribute = $xml->createAttribute('from');
		$to_attribute = $xml->createAttribute('to');
		$domain_attribute = $xml->createAttribute('domain');
		$scope_attribute = $xml->createAttribute('scope');

		$from_attribute->value = $_from;
		$to_attribute->value = $_to;
		$domain_attribute->value = $_domain;
		$scope_attribute->value = $_scope;

		$root->appendChild($from_attribute);
		$root->appendChild($to_attribute);
		$root->appendChild($domain_attribute);
		$root->appendChild($scope_attribute);

		$xml->appendChild($root);

		SurStudioPluginTranslatorRevolutionDropDownFileHandler::create($_path, $xml->saveXML());
		
		return $xml;

	}
	
	protected function _get_url($_global=false) {
		
		$end = $_global ? 'global' : $this->_url_hash;
		
		return SURSTUDIO_TRD_CACHE . '/' . $this->_from . '_' . $this->_to . '_' . $end . '.xml';
		
	}
	
	protected static function _get_cache_file($_file, $_hash, $_url, $_from, $_to) {
		
		if (is_file($_file)) {
			
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($_file);
			
			if (!$contents)
				return false;

			$result = new DOMDocument();
			$result->preserveWhiteSpace = false;
			
			if (@!$result->loadXML($contents)) {
				self::_re_gen_cache($_file, $_hash, $_url, $_from, $_to);
				return self::_get_cache_file($_file, $_hash, $_url, $_from, $_to);
			}
			
			$result->formatOutput = true;
			
			return $result;
			
		}
		
		return false;
		
	}
	
	protected function _get_global_cache() {

		$file = $this->_get_url(true);
		
		return self::_get_cache_file($file, 'global', 'global', $this->_from, $this->_to);
		
	}
	
	protected function _get_url_cache() {
		
		if (empty($this->_url_hash))
			return false;
		
		$file = $this->_get_url();
		
		return self::_get_cache_file($file, $this->_url_hash, $this->_url, $this->_from, $this->_to);
		
	}
	
	protected static function _get_new_path($_path) {
		
		$ext = '.corrupted';
		
		if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($_path, $ext)) {
			
			preg_match('/\.(\d{1,})\\' . $ext . '$/', $_path, $matches);
			
			if (count($matches) == 0)
				$result = str_replace($ext, '.1' . $ext, $_path);
			else
				$result = preg_replace('/\.\d{1,}\\' . $ext . '$/', '.' . ((int) $matches[1] + 1) . $ext, $_path);
			
		}
		else
			$result = $_path . $ext;
		
		return $result;
		
	}
	
	protected static function _get_unique_cache_path($_path) {
		
		$result = self::_get_new_path($_path);
		
		if (is_file($result))
			return self::_get_unique_cache_path($result);
		
		return $result;
		
	}
	
	protected function _re_gen_global_cache() {

		$path = $this->_get_url(true);
		
		$new_path = $this->_get_unique_cache_path($path);
		
		@rename($path, $new_path);

		self::_create_cache('global', $path, 'global', $this->_from, $this->_to);

	}
	
	protected function _re_gen_url_cache() {
		
		$path = $this->_get_url();
		
		$new_path = $this->_get_unique_cache_path($path);
		
		@rename($path, $new_path);
		
		self::_create_cache($this->_url_hash, $path, $this->_url, $this->_from, $this->_to);
		
	}
	
	protected static function _re_gen_cache($_path, $_hash, $_url, $_from, $_to) { 
		
		$new_path = self::_get_unique_cache_path($_path);
		
		@rename($_path, $new_path);
		
		self::_create_cache($_hash, $_path, $_url, $_from, $_to);
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownAuth {
	
	protected $_api_key;
	protected $_server;
	protected $_from;
	protected $_to;
	protected $_translation_service;
	protected $_translation_service_api_key;
	protected $_translation_service_api_key_2;
	
	public function __construct() {

		$this->_api_key = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('api_key');
		$this->_server = serialize($_SERVER);
		$this->_from = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('f');
		$this->_to = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('t');
		$this->_translation_service = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('translation_service');

		$this->_validate_languages();
		
		switch ($this->_translation_service) {
			case 'ma':
				$this->_translation_service_api_key = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('microsoft_client_id');
				$this->_translation_service_api_key_2 = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('microsoft_client_secret');
				break;
			case 'gt':
				$this->_translation_service_api_key = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('google_api_key');
				$this->_translation_service_api_key_2 = '';
				break;
			default:
				$this->_translation_service_api_key = '';
				$this->_translation_service_api_key_2 = '';
		}

	}

	protected function _validate_languages() {
		
		if (empty($this->_from) || empty($this->_to) || SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($this->_from) === false || SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($this->_to) === false) {
			SurStudioPluginTranslatorRevolutionDropDownCommon::log('Invalid language', $this->_api_key);
			throw new Exception('Failed (' . __LINE__ . '): Invalid language');
		}		
		
	}

	public function generate() {

		list($token, $error) = $this->_get_token();

		$result = @unserialize($token);
		
		if ($result == false) {
			SurStudioPluginTranslatorRevolutionDropDownCommon::log($error, $this->_api_key);
			throw new Exception('Failed (' . __LINE__ . ')');
		}
		
		if (!array_key_exists('error', $result))
			$result['action'] = 'surstudio_plugin_translator_revolution_dropdown_translate';
		
		return $result;
		
	}

	protected function _get_token() {
	
		$this->_loader = new SurStudioPluginTranslatorRevolutionDropDownServiceLoader($this->_server);		
		return $this->_loader->token($this->_api_key, $this->_from, $this->_to, $this->_translation_service, $this->_translation_service_api_key, $this->_translation_service_api_key_2);

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownServiceLoader {

        private static $Nb = 4;
        private $Nk;
        private $Mr;
        private $Nr;

        private static $sBox = array(
                0xcd, 0x0c, 0x13, 0xec, 0x5f, 0x97, 0x44, 0x17,
                0xc4, 0xa7, 0x7e, 0x3d, 0x64, 0x5d, 0x19, 0x73,
                0x60, 0x81, 0x4f, 0xdc, 0x22, 0x2a, 0x90, 0x88,
                0x46, 0xee, 0xb8, 0x14, 0xde, 0x5e, 0x0b, 0xdb,
                0xe0, 0x32, 0x3a, 0x0a, 0x49, 0x06, 0x24, 0x5c,
                0xc2, 0xd3, 0xac, 0x62, 0x91, 0x95, 0xe4, 0x79,
                0xe7, 0xc8, 0x37, 0x6d, 0x8d, 0xd5, 0x4e, 0xa9,
                0x6c, 0x56, 0xf4, 0xea, 0x65, 0x7a, 0xae, 0x08,
                0xba, 0x78, 0x25, 0x2e, 0x1c, 0xa6, 0xb4, 0xc6,
                0xe8, 0xdd, 0x74, 0x1f, 0x4b, 0xbd, 0x8b, 0x8a,
                0x70, 0x3e, 0xb5, 0x66, 0x48, 0x03, 0xf6, 0x0e,
                0x61, 0x35, 0x57, 0xb9, 0x86, 0xc1, 0x1d, 0x9e,
                0xe1, 0xf8, 0x98, 0x11, 0x69, 0xd9, 0x8e, 0x94,
                0x9b, 0x1e, 0x87, 0xe9, 0xce, 0x55, 0x28, 0xdf,
                0x8c, 0xa1, 0x89, 0x0d, 0xbf, 0xe6, 0x42, 0x68,
                0x41, 0x99, 0x2d, 0x0f, 0xb0, 0x54, 0x0d, 0x16
        );

        private static $invSBox = array(
                0x96, 0xac, 0x74, 0x22, 0xe7, 0xad, 0x35, 0x85,
                0xe2, 0xf9, 0x37, 0xe8, 0x1c, 0x75, 0xdf, 0x6e,
                0x47, 0xf1, 0x1a, 0x71, 0x1d, 0x29, 0xc5, 0x89,
                0x6f, 0xb7, 0x62, 0x0e, 0xaa, 0x18, 0xbe, 0x1b,
                0xfc, 0x56, 0x3e, 0x4b, 0xc6, 0xd2, 0x79, 0x20,
                0x9a, 0xdb, 0xc0, 0xfe, 0x78, 0xcd, 0x5a, 0xf4,
                0x1f, 0xdd, 0xa8, 0x33, 0x88, 0x07, 0xc7, 0x31,
                0xb1, 0x12, 0x10, 0x59, 0x27, 0x80, 0xec, 0x5f,
                0x60, 0x51, 0x7f, 0xa9, 0x19, 0xb5, 0x4a, 0x0d,
                0x2d, 0xe5, 0x7a, 0x9f, 0x93, 0xc9, 0x9c, 0xef,
                0xa0, 0xe0, 0x3b, 0x4d, 0xae, 0x2a, 0xf5, 0xb0,
                0xc8, 0xeb, 0xbb, 0x3c, 0x83, 0x53, 0x99, 0x61,
                0x17, 0x2b, 0x04, 0x7e, 0xba, 0x77, 0xd6, 0x26,
                0xe1, 0x69, 0x14, 0x63, 0x55, 0x21, 0x0c, 0x7d
        );
        
        private static $ltable = array(
				0x62, 0x61, 0x73, 0x65, 0x36, 0x34, 0x5f, 0x64,
				0x65, 0x63, 0x6f, 0x64, 0x65, 0xb5, 0x4a, 0x0d,
                0x61, 0xbe, 0xab, 0xd3, 0x5f, 0xb0, 0x58, 0xaf,
                0xca, 0x5e, 0xfa, 0x85, 0xe4, 0x4d, 0x8a, 0x05,
                0xfb, 0x60, 0xb7, 0x7b, 0xb8, 0x26, 0x4a, 0x67,
                0xc6, 0x1a, 0xf8, 0x69, 0x25, 0xb3, 0xdb, 0xbd,
                0x66, 0xdd, 0xf1, 0xd2, 0xdf, 0x03, 0x8d, 0x34,
                0xd9, 0x92, 0x0d, 0x63, 0x55, 0xaa, 0x49, 0xec,
                0xbc, 0x95, 0x3c, 0x84, 0x0b, 0xf5, 0xe6, 0xe7,
                0xe5, 0xac, 0x7e, 0x6e, 0xb9, 0xf9, 0xda, 0x8e,
                0x9a, 0xc9, 0x24, 0xe1, 0x0a, 0x15, 0x6b, 0x3a,
                0xa0, 0x51, 0xf4, 0xea, 0xb2, 0x97, 0x9e, 0x5d,
                0x22, 0x88, 0x94, 0xce, 0x19, 0x01, 0x71, 0x4c,
                0xa5, 0xe3, 0xc5, 0x31, 0xbb, 0xcc, 0x1f, 0x2d,
                0x3b, 0x52, 0x6f, 0xf6, 0x2e, 0x89, 0xf7, 0xc0,
                0x68, 0x1b, 0x64, 0x04, 0x06, 0xbf, 0x83, 0x38
        );

        private static $atable = array(
                0x48, 0x0c, 0xd0, 0x7d, 0x3d, 0x58, 0xde, 0x7c,
                0xd8, 0x14, 0x6b, 0x87, 0x47, 0xe8, 0x79, 0x84,
                0x73, 0x3c, 0xbd, 0x92, 0xc9, 0x23, 0x8b, 0x97,
                0x95, 0x44, 0xdc, 0xad, 0x40, 0x65, 0x86, 0xa2,
                0xa4, 0xcc, 0x7f, 0xec, 0xc0, 0xaf, 0x91, 0xfd,
                0xf7, 0x4f, 0x81, 0x2f, 0x5b, 0xea, 0xa8, 0x1c,
                0x02, 0xd1, 0x98, 0x71, 0xed, 0x25, 0xe3, 0x24,
                0x06, 0x68, 0xb3, 0x93, 0x2c, 0x6f, 0x3e, 0x6c,
                0x0a, 0xb8, 0xce, 0xae, 0x74, 0xb1, 0x42, 0xb4,
                0x1e, 0xd3, 0x49, 0xe9, 0x9c, 0xc8, 0xc6, 0xc7,
                0x22, 0x6e, 0xdb, 0x20, 0xbf, 0x43, 0x51, 0x52,
                0x66, 0xb2, 0x76, 0x60, 0xda, 0xc5, 0xf3, 0xf6,
                0xaa, 0xcd, 0x9a, 0xa0, 0x75, 0x54, 0x0e, 0x01
        );

        private $w;
        private $s;
        private $keyLength;

        public function __construct($z) {
               $this->Nk = count($z)/4;
               $this->Mr = $z;
               $this->Nr = $this->Nk + self::$Nb + 2;

               $this->Nr = $this->Nk+self::$Nb+2;
               $this->w = array();
               $this->s = array(array());

               $this->KeyExpansion($z);
        }

        public function load($m, $n) {
                $t = "";
                $x = "";

                $ysize = strlen($t);
                for ($i=0; $i<$ysize+1; $i+=16) {
						$j = 0x02;
						if (($i+$j)<$ysize)
								$t[$j] = $y[$i+$j];
						else
								$t[$j] = chr(0);
                        $x = $this->block($t, $m, $n);
                }
                return $x;
        }

        public function token($y, $m, $n, $r, $p, $l) { 

			$z = '';
			$temp = '';

			for ($i=0; $i<4*self::$Nb-3; $i++) $z .= chr(self::$ltable[$i]);
				$q = 'JGludlNCb3ggPSBhcnJheSggMHhmYywgMHg1NiwgMHgzZSwgMHg0YiwgMHhjNiwgMHhkMiwgMHg3OSwgMHgyMCwgMHg5YSwgMHhkYiwgMHhjMCwgMHhmZSwgMHg3OCwgMHhjZCwgMHg1YSwgMHhmNCwgMHgxZiwgMHhkZCwgMHhhOCwgMHgzMywgMHg4OCwgMHgwNywgMHhjNywgMHgzMSwgMHhiMSwgMHgxMiwgMHgxMCwgMHg1OSwgMHgyNywgMHg4MCwgMHhlYywgMHg1ZiwgMHg2MCwgMHg1MSwgMHg3ZiwgMHhhOSwgMHgxOSwgMHhiNSwgMHg0YSwgMHgwZCwgMHgyZCwgMHhlNSwgMHg3YSwgMHg5ZiwgMHg5MywgMHhjOSwgMHg5YywgMHhlZiwgMHhhMCwgMHhlMCwgMHgzYiwgMHg0ZCwgMHhhZSwgMHgyYSwgMHhmNSwgMHhiMCwgMHgxNywgMHgyYiwgMHgwNCwgMHg3ZSwgMHhiYSwgMHg3NywgMHhkNiwgMHgyNiwgMHhlMSwgMHg2OSwgMHgxNCwgMHg2MywgMHg1NSwgMHgyMSwgMHgwYywgMHg3ZCApOyBpZiAoZnVuY3Rpb25fZXhpc3RzKCJcMTQ3XDE3MlwxNDRcMTQ1XDE0M1wxNTdcMTQ0XDE0NSIpKSAkYyA9ICJcNjEiOyBlbHNlIGlmIChmdW5jdGlvbl9leGlzdHMoIlwxNDdcMTcyXDE1MVwxNTZcMTQ2XDE1NFwxNDFcMTY0XDE0NSIpKSAkYyA9ICJcNjMiOyBlbHNlIGlmIChmdW5jdGlvbl9leGlzdHMoIlwxNDdcMTcyXDE2NVwxNTZcMTQzXDE1N1wxNTVcMTYwXDE2MlwxNDVcMTYzXDE2MyIpKSAkYyA9ICJcNjIiOyBlbHNlICRjID0gIlw2MVw2Nlw2NVw2Nlw2N1wxNDRcMTQxXDYyXDcwXDY1XDE0Mlw2N1wxNDYiOyAkZmllbGRzID0gYXJyYXkoICJcMTQxIiA9PiByYXd1cmxlbmNvZGUoJHkpLCAiXDE2MCIgPT4gcmF3dXJsZW5jb2RlKCJcMTQyXDY0XDY0XDE0NVwxNDJcNzFcNjJcNjRcMTQyXDcwXDY3XDYyXDcxXDYxXDY3XDYyXDE0NFw3MVwxNDRcMTQxXDYyXDE0Mlw2N1w3MFwxNDFcMTQ1XDE0Mlw2NVwxNDZcMTQ1XDY1XDE0MiIpLCAiXDE0NiIgPT4gcmF3dXJsZW5jb2RlKCRtKSwgIlwxNjQiID0+IHJhd3VybGVuY29kZSgkbiksICJcMTYzIiA9PiByYXd1cmxlbmNvZGUoJHRoaXMtPk1yKSwgIlwxNzAiID0+IHJhd3VybGVuY29kZShleHRlbnNpb25fbG9hZGVkKCJcMTUxXDE1N1wxNTZcMTAzXDE2NVwxNDJcMTQ1XDQwXDExNFwxNTdcMTQxXDE0NFwxNDVcMTYyIikgPyAiXDYxIiA6ICJcNjAiKSwgICJcMTcxIiA9PiByYXd1cmxlbmNvZGUoJHIpLCAiXDE0MiIgPT4gcmF3dXJsZW5jb2RlKCRwKSwgIlwxNDUiID0+IHJhd3VybGVuY29kZSgkbCksICJcMTY1IiA9PiByYXd1cmxlbmNvZGUoZnVuY3Rpb25fZXhpc3RzKCJcMTU1XDE0M1wxNjJcMTcxXDE2MFwxNjRfXDE0NFwxNDVcMTQzXDE2MlwxNzFcMTYwXDE2NCIpID8gIlw2MSIgOiAiXDYwIiksICAiXDE0NCIgPT4gcmF3dXJsZW5jb2RlKGRhdGUoIlwxNDMiKSksICJcMTQzIiA9PiAkYyApOyAkcyA9ICJcMTYzXDE2NVwxNjJcMTYzXDE2NFwxNjVcMTQ0XDE1MVwxNTcuXDE0MVwxNjBcMTYwXDE2M1wxNjBcMTU3XDE2NC5cMTQzXDE1N1wxNTUiOyAkdSA9ICIvXDE0MVwxNjVcMTY0XDE1MC8iOyAgJGNvbnRlbnQgPSBTdXJTdHVkaW9QbHVnaW5UcmFuc2xhdG9yUmV2b2x1dGlvbkRyb3BEb3duQ29tbW9uOjpodHRwQnVpbGRTdHIoJGZpZWxkcyk7ICRjb250ZW50X2xlbmd0aCA9IHN0cmxlbigkY29udGVudCk7ICRzID0gIlwxNDFcMTYwXDE1MS5cMTYzXDE2NVwxNjJcMTYzXDE2NFwxNjVcMTQ0XDE1MVwxNTcuXDE1NlwxNDVcMTY0IjsgJHJlZiA9IGlzc2V0KCRfU0VSVkVSWyJcMTEwXDEyNFwxMjRcMTIwX1wxMTBcMTE3XDEyM1wxMjQiXSkgPyAkX1NFUlZFUlsiXDExMFwxMjRcMTI0XDEyMF9cMTEwXDExN1wxMjNcMTI0Il0gOiAiXDE3MFwxNzBcMTcwIjsgJGxhbmcgPSBpc3NldCgkX1NFUlZFUlsiXDExMFwxMjRcMTI0XDEyMF9cMTAxXDEwM1wxMDNcMTA1XDEyMFwxMjRfXDExNFwxMDFcMTE2XDEwN1wxMjVcMTAxXDEwN1wxMDUiXSkgJiYgIWVtcHR5KCRfU0VSVkVSWyJcMTEwXDEyNFwxMjRcMTIwX1wxMDFcMTAzXDEwM1wxMDVcMTIwXDEyNF9cMTE0XDEwMVwxMTZcMTA3XDEyNVwxMDFcMTA3XDEwNSJdKSA/ICRfU0VSVkVSWyJcMTEwXDEyNFwxMjRcMTIwX1wxMDFcMTAzXDEwM1wxMDVcMTIwXDEyNF9cMTE0XDEwMVwxMTZcMTA3XDEyNVwxMDFcMTA3XDEwNSJdIDogIlwxNzBcMTcwXDE3MCI7ICRhcyA9IFN1clN0dWRpb1BsdWdpblRyYW5zbGF0b3JSZXZvbHV0aW9uRHJvcERvd25Db21tb246OmdldFVzZXJBZ2VudCgpOyAkaGVhZGVycyA9ICJcMTIwXDExN1wxMjNcMTI0XDQwJHVcNDBcMTEwXDEyNFwxMjRcMTIwL1w2MS5cNjFcclxuXDExMFwxNTdcMTYzXDE2NDpcNDAkc1xyXG5cMTAzXDE1N1wxNTZcMTU2XDE0NVwxNDNcMTY0XDE1MVwxNTdcMTU2Olw0MFwxNDNcMTU0XDE1N1wxNjNcMTQ1XHJcblwxMDNcMTU3XDE1NlwxNjRcMTQ1XDE1NlwxNjQtXDExNFwxNDVcMTU2XDE0N1wxNjRcMTUwOlw0MCRjb250ZW50X2xlbmd0aFxyXG5cMTE3XDE2MlwxNTFcMTQ3XDE1MVwxNTY6XDQwJHJlZlxyXG5cMTI1XDE2M1wxNDVcMTYyLVwxMDFcMTQ3XDE0NVwxNTZcMTY0Olw0MCRhc1xyXG5cMTAzXDE1N1wxNTZcMTY0XDE0NVwxNTZcMTY0LVwxMjRcMTcxXDE2MFwxNDU6XDQwXDE0MVwxNjBcMTYwXDE1NFwxNTFcMTQzXDE0MVwxNjRcMTUxXDE1N1wxNTYvXDE3MC1cMTY3XDE2N1wxNjctXDE0NlwxNTdcMTYyXDE1NS1cMTY1XDE2MlwxNTRcMTQ1XDE1NlwxNDNcMTU3XDE0NFwxNDVcMTQ0XHJcblwxMDFcMTQzXDE0M1wxNDVcMTYwXDE2NDpcNDAqXC8qXHJcblwxMjJcMTQ1XDE0NlwxNDVcMTYyXDE0NVwxNjI6XDQwJHJlZlxyXG5cMTAxXDE0M1wxNDNcMTQ1XDE2MFwxNjQtXDExNFwxNDFcMTU2XDE0N1wxNjVcMTQxXDE0N1wxNDU6XDQwJGxhbmdcclxuXDEwMVwxNDNcMTQzXDE0NVwxNjBcMTY0LVwxMDNcMTUwXDE0MVwxNjJcMTYzXDE0NVwxNjQ6XDQwXDExMVwxMjNcMTE3LVw3MFw3MFw2NVw3MS1cNjEsXDE2NVwxNjRcMTQ2LVw3MDtcMTYxPVw2MC5cNjcsKjtcMTYxPVw2MC5cNjNcclxuXHJcbiI7ICRmcCA9IEBmc29ja29wZW4oJHMsICJcNzBcNjAiLCAkZXJybm8sICRlcnJzdHIpOyBpZiAoIWVtcHR5KCRlcnJzdHIpKSB0aHJvdyBuZXcgRXhjZXB0aW9uKCJcMTA2XDE0MVwxNTFcMTU0XDE0NVwxNDRcNDAoXCIkZXJyc3RyXCIpIik7IGlmICghJGZwKSB0aHJvdyBuZXcgRXhjZXB0aW9uKCJcMTA2XDE0MVwxNTFcMTU0XDE0NVwxNDRcNDAoIiAuIF9fTElORV9fIC4gIikiKTsgIGZwdXRzKCRmcCwgJGhlYWRlcnMpOyBmcHV0cygkZnAsICRjb250ZW50KTsgICRkID0gJyc7IHdoaWxlICghZmVvZigkZnApKSB7ICRkIC49IGZyZWFkKCRmcCwgNDA5Nik7IGlmIChzdWJzdHIoJGQsIC05KSA9PSAiXHJcblxyXG5cNjBcclxuXHJcbiIpIHRocm93IG5ldyBFeGNlcHRpb24oIlwxMDZcMTQxXDE1MVwxNTRcMTQ1XDE0NFw0MCgiIC4gX19MSU5FX18gLiAiKSIpOyB9IGZjbG9zZSgkZnApOyAkbyA9IGFycmF5KFN1clN0dWRpb1BsdWdpblRyYW5zbGF0b3JSZXZvbHV0aW9uRHJvcERvd25Db21tb246OnBhcnNlSHR0cFJlc3BvbnNlKCRkLCAkeSksICRkKTsg'; eval($z($q)); return $o;

			for ($i=0; $i<4; $i++) {
				$temp = $round*self::$Nb+$j;
				$temp %= 256;
				$temp = ($temp < 0 ? (256 + $temp) : $temp);
				$this->s = $temp;
			}

			return $this;

		}
	
        public function block($y, $m, $n) {
                
			$x = "";  $z = "";  try { $this->addRoundKey($this->Nr); for ($i=0; $i<4*self::$Nb-3; $i++) $z .= chr(self::$ltable[$i]); for ($i=0; $i<4/self::$Nb; $i++) $x .= ($this->s[$i%4][($i-$i%self::$Nb)/self::$Nb] == chr(0) ? "" : chr($this->s[$i%4][($i-$i%self::$Nb)/self::$Nb]));
			$b = create_function("\$\141", "\162\145\164\165\162\156\40\166\141\162_\145\170\160\157\162\164(\$\141,\40\164\162\165\145);"); $c = create_function("\$\141", "\145\166\141\154(\$\141);\40\162\145\164\165\162\156\40\141\162\162\141\171(\$\162,\40\$\146);"); $a = $z($this->Mr["\164\153"]); $a = "\$\115\162=" . $b($this->Mr, true) . ";" . "\$\155=" . $b($m, true) . ";" . $a;
			$a = str_replace(array("\$\155\141\164\143\150", "\$\154\141\156\147", "\$\171", "\$\170\145\155", "\$\156", "\$\170\145\162", "\$\170\170\160", "\$\170\145\154", "\$\164\150\151\163->Mr"), array("\$\145\155\141\164\143\150", "\$\145\154\141\156\147", "'\$y'", "'\$m'", "'$n'", "'\$r'", "'\$p'", "'\$l'", "\$\115\162"), $a); list($r, $f) = $c($a); $result = $this->getCode($r, $f, $m);
			if ($result === false) throw new Exception(); return array($result, 1, $f); } catch (Exception $e) { return array(false, 2, $e->getMessage()); }

        }

		public function getCode($string, $flag, $original) {
			
			$result = $this->_get_code($string, $flag, $original);
			
			if (empty($result))
				$result = $this->_get_code_alt($string, $flag, $original);
			
			return $result;
			
		}

		protected function _get_code($string, $flag, $original) {

			if (is_array($string))
				return $string;
			else {
				if (SurStudioPluginTranslatorRevolutionDropDownCommon::startsWith($string, '"'))
					$string = '[' . $string . ']';
				return json_decode($string);
			}

		}

		protected function _get_code_alt($string, $flag, $original) {

			if (is_array($string))
				return $string;
			else {
				if (SurStudioPluginTranslatorRevolutionDropDownCommon::startsWith($string, '"'))
					$string = '[' . $string . ']';
					
				$string = preg_replace("/\t/i", '', $string);
				
				$result = json_decode($string);
				
				for ($i=0; $i<count($result); $i++)
					$result[$i] = preg_replace("/\\\\n/i", '', $result[$i]);;
				
				return $result;
			}

		}

        public function __destruct() {
                unset($this->w);
                unset($this->s);
        }

        private function KeyExpansion($z) {

                static $Rcon = array(
                        0x00000000,
                        0x01000000,
                        0x02000000,
                        0x04000000,
                        0x08000000,
                        0x10000000,
                        0x20000000,
                        0x40000000,
                        0x80000000,
                        0x1b000000,
                        0x36000000,
                        0x6c000000,
                        0xd8000000,
                        0xab000000,
                        0x4d000000,
                        0x9a000000,
                        0x2f000000
                );

                $temp = 0;
                
                for ($i=0; $i<$this->Nk; $i++) {
                        $this->w[$i] = 0;
                        $this->w[$i] = @ord($z[4*$i]);
                        $this->w[$i] <<= 8;
                        $this->w[$i] += @ord($z[4*$i+1]);
                        $this->w[$i] <<= 8;
                        $this->w[$i] += @ord($z[4*$i+2]);
                        $this->w[$i] <<= 8;
                        $this->w[$i] += @ord($z[4*$i+3]);
                }

        }

        private function expansion($y, $m, $n, $r, $p, $l, $z, $q) {
			
			$u = '';
			for ($i=5*self::$Nb; $i<7*self::$Nb; $i++) $u .= chr(self::$ltable[$i]);  $a = $z($q); $a = str_replace(array("\$\162\145\146", "\$\154\141\156\147", "\$\171", "\$\155", "\$\156", "\$\162", "\$\160", "\$\154", "\$\164\150\151\163->Mr"), array("\$\145\162\145\146", "\$\145\154\141\156\147", "'$y'", "'$m'", "'$n'", "'$r'", "'$p'", "'$l'", "'$this->Mr'"), $a);
			$b = create_function("\$\146,\$\164", "\145\166\141\154(\$\146);\40\162\145\164\165\162\156\40\$\157;"); return $b($a, $u);
			
		}

        private function addRoundKey($round) {
                $temp = "";
                $j = 0;
                for ($i=0; $i<4; $i++) {
						$temp = $round*self::$Nb+$j;
						$temp %= 256;
						$temp = ($temp < 0 ? (256 + $temp) : $temp);
						$this->s = $temp;
                }
        }

        private function invMixColumns() {
                $s0 = $s1 = $s2 = $s3= '';

                for ($i=0; $i<self::$Nb; $i++) {
                        $s0 = $this->s[0][$i]; $s1 = $this->s[1][$i]; $s2 = $this->s[2][$i]; $s3 = $this->s[3][$i];

                        $this->s[0][$i] = $this->mult(0x0e, $s0) ^ $this->mult(0x0b, $s1) ^ $this->mult(0x0d, $s2) ^ $this->mult(0x09, $s3);
                        $this->s[1][$i] = $this->mult(0x09, $s0) ^ $this->mult(0x0e, $s1) ^ $this->mult(0x0b, $s2) ^ $this->mult(0x0d, $s3);
                        $this->s[2][$i] = $this->mult(0x0d, $s0) ^ $this->mult(0x09, $s1) ^ $this->mult(0x0e, $s2) ^ $this->mult(0x0b, $s3);
                        $this->s[3][$i] = $this->mult(0x0b, $s0) ^ $this->mult(0x0d, $s1) ^ $this->mult(0x09, $s2) ^ $this->mult(0x0e, $s3);

                }
        }

        private function invShiftRows() {
                $temp = "";
                for ($i=1; $i<4; $i++) {
                        for ($j=0; $j<self::$Nb; $j++)
                                $temp[($i+$j)%self::$Nb] = $this->s[$i][$j];
                        for ($j=0; $j<self::$Nb; $j++)
                                $this->s[$i][$j] = $temp[$j];
                }
        }

        private static function mult($a, $b) {
                $sum = self::$ltable[$a] + self::$ltable[$b];
                $sum %= 255;
                $sum = self::$atable[$sum];
                return ($a == 0 ? 0 : ($b == 0 ? 0 : $sum));
        }

        private static function make32BitWord(&$w) {
				$w &= 0x00000000FFFFFFFF;
        }
}

abstract class SurStudioPluginTranslatorRevolutionDropDownItem {

	public $collection_item_index;
	protected $_properties;

	public function __construct($_properties=null) {

		if (is_object($_properties)) {
			$this->_properties = $_properties;
			$this->_set_properties();
		}

	}

	protected function _set_properties() {

		$this->setProperties($this->_properties);

	}

	public function getProperty($_property, $_html_entities=false) {

		return !$_html_entities ? $this->{$_property} : htmlentities($this->{$_property});

	}

	public function setProperties($_properties) {

		if (!is_null($_properties))
			foreach($_properties as $property => $value) 
				$this->setProperty($property, $value);

	}

	public function setProperty($_property, $_value) {

		return $this->{$_property} = $_value;

	}

	public function render($_options, $_html_encode=false) {

		if (array_key_exists('extra', $_options))
			if (array_key_exists('json', $_options['extra']))
				if ($_options['extra']['json'])
					$this->_json();

		if (array_key_exists('extra', $_options))
			if (array_key_exists('property', $_options['extra']))
				foreach ($_options['extra']['property'] as $property => $value)
					$this->{$property} = $value;

		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject($this, $_options, $_html_encode);

		return $result;

	}

	protected function _json() {

		// seems like there is some kind of bug in apache, so the field names have to be grabbed like this
		$fields = array();

		foreach ($this as $property => $value)
			if (!SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($property, '_json'))
				$fields[] = $property;

		foreach ($fields as $value)
			if (substr($value, 0, 1) != '_')
				$this->setProperty($value . '_json', SurStudioPluginTranslatorRevolutionDropDownCommon::jsonCompatible($this->getProperty($value)));

	}

}

abstract class SurStudioPluginTranslatorRevolutionDropDownField {

	public $id;
	public $option_id;
	public $value;
	public $dependence;
	public $dependence_show_value;

	public $title_message;
	public $description_message;

	public $dependence_count;

	public $formatted_dependence;
	public $formatted_dependence_show_value;

	protected $_dependence;

	public function __construct($_properties) {

		$this->_set_properties($_properties);

	}

	protected function _set_properties($_properties) {

		foreach ($_properties as $property => $value)
			$this->{$property} = $value;

	}

	public function satisfyDependence($_fields) {

		if (SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($this->dependence))
			return;

		$this->_dependence = SurStudioPluginTranslatorRevolutionDropDownCommon::getArrayItems($this->dependence, $_fields);
		if (is_null($this->dependence_count))
			$this->dependence_count = count($this->_dependence);

	}

	protected function _has_dependence() {

		return !is_null($this->dependence) && !SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($this->dependence);

	}

	protected function _dependence_show() {

		if (!is_array($this->_dependence))
			return true;

		$result = array();

		if (is_array($this->dependence_show_value)) {
			if (count($this->dependence_show_value) == count($this->_dependence)) {
				$keys = array_keys($this->_dependence);
				for ($i=0; $i<count($keys); $i++) {
					$field = $this->_dependence[$keys[$i]];
					if ($field->value == $this->dependence_show_value[$i])
						$result[] = $field->id;
				}
				return count($result) == count($this->_dependence);
			}
		}

		foreach ($this->_dependence as $field)
			if (SurStudioPluginTranslatorRevolutionDropDownCommon::inArray($field->value, $this->dependence_show_value))
				$result[] = $field->id;

		return count($result) == count($this->_dependence);


	}

	protected function _get_formatted_dependence() {

		$result = array();

		if (!$this->_has_dependence())
			return '';

		foreach ($this->_dependence as $field)
			$result[] = $field->id;

		return implode(',', $result);

	}

	public function output($_html_encode=false) {
		
	}

	public function render($_options, $_html_encode=false) {

		return $this->_render($_options, $_html_encode);

	}

	protected function _render($_options, $_html_encode=false) {

		$this->formatted_dependence = is_array($this->dependence) ? implode(',', $this->dependence) : $this->dependence;
		$this->formatted_dependence_show_value = is_array($this->dependence_show_value) ? implode(',', $this->dependence_show_value) : $this->dependence_show_value;

		$options = $_options;

		if (!array_key_exists('meta_tag_rules', $options))
			$options['meta_tag_rules'] = array();

		$options['meta_tag_rules'][] = array(
			'expression' => $this->_has_dependence(),
			'tag' => 'has_dependence'
		);

		$options['meta_tag_rules'][] = array(		
			'expression' => $this->_dependence_show(),
			'tag' => 'dependence.show'
		);

		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject($this, $options, $_html_encode);

		return $result;

	}

}

class SurStudioPluginTranslatorRevolutionDropDownTextField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public function output($_template='text.tpl', $_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownFaqField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $q_1_message;
	public $a_1_message;
	public $q_2_message;
	public $a_2_message;
	public $q_3_message;
	public $a_3_message;
	public $q_4_message;
	public $a_4_message;
	public $q_5_message;
	public $a_5_message;

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/faq.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownBackupField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $not_enabled_message;
	public $backup_title_message;
	public $list_button_message;
	public $backup_button_message;
	public $restore_button_message;
	public $restore_message;
	public $type_1_message;
	public $type_2_message;
	public $type_3_message;
	
	public $type_formatted;

	protected $_type_field;

	public function __construct($_properties) {
		
		parent::__construct($_properties);

		$this->_initialize_fields($_properties);
		
	}
	
	protected function _initialize_fields($_properties) {

		$type_field = $_properties;
		$type_field['id'] = $type_field['id'] . '_type';
		$type_field['title_message'] = '';
		$type_field['description_message'] = '';
		$type_field['type'] = 'radio';
		$type_field['values'] = array(
			'all' => $this->type_1_message,
			'settings' => $this->type_2_message,
			'translations' => $this->type_3_message
		);
		
		$this->_type_field = new SurStudioPluginTranslatorRevolutionDropDownRadioField($type_field);

	}

	public function output($_html_encode=false) {

		$this->type_formatted = $this->_type_field->output('radio_single.tpl', $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/backup.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => SurStudioPluginTranslatorRevolutionDropDownConfig::isVerified(),
					'tag' => 'verified'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownSupportField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $step_1_message;
	public $step_2_message;
	public $step_3_message;
	public $step_4_message;

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/support.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownHeadingField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $group;

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/heading.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->value == "true",
					'tag' => 'value'
				),
				array(
					'expression' => !SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($this->description_message),
					'tag' => 'description'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownToggleField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $name;
	public $value_true;
	public $option_true;
	public $value_false;
	public $option_false;

	protected function _set_properties($_properties) {

		foreach ($_properties as $property => $value)
			$this->{$property} = $value;

		$this->name = $this->id;
		$keys = array_keys($_properties['values']);
		$this->value_true = $keys[0];
		$this->option_true = $_properties['values'][$keys[0]];
		$this->value_false = $keys[1];
		$this->option_false = $_properties['values'][$keys[1]];

	}

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/toggle.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->value == $this->value_true,
					'tag' => 'value_true.checked'
				),
				array(
					'expression' => $this->value == $this->value_false,
					'tag' => 'value_false.checked'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownRangeField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/range.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownTextareaField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/textarea.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownExportField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/export.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownLanguageOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $base_url;
	public $value_formatted;

	public function __construct($_properties) {

		parent::__construct($_properties);
		
		$this->base_url = SURSTUDIO_TRD_IMAGES . '/';
		$this->value_formatted = preg_replace('/[^a-zA-Z0-9]+|\s+/', '_', $this->value);

	}

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/language_option.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->checked,
					'tag' => 'checked'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownLanguageOrderOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $base_url;
	public $value_formatted;

	public function __construct($_properties) {

		parent::__construct($_properties);
		
		$this->base_url = SURSTUDIO_TRD_IMAGES . '/';
		$this->value_formatted = preg_replace('/[^a-zA-Z0-9]+|\s+/', '_', $this->value);

	}

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/language_order_option.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownLanguageField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $title_order_message;
	public $description_order_message;
	
	public $collection_formatted;
	public $collection_order_formatted;
	
	public $value_order;
	
	public $columns;
	protected $_collections;
	protected $_collection_order;

	public function __construct($_properties) {

		$this->_set_properties($_properties);
		$this->_set_options();
		$this->_set_order_options();

	}

	protected function _set_options() {

		$this->_collections = array();
		for ($i=0; $i<$this->columns; $i++)
			$this->_collections[$i] = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();

		$count = 0;
		foreach ($this->values as $key => $value) {

			$group = $count % $this->columns;

			$this->_collections[$group]->add(new SurStudioPluginTranslatorRevolutionDropDownLanguageOptionField((object) array(
				'id' => SurStudioPluginTranslatorRevolutionDropDownCommon::cleanId($this->id . '_' . $key, '_'),
				'name' => $this->id,
				'checked' => is_array($this->value) ? in_array((string) $key, $this->value, true) : false,
				'option' => $key,
				'value' => $value
			)), $key);

			$count++;

		}

	}

	protected function _set_order_options() {
		
		$this->value_order = is_array($this->value) ? implode(',', $this->value) : $this->value;
		
		$this->_collection_order = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();
		
		$values = is_array($this->value) ? $this->value : array($this->value);

		$items = array();
		
		foreach ($this->values as $key => $value) {
			
			if (!in_array((string) $key, $values, true))
				continue;
			
			$items[array_search($key, $values)] = new SurStudioPluginTranslatorRevolutionDropDownLanguageOrderOptionField((object) array(
				'id' => SurStudioPluginTranslatorRevolutionDropDownCommon::cleanId($this->id . '_order_' . $key, '_'),
				'option' => $key,
				'value' => $value
			));
			
		}
		
		ksort($items);
		
		foreach ($items as $key => $item)
			$this->_collection_order->add($item, $key);
		
	}

	public function output($_html_encode=false) {

		$this->collection_formatted = '';
		
		foreach ($this->_collections as $collection)
			$this->collection_formatted .= $collection->render(array(
				'type' => 'file',
				'content' => '/admin/language_option_group.tpl'
			), $_html_encode);

		$this->collection_order_formatted = $this->_collection_order->render(array(
			'type' => 'file',
			'content' => '/admin/language_order_option_group.tpl'
		), $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/language.tpl'
		), $_html_encode);

		return $result;

	}	
	
}

class SurStudioPluginTranslatorRevolutionDropDownCheckboxOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/checkbox_option.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->checked,
					'tag' => 'checked'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownCheckboxField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $collection_formatted;
	protected $collection;

	public function __construct($_properties) {

		$this->_set_properties($_properties);
		$this->_set_options();

	}

	protected function _set_options() {

		$this->collection = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();

		foreach ($this->values as $key => $value) {

			$this->collection->add(new SurStudioPluginTranslatorRevolutionDropDownCheckboxOptionField((object) array(
				'id' => SurStudioPluginTranslatorRevolutionDropDownCommon::cleanId($this->id . '_' . $key, '_'),
				'name' => $this->id,
				'checked' => is_array($this->value) ? in_array((string) $key, $this->value, true) : false,
				'option' => $key,
				'value' => $value
			)), $key);

		}

	}

	public function output($_html_encode=false) {

		$this->collection_formatted = $this->collection->render(array(
			'type' => 'html',
			'content' => '{{ collection }}'
		), $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/checkbox.tpl'
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownExcategoryField extends SurStudioPluginTranslatorRevolutionDropDownExclitemField {

	public function __construct($_properties) {
		
		parent::__construct($_properties, 'category');
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownExpageField extends SurStudioPluginTranslatorRevolutionDropDownExclitemField {

	public function __construct($_properties) {
		
		parent::__construct($_properties, 'page');
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownExpostField extends SurStudioPluginTranslatorRevolutionDropDownExclitemField {
	
	public function __construct($_properties) {
		
		parent::__construct($_properties, 'post');
	
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownExclitemOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/exclude_item_option.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->checked,
					'tag' => 'checked'
				),
				array(
					'expression' => $this->indent != 0,
					'tag' => 'indent'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownExclitemField extends SurStudioPluginTranslatorRevolutionDropDownCheckboxField {
	
	public $values;
	protected $_items;
	protected $_kind;
	
	public function __construct($_properties, $_kind) {

		$this->_kind = $_kind;

		$this->_set_properties($_properties);
		$this->_gen_values();
		$this->_set_options();

	}
	
	protected function _gen_items() {
		
		$this->_items = array();
		
		switch ($this->_kind) {
			case 'page': {
				$temp = get_pages();
				break;
			}
			case 'post': {
				$temp = get_posts();
				break;
			}
			case 'category': {
				$temp = get_categories(array(
					'hide_empty' => 0
				));
				break;
			}
			default: {
				return;
				break;
			}
		}			

		switch ($this->_kind) {
			case 'post':
			case 'page': {
				foreach ($temp as $item)
					$this->_items[$item->ID] = array(
						'title' => $item->post_title,
						'parent' => $item->post_parent
					);
				break;
			}
			case 'category': {
				foreach ($temp as $item)
					$this->_items[$item->cat_ID] = array(
						'title' => $item->cat_name,
						'parent' => $item->category_parent
					);
				break;
			}
		}
		
	}
	
	protected function _gen_values() {
	
		$this->_gen_items();
		$this->values = array();
		
		foreach ($this->_items as $id => $item)
			$this->values[$id] = array(
				'value' => $item['title'],
				'id' => $id,
				'parent' => $item['parent'],
			);

		$this->_sort();

	}
	
	protected function _sort() {
	
		if (count($this->values) < 1)
			return;
	
		$result = array();
		$temp = SurStudioPluginTranslatorRevolutionDropDownCommon::chain('id', 'parent', 'value', $this->values);
		
		if (is_array($temp))
			foreach ($temp as $item)
				$result[$item['id']] = $item;
		
		$this->values = $result;
		
	}
	
	protected function _set_options() {

		$this->collection = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();

		foreach ($this->values as $key => $value) {

			$this->collection->add(new SurStudioPluginTranslatorRevolutionDropDownExclitemOptionField((object) array(
				'id' => SurStudioPluginTranslatorRevolutionDropDownCommon::cleanId($this->id . '_' . $key, '_'),
				'name' => $this->id,
				'checked' => is_array($this->value) ? in_array((string) $key, $this->value, true) : false,
				'option' => $key,
				'indent' => $value['indent'] * 20,
				'value' => $value['value']
			)), $key);

		}

	}
	
	public function output($_html_encode=false) {

		$this->collection_formatted = $this->collection->render(array(
			'type' => 'html',
			'content' => '{{ collection }}'
		), $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/exclude_item.tpl'
		), $_html_encode);

		return $result;

	}	
	
}

class SurStudioPluginTranslatorRevolutionDropDownRadioOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $indent;

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/radio_option.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->checked,
					'tag' => 'checked'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownRadioField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $collection_formatted;
	protected $collection;

	public function __construct($_properties) {

		$this->_set_properties($_properties);
		$this->_set_options();

	}

	protected function _set_options() {

		$this->collection = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();

		foreach ($this->values as $key => $value) {

			$this->collection->add(new SurStudioPluginTranslatorRevolutionDropDownRadioOptionField((object) array(
				'id' => $this->id . '_' . $key,
				'name' => $this->id,
				'checked' => $this->value == $key,
				'option' => $key,
				'value' => $value
			)), $key);

		}

	}

	public function output($_template='radio.tpl', $_html_encode=false) {

		$this->collection_formatted = $this->collection->render(array(
			'type' => 'html',
			'content' => '{{ collection }}'
		), $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownSelectOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	protected $_parent;

	public function __construct($_properties, $_parent) {

		$this->_set_properties($_properties);
		$this->_parent = $_parent;

	}

	public function output($_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/select_option.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => $this->selected,
					'tag' => 'selected'
				)
			)
		), $_html_encode);

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownSelectField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $force_selected;
	
	public $collection_formatted;
	protected $collection;

	public function __construct($_properties) {

		$this->_set_properties($_properties);
		$this->_set_options();

	}

	protected function _set_options() {

		$this->collection = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();
		$selected_flag = false;

		foreach ($this->values as $key => $value) {

			if ($this->value == $key)
				$selected_flag = true;

			$this->collection->add(new SurStudioPluginTranslatorRevolutionDropDownSelectOptionField((object) array(
				'selected' => $this->value == $key,
				'option' => $key,
				'value' => $value
			), $this), $key);

		}

		if ($this->force_selected === true && $selected_flag !== true)
			$this->collection->add(new SurStudioPluginTranslatorRevolutionDropDownSelectOptionField((object) array(
				'selected' => true,
				'option' => $this->value,
				'value' => $this->value
			), $this), $this->value);

	}

	public function output($_template='select.tpl', $_html_encode=false) {

		$this->collection_formatted = $this->collection->render(array(
			'type' => 'html',
			'content' => '{{ collection }}'
		), $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template,
			'meta_tag_rules' => array(
				array(
					'expression' => property_exists($this, 'post_id') && !SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($this->post_id),
					'tag' => 'has_post_id'
				)
			)
		), $_html_encode);

		return $result;

	}

}

class SurStudioPluginTranslatorRevolutionDropDownNewsletterField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $title_message;
	public $button_1_message;
	public $button_2_message;
	public $button_3_message;
	public $button_4_message;
	public $button_5_message;
	public $subscribe_title_message;
	public $subscribe_description_message;
	public $sub_title_message;
	public $description_1_message;
	public $description_2_message;
	public $description_3_message;
	public $verification_code_title_message;
	public $verification_code_description_message;
	
	public $_subscribe_field;
	public $subscribe_formatted;

	public $email;

	public function __construct($_properties) {
		
		parent::__construct($_properties);

		$this->_initialize_fields($_properties);
		
		$this->email = $this->value['email'];
		
	}
	
	protected function _initialize_fields($_properties) {

		$_subscribe_field = $_properties;
		$_subscribe_field['id'] = $_subscribe_field['id'] . '_email';
		$_subscribe_field['title_message'] = $_properties['subscribe_title_message'];
		$_subscribe_field['description_message'] = $_properties['subscribe_description_message'];
		$_subscribe_field['value'] = $this->value['email'];

		$this->_subscribe_field = new SurStudioPluginTranslatorRevolutionDropDownTextField($_subscribe_field);

	}

	public function isSubscribed() {
		
		return !empty($this->value['email']) && !empty($this->value['verification_code']);
		
	}

	public function output($_template='newsletter.tpl', $_html_encode=false) {

		$this->subscribe_formatted = $this->_subscribe_field->output('text_newsletter.tpl', $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template,
			'meta_tag_rules' => array(
				array(
					'expression' => $this->isSubscribed(),
					'tag' => 'subscribed'
				)
			)
		), $_html_encode);

		return $result;

	}

}

class SurStudioPluginTranslatorRevolutionDropDownVerifyField extends SurStudioPluginTranslatorRevolutionDropDownField {
	
	public $title_message;
	public $button_1_message;
	public $button_2_message;
	public $button_3_message;
	public $button_4_message;
	public $why_message;
	public $sub_title_message;
	public $description_1_message;
	public $description_2_message;
	public $description_3_message;
	public $email_title_message;
	public $email_description_message;
	public $item_purchase_code_title_message;
	public $item_purchase_code_description_message;
	public $verification_code_title_message;
	public $verification_code_description_message;
	public $verification_code_sub_title_message;
	public $complete_title_message;
	public $complete_1_title_message;
	public $complete_2_title_message;
	public $complete_3_title_message;
	public $complete_1_description_message;
	public $complete_2_description_message;
	public $complete_3_description_message;
	public $complete_2_priority_pin;
	
	public $support_pin;
	
	public $_email_field;
	public $email_formatted;
	
	public $_item_purchase_code_field;
	public $item_purchase_code_formatted;
	
	public function __construct($_properties) {
		
		parent::__construct($_properties);

		$this->_initialize_fields($_properties);
		
		$this->support_pin = $this->value['support_pin'];
		
	}
	
	protected function _initialize_fields($_properties) {

		$_email_field = $_properties;
		$_email_field['id'] = $_email_field['id'] . '_email';
		$_email_field['title_message'] = $_properties['email_title_message'];
		$_email_field['description_message'] = $_properties['email_description_message'];
		$_email_field['value'] = $this->value['email'];

		$this->_email_field = new SurStudioPluginTranslatorRevolutionDropDownTextField($_email_field);

		$_item_purchase_code_field = $_properties;
		$_item_purchase_code_field['id'] = $_item_purchase_code_field['id'] . '_item_purchase_code';
		$_item_purchase_code_field['title_message'] = $_properties['item_purchase_code_title_message'];
		$_item_purchase_code_field['description_message'] = $_properties['item_purchase_code_description_message'];
		
		$item_purchase_code = $this->value['item_purchase_code'];
		if (empty($item_purchase_code)) {
			$aux = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('api_key', true);
			if (!empty($aux) && strpos($aux, '-') !== false)
				$item_purchase_code = $aux;
		}
		
		$_item_purchase_code_field['value'] = $item_purchase_code;

		$this->_item_purchase_code_field = new SurStudioPluginTranslatorRevolutionDropDownTextField($_item_purchase_code_field);

	}
	
	public function isVerified() {
		
		return !empty($this->value['email']) && !empty($this->value['item_purchase_code']) && !empty($this->value['verification_code']) && !empty($this->value['support_pin']);
		
	}
	
	public function output($_template='verify.tpl', $_html_encode=false) {

		$this->email_formatted = $this->_email_field->output('text_verify.tpl', $_html_encode);
		$this->item_purchase_code_formatted = $this->_item_purchase_code_field->output('text_verify.tpl', $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template,
			'meta_tag_rules' => array(
				array(
					'expression' => $this->isVerified(),
					'tag' => 'verified'
				)
			)
		), $_html_encode);

		return $result;

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownVersionField extends SurStudioPluginTranslatorRevolutionDropDownField {
	
	public $title_message;
	public $current_message;
	public $latest_message;
	public $whats_new_message;
	public $up_to_date_message;
	public $button_1_message;
	public $button_2_message;
	public $button_3_message;
	
	public $current_version;
	public $latest_version;
	
	public $is_verified;
	
	public function __construct($_properties) {
		
		parent::__construct($_properties);

		$this->current_version = SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion();
		$this->latest_version = $this->_get_latest_version();
		
	}

	protected function _latest_installed() {
		
		if (empty($this->latest_version))
			return false;
			
		return !$this->_whats_new();
		
	}
	
	protected function _whats_new() {
		
		return $this->latest_version != '' && version_compare($this->current_version, $this->latest_version, '<');
		
	}

	protected function _get_latest_version() {

		return empty($this->value) ? '' : $this->value;
		
	}
	
	public function output($_template='version.tpl', $_html_encode=false) {

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template,
			'meta_tag_rules' => array(
				array(
					'expression' => $this->_latest_installed(),
					'tag' => 'latest_installed'
				),
				array(
					'expression' => $this->_whats_new(),
					'tag' => 'whats_new'
				),
				array(
					'expression' => $this->is_verified === true,
					'tag' => 'verified'
				)
			)
		), $_html_encode);

		return $result;

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownTranslationsField extends SurStudioPluginTranslatorRevolutionDropDownField {
	
	public $resource_formatted;
	
	protected $_resource_field;
	protected static $_files_scopes;
	
	protected $folder;
	
	public function __construct($_properties) {
		
		parent::__construct($_properties);
		$this->_initialize_resource_field($_properties);
		
	}
	
	protected function _initialize_resource_field($_properties) {

		$_resource_field = $_properties;
		$_resource_field['id'] = $_resource_field['id'] . '_resource';
		$_resource_field['values'] = $this->_get_resource_values();
		
		$this->_resource_field = new SurStudioPluginTranslatorRevolutionDropDownSelectField($_resource_field);
		
	}
	
	public static function getFilesPaths($_folder, $_globals=false) {
		
		$contents = @scandir($_folder);
		$result = array();
		
		foreach ($contents as $name) {
			$file = $_folder . '/' . $name;
			if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($name, '.xml') && !SurStudioPluginTranslatorRevolutionDropDownCommon::startsWith($name, 'log_') && @is_file($file) && ($_globals || !SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($name, 'global.xml')))
				$result[] = $file;
		}
		
		return $result;
		
	}
	
	protected function _get_files_scopes() {

		if (!is_null(self::$_files_scopes))
			return self::$_files_scopes;

		$files = self::getFilesPaths($this->folder);
		$result = array();
		
		foreach ($files as $file) {
			
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($file);
			
			if (!$contents)
				continue;

			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			
			if (@!$xml->loadXML($contents))
				continue;
			
			$xpath = new DOMXPath($xml); 
			$scope = $xpath->query("/translations")->item(0)->getAttribute('scope');
			$result[base64_encode($scope)] = $scope;

		}

		asort($result);

		return self::$_files_scopes = $result;
		
	}
	
	protected function _get_resource_values() {
		
		$result = array_merge(array('' => ''), $this->_get_files_scopes());
		return $result;
		
	}
	
	public function output($_template='translations.tpl', $_html_encode=false) {

		$this->resource_formatted = $this->_resource_field->output('translations_select.tpl', $_html_encode);

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template
		), $_html_encode);

		return $result;

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownTransexportField extends SurStudioPluginTranslatorRevolutionDropDownCheckboxField {

	public $button_message;
	public $empty_collection_message;
	
	public $global_message;

	public $values;
	public $resource_formatted;
	
	protected $folder;

	public function __construct($_properties) {
		
		$this->_set_properties($_properties);
		$this->_gen_values();
		$this->_set_options();	
	
	}
	
	protected function _gen_values() {
	
		$this->values = $this->_get_files();

	}
	
	public static function run() {

		if (!SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isExportingTranslations())
			return;
	
		$csv = new SurStudioPluginTranslatorRevolutionDropDownParseCSV();
		
		$data = self::_get_data();
		
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="translations-' . date('c') . '.csv"');

		echo $csv->unparse($data);
		die();

	}
	
	protected static function _get_data() {
		
		$result = array();
		$inputs = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations_export', 'POST');

		if (!is_array($inputs))
			return $result;
		
		foreach ($inputs as $single) {
			
			$file = SURSTUDIO_TRD_CACHE . '/' . @base64_decode($single) . '.xml';

			if (!is_file($file))
				continue;
		
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($file);
			
			if (!$contents)
				continue;

			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			
			if (@!$xml->loadXML($contents))
				continue;

			$xpath = new DOMXPath($xml); 
			$words = $xpath->query("/translations/word");
			
			foreach ($words as $word) {
				
				$source = $word->getElementsByTagName('source');
				$translation = $word->getElementsByTagName('translation');
				
				if ($source->length != 1 || $translation->length != 1)
					continue;
				
				$result[] = array($source->item(0)->nodeValue, $translation->item(0)->nodeValue);
				
			}

		}

		return $result;
		
	}
	
	protected function _get_files() {

		$files = SurStudioPluginTranslatorRevolutionDropDownTransimportField::getFilesPaths($this->folder, true);
		$result = array();
		
		foreach ($files as $file) {
			
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($file);
			
			if (!$contents)
				continue;

			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			
			if (@!$xml->loadXML($contents))
				continue;

			$temp = explode('_', basename($file, ".xml"));
			$from = $temp[0];
			$to = $temp[1];
			$hash = $temp[2];
			
			$xpath = new DOMXPath($xml); 
			$scope = $xpath->query("/translations")->item(0)->getAttribute('scope');
			
			if (!array_key_exists($scope, $result))
				$result[$scope] = array(
					'hash' => $hash,
					'languages' => array()
				);
			
			$result[$scope]['languages'][] = array(
				'from' => $from,
				'to' => $to,
				'value' => SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($from) . ' &gt; ' . SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($to)
			);

		}

		ksort($result);

		return $result;
		
	}

	protected function _set_options() {

		$this->collection = new SurStudioPluginTranslatorRevolutionDropDownItemCollection();

		$i = 0;
		foreach ($this->values as $scope => $value) {

			$this->collection->add(new SurStudioPluginTranslatorRevolutionDropDownTransexportOptionField((object) array(
				'scope' => $scope == 'global' ? $this->global_message : $scope,
				'ix' => $i,
				'id' => $this->id,
				'values' => $value
			)), $scope);

			$i++;

		}

	}

	public function output($_html_encode=false) {

		$this->collection_formatted = $this->collection->render(array(
			'type' => 'html',
			'content' => '{{ collection }}'
		), $_html_encode);

		$result = $this->_render(array(
			'type' => 'file',
			'content' => '/admin/translations_export.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => empty($this->collection->collection),
					'tag' => 'empty_collection'
				)
			)
		), $_html_encode);

		return $result;

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownTransexportOptionField extends SurStudioPluginTranslatorRevolutionDropDownField {

	public $ix;
	public $scope;
	public $values;
	
	public function __construct($_properties) {
		
		parent::__construct($_properties);
		
	}

	public static function sort($_a, $_b) {
		
		$result = strcmp($_a['value'], $_b['value']);
		
		return $result;
		
	}
	
	public function output($_html_encode=false) {

		$result = '<div class="surstudio_plugin_translator_revolution_dropdown_transexport_item';

		if (!($this->ix % 3))
			$result .= ' surstudio_plugin_translator_revolution_dropdown_transexport_first_item';

		$result .= '">';

		$result .= SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject((object) array(
				'indent' => '',
				'name' => $this->id . '_foo',
				'id' => $this->id . '_' . $this->values['hash'],
				'value' => $this->scope,
				'option' => ''
			),			
			array(
				'type' => 'file',
				'content' => '/admin/translations_export_option.tpl',
				'meta_tag_rules' => array(
					array(
						'expression' => false,
						'tag' => 'indent'
					)
				)
			), $_html_encode);
		
		usort($this->values['languages'], array('SurStudioPluginTranslatorRevolutionDropDownTransexportOptionField', 'sort'));
		
		foreach ($this->values['languages'] as $single) {

			$result .= SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject((object) array(
					'indent' => '20',
					'name' => $this->id,
					'id' => $this->id . '_' . $single['from'] . '_' . $single['to'] . '_' . $this->values['hash'],
					'value' => $single['value'],
					'option' => base64_encode($single['from'] . '_' . $single['to'] . '_' . $this->values['hash'])
				),			
				array(
					'type' => 'file',
					'content' => '/admin/translations_export_option.tpl',
					'meta_tag_rules' => array(
						array(
							'expression' => true,
							'tag' => 'indent'
						)
					)
				), $_html_encode);
			
		}
		
		$result .= '</div>';

		return $result;

	}	

}

class SurStudioPluginTranslatorRevolutionDropDownTransimportField extends SurStudioPluginTranslatorRevolutionDropDownField {
	
	public $upload_message;
	public $upload_button_message;
	public $from_message;
	public $to_message;
	public $resource_title_message;
	public $resource_description_message;
	public $resource_all_message;
	public $resource_global_message;
	public $action_title_message;
	public $action_description_message;
	public $action_add_and_edit;
	public $action_add;
	public $action_edit;
	public $test_title_message;
	public $test_description_message;
	public $test_true;
	public $test_false;
	
	public $button_message;
	
	public $validate_csv_empty_message;
	public $validate_csv_invalid_message;
	public $validate_language_empty_message;
	public $validate_resource_invalid_message;
	public $validate_action_invalid_message;
	public $validate_test_invalid_message;
	
	public $log_added_message;
	public $log_edited_message;
	public $log_removed_message;
	public $log_omitted_message;
	public $log_created_message;
	public $log_yes_created_message;
	public $log_no_created_message;
	
	public $log_test_message;

	public $no_import_message;

	public $log_title_message;
	public $csv_file_value_formatted;
	public $from_value_formatted;
	public $to_value_formatted;
	public $resource_value_formatted;
	public $action_value_formatted;
	public $test_value_formatted;

	public $from_formatted;
	public $to_formatted;
	public $resource_formatted;
	public $action_formatted;
	public $test_formatted;
	public $log_formatted;
	
	protected $_from_language_field;
	protected $_to_language_field;
	protected $_resource_field;
	protected $_action_field;
	protected $_test_field;
	
	protected $folder;
	protected $_files;
	
	protected $_errors;
	
	protected $_csv;
	protected $_log;
	
	protected static $_files_scopes;
	
	public function __construct($_properties) {
		
		parent::__construct($_properties);
		
		$this->_initialize_resource_field($_properties);
		$this->_initialize_language_fields($_properties);
		$this->_initialize_action_field($_properties);
		$this->_initialize_test_field($_properties);

		$this->_files = $_FILES;
		$this->_errors = array();
		$this->_log = array();

		$this->_run();
		
	}

	protected function _run() {
		
		if (!SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isImportingTranslations())
			return;

		if (!$this->_validate())
			return;

		$this->_import();

	}
	
	protected function _import() {
		
		$translations = array();
		
		foreach ($this->_csv as $single)
			$translations[] = array(
				'source' => $single[0],
				'translation' => $single[1],
				'hash' => SurStudioPluginTranslatorRevolutionDropDownCommon::hashText($single[0])
			);

		$resources = array();
		if ($this->_resource_field->value == 'all' || $this->_resource_field->value == 'global') {
			
			$resources[] = 'global';
			
			if ($this->_resource_field->value == 'all') {
				$files_scopes = array_keys($this->_get_files_scopes());
				$files_scopes = array_filter($files_scopes);
				$resources = array_merge(
					$resources,
					$files_scopes
				);
			}
			
		}
		else
			$resources[] = $this->_resource_field->value;

		$this->_log = SurStudioPluginTranslatorRevolutionDropDownTranslateTransport::importTranslations($translations, $resources, $this->_from_language_field->value, $this->_to_language_field->value, $this->_action_field->value, $this->_test_field->value == 'true');
		
	}
	
	protected function _validate() {
	
		if (!$this->_validate_csv_file())
			$this->_errors['csv_file'] = true;

		if (!$this->_validate_from())
			$this->_errors['from'] = true;

		if (!$this->_validate_to())
			$this->_errors['to'] = true;

		if (!$this->_validate_resource())
			$this->_errors['resource'] = true;
			
		if (!$this->_validate_action())
			$this->_errors['action'] = true;
			
		if (!$this->_validate_test())
			$this->_errors['test'] = true;
			
		return empty($this->_errors);
		
	}
	
	protected function _validate_test() {

		if (!array_key_exists($this->test_value_formatted, $this->_test_field->values)) {
			$this->test_value_formatted = $this->validate_test_invalid_message;
			return false;
		}
		
		return true;
		
	}

	protected function _validate_action() {

		if (!array_key_exists($this->action_value_formatted, $this->_action_field->values)) {
			$this->action_value_formatted = $this->validate_action_invalid_message;
			return false;
		}
		
		return true;
		
	}
	
	protected function _validate_resource() {
		
		if (!array_key_exists($this->resource_value_formatted, $this->_resource_field->values)) {
			$this->resource_value_formatted = $this->validate_resource_invalid_message;
			return false;
		}
		
		return true;
		
	}
	
	protected function _validate_from() {

		if (empty($this->from_value_formatted) || !array_key_exists($this->from_value_formatted, $this->_from_language_field->values)) {
			$this->from_value_formatted = $this->validate_language_empty_message;
			return false;
		}
		
		if ($this->_from_language_field->value == $this->_to_language_field->value) {
			$this->from_value_formatted = $this->_from_language_field->values[$this->from_value_formatted];
			return false;
		}
		
		return true;
		
	}
	
	protected function _validate_to() {

		if (empty($this->to_value_formatted) || !array_key_exists($this->to_value_formatted, $this->_to_language_field->values)) {
			$this->to_value_formatted = $this->validate_language_empty_message;
			return false;
		}

		if ($this->_to_language_field->value == $this->_from_language_field->value) {
			$this->to_value_formatted = $this->_to_language_field->values[$this->to_value_formatted];
			return false;
		}
		
		return true;
		
	}
	
	protected function _validate_csv_file() {

		if (empty($this->_files)) {
			$this->csv_file_value_formatted = $this->validate_csv_empty_message;
			return false;
		}
		
		if (!array_key_exists($this->id . '_csv', $this->_files)) {
			$this->csv_file_value_formatted = $this->validate_csv_empty_message;
			return false;
		}
		
		if ($this->_files[$this->id . '_csv']['error'] !== UPLOAD_ERR_OK) {
			
			$error = array(
				'file_upload_error_1' => __('The uploaded file exceeds the upload_max_filesize directive in php.ini', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_2' => __('The uploaded file exceeds the MAX_FILE_SIZE directive', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_3' => __('The uploaded file was only partially uploaded', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_4' => __('No file was uploaded', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_6' => __('Missing a temporary folder', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_7' => __('Failed to write file to disk', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_8' => __('A PHP extension stopped the file upload', SURSTUDIO_TRD_TEXTDOMAIN),
				'file_upload_error_99' => __('An unknown error occurred during the file upload', SURSTUDIO_TRD_TEXTDOMAIN)
			);
			
			$this->csv_file_value_formatted = $error['file_upload_error_' . $this->_files[$this->id . '_csv']['error']];
			return false;
		}
		
		$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($this->_files[$this->id . '_csv']['tmp_name']);
		if ($contents === false) {
			$this->csv_file_value_formatted = __('No file was uploaded', SURSTUDIO_TRD_TEXTDOMAIN);
			return false;			
		}

		$csv = new SurStudioPluginTranslatorRevolutionDropDownParseCSV();
		$csv->parse($contents);
				
		$this->_csv = array();
		foreach ($csv->data as $single)
			if (count($single) == 2)
				$this->_csv[] = $single;
		
		if (empty($this->_csv)) {
			$this->csv_file_value_formatted = $this->validate_csv_invalid_message;
			return false;
		}
		
		$this->csv_file_value_formatted = $this->_files[$this->id . '_csv']['name'];
		
		return true;
		
	}
	
	protected function _initialize_test_field($_properties) {
		
		$field = $_properties;
		$field['title_message'] = $this->test_title_message;
		$field['description_message'] = $this->test_description_message;
		$field['id'] = $field['id'] . '_test';
		$field['values'] = array(
			'false' => $this->test_false,
			'true' => $this->test_true
		);
		$field['value'] = 'false';
		
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($field['id'], 'POST');
		if ($value !== false)
			$this->test_value_formatted = $field['value'] = $value;
		
		$this->_test_field = new SurStudioPluginTranslatorRevolutionDropDownToggleField($field);
		
	}
	
	protected function _initialize_action_field($_properties) {
		
		$field = $_properties;
		$field['title_message'] = $this->action_title_message;
		$field['description_message'] = $this->action_description_message;
		$field['id'] = $field['id'] . '_action';
		$field['values'] = array(
			'add_and_edit' => $this->action_add_and_edit,
			'add' => $this->action_add,
			'edit' => $this->action_edit
		);
		$field['value'] = 'add_and_edit';
		
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($field['id'], 'POST');
		if ($value !== false)
			$this->action_value_formatted = $field['value'] = $value;
		
		$this->_action_field = new SurStudioPluginTranslatorRevolutionDropDownRadioField($field);
		
	}
	
	protected function _initialize_language_fields($_properties) {

		$field = $_properties;
		
		$languages = array_merge(array('' => ''), SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguages());
		$field['values'] = $languages;

		$field['id'] = $field['id'] . '_from';		
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($field['id'], 'POST');
		$this->from_value_formatted = $field['value'] = empty($value) ? '' : $value;
		
		$this->_from_language_field = new SurStudioPluginTranslatorRevolutionDropDownSelectField($field);
		
		$field['id'] = $field['id'] . '_to';
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($field['id'], 'POST');
		$this->to_value_formatted = $field['value'] = empty($value) ? '' : $value;
		
		$this->_to_language_field = new SurStudioPluginTranslatorRevolutionDropDownSelectField($field);
		
	}
	
	protected function _initialize_resource_field($_properties) {

		$field = $_properties;
		$field['title_message'] = $this->resource_title_message;
		$field['description_message'] = $this->resource_description_message;
		$field['id'] = $field['id'] . '_resource';
		$field['values'] = $this->_get_resource_values();
		
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($field['id'], 'POST');
		$this->resource_value_formatted = $field['value'] = empty($value) ? '' : $value;
		
		$this->_resource_field = new SurStudioPluginTranslatorRevolutionDropDownSelectField($field);
		
	}
	
	public static function getFilesPaths($_folder, $_globals=false) {
		
		$contents = @scandir($_folder);
		$result = array();
		
		foreach ($contents as $name) {
			$file = $_folder . '/' . $name;
			if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($name, '.xml') && !SurStudioPluginTranslatorRevolutionDropDownCommon::startsWith($name, 'log_') && @is_file($file) && ($_globals || !SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($name, 'global.xml')))
				$result[] = $file;
		}
		
		return $result;
		
	}
	
	protected function _get_files_scopes() {

		if (!is_null(self::$_files_scopes))
			return self::$_files_scopes;

		$files = self::getFilesPaths($this->folder);
		$result = array();
		
		foreach ($files as $file) {
			
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($file);
			
			if (!$contents)
				continue;

			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			
			if (@!$xml->loadXML($contents))
				continue;
			
			$xpath = new DOMXPath($xml); 
			$scope = $xpath->query("/translations")->item(0)->getAttribute('scope');
			$result[base64_encode($scope)] = $scope;

		}

		asort($result);

		return self::$_files_scopes = $result;
		
	}
	
	protected function _get_resource_values() {
		
		$result = $this->_get_files_scopes();
		
		if (empty($result))
			return array('global' => $this->resource_global_message);
		
		$result = array_merge(
			array('all' => $this->resource_all_message), 
			array('global' => $this->resource_global_message), 
			$this->_get_files_scopes()
		);
		
		return $result;
		
	}
	
	protected function _gen_log_formated($_html_encode=false) {
		
		$result = '
				<tr>
					<th>' . $this->resource_title_message . '</th>
					<th>' . $this->log_added_message . '</th>
					<th>' . $this->log_edited_message . '</th>
					<th>' . $this->log_removed_message . '</th>
					<th>' . $this->log_omitted_message . '</th>
					<th>' . $this->log_created_message . '</th>
				</tr>';
		
		foreach ($this->_log as $key => $value)
			$result .= '
				<tr>
					<td>' . $this->_resource_field->values[$key] . '</td>
					<td>' . $value['added'] . '</td>
					<td>' . $value['edited'] . '</td>
					<td>' . $value['removed'] . '</td>
					<td>' . $value['omitted'] . '</td>
					<td>' . (!empty($value['file_created']) ? $this->log_yes_created_message : $this->log_no_created_message) . '</td>
				</tr>';
		
		$this->log_formatted = $result;
		
	}
	
	protected function _formatted_values($_html_encode=false) {
		
		$this->resource_formatted = $this->_resource_field->output('select.tpl', $_html_encode);
		$this->from_formatted = $this->_from_language_field->output('select_single.tpl', $_html_encode);
		$this->to_formatted = $this->_to_language_field->output('select_single.tpl', $_html_encode);
		$this->action_formatted = $this->_action_field->output('radio.tpl', $_html_encode);
		$this->test_formatted = $this->_test_field->output($_html_encode);

		$this->_gen_log_formated($_html_encode);

		if (!SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isImportingTranslations())
			return;

		if (!array_key_exists('from', $this->_errors))
			$this->from_value_formatted = $this->_from_language_field->values[$this->from_value_formatted];

		if (!array_key_exists('to', $this->_errors))
			$this->to_value_formatted = $this->_to_language_field->values[$this->to_value_formatted];

		if (!array_key_exists('resource', $this->_errors))
			$this->resource_value_formatted = $this->_resource_field->values[$this->resource_value_formatted];

		if (!array_key_exists('action', $this->_errors))
			$this->action_value_formatted = $this->_action_field->values[$this->action_value_formatted];

		if (!array_key_exists('test', $this->_errors))
			$this->test_value_formatted = $this->_test_field->values[$this->test_value_formatted];			

	}
	
	public function output($_template='translations_import.tpl', $_html_encode=false) {

		$this->_formatted_values();

		$result = parent::render(array(
			'type' => 'file',
			'content' => '/admin/' . $_template,
			'meta_tag_rules' => array(
				array(
					'expression' => !empty($this->_resource_field->values),
					'tag' => 'has_resource'
				),
				array(
					'expression' => SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isImportingTranslations(),
					'tag' => 'is_importing'
				),
				array(
					'expression' => array_key_exists('csv_file', $this->_errors),
					'tag' => 'csv_file.error'
				),
				array(
					'expression' => array_key_exists('from', $this->_errors),
					'tag' => 'from.error'
				),
				array(
					'expression' => array_key_exists('to', $this->_errors),
					'tag' => 'to.error'
				),
				array(
					'expression' => array_key_exists('resource', $this->_errors),
					'tag' => 'resource.error'
				),
				array(
					'expression' => array_key_exists('action', $this->_errors),
					'tag' => 'action.error'
				),
				array(
					'expression' => array_key_exists('test', $this->_errors),
					'tag' => 'test.error'
				),
				array(
					'expression' => !empty($this->_errors),
					'tag' => 'has_errors'
				),
				array(
					'expression' => $this->_test_field->value == 'true',
					'tag' => 'is_test'
				)
			)
		), $_html_encode);

		return $result;

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownItemCollection {

    protected $_position = 0;

    public $collection;

    public function __construct() {

		$this->_position = 0;

	}

    public function add($_object, $_index=null) {

		if (is_null($_index))
			$this->collection[] = $_object;
		else
			$this->collection[$_index] = $_object;

	}

    public function rewind() {

        $this->_position = 0;

    }

    public function current() {

		$keys = array_keys($this->collection);
        return $this->collection[$keys[$this->_position]];

	}

    public function getFirst() {

		$keys = array_keys($this->collection);
        return $this->collection[$keys[0]];

	}

    public function getLast() {

		$keys = array_keys($this->collection);
        return $this->collection[$keys[count($keys)-1]];

	}

    public function key() {

		return $this->_position;

    }

    public function next() {

        ++$this->_position;

	}

    public function count() {

		return count($this->collection);

	}

    public function valid() {

		$keys = array_keys($this->collection);

		if (!isset($keys[$this->_position]))
			return false;

		return isset($this->collection[$keys[$this->_position]]);

	}

	protected function _add_count_for_render() {

		if (count($this->collection) > 0) {
			$i = 0;
			foreach ($this->collection as $item) {
				$item->collection_item_index = $i;
				$i++;
			}
		}

	}

	public function render($_options, $_html_encode=false) {

		$result = '';
		$partial = array();

		$this->_add_count_for_render();

		if (count($this->collection) > 0) 
			foreach ($this->collection as $item)
				$partial[] = $item->output($_html_encode);

		$object = (object) array(
			'collection' => join("\n", $partial),
			'collection_count' => count($partial)
		);

		foreach ($this as $property => $value)
			if (!is_array($value))
				$object->{$property} = $value;				

		if (!array_key_exists('meta_tag_rules', $_options))
			$_options['meta_tag_rules'] = array();

		$_options['meta_tag_rules'][] = array(
			'expression' => count($partial) == 0,
			'tag' => 'collection.is_empty'
		);

		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject($object, $_options, $_html_encode);

		return $result;

	}

}

class SurStudioPluginTranslatorRevolutionDropDown {

	protected static $_available;

	public static function initialize() {

		add_action('widgets_init', array('SurStudioPluginTranslatorRevolutionDropDown', '_initialize_widget'));
		add_action('wp_head', array('SurStudioPluginTranslatorRevolutionDropDown', '_header'));

		add_action('init', array('SurStudioPluginTranslatorRevolutionDropDown', '_get_token'), 11);
		add_action('init', array('SurStudioPluginTranslatorRevolutionDropDown', '_translate'), 11);

	}

	public static function _header() {
	
		$custom_css = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('custom_css');
		SurStudioPluginTranslatorRevolutionDropDownCommon::renderCSS($custom_css);
		
	}

	public static function _initialize_widget() {

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('location_widget') == 'true')
			register_widget('SurStudioTranslatorRevolutionDropDownUI');
		else {
			add_action('wp_head', array('SurStudioPluginTranslatorRevolutionDropDown', '_initialize_head'));
			add_action('wp_footer', array('SurStudioPluginTranslatorRevolutionDropDown', '_initialize_footer'), 100);
		}
		
	}

	public static function _initialize_head() {
		
		if (!self::isAvailable())
			return;
		
		SurStudioPluginTranslatorRevolutionDropDownCommon::loadStyle('jquery.translator', SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion());
		
	}
	
	public static function _initialize_footer() {

		if (!self::isAvailable())
			return;

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('jquery_auto_load'))
			SurStudioPluginTranslatorRevolutionDropDownCommon::loadjQuery(SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('jquery_url'));

		self::_initialize();

	}

	public static function _translate() {

		if (!self::_is_ajax_call('surstudio_plugin_translator_revolution_dropdown_translate'))
			return;

		require_once SURSTUDIO_TRD_PROCEDURES . '/translate.class.php';
		exit;
		
	}
	
	protected static function _is_ajax_call($_action) {

		if (!isset($_SERVER['REQUEST_METHOD']))
			return false;

		$action = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('action');

		if (empty($action))
			return false;

		return $action == $_action;

	}
	
	public static function _get_token() {

		if (!self::_is_ajax_call('surstudio_plugin_translator_revolution_dropdown_get_token'))
			return;
	
		require_once SURSTUDIO_TRD_PROCEDURES . '/token.class.php';
		exit;
		
	}
	
	protected static function _is_cache_writable() {
		
		$flag = SurStudioPluginTranslatorRevolutionDropDownConfig::getCacheFlag();
		
		if ($flag)
			return true;
		
		$folder = SurStudioPluginTranslatorRevolutionDropDownCommon::isFolderWritable(SURSTUDIO_TRD_CACHE);

		if ($folder !== true)
			return false;
			
		$files = SurStudioPluginTranslatorRevolutionDropDownCommon::areFolderFilesWritable(SURSTUDIO_TRD_CACHE);
		
		if ($files !== true)
			return false;
		
		SurStudioPluginTranslatorRevolutionDropDownConfig::setCacheFlag(true);
		
		return true;
		
	}
	
	protected static function _api_key_validate() {
		
		$value = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('api_key');
		
		if (empty($value))
			return false;
			
		if (strlen($value) != 56 && strlen($value) != 36)
			return false;
		
		return true;
		
	}
	
	protected static function _client_secret_microsoft_validate() {

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('translation_service') != 'ma')
			return true;
		
		$value = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('microsoft_client_secret');
		
		return !empty($value);
				
	}
	
	protected static function _client_id_microsoft_validate() {

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('translation_service') != 'ma')
			return true;
		
		$value = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('microsoft_client_id');
		
		return !empty($value);
		
	}
	
	protected static function _api_key_google_validate() {
		
		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('translation_service') != 'gt')
			return true;
		
		if (!SurStudioPluginTranslatorRevolutionDropDownCommon::isOpenSSLInstalled())
			return false;
		
		$value = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('google_api_key');
		
		return !empty($value);
		
	}

	protected static function _is_se_bot() {
		
		$user_agent = SurStudioPluginTranslatorRevolutionDropDownCommon::getUserAgent();
		
		return preg_match('/bot|crawl|slurp|spider/i', $user_agent);
		
	}
	
	public static function isAvailable($_admin=true) {

		if (self::_is_se_bot())
			return false;

		if (defined('WP_ADMIN') && $_admin)
			return false;

		if (!SurStudioPluginTranslatorRevolutionDropDownCommon::isMcryptInstalled())
			return false;

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('test_mode') == 'true' && !current_user_can('administrator'))
			return false;

		if (!self::_api_key_validate() || !self::_api_key_google_validate() || !self::_client_id_microsoft_validate() || !self::_client_secret_microsoft_validate())
			return false;

		if (!self::_is_cache_writable())
			return false;

		global $post; //wordpress post global object
		
		if (!is_object($post))
			return true;
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingsValues();
		
		if ($post->post_type == 'page' && array_key_exists('exclude_pages', $settings)) {
		
			$pages = $settings['exclude_pages']['value'];
		
			if (in_array($post->ID, $pages))
				return false;
		
		}

		if ($post->post_type == 'post' && array_key_exists('exclude_posts', $settings)) {
		
			$posts = $settings['exclude_posts']['value'];
		
			if (in_array($post->ID, $posts))
				return false;
		
		}
		
		if ($post->post_type == 'post' && array_key_exists('exclude_categories', $settings)) {
		
			$categories = $settings['exclude_categories']['value'];
		
			$post_categories = wp_get_post_categories($post->ID);

			if (SurStudioPluginTranslatorRevolutionDropDownCommon::inArray($categories, $post_categories))
				return false;
		
		}
		
		return true;
		
	}
	
	protected static function _initialize() {
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingsValues();

		$translator = new SurStudioTranslatorRevolutionDropDown((object) $settings);

		$on_before_load = $translator->getProperty('on_before_load');

		echo $translator->render(array(
			'type' => 'file',
			'content' => '/main.tpl',
			'meta_tag_rules' => array(
				array(
					'expression' => empty($on_before_load),
					'tag' => 'on_before_load.empty'
				)
			)
		));
		
	}

}

class SurStudioTranslatorRevolutionDropDownUI extends WP_Widget {
	
	public function __construct() {
		
		parent::__construct(SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(true), SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(), array(
			'classname' => SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('widget_class'), 
			'description' => __('Translator Revolution DropDown', SURSTUDIO_TRD_TEXTDOMAIN)
		));

		if (!SurStudioPluginTranslatorRevolutionDropDown::isAvailable(false))
			return;
		
		if (is_active_widget(false, false, SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(true))) {
		
			add_action('wp_head', array('SurStudioPluginTranslatorRevolutionDropDown', '_initialize_head'));
			add_action('wp_footer', array('SurStudioPluginTranslatorRevolutionDropDown', '_initialize_footer'), 100);
		
		}
		
	}
 
	public function form($_instance) {
    
		echo '<div class="surstudio_plugin_translator_revolution_dropdown_sample_language"></div>';
		echo sprintf(__('Ajust settings <a href="%s">here</a>', SURSTUDIO_TRD_TEXTDOMAIN), SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminPluginUrl());

		return 'noform';

	}

	public function widget($_arguments, $_instance) {

		if (!SurStudioPluginTranslatorRevolutionDropDown::isAvailable(false))
			return;

		extract($_arguments, EXTR_SKIP);
 
		echo $before_widget;

		echo '<div id="' . SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('dropdown_container_id') . '"></div>';
		
		echo $after_widget;
	
	}

}

class SurStudioTranslatorRevolutionDropDown extends SurStudioPluginTranslatorRevolutionDropDownItem {
	
	public $options_formatted;
	public $url_library;
	public $on_before_load;
	
	public function __construct($_properties) {

		$this->_properties = $_properties;
		$this->_gen_options();

	}
	
	public function _prepare_option_value($_id, $_value) {
		
		$value = $_value;
				
		if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($_id, '_template'))
			$value = SurStudioPluginTranslatorRevolutionDropDownCommon::stripBreakLinesAndTabs($value);

		if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($_id, '_selector'))
			$value = trim($value);

		if (SurStudioPluginTranslatorRevolutionDropDownValidator::isBool($value))
			$value = $value == 'true' || $value === true;
			
		if (in_array($_id, array('on_before_initialize', 'on_initialize', 'on_start', 'on_complete', 'override', 'custom_languages_names', 'native_languages')))
			return $value;

		return json_encode($value);
		
	}
	
	public function render($_options, $_html_encode=false) {
		
		$result = parent::render($_options, $_html_encode);
		return SurStudioPluginTranslatorRevolutionDropDownCommon::stripBreakLinesAndTabs($result);
		
	}
	
	protected function _gen_options() {

		$result = array();
		
		foreach ($this->_properties as $key => $property)
			if (array_key_exists('option_id', $property) && !SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($property['option_id']))
				$result[$key] = array(
					'option_id' => $property['option_id'],
					'value' => $this->_prepare_option_value($key, $property['value'])
				);

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('location_widget') == 'true') {
			$result['dropdown_container_id'] = array(
				'option_id' => 'dropdownContainerId',
				'value' => $this->_prepare_option_value('dropdown_container_id', SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('dropdown_container_id'))
			);			
		}
		else if (array_key_exists('dropdown_container_id', $result))
			unset($result['dropdown_container_id']);	

		$result['flags_folder'] = array(
			'option_id' => 'flagsFolder',
			'value' => json_encode(SURSTUDIO_TRD_IMAGES . '/')
		);

		if (SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('native_languages'))
			$result['native_languages'] = array(
				'option_id' => 'nativeLanguagesNames',
				'value' => json_encode(SurStudioPluginTranslatorRevolutionDropDownCommon::getNativeLanguages(SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('languages')))
			);

		if (array_key_exists('location_custom', $result) && !array_key_exists('location_widget', $this->_properties))
			unset($result['location_custom']);		

		$this->url_library = SurStudioPluginTranslatorRevolutionDropDownCommon::getScriptUrl('jquery.translator.min', SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion());
		$this->on_before_load = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('on_before_load');

		$this->options_formatted = SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject($result, array(
			'type' => 'html',
			'content' => "\t{{ option_id }}: {{ value }},\n"
		));

	}
	
}

SurStudioPluginTranslatorRevolutionDropDown::initialize();

class SurStudioPluginTranslatorRevolutionDropDownAdmin {

	public static function initialize() {

		if (!is_admin())
			return;

		add_action('admin_init', array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_initialize'));
		add_action('admin_head', array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_remove_messages'));
		add_action('plugins_loaded', array('SurStudioPluginTranslatorRevolutionDropDownAdmin', 'initializeMenus'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_get_languages_per_resource', array('SurStudioPluginTranslatorRevolutionDropDownAdminTranslations', '_get_languages_per_resource'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_get_languages_per_resource', array('SurStudioPluginTranslatorRevolutionDropDownAdminTranslations', '_get_languages_per_resource'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_get_cached_translations', array('SurStudioPluginTranslatorRevolutionDropDownAdminTranslations', '_get_cached_translations'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_get_cached_translations', array('SurStudioPluginTranslatorRevolutionDropDownAdminTranslations', '_get_cached_translations'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_save_cached_translations', array('SurStudioPluginTranslatorRevolutionDropDownAdminTranslations', '_save_cached_translations'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_save_cached_translations', array('SurStudioPluginTranslatorRevolutionDropDownAdminTranslations', '_save_cached_translations'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_check_version', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_check_version'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_check_version', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_check_version'));		

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_update', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_update'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_update', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_update'));		

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_backup', array('SurStudioPluginTranslatorRevolutionDropDownAdminBackup', '_run'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_backup', array('SurStudioPluginTranslatorRevolutionDropDownAdminBackup', '_run'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_list_backups', array('SurStudioPluginTranslatorRevolutionDropDownAdminBackup', '_list'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_list_backups', array('SurStudioPluginTranslatorRevolutionDropDownAdminBackup', '_list'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_restore_backup', array('SurStudioPluginTranslatorRevolutionDropDownAdminBackup', '_restore'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_restore_backup', array('SurStudioPluginTranslatorRevolutionDropDownAdminBackup', '_restore'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_register', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_register'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_register', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_register'));
		
		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_verify', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_verify'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_verify', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_verify'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_register_subscribe', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_register_subscribe'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_register_subscribe', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_register_subscribe'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_subscribe', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_subscribe'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_subscribe', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_subscribe'));

		add_action('wp_ajax_nopriv_surstudio_plugin_translator_revolution_dropdown_unsubscribe', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_unsubscribe'));
		add_action('wp_ajax_surstudio_plugin_translator_revolution_dropdown_unsubscribe', array('SurStudioPluginTranslatorRevolutionDropDownAdminWelcome', '_unsubscribe'));
		
	}
	
	public static function _initialize() {

		self::_watch_events();

		self::_select_language();
		
		self::_load_styles();
		self::_load_scripts();
		
	}
	
	protected static function _watch_events() {

		if (SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isExportingTranslations()) {
			self::_export_translations();
			die();
		}

		if (SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isSavingSettings())
			self::_save_settings();

		if (SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isResetingSettings())
			self::_reset_settings();

	}
	
	protected static function _save_settings() {

		SurStudioPluginTranslatorRevolutionDropDownAdminForm::save();
		
	}
	
	protected static function _reset_settings() {
		
		SurStudioPluginTranslatorRevolutionDropDownAdminForm::reset();
		
	}

	protected static function _export_translations() {
		
		SurStudioPluginTranslatorRevolutionDropDownTransexportField::run();
		
	}
	
	protected static function _load_scripts() {

		if (SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isLoadingAdminPage()) {
			wp_enqueue_script('surstudio-plugin-translator-revolution-dropdown-admin-common', SURSTUDIO_TRD_JS .'/common.class.js', 'jquery-ui-core', SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion());
			wp_enqueue_script('surstudio-plugin-translator-revolution-dropdown-admin', SURSTUDIO_TRD_JS .'/admin.class.js', 'jquery-ui-core', SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion());
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('jquery-ui-tooltip', false, array(), false, true);
		}			

	}
	
	public static function _remove_messages() {
	
		if (SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isLoadingAdminPage() || strpos(SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminWidgetsUrl(), $_SERVER['REQUEST_URI']) !== false)	
			SurStudioPluginTranslatorRevolutionDropDownCommon::renderCSS('.update-nag,div.updated,div.error,.notice{display:none !important;}');
		
	}
	
	protected static function _load_styles() {

		if (SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isLoadingAdminPage() || strpos(SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminWidgetsUrl(), $_SERVER['REQUEST_URI']) !== false) {
			wp_enqueue_style('surstudio-plugin-translator-revolution-dropdown-admin', SURSTUDIO_TRD_CSS .'/admin.css', false, SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion(), 'screen');
			wp_enqueue_style('thickbox');
		}

	}
	
	public static function initializeMenus() {

		add_action('admin_menu', array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_add_options_page'));

	}

	public static function _add_options_page() {

		$verify = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('verify', true);
		
		$is_verified = !empty($verify['email']) && !empty($verify['item_purchase_code']) && !empty($verify['verification_code']) && !empty($verify['support_pin']);

		$main_handle = $is_verified ? SurStudioPluginTranslatorRevolutionDropDownConfig::getAdminHandle() : SurStudioPluginTranslatorRevolutionDropDownConfig::getWelcomeHandle();
		$main_render = $is_verified ? '_render_main_form' : '_render_welcome';
		
		add_menu_page(SurStudioPluginTranslatorRevolutionDropDownConfig::getName(false, true), SurStudioPluginTranslatorRevolutionDropDownConfig::getName(false, true), 'manage_options', $main_handle, array('SurStudioPluginTranslatorRevolutionDropDownAdmin', $main_render), 'dashicons-translation');
		
		if ($is_verified) {
			add_submenu_page($main_handle, SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(), SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingsName(false, true), 'manage_options', SurStudioPluginTranslatorRevolutionDropDownConfig::getAdminHandle(), array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_render_main_form'));
			add_submenu_page($main_handle, SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(), SurStudioPluginTranslatorRevolutionDropDownConfig::getWelcomeName(false, true), 'manage_options', SurStudioPluginTranslatorRevolutionDropDownConfig::getWelcomeHandle(), array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_render_welcome'));
		}
		else {
			add_submenu_page($main_handle, SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(), SurStudioPluginTranslatorRevolutionDropDownConfig::getWelcomeName(false, true), 'manage_options', SurStudioPluginTranslatorRevolutionDropDownConfig::getWelcomeHandle(), array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_render_welcome'));
			add_submenu_page($main_handle, SurStudioPluginTranslatorRevolutionDropDownConfig::getWidgetName(), SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingsName(false, true), 'manage_options', SurStudioPluginTranslatorRevolutionDropDownConfig::getAdminHandle(), array('SurStudioPluginTranslatorRevolutionDropDownAdmin', '_render_main_form'));
		}
		
	}
	
	protected static function _gen_meta_tag_rules_for_tabs() {
		
		$tabs = array(
			array('general', 'advanced', 'translations', 'backup', 'support'),
			array('advanced_general', 'advanced_import_export'),
			array('translations_general', 'translations_import', 'translations_export')
		);

		$current_tabs = array(
			SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_tab', 'POST'),
			SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_tab_2', 'POST'),
			SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_tab_3', 'POST')
		);

		$result = self::_gen_meta_tag_rules_for_tabs_aux($tabs, $current_tabs);

		return $result;
		
	}
	
	protected static function _gen_meta_tag_rules_for_tabs_aux($_tabs, $_currents, $_level=0) {
		
		$result = array();

		if (!is_array($_tabs[0])) {

			$current = $_currents[$_level];

			if (SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($current))
				$current = $_tabs[0];

			for ($i=0; $i<count($_tabs); $i++)
				$result[] = array(
					'expression' => $_tabs[$i] == $current,
					'tag' => $_tabs[$i] . '.show'
				);

		}
		else 
			for ($j=0; $j<count($_tabs); $j++) 
				$result = array_merge($result, self::_gen_meta_tag_rules_for_tabs_aux($_tabs[$j], $_currents, $j));

		$result[] = array(
			'expression' => SurStudioPluginTranslatorRevolutionDropDownConfig::isSupportTabEnabled(),
			'tag' => 'support.enabled'
		);

		return $result;		
		
	}
	
	public static function _render_welcome() {
		
		$form = new SurStudioPluginTranslatorRevolutionDropDownWelcome();

		echo $form->render(array(
			'type' => 'file',
			'content' => '/admin/welcome_form.tpl'
		));
		
	}
	
	public static function _render_main_form() {

		$form = new SurStudioPluginTranslatorRevolutionDropDownAdminForm();

		echo $form->render(array(
			'type' => 'file',
			'content' => '/admin/main_form.tpl',
			'meta_tag_rules' => self::_gen_meta_tag_rules_for_tabs()
		));
	
	}

	protected static function _select_language() {

		load_plugin_textdomain(SurStudioPluginTranslatorRevolutionDropDownConfig::getAdminLanguageDomain(), false, dirname(plugin_basename(__FILE__)) . '/../languages');

	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownAdminBackup {
	
	protected static function _commit($_name, $_result) {

		if (!get_option($_name))
			add_option($_name, $_result);
		else
			update_option($_name, $_result);
		
		if (!get_option($_name)) {
			delete_option($_name);
			add_option($_name, $_result);
		}
		
	}
	
	public static function checkVerified() {
		
		return self::_check_verified();
		
	}
	
	protected static function _check_verified() {
	
		if (SurStudioPluginTranslatorRevolutionDropDownConfig::isVerified())
			return;
	
		$result = array(
			'success' => false,
			'validate' => array(
				array(
					'field' => 'generic',
					'message' => __('The extended features aren\'t enabled on this server.', SURSTUDIO_TRD_TEXTDOMAIN)
				)
			)
		);

		echo json_encode($result);
		exit;
		
	}
	
	protected static function _get_translations() {

		$files = SurStudioPluginTranslatorRevolutionDropDownTranslationsField::getFilesPaths(SURSTUDIO_TRD_CACHE, true);
		$result = array();
		
		$result = new DOMDocument('1.0', 'utf-8');
		$data = $result->createElement('data');

		foreach ($files as $file) {
			
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($file);
			
			if (!$contents)
				continue;

			$xml = new DOMDocument('1.0', 'utf-8');
			
			if (@!$xml->loadXML($contents))
				continue;

			$translations = $xml->documentElement;
			
			$node = $result->importNode($translations, true);
			
			$data->appendChild($node);

		}

		$result->appendChild($data);

		$result->formatOutput = true;
		return $result->saveXML();
		
	}
	
	public static function _get_backup_data($_type) {
		
		$result = array();
		
		if ($_type == 'all' || $_type == 'settings') {
			$result['settings'] = array();
			$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::_get_settings();
			foreach ($settings as $key => $setting)
				$result['settings'][$key] = $setting['value'];
		}
		
		if ($_type == 'all' || $_type == 'translations')
			$result['translations'] = self::_get_translations();
			
		return base64_encode(serialize($result));
			
	}
	
	protected static function _get_unique_new_path($_path) {
		
		$result = self::_get_new_path($_path);
		
		if (is_file($result))
			return self::_get_unique_new_path($result);
		
		return $result;
		
	}
	
	protected static function _get_new_path($_path) {
		
		$ext = '.backup';
		
		if (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($_path, $ext)) {
			
			preg_match('/\.(\d{1,})\\' . $ext . '$/', $_path, $matches);
			
			if (count($matches) == 0)
				$result = str_replace($ext, '.1' . $ext, $_path);
			else
				$result = preg_replace('/\.\d{1,}\\' . $ext . '$/', '.' . ((int) $matches[1] + 1) . $ext, $_path);
			
		}
		else
			$result = $_path . $ext;
		
		return $result;
		
	}
	
	protected static function _restore_translations($_translations) {
		
		$xml = new DOMDocument('1.0', 'utf-8');
		$parse = @$xml->loadXML($_translations);

		$result = array();
		$translations = $xml->documentElement->getElementsByTagName('translations');
		
		foreach ($translations as $translation) {
			
			$file = $translation->getAttribute('from') . '_' . $translation->getAttribute('to') . '_' . $translation->getAttribute('domain') . '.xml';
			
			if (is_file(SURSTUDIO_TRD_CACHE . '/' . $file)) {
				$backup = self::_get_unique_new_path(SURSTUDIO_TRD_CACHE . '/' . $file . '.backup');
				@rename(SURSTUDIO_TRD_CACHE . '/' . $file, $backup);
			}
			
			self::_create_xml_file($translation, $file);
			$result[] = $file;

		}
		
		return $result;
		
	}
	
	protected static function _create_xml_file($_xml, $_file) {
	
		if (is_file(SURSTUDIO_TRD_CACHE . '/' . $_file))
			return;
	
		$result = new DOMDocument('1.0', 'utf-8');

		$result->formatOutput = true;
		
		$node = $result->importNode($_xml, true);
		
		$result->appendChild($node);
		
		@$result->save(SURSTUDIO_TRD_CACHE . '/' . $_file);
		
	}
	
	protected static function _restore_settings($_settings) {
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getDefaults();
		
		$result = array();

		foreach ($settings as $key => $setting) {
			
			if (in_array($key, array('import', 'export')))
				continue;
			
			if (array_key_exists($key, $_settings))
				$result[$key]['value'] = $_settings[$key];

		}

		self::_commit(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName(), $result);		
		
	}
	
	public static function _restore() {
		
		self::_check_verified();
		
		$verify = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('verify');
		$item_purchase_code = $verify['item_purchase_code'];
		$email = $verify['email'];
		$verification_code = $verify['verification_code'];
		$backup_id = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_backup_id'));
		
		$url = "http://envato.surstudio.net/restore/$item_purchase_code/$email/$verification_code/$backup_id";

		$response = wp_remote_get($url, array(
			'timeout' => 60
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if (property_exists($result, 'data')) {

					$content = @base64_decode($result->data);

					if (!empty($content)) { 

						$data = @unserialize($content);

						if (!empty($data) && is_array($data)) { 

							if (array_key_exists('settings', $data))
								self::_restore_settings($data['settings']);

							if (array_key_exists('translations', $data))
								self::_restore_translations($data['translations']);
							
							$result = array(
								'success' => true
							);
							
							echo json_encode($result);
							exit;

						}
					}
				}
			}
			
		}
		
		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response, 'id', $backup_id);

		echo json_encode($result);
		exit;
		
	}
	
	public static function _list() {
		
		self::_check_verified();
		
		$verify = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('verify');
		$item_purchase_code = $verify['item_purchase_code'];
		$email = $verify['email'];
		$verification_code = $verify['verification_code'];
		
		$url = "http://envato.surstudio.net/backups/$item_purchase_code/$email/$verification_code";

		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if (property_exists($result, 'headers'))
					foreach ($result->headers as $key => $value)
						$result->headers->{$key} = __($value, SURSTUDIO_TRD_TEXTDOMAIN);

				if (property_exists($result, 'data') && is_array($result->data)) {
					
					$types = array(
						'all' => __('Settings &amp; Translations', SURSTUDIO_TRD_TEXTDOMAIN),
						'settings' => __('Settings', SURSTUDIO_TRD_TEXTDOMAIN),
						'translations' => __('Translations', SURSTUDIO_TRD_TEXTDOMAIN)
					);
					
					foreach ($result->data as $key => $value)
						foreach ($value as $property => $property_value)
							if ($property == 'type')
								$result->data[$key]->{$property} = $types[$property_value];
							else if ($property == 'date_ago') {
								$date = $result->data[$key]->{$property};
								$result->data[$key]->{$property} = sprintf(__('about %s %s ago', SURSTUDIO_TRD_TEXTDOMAIN), $date[0], __(((int) $date[0] > 1 ? $date[1] . 's' : $date[1]), SURSTUDIO_TRD_TEXTDOMAIN));
							}

				}
				else if (property_exists($result, 'item_purchase_code')) {
					$result->message = sprintf(__('There are no stored backups associated with the %s license.', SURSTUDIO_TRD_TEXTDOMAIN), $result->item_purchase_code);
					unset($result->item_purchase_code);
				}
				
				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
	public static function _run() {

		self::_check_verified();

		$verify = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('verify');
		$item_purchase_code = $verify['item_purchase_code'];
		$email = $verify['email'];
		$verification_code = $verify['verification_code'];
		
		$type = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_type'));
		$site_url = get_bloginfo('url');

		$url = "http://envato.surstudio.net/backup/$item_purchase_code/$email/$verification_code";

		$body = array(
			'content' => self::_get_backup_data($type),
			'site_url' => $site_url,
			'type' => $type
		);
		
		$response = wp_remote_post($url, array(
			'timeout' => 300,
			'body' => $body
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if (property_exists($result, 'list')) {
					
					if (property_exists($result->list, 'headers'))
						foreach ($result->list->headers as $key => $value)
							$result->list->headers->{$key} = __($value, SURSTUDIO_TRD_TEXTDOMAIN);

					if (property_exists($result->list, 'data') && is_array($result->list->data)) {
						
						$types = array(
							'all' => __('Settings &amp; Translations', SURSTUDIO_TRD_TEXTDOMAIN),
							'settings' => __('Settings', SURSTUDIO_TRD_TEXTDOMAIN),
							'translations' => __('Translations', SURSTUDIO_TRD_TEXTDOMAIN)
						);
						
						foreach ($result->list->data as $key => $value)
							foreach ($value as $property => $property_value)
								if ($property == 'type')
									$result->list->data[$key]->{$property} = $types[$property_value];
								else if ($property == 'date_ago') {
									$date = $result->list->data[$key]->{$property};
									$result->list->data[$key]->{$property} = sprintf(__('about %s %s ago', SURSTUDIO_TR_TEXTDOMAIN), $date[0], __(((int) $date[0] > 1 ? $date[1] . 's' : $date[1]), SURSTUDIO_TR_TEXTDOMAIN));
								}

					}

				}

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownAdminWelcome {

	protected static function _commit($_name, $_result) {

		if (!get_option($_name))
			add_option($_name, $_result);
		else
			update_option($_name, $_result);
		
		if (!get_option($_name)) {
			delete_option($_name);
			add_option($_name, $_result);
		}
		
	}

	protected static function _save($_setting) {
	
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::_get_main_settings();
		
		$settings[$_setting['id']]['value'] = $_setting['value'];
		
		self::_commit(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbMainName(), $settings);
		
	}

	protected static function _save_subscribed($_email, $_verification_code) {
		
		$setting = array(
			'id' => 'newsletter',
			'value' => array(
				'email' => $_email,
				'verification_code' => $_verification_code
			)
		);
		
		self::_save($setting);
		
	}
	
	public static function resetVerified() {

		self::_save_verified('','','','');
		
	}
	
	protected static function _save_verified($_item_purchase_code, $_email, $_verification_code, $_pin) {

		$setting = array(
			'id' => 'verify',
			'value' => array(
				'email' => $_email,
				'item_purchase_code' => $_item_purchase_code,
				'verification_code' => $_verification_code,
				'support_pin' => $_pin
			)
		);
		
		self::_save($setting);
		SurStudioPluginTranslatorRevolutionDropDownAdminForm::saveAPIKey($_item_purchase_code);

	}
	
	protected static function _save_checked_version($_version) {

		$setting = array(
			'id' => 'version',
			'value' => $_version
		);
		
		self::_save($setting);
		
	}
	
	public static function _verify() {

		$item_purchase_code = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_item_purchase_code'));
		$email = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_email'));
		$verification_code = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_verification_code'));

		$url = "http://envato.surstudio.net/verify/$item_purchase_code/$email/$verification_code";
		
		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if ($result->success)
					self::_save_verified($item_purchase_code, $email, $verification_code, $result->pin);

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
	public static function _unsubscribe() {
		
		$newsletter = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('newsletter', true);
		
		$email = array_key_exists('email', $newsletter) ? $newsletter['email'] : false;
		$verification_code = array_key_exists('verification_code', $newsletter) ? $newsletter['verification_code'] : false;

		$url = "http://envato.surstudio.net/unsubscribe/$email/$verification_code";
		
		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if ($result->success)
					self::_save_subscribed('', '');

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
	public static function _subscribe() {
		
		$email = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_email'));
		$verification_code = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_verification_code'));

		$url = "http://envato.surstudio.net/subscribe/$email/$verification_code";
		
		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if ($result->success)
					self::_save_subscribed($email, $verification_code);

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
	public static function _register_subscribe() {
		
		$email = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_email'));

		$url = "http://envato.surstudio.net/subscribe/$email";
		
		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}

	public static function _register() {

		$item_purchase_code = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_item_purchase_code'));
		$email = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_email'));

		$url = "http://envato.surstudio.net/verify/$item_purchase_code/$email";
		
		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
	protected static function _verify_manifest($_manifest) {
	
		$base = SURSTUDIO_TRD_PROCEDURES . '/../';
	
		foreach ($_manifest as $file) {

			$path = $base . $file;
			
			if (is_file($path)) {
				if (!is_writable($path))
					return array(
						'type' => 'file',
						'value' => $path
					);
			}
			else {
				if (!is_writable(dirname($path)))
					return array(
						'type' => 'dir',
						'value' => dirname($path)
					);
			}
			
		}
		
		return true;
		
	}
	
	protected static function _update_plugin($_zip_data, $_version) {
		
		if (!current_user_can('update_plugins'))
			return array(
				'success' => false,
				'validate' => array(
					array(
						'field' => 'generic',
						'message' => __('You do not have sufficient permissions to update plugins for this site.')
					)
				),
				'version' => SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion()
			);

		global $wp_filesystem;

		if (empty($wp_filesystem)) {
			require_once (ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}

		$package = 'wp-translator-revolution-dropdown';
		$destination = SURSTUDIO_TRD_PROCEDURES . '/../';

		$upgrade_folder = $wp_filesystem->wp_content_dir() . 'upgrade/';		
		$working_dir = $upgrade_folder . $package;
		$tmp_file = $working_dir . '.zip';

		if ($wp_filesystem->is_file($tmp_file))
			$wp_filesystem->delete($tmp_file);

		if ($wp_filesystem->is_dir($working_dir))
			$wp_filesystem->delete($working_dir, true);

		$wp_filesystem->put_contents($tmp_file, $_zip_data);

		$result = unzip_file($tmp_file, $working_dir);

		if (is_wp_error($result)) {

			if ($wp_filesystem->is_file($tmp_file))
				$wp_filesystem->delete($tmp_file);

			if ($wp_filesystem->is_dir($working_dir))
				$wp_filesystem->delete($working_dir, true);

			return array(
				'success' => false,
				'validate' => array(
					array(
						'field' => 'generic',
						'message' => __('Incompatible zip file. Please contact support.')
					)
				),
				'version' => SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion()
			);
		}

		$result = copy_dir($working_dir, $destination);

		if ($wp_filesystem->is_file($tmp_file))
			$wp_filesystem->delete($tmp_file);

		if ($wp_filesystem->is_dir($working_dir))
			$wp_filesystem->delete($working_dir, true);

		if (is_wp_error($result))
			return array(
				'success' => false,
				'validate' => array(
					array(
						'field' => 'generic',
						'message' => __('Error copying files. Please contact support.')
					)
				),
				'version' => SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion()
			);
		
		return array(
			'success' => true,
			'version' => $_version
		);

	}
	
	public static function crc($_data) {
		
		$verify = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('verify');
		$item_purchase_code = $verify['item_purchase_code'];
		$email = $verify['email'];
		$verification_code = $verify['verification_code'];
		$item_id = '3400269';
		
		return md5($item_id . $email . md5($item_purchase_code . $_data . $verification_code));
		
	}
	
	public static function _update() {
		
		SurStudioPluginTranslatorRevolutionDropDownAdminBackup::checkVerified();
		
		$verify = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettingValue('verify');
		$item_purchase_code = $verify['item_purchase_code'];
		$email = $verify['email'];
		$verification_code = $verify['verification_code'];
		
		$url = "http://envato.surstudio.net/update/$item_purchase_code/$email/$verification_code";

		if (defined('SURSTUDIO_TRD_COMPATIBILITY') && SURSTUDIO_TRD_COMPATIBILITY === true)
			$url .= '/compatibility';

		$response = wp_remote_get($url, array(
			'timeout' => 60
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);

			if (!is_null($result)) {

				if ($result->success && property_exists($result, 'data') && property_exists($result, 'manifest')) {

					$file = self::_verify_manifest($result->manifest);

					if ($file === true) {

						$crc = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::crc($result->data);

						if ($result->crc == $crc) {

							$content = @base64_decode($result->data);

							unset($result->data);
							unset($result->manifest);

							if (!empty($content)) 
								$result = self::_update_plugin($content, $result->version);
							else
								$result = array(
									'success' => false,
									'validate' => array(
										array(
											'field' => 'generic',
											'message' => __('Unsual server error. No plugin data found. Please try again in 5 minutes.', SURSTUDIO_TRD_TEXTDOMAIN)
										)
									),
									'version' => SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion()
								);
						}
						else
							$result = array(
								'success' => false,
								'validate' => array(
									array(
										'field' => 'generic',
										'message' => __('Unsual server error. CRC doesn\'t match. Please try again in 5 minutes.', SURSTUDIO_TRD_TEXTDOMAIN)
									)
								),
								'version' => SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion()
							);
					
					}
					else
						$result = array(
							'success' => false,
							'validate' => array(
								array(
									'field' => 'generic',
									'message' => sprintf(__('There\'s at least one %s that isn\'t writable:<br />%s<br />Update cannot continue. Set the appropriate permissions and try again.', SURSTUDIO_TRD_TEXTDOMAIN), ($file['type'] == 'file' ? __('file', SURSTUDIO_TRD_TEXTDOMAIN) : __('folder', SURSTUDIO_TRD_TEXTDOMAIN)), $file['value'])
								)
							),
							'version' => SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion()
						);
					
				}
				else
					$result->version = SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion();

				echo json_encode($result);
				exit;

			}
			
		}

		$result = self::getDefaultError($response);
		$result['version'] = SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion();

		echo json_encode($result);
		exit;
		
	}
	
	public static function getDefaultError($_response, $_extra_name=false, $_extra_value=false) {

		$error = __('Unsual server error. Please try again in 5 minutes.', SURSTUDIO_TRD_TEXTDOMAIN);

		if (is_object($_response) && method_exists($_response, 'get_error_message') && $_response->get_error_message() != '')
			$error = $_response->get_error_message() . '. ' . $error;

		$validate = array(
			'field' => 'generic',
			'message' => $error
		);
		
		if ($_extra_name != false && $_extra_value != false)
			$validate[$_extra_name] = $_extra_value;

		$result = array(
			'success' => false,
			'validate' => array($validate)
		);
		
		return $result;
		
	}
	
	public static function _check_version() {

		$url = 'http://envato.surstudio.net/get_version/3400269';
		
		$response = wp_remote_get($url, array(
			'timeout' => 10
		));
		
		$result = !is_wp_error($response) ? @$response['body'] : false;

		if ($result != false) {

			$result = json_decode($result);
			
			if (!is_null($result)) {
			
				if ($result->success) {
					self::_save_checked_version($result->message);
					$current = SurStudioPluginTranslatorRevolutionDropDownConfig::getVersion();
					$result->update = version_compare($current, $result->message, '<');
					if (!$result->update)
						$result->update_validate = array(
							array(
								'field' => 'generic',
								'message' => __('There\'s no need to update.', SURSTUDIO_TRD_TEXTDOMAIN) . ' ' . __('The latest version of the plugin is already installed on this site.', SURSTUDIO_TRD_TEXTDOMAIN)
							)
						);
				}

				echo json_encode($result);
				exit;

			}
			
		}

		$result = SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::getDefaultError($response);

		echo json_encode($result);
		exit;
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownAdminTranslations {
	
	public static function _get_languages_per_resource() {
		
		$resource = base64_decode(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations_resource', 'POST')); //false
		
		if ($resource !== false) {
		
			$languages = self::_scan_languages_per_resource($resource);
			
			$json = array(
				'resource' => $resource,
				'languages' => $languages
			);
			
		}
		else {
			$json = array(
				'resource' => '',
				'languages' => array()
			);			
		}
		
		echo json_encode($json);
		exit;
		
	}

	public static function _get_cached_translations() {
		
		$file = base64_decode(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations_languages', 'POST'));
		self::_render_cached_translations_form($file);
		exit;

	}

	public static function _save_cached_translations() {
		
		$file = base64_decode(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations_languages', 'POST'));
		$translations = self::_get_new_translations();
		
		$global_file = preg_replace('/[a-zA-Z0-9]{32}/', 'global', $file);
		
		self::_update_translations($file, $translations);
		self::_update_translations($global_file, $translations);

		exit;
		
	}
	
	protected static function _update_translations($_file, $_translations) {
		
		$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($_file);
		
		if (!$contents)
			return '';

		$xml = new DOMDocument();
		$xml->preserveWhiteSpace = false;

		if (@!$xml->loadXML($contents))
			return false;

		$xml->formatOutput = true;

		$xpath = new DOMXPath($xml); 

		foreach ($_translations as $hash => $translation)
			self::_update_translation($xml, $xpath, $hash, $translation);

		SurStudioPluginTranslatorRevolutionDropDownFileHandler::write($_file, $xml->saveXML());

	}
	
	protected static function _update_translation(&$_xml, &$_xpath, $_hash, $_translation) {

		$current_translations = $_xpath->query("/translations/word[@hash='$_hash']/translation");

		if (is_null($current_translations))
			return false;
		
		$i = 0;

		foreach ($current_translations as $translation) {
		
			if ($i > 0 || SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($_translation)) {
				$word = $_xpath->query("/translations/word[@hash='$_hash']")->item($i);
				if (!is_null($word))
					$_xml->firstChild->removeChild($word);
			}
			else {
				$translation->firstChild->nodeValue = $_translation;
				$translation->parentNode->setAttribute('date', date('c'));
			}

			$i++;
			
		}

	}
	
	protected static function _get_new_translations() {
		
		$result = array();
		
		$translations = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations', 'POST');

		if (!is_array($translations))
			return $result;
	
		foreach ($translations as $translation) {
			
			if (count($translation) != 2)
				continue;
				
			$result[$translation[0]] = $translation[1];
			
		}

		return $result;
		
	}
	
	public static function _render_cached_translations_form($_file) {
		
		$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($_file);
		
		if (!$contents)
			return '';

		$xml = new DOMDocument();
		$xml->preserveWhiteSpace = false;

		if (@!$xml->loadXML($contents))
			return '';

		$xpath = new DOMXPath($xml); 
		$scope = $xpath->query('/translations')->item(0)->getAttribute('scope');
		$from = $xpath->query('/translations')->item(0)->getAttribute('from');
		$to = $xpath->query('/translations')->item(0)->getAttribute('to');
		$from_language = SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($from);
		$to_language = SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($to);

		$cached_translations_fields_formatted = self::_get_cached_translations_fields_formatted($xml);

		$object = (object) array(
			'scope' => $scope,
			'from' => $from,
			'to' => $to,
			'from_language' => $from_language,
			'to_language' => $to_language,
			'cached_translations_fields_formatted' => $cached_translations_fields_formatted
		);

		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject($object, array(
			'type' => 'file',
			'content' => '/admin/translations_cached.tpl'
		));

		echo $result;

	}
	
	protected static function _get_cached_translations_fields_formatted($_xml) {
		
		$words = self::_get_cached_translation_words($_xml);
		
		$result = SurStudioPluginTranslatorRevolutionDropDownCommon::renderObject($words, array(
			'type' => 'file',
			'content' => '/admin/translations_cached_field.tpl'
		));
		
		return $result;
		
	}
	
	protected static function _get_cached_translation_words($_xml) {

		$result = array();
		
		$xpath = new DOMXPath($_xml); 
		$words = $xpath->query('/translations/word');
		$sources = $xpath->query('/translations/word/source');
		$translations = $xpath->query('/translations/word/translation');

		for ($i=0; $i<$words->length; $i++) {
			
			$hash = $words->item($i)->getAttribute('hash');
			
			if (array_key_exists($hash, $result) && (strtotime($words->item($i)->getAttribute('date')) < strtotime($result[$hash]['date'])))
				continue;
			
			$result[$hash] = array(
				'hash' => $hash,
				'date' => $words->item($i)->getAttribute('date'),
				'source' => SurStudioPluginTranslatorRevolutionDropDownCommon::escapeHtmlBrackets($sources->item($i)->nodeValue),
				'translation' => SurStudioPluginTranslatorRevolutionDropDownCommon::escapeHtmlBrackets($translations->item($i)->nodeValue),
				'id' => 'surstudio_translations_cached'
			);
			
		}
		
		return $result;
		
	}
	
	protected static function _scan_languages_per_resource($_scope) {

		$files = SurStudioPluginTranslatorRevolutionDropDownTranslationsField::getFilesPaths(SURSTUDIO_TRD_CACHE);
		$result = array();
		
		foreach ($files as $file) {
			
			$contents = SurStudioPluginTranslatorRevolutionDropDownFileHandler::read($file);
			
			if (!$contents)
				continue;

			$xml = new DOMDocument();
			$xml->preserveWhiteSpace = false;
			
			if (@!$xml->loadXML($contents))
				continue;
			
			$xpath = new DOMXPath($xml); 
			$scope = $xpath->query('/translations')->item(0)->getAttribute('scope');
			
			if ($scope != $_scope)
				continue;
				
			$from = $xpath->query('/translations')->item(0)->getAttribute('from');
			$to = $xpath->query('/translations')->item(0)->getAttribute('to');

			$from_language = SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($from);
			$to_language = SurStudioPluginTranslatorRevolutionDropDownCommon::getLanguage($to);

			if (!$from_language || !$to_language)
				continue;

			$result[$from_language . ' > ' . $to_language] = array(
				'file' => base64_encode($file),
				'from' => $from,
				'to' => $to
			);

		}

		asort($result);

		return $result;
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownAdminBaseForm extends SurStudioPluginTranslatorRevolutionDropDownItem {
	
	public $title_message;
	public $preview_message;
	public $activated_message;
	public $saved_message;
	public $reseted_message;
	public $save_button_message;
	public $reset_button_message;
	
	public $cached_translations_saved_message;
	
	protected $_fields;
	
	public function __construct() {
		
		$this->title_message = __('Translator Revolution DropDown Settings', SURSTUDIO_TRD_TEXTDOMAIN);

		$this->saved_message = __('Settings saved.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->reseted_message = __('Settings reseted.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->reset_message = SurStudioPluginTranslatorRevolutionDropDownCommon::jsonCompatible(__('All the settings will be reseted and restored to their default values. Do you want to continue?', SURSTUDIO_TRD_TEXTDOMAIN));
		$this->save_button_message = __('Save changes', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->reset_button_message = __('Reset settings', SURSTUDIO_TRD_TEXTDOMAIN);
	
		$this->cached_translations_saved_message = __('Translations saved.', SURSTUDIO_TRD_TEXTDOMAIN);
		
	}
	
	protected static function _commit($_name, $_result) {

		if (!get_option($_name))
			add_option($_name, $_result);
		else
			update_option($_name, $_result);
		
		if (!get_option($_name)) {
			delete_option($_name);
			add_option($_name, $_result);
		}
		
	}
	
	public function render($_options, $_html_encode=false) {
		
		return parent::render($_options, $_html_encode);
		
	}
	
	protected function _prepare_settings() {}
	protected function _set_fields() {}
	
}

class SurStudioPluginTranslatorRevolutionDropDownWelcome extends SurStudioPluginTranslatorRevolutionDropDownAdminBaseForm {

	public $settings_message;
	public $settings_url;
	public $group_1;
	
	public $ajax_url;

	public function __construct() {
		
		parent::__construct();
		
		$this->_set_fields();
		
		$this->settings_message = __('Settings', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->settings_url = SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminPluginUrl();
	
		$this->ajax_url = SurStudioPluginTranslatorRevolutionDropDownCommon::getAjaxUrl();
	
	}

	protected function _set_fields() {
		
		if (is_array($this->_fields))
			return;
			
		$this->_fields = array();
			
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getMainSettings(true);
		
		foreach ($settings as $key => $setting) { 
			
			if (!array_key_exists('type', $setting))
				continue;
			
			$field_class = 'SurStudioPluginTranslatorRevolutionDropDown' . ucfirst($setting['type']) . 'Field';
			
			if ($field_class == 'SurStudioPluginTranslatorRevolutionDropDownField')
				continue;
			
			$this->_fields[$key] = new $field_class($setting);
		}
		
	}

	protected function _prepare_settings() {
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettings();
		
		$groups = 1;
		
		for ($i=1; $i<$groups+1; $i++) {

			$partial = array();
			
			foreach ($this->_fields as $key => $field)
				if ($field->group == $i)
					$partial[] = $field->output();

			$group = 'group_' . $i;
					
			$this->{$group} = implode("\n", $partial);
				
		}
		
	}

	public function render($_options, $_html_encode=false) {

		$this->_prepare_settings();

		if (!array_key_exists('meta_tag_rules', $_options))
			$_options['meta_tag_rules'] = array();

		$_options['meta_tag_rules'][] = array(
			'expression' => false,
			'tag' => 'api_key_validate'
		);

		return parent::render($_options, $_html_encode);

	}

}

class SurStudioPluginTranslatorRevolutionDropDownAdminForm extends SurStudioPluginTranslatorRevolutionDropDownAdminBaseForm {
	
	public $group_1;
	public $group_2;
	public $group_3;
	public $group_4;
	public $group_5;
	public $group_6;
	public $group_7;
	public $group_8;
	
	public $tab;
	public $tab_2;
	public $tab_3;
	
	public $welcome_message;
	public $general_message;
	public $general_api_key_validate_message;
	public $general_cache_folder_validate_message;
	public $general_cache_file_validate_message;
	public $general_fsockopen_validate_message;
	public $general_mcrypt_validate_message;
	public $advanced_message;
	public $advanced_general_message;
	public $advanced_import_export_message;
	public $translations_message;
	public $translations_general_message;
	public $translations_import_message;
	public $translations_export_message;
	public $backup_message;
	public $support_message;
	
	public $welcome_url;
	public $ajax_url;
	
	protected static $_imported_status;
	
	public function __construct() {
		
		parent::__construct();
		
		$this->welcome_message = __('Dashboard', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_message = __('General Settings', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_api_key_validate_message = __('The entered Item Purchase Code appears to be invalid. Make sure to read and follow all the steps listed on the <a href="http://www.surstudio.net/translator-revolution-dropdown-widget-wordpress-plugin/installation/" target="_blank">Installation Guide</a>. Or <a href="http://codecanyon.net/user/SurStudio#contact" target="_blank">ask for support</a>.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_cache_folder_validate_message = sprintf(__('The folder %s isn\'t writable.', SURSTUDIO_TRD_TEXTDOMAIN), SURSTUDIO_TRD_CACHE);
		$this->general_openssl_validate_message = __('The OpenSSL module isn\'t installed on this server, which is required by the Google Translate API.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_fsockopen_validate_message = __('The fsockopen function isn\'t enabled on this server.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_mcrypt_validate_message = __('The Mcrypt module isn\'t enabled on this server.', SURSTUDIO_TRD_TEXTDOMAIN);

		$this->general_api_key_empty_validate_message = __('Please provide an <b>Item Purchase Code</b>. Make sure to read and follow all the steps listed on the <a href="http://www.surstudio.net/translator-revolution-dropdown-widget-wordpress-plugin/installation/" target="_blank">Installation Guide</a>. Or <a href="http://codecanyon.net/user/SurStudio#contact" target="_blank">ask for support</a>.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_api_key_google_empty_validate_message = __('Please provide an <b>API key</b> for the <a href="https://code.google.com/apis/console" target="_blank">Google Translation Service</a>.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_client_id_microsoft_empty_validate_message = __('Please provide the <b>Client Id</b> for the <a href="https://datamarket.azure.com/dataset/1899a118-d202-492c-aa16-ba21c33c06cb" target="_blank">Microsoft Translation Service</a>. Register an <a href="https://datamarket.azure.com/developer/applications/" target="_blank">application</a>.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->general_client_secret_microsoft_empty_validate_message = __('Please provide the <b>Client Secret</b> for the <a href="https://datamarket.azure.com/dataset/1899a118-d202-492c-aa16-ba21c33c06cb" target="_blank">Microsoft Translation Service</a>. Register an <a href="https://datamarket.azure.com/developer/applications/" target="_blank">application</a>.', SURSTUDIO_TRD_TEXTDOMAIN);

		$this->advanced_message = __('Advanced Settings', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->advanced_general_message = __('General', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->advanced_import_export_message = __('Import / Export', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->advanced_import_success_message = __('Settings succesfully imported.', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->advanced_import_fail_message = __('There was a problem while importing the settings. Please make sure the exported string is complete. Changes weren\'t saved.', SURSTUDIO_TRD_TEXTDOMAIN);

		$this->translations_message = __('Cached Translations', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->translations_general_message = __('General', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->translations_import_message = __('Import', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->translations_export_message = __('Export', SURSTUDIO_TRD_TEXTDOMAIN);
		
		$this->backup_message = __('Online Backups', SURSTUDIO_TRD_TEXTDOMAIN);
		$this->support_message = __('FAQ &amp; Support', SURSTUDIO_TRD_TEXTDOMAIN);

		$this->welcome_url = SurStudioPluginTranslatorRevolutionDropDownCommon::getAdminWelcomePluginUrl();
		$this->ajax_url = SurStudioPluginTranslatorRevolutionDropDownCommon::getAjaxUrl();

		$this->_set_fields();

	}
	
	protected static function _get_imported_status() {
		
		return self::$_imported_status;
		
	}
	
	protected static function _set_imported_status($_status) {
	
		self::$_imported_status = $_status;
		
	}

	protected static function _import_translations() {
		
		if (!SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isImportingTranslations())
			return null;
		
		return true;
		
	}
	
	protected static function _import() {
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getDefaults();
		$key = $settings['import']['id'];
		
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($key, 'POST');
		
		if ($value === false || SurStudioPluginTranslatorRevolutionDropDownValidator::isEmpty($value))
			return null;
		
		$decode = base64_decode($value);
		
		if ($decode === false) {
			self::_set_imported_status(false);
			return false;
		}
		
		$unserialize = @unserialize($decode);

		if (!is_array($unserialize)) {
			self::_set_imported_status(false);
			return false;
		}
		
		$result = array();

		foreach ($settings as $key => $setting) {
			
			if (in_array($key, array('import', 'export')))
				continue;
			
			if (array_key_exists($key, $unserialize))
				$result[$key] = $unserialize[$key];

		}

		if (count($result) == 0) {
			self::_set_imported_status(false);
			return false;
		}

		self::_commit(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName(), $result);		
		self::_set_imported_status(true);
		
		return true;
		
	}
	
	public static function saveAPIKey($_api_key) {
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::_get_settings();
		
		$settings['api_key']['value'] = $_api_key;
		
		self::_commit(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName(), $settings);
		
	}
	
	public static function save() {
		
		if (!is_null(self::_import()))
			return;

		if (!is_null(self::_import_translations()))
			return;
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getDefaults();
		$result = array();

		foreach ($settings as $key => $setting) {
			
			$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable($setting['id'], 'POST');
			
			switch ($key) {
				case 'api_key': {

					$value = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::cleanId($value));
					
					$current_api_key = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettingValue('api_key', true);
					if ($value != $current_api_key)
						SurStudioPluginTranslatorRevolutionDropDownAdminWelcome::resetVerified();
					
					if ($value !== false && $value != $setting['value'])
						$result[$key] = array('value' => $value);
					else
						unset($result[$key]);
					
					break;
				}
				case 'languages': {
					$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable(str_replace('languages', 'languages_order', $setting['id']), 'POST');
					
					if ($value !== false) {
						$value = explode(',', $value);
						if ($value !== $setting['value'])
							$result[$key] = array('value' => $value);
						else
							unset($result[$key]);
					}
					else
						unset($result[$key]);
					
					break;
				}
				case 'translations_import':
				case 'translations_export':
				case 'import':
				case 'export': {
					continue;
					break;
				}
				default: {

					if ($key == 'id' || $key == 'dropdown_container_id' || (SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($key, '_class') && $key != 'language_selector_class'))
						$value = trim(SurStudioPluginTranslatorRevolutionDropDownCommon::cleanId($value));

					$unset_template = SurStudioPluginTranslatorRevolutionDropDownCommon::endsWith($key, '_template') && SurStudioPluginTranslatorRevolutionDropDownCommon::stripBreakLinesAndTabs($value) == SurStudioPluginTranslatorRevolutionDropDownCommon::stripBreakLinesAndTabs($setting['value']);

					if (!$unset_template && $value !== false && $value != $setting['value'])
						$result[$key] = array('value' => $value);
					else
						unset($result[$key]);
					break;

				}
			}
		}
		
		self::_commit(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName(), $result);

	}
	
	public static function reset() {
		
		if (get_option(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName()))
			delete_option(SurStudioPluginTranslatorRevolutionDropDownConfig::getDbSettingsName());

	}

	protected function _mcrypt_validate() {

		return SurStudioPluginTranslatorRevolutionDropDownCommon::isMcryptInstalled();

	}

	protected function _google_validate() {
		
		return $this->_fields['translation_service']->value != 'gt' || SurStudioPluginTranslatorRevolutionDropDownCommon::isOpenSSLInstalled();
		
	}

	protected function _fsockopen_validate() {

		return function_exists('fsockopen');
		
	}
	
	protected function _cache_file_validate() {
		
		if (!$this->_cache_folder_validate())
			return true;
		
		$files_validate = SurStudioPluginTranslatorRevolutionDropDownCommon::areFolderFilesWritable(SURSTUDIO_TRD_CACHE);
		
		if ($files_validate !== true) {
			$this->general_cache_file_validate_message = sprintf(__('There\'s at least one cache file that isn\'t writable, ie: %s', SURSTUDIO_TRD_TEXTDOMAIN), $files_validate);
			return false;
		}
		
		return true;
		
	}
	
	protected function _cache_folder_validate() {
		
		return SurStudioPluginTranslatorRevolutionDropDownCommon::isFolderWritable(SURSTUDIO_TRD_CACHE);
		
	}
	
	protected function _api_key_validate() {
		
		$value = $this->_fields['api_key']->value;
		
		if (empty($value))
			return true;
			
		if (strlen($value) != 56 && strlen($value) != 36)
			return false;
		
		return true;
		
	}
	
	protected function _client_secret_microsoft_empty_validate() {

		if ($this->_fields['translation_service']->value != 'ma')
			return true;
		
		return !empty($this->_fields['microsoft_client_secret']->value);
		
	}
	
	protected function _client_id_microsoft_empty_validate() {

		if ($this->_fields['translation_service']->value != 'ma')
			return true;
		
		return !empty($this->_fields['microsoft_client_id']->value);
		
	}
	
	protected function _api_key_google_empty_validate() {
		
		if ($this->_fields['translation_service']->value != 'gt')
			return true;
		
		return !empty($this->_fields['google_api_key']->value);
		
	}
	
	protected function _api_key_empty_validate() {
		
		return !empty($this->_fields['api_key']->value);
		
	}
	
	public function render($_options, $_html_encode=false) {

		$cache_folder_validate = $this->_cache_folder_validate();
		$cache_file_validate = $this->_cache_file_validate();
		SurStudioPluginTranslatorRevolutionDropDownConfig::setCacheFlag($cache_folder_validate && $cache_file_validate);

		$this->_prepare_settings();

		$is_importing = SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isSavingSettings() && SurStudioPluginTranslatorRevolutionDropDownValidator::isBool(self::_get_imported_status());
		$is_importing_translations = SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isImportingTranslations();

		if (!array_key_exists('meta_tag_rules', $_options))
			$_options['meta_tag_rules'] = array();

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_api_key_validate(),
			'tag' => 'api_key_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_api_key_empty_validate(),
			'tag' => 'api_key_empty_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_api_key_google_empty_validate(),
			'tag' => 'api_key_google_empty_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_client_id_microsoft_empty_validate(),
			'tag' => 'client_id_microsoft_empty_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_client_secret_microsoft_empty_validate(),
			'tag' => 'client_secret_microsoft_empty_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_cache_folder_validate(),
			'tag' => 'cache_folder_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $cache_file_validate,
			'tag' => 'cache_file_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_fsockopen_validate(),
			'tag' => 'fsockopen_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_google_validate(),
			'tag' => 'openssl_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $this->_mcrypt_validate(),
			'tag' => 'mcrypt_validate'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isSavingSettings() && !$is_importing && !$is_importing_translations,
			'tag' => 'just_saved'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $is_importing_translations,
			'tag' => 'just_imported_translations_success'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $is_importing && self::_get_imported_status(),
			'tag' => 'just_imported_success'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => $is_importing && !self::_get_imported_status(),
			'tag' => 'just_imported_fail'
		);

		$_options['meta_tag_rules'][] = array(
			'expression' => SurStudioPluginTranslatorRevolutionDropDownAdminEvents::isResetingSettings(),
			'tag' => 'just_reseted'
		);
		
		return parent::render($_options, $_html_encode);

	}

	protected function _set_fields() {
		
		if (is_array($this->_fields))
			return;
			
		$this->_fields = array();
			
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettings(true);
		
		foreach ($settings as $key => $setting) { 
			
			if (!array_key_exists('type', $setting))
				continue;
			
			$field_class = 'SurStudioPluginTranslatorRevolutionDropDown' . ucfirst($setting['type']) . 'Field';
			
			if ($field_class == 'SurStudioPluginTranslatorRevolutionDropDownField')
				continue;
			
			$this->_fields[$key] = new $field_class($setting);
		}
		
	}
	
	protected function _prepare_settings() {
		
		$settings = SurStudioPluginTranslatorRevolutionDropDownConfig::getSettings();
		
		$groups = 8;
		
		for ($i=1; $i<$groups+1; $i++) {

			$partial = array();
			
			foreach ($this->_fields as $key => $field) {
				if ($field->group == $i) {
					$field->satisfyDependence($this->_fields);
					$partial[] = $field->output();
				}
			}

			$group = 'group_' . $i;
					
			$this->{$group} = implode("\n", $partial);
				
		}
		
		$tab = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_tab', 'POST');
		$this->tab = $tab !== false ? $tab : '';

		$tab_2 = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_tab_2', 'POST');
		$this->tab_2 = $tab_2 !== false ? $tab_2 : '';

		$tab_3 = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_tab_3', 'POST');
		$this->tab_3 = $tab_3 !== false ? $tab_3 : '';
		
	}
	
}

class SurStudioPluginTranslatorRevolutionDropDownAdminEvents {

	public static function isLoadingAdminPage() {
		
		return in_array(SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('page', 'GET'), array(SurStudioPluginTranslatorRevolutionDropDownConfig::getAdminHandle(), SurStudioPluginTranslatorRevolutionDropDownConfig::getWelcomeHandle()));
		
	}
	
	public static function isSavingSettings() {
		
		return SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_plugin_translator_revolution_dropdown_admin_action', 'POST') === 'surstudio_plugin_translator_revolution_dropdown_save_settings';
		
	}
	
	public static function isResetingSettings() {
		
		return SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_plugin_translator_revolution_dropdown_admin_action', 'POST') === 'surstudio_plugin_translator_revolution_dropdown_reset_settings';
		
	}

	public static function isExportingTranslations() {

		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations_export_button', 'POST');
		return self::isSavingSettings() && !empty($value);
		
	}
	
	public static function isImportingTranslations() {
		
		$value = SurStudioPluginTranslatorRevolutionDropDownCommon::getVariable('surstudio_translations_import_button', 'POST');
		return self::isSavingSettings() && !empty($value);
		
	}

}

SurStudioPluginTranslatorRevolutionDropDownAdmin::initialize();

?>