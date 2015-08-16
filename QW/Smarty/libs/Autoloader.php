<?php
/**
 * Smarty Autoloader
 *
 * @package    Smarty
 */

/**
 * Smarty Autoloader
 *
 * @package    Smarty
 * @author     Uwe Tews
 *             Usage:
 *             require_once '...path/Autoloader.php';
 *             Smarty_Autoloader::register();
 *             $smarty = new Smarty();
 *             Note:       This autoloader is not needed if you use Composer.
 *             Composer will automatically add the classes of the Smarty package to it common autoloader.
 */
class Smarty_Autoloader {
	/**
	 * Filepath to Smarty root
	 *
	 * @var string
	 */
	public static $SMARTY_DIR = '';
	/**
	 * Filepath to Smarty internal plugins
	 *
	 * @var string
	 */
	public static $SMARTY_SYSPLUGINS_DIR = '';
	/**
	 * Array of not existing classes to avoid is_file calls for  already tested classes
	 *
	 * @var array
	 */
	public static $unknown = [ ];
	/**
	 * Array with Smarty core classes and their filename
	 *
	 * @var array
	 */
	public static $rootClasses = [ 'Smarty' => 'Smarty.class.php', 'SmartyBC' => 'SmartyBC.class.php', ];

	private static $syspluginsClasses = [ 'smarty_config_source' => TRUE, 'smarty_security' => TRUE, 'smarty_cacheresource' => TRUE, 'smarty_compiledresource' => TRUE, 'smarty_cacheresource_custom' => TRUE, 'smarty_cacheresource_keyvaluestore' => TRUE, 'smarty_resource' => TRUE, 'smarty_resource_custom' => TRUE, 'smarty_resource_uncompiled' => TRUE, 'smarty_resource_recompiled' => TRUE, 'smarty_template_source' => TRUE, 'smarty_template_compiled' => TRUE, 'smarty_template_cached' => TRUE, 'smarty_template_config' => TRUE, 'smarty_data' => TRUE, 'smarty_variable' => TRUE, 'smarty_undefined_variable' => TRUE, 'smartyexception' => TRUE, 'smartycompilerexception' => TRUE, 'smarty_internal_data' => TRUE, 'smarty_internal_template' => TRUE, 'smarty_internal_templatebase' => TRUE, 'smarty_internal_resource_file' => TRUE, 'smarty_internal_resource_extends' => TRUE, 'smarty_internal_resource_eval' => TRUE, 'smarty_internal_resource_string' => TRUE, 'smarty_internal_resource_registered' => TRUE, 'smarty_internal_extension_codeframe' => TRUE, 'smarty_internal_extension_config' => TRUE, 'smarty_internal_filter_handler' => TRUE, 'smarty_internal_function_call_handler' => TRUE, 'smarty_internal_cacheresource_file' => TRUE, 'smarty_internal_write_file' => TRUE, ];

	/**
	 * Handles autoloading of classes.
	 *
	 * @param string $class A class name.
	 */
	public static function autoload($class) {
		// Request for Smarty or already unknown class
		if ( isset( self::$unknown[ $class ] ) ) {
			return;
		}
		$_class = strtolower($class);
		if ( isset( self::$syspluginsClasses[ $_class ] ) ) {
			$_class = ( self::$syspluginsClasses[ $_class ] === TRUE ) ? $_class : self::$syspluginsClasses[ $_class ];
			$file   = self::$SMARTY_SYSPLUGINS_DIR . $_class . '.php';
			require_once $file;

			return;
		}
		elseif ( 0 !== strpos($_class, 'smarty_internal_') ) {
			if ( isset( self::$rootClasses[ $class ] ) ) {
				$file = self::$SMARTY_DIR . self::$rootClasses[ $class ];
				require_once $file;

				return;
			}
			self::$unknown[ $class ] = TRUE;

			return;
		}
		$file = self::$SMARTY_SYSPLUGINS_DIR . $_class . '.php';
		if ( is_file($file) ) {
			require_once $file;

			return;
		}
		self::$unknown[ $class ] = TRUE;

		return;
	}

	/**
	 * Registers Smarty_Autoloader as an SPL autoloader.
	 *
	 * @param bool $prepend Whether to prepend the autoloader or not.
	 */
	public static function register($prepend = FALSE) {
		self::$SMARTY_DIR            = defined('SMARTY_DIR') ? SMARTY_DIR : dirname(__FILE__) . '/';
		self::$SMARTY_SYSPLUGINS_DIR = defined('SMARTY_SYSPLUGINS_DIR') ? SMARTY_SYSPLUGINS_DIR : self::$SMARTY_DIR . 'sysplugins/';
		if ( version_compare(phpversion(), '5.3.0', '>=') ) {
			spl_autoload_register([ __CLASS__, 'autoload' ], TRUE, $prepend);
		}
		else {
			spl_autoload_register([ __CLASS__, 'autoload' ]);
		}
	}

	/**
	 * Registers Smarty_Autoloader backward compatible to older installations.
	 *
	 * @param bool $prepend Whether to prepend the autoloader or not.
	 */
	public static function registerBC($prepend = FALSE) {
		/**
		 * register the class autoloader
		 */
		if ( !defined('SMARTY_SPL_AUTOLOAD') ) {
			define('SMARTY_SPL_AUTOLOAD', 0);
		}
		if ( SMARTY_SPL_AUTOLOAD && set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_SYSPLUGINS_DIR) !== FALSE ) {
			$registeredAutoLoadFunctions = spl_autoload_functions();
			if ( !isset( $registeredAutoLoadFunctions[ 'spl_autoload' ] ) ) {
				spl_autoload_register();
			}
		}
		else {
			self::register($prepend);
		}
	}
}
