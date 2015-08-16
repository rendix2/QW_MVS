<?php
/**
 * Smarty Internal Plugin Data
 * This file contains the basic classes and methods for template and variable creation
 *
 * @package    Smarty
 * @subpackage Template
 * @author     Uwe Tews
 */

/**
 * Base class with template and variable methods
 *
 * @package    Smarty
 * @subpackage Template
 */
class Smarty_Internal_Data {
	/**
	 * name of class used for templates
	 *
	 * @var string
	 */
	public $template_class = 'Smarty_Internal_Template';
	/**
	 * template variables
	 *
	 * @var array
	 */
	public $tpl_vars = [ ];
	/**
	 * parent template (if any)
	 *
	 * @var Smarty_Internal_Template
	 */
	public $parent = NULL;
	/**
	 * configuration settings
	 *
	 * @var array
	 */
	public $config_vars = [ ];

	/**
	 * appends values to template variables
	 *
	 * @param  array|string $tpl_var the template variable name(s)
	 * @param  mixed        $value   the value to append
	 * @param  boolean      $merge   flag if array elements shall be merged
	 * @param  boolean      $nocache if true any output of this variable will be not cached
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function append($tpl_var, $value = NULL, $merge = FALSE, $nocache = FALSE) {
		if ( is_array($tpl_var) ) {
			// $tpl_var is an array, ignore $value
			foreach ( $tpl_var as $_key => $_val ) {
				if ( $_key != '' ) {
					if ( !isset( $this->tpl_vars[ $_key ] ) ) {
						$tpl_var_inst = $this->getVariable($_key, NULL, TRUE, FALSE);
						if ( $tpl_var_inst instanceof Smarty_Undefined_Variable ) {
							$this->tpl_vars[ $_key ] = new Smarty_Variable(NULL, $nocache);
						}
						else {
							$this->tpl_vars[ $_key ] = clone $tpl_var_inst;
						}
					}
					if ( !( is_array($this->tpl_vars[ $_key ]->value) || $this->tpl_vars[ $_key ]->value instanceof ArrayAccess ) ) {
						settype($this->tpl_vars[ $_key ]->value, 'array');
					}
					if ( $merge && is_array($_val) ) {
						foreach ( $_val as $_mkey => $_mval ) {
							$this->tpl_vars[ $_key ]->value[ $_mkey ] = $_mval;
						}
					}
					else {
						$this->tpl_vars[ $_key ]->value[] = $_val;
					}
				}
			}
		}
		else {
			if ( $tpl_var != '' && isset( $value ) ) {
				if ( !isset( $this->tpl_vars[ $tpl_var ] ) ) {
					$tpl_var_inst = $this->getVariable($tpl_var, NULL, TRUE, FALSE);
					if ( $tpl_var_inst instanceof Smarty_Undefined_Variable ) {
						$this->tpl_vars[ $tpl_var ] = new Smarty_Variable(NULL, $nocache);
					}
					else {
						$this->tpl_vars[ $tpl_var ] = clone $tpl_var_inst;
					}
				}
				if ( !( is_array($this->tpl_vars[ $tpl_var ]->value) || $this->tpl_vars[ $tpl_var ]->value instanceof ArrayAccess ) ) {
					settype($this->tpl_vars[ $tpl_var ]->value, 'array');
				}
				if ( $merge && is_array($value) ) {
					foreach ( $value as $_mkey => $_mval ) {
						$this->tpl_vars[ $tpl_var ]->value[ $_mkey ] = $_mval;
					}
				}
				else {
					$this->tpl_vars[ $tpl_var ]->value[] = $value;
				}
			}
		}

		return $this;
	}

	/**
	 * appends values to template variables by reference
	 *
	 * @param  string  $tpl_var the template variable name
	 * @param  mixed   &$value  the referenced value to append
	 * @param  boolean $merge   flag if array elements shall be merged
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function appendByRef($tpl_var, &$value, $merge = FALSE) {
		if ( $tpl_var != '' && isset( $value ) ) {
			if ( !isset( $this->tpl_vars[ $tpl_var ] ) ) {
				$this->tpl_vars[ $tpl_var ] = new Smarty_Variable();
			}
			if ( !is_array($this->tpl_vars[ $tpl_var ]->value) ) {
				settype($this->tpl_vars[ $tpl_var ]->value, 'array');
			}
			if ( $merge && is_array($value) ) {
				foreach ( $value as $_key => $_val ) {
					$this->tpl_vars[ $tpl_var ]->value[ $_key ] = &$value[ $_key ];
				}
			}
			else {
				$this->tpl_vars[ $tpl_var ]->value[] = &$value;
			}
		}

		return $this;
	}

	/**
	 * assigns a Smarty variable
	 *
	 * @param  array|string $tpl_var the template variable name(s)
	 * @param  mixed        $value   the value to assign
	 * @param  boolean      $nocache if true any output of this variable will be not cached
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function assign($tpl_var, $value = NULL, $nocache = FALSE) {
		if ( is_array($tpl_var) ) {
			foreach ( $tpl_var as $_key => $_val ) {
				if ( $_key != '' ) {
					$this->tpl_vars[ $_key ] = new Smarty_Variable($_val, $nocache);
				}
			}
		}
		else {
			if ( $tpl_var != '' ) {
				$this->tpl_vars[ $tpl_var ] = new Smarty_Variable($value, $nocache);
			}
		}

		return $this;
	}

	/**
	 * assigns values to template variables by reference
	 *
	 * @param string   $tpl_var the template variable name
	 * @param          $value
	 * @param  boolean $nocache if true any output of this variable will be not cached
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function assignByRef($tpl_var, &$value, $nocache = FALSE) {
		if ( $tpl_var != '' ) {
			$this->tpl_vars[ $tpl_var ]        = new Smarty_Variable(NULL, $nocache);
			$this->tpl_vars[ $tpl_var ]->value = &$value;
		}

		return $this;
	}

	/**
	 * assigns a global Smarty variable
	 *
	 * @param  string  $varname the global variable name
	 * @param  mixed   $value   the value to assign
	 * @param  boolean $nocache if true any output of this variable will be not cached
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function assignGlobal($varname, $value = NULL, $nocache = FALSE) {
		if ( $varname != '' ) {
			Smarty::$global_tpl_vars[ $varname ] = new Smarty_Variable($value, $nocache);
			$ptr                                 = $this;
			while ( $ptr instanceof Smarty_Internal_Template ) {
				$ptr->tpl_vars[ $varname ] = clone Smarty::$global_tpl_vars[ $varname ];
				$ptr                       = $ptr->parent;
			}
		}

		return $this;
	}

	/**
	 * clear all the assigned template variables.
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function clearAllAssign() {
		$this->tpl_vars = [ ];

		return $this;
	}

	/**
	 * clear the given assigned template variable.
	 *
	 * @param  string|array $tpl_var the template variable(s) to clear
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function clearAssign($tpl_var) {
		if ( is_array($tpl_var) ) {
			foreach ( $tpl_var as $curr_var ) {
				unset( $this->tpl_vars[ $curr_var ] );
			}
		}
		else {
			unset( $this->tpl_vars[ $tpl_var ] );
		}

		return $this;
	}

	/**
	 * Deassigns a single or all config variables
	 *
	 * @param  string $varname variable name or null
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function clearConfig($varname = NULL) {
		return Smarty_Internal_Extension_Config::clearConfig($this, $varname);
	}

	/**
	 * load a config file, optionally load just selected sections
	 *
	 * @param  string $config_file filename
	 * @param  mixed  $sections    array of section names, single section or null
	 *
	 * @return Smarty_Internal_Data current Smarty_Internal_Data (or Smarty or Smarty_Internal_Template) instance
	 *                              for chaining
	 */
	public function configLoad($config_file, $sections = NULL) {
		// load Config class
		Smarty_Internal_Extension_Config::configLoad($this, $config_file, $sections);

		return $this;
	}

