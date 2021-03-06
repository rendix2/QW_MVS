<?php
	/**
	 * Smarty Plugin Data
	 * This file contains the data object
	 * @package    Smarty
	 * @subpackage Template
	 * @author     Uwe Tews
	 */

	/**
	 * class for the Smarty data object
	 * The Smarty data object will hold Smarty variables in the current scope
	 * @package    Smarty
	 * @subpackage Template
	 */
	class Smarty_Data extends Smarty_Internal_Data {
		/**
		 * Counter
		 * @var int
		 */
		static $count = 0;

		/**
		 * Data block name
		 * @var string
		 */
		public $dataObjectName = '';
		/**
		 * Smarty object
		 * @var Smarty
		 */
		public $smarty = NULL;

		/**
		 * create Smarty data object
		 * @param Smarty|array $_parent parent template
		 * @param Smarty|Smarty_Internal_Template $smarty global smarty instance
		 * @param string $name optional data block name
		 * @throws SmartyException
		 */
		public function __construct ( $_parent = NULL, $smarty = NULL, $name = NULL ) {
			self::$count++;
			$this->dataObjectName = 'Data_object ' . ( isset( $name ) ? "'{$name}'" : self::$count );
			$this->smarty         = $smarty;
			if ( is_object ( $_parent ) ) {
				// when object add up back pointer
				$this->parent = $_parent;
			} elseif ( is_array ( $_parent ) ) {
				// add up variable values
				foreach ( $_parent as $_key => $_val ) {
					$this->tpl_vars[ $_key ] = new Smarty_Variable( $_val );
				}
			} elseif ( $_parent != NULL ) {
				throw new SmartyException( "Wrong type for template variables" );
			}
		}
	}