	/**
	 * gets  a config variable
	 *
	 * @param  string $variable the name of the config variable
	 * @param bool    $error_enable
	 *
	 * @return mixed  the value of the config variable
	 */
	public function getConfigVariable($variable, $error_enable = TRUE) {
		return Smarty_Internal_Extension_Config::getConfigVariable($this, $variable, $error_enable = TRUE);
	}

	/**
	 * Returns a single or all config variables
	 *
	 * @param  string $varname variable name or null
	 * @param bool    $search_parents
	 *
	 * @return string variable value or or array of variables
	 */
	public function getConfigVars($varname = NULL, $search_parents = TRUE) {
		return Smarty_Internal_Extension_Config::getConfigVars($this, $varname, $search_parents);
	}

	/**
	 * gets  a stream variable
	 *
	 * @param  string $variable the stream of the variable
	 *
	 * @throws SmartyException
	 * @return mixed  the value of the stream variable
	 */
	public function getStreamVariable($variable) {
		$_result = '';
		$fp      = fopen($variable, 'r+');
		if ( $fp ) {
			while ( !feof($fp) && ( $current_line = fgets($fp) ) !== FALSE ) {
				$_result .= $current_line;
			}
			fclose($fp);

			return $_result;
		}
		$smarty = isset( $this->smarty ) ? $this->smarty : $this;
		if ( $smarty->error_unassigned ) {
			throw new SmartyException('Undefined stream variable "' . $variable . '"');
		}
		else {
			return NULL;
		}
	}

	/**
	 * Returns a single or all template variables
	 *
	 * @param  string  $varname        variable name or null
	 * @param  object  $_ptr           optional pointer to data object
	 * @param  boolean $search_parents include parent templates?
	 *
	 * @return string  variable value or or array of variables
	 */
	public function getTemplateVars($varname = NULL, $_ptr = NULL, $search_parents = TRUE) {
		if ( isset( $varname ) ) {
			$_var = $this->getVariable($varname, $_ptr, $search_parents, FALSE);
			if ( is_object($_var) ) {
				return $_var->value;
			}
			else {
				return NULL;
			}
		}
		else {
			$_result = [ ];
			if ( $_ptr === NULL ) {
				$_ptr = $this;
			}
			while ( $_ptr !== NULL ) {
				foreach ( $_ptr->tpl_vars AS $key => $var ) {
					if ( !array_key_exists($key, $_result) ) {
						$_result[ $key ] = $var->value;
					}
				}
				// not found, try at parent
				if ( $search_parents ) {
					$_ptr = $_ptr->parent;
				}
				else {
					$_ptr = NULL;
				}
			}
			if ( $search_parents && isset( Smarty::$global_tpl_vars ) ) {
				foreach ( Smarty::$global_tpl_vars AS $key => $var ) {
					if ( !array_key_exists($key, $_result) ) {
						$_result[ $key ] = $var->value;
					}
				}
			}

			return $_result;
		}
	}

	/**
	 * gets the object of a Smarty variable
	 *
	 * @param  string  $variable       the name of the Smarty variable
	 * @param  object  $_ptr           optional pointer to data object
	 * @param  boolean $search_parents search also in parent data
	 * @param bool     $error_enable
	 *
	 * @return object  the object of the variable
	 */
	public function getVariable($variable, $_ptr = NULL, $search_parents = TRUE, $error_enable = TRUE) {
		if ( $_ptr === NULL ) {
			$_ptr = $this;
		}
		while ( $_ptr !== NULL ) {
			if ( isset( $_ptr->tpl_vars[ $variable ] ) ) {
				// found it, return it
				return $_ptr->tpl_vars[ $variable ];
			}
			// not found, try at parent
			if ( $search_parents ) {
				$_ptr = $_ptr->parent;
			}
			else {
				$_ptr = NULL;
			}
		}
		if ( isset( Smarty::$global_tpl_vars[ $variable ] ) ) {
			// found it, return it
			return Smarty::$global_tpl_vars[ $variable ];
		}
		$smarty = isset( $this->smarty ) ? $this->smarty : $this;
		if ( $smarty->error_unassigned && $error_enable ) {
			// force a notice
			$x = $$variable;
		}

		return new Smarty_Undefined_Variable;
	}
}
