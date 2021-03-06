<?php
	/**
	 * Smarty Internal Plugin Compile Nocache
	 * Compiles the {nocache} {/nocache} tags.
	 * @package    Smarty
	 * @subpackage Compiler
	 * @author     Uwe Tews
	 */

	/**
	 * Smarty Internal Plugin Compile Nocache Class
	 * @package    Smarty
	 * @subpackage Compiler
	 */
	class Smarty_Internal_Compile_Nocache extends Smarty_Internal_CompileBase {
		/**
		 * Array of names of valid option flags
		 * @var array
		 */
		public $option_flags = [ ];

		/**
		 * Compiles code for the {nocache} tag
		 * This tag does not generate compiled output. It only sets a compiler flag.
		 * @param  array $args array with attributes from parser
		 * @param  object $compiler compiler object
		 * @return bool
		 */
		public function compile ( $args, $compiler ) {
			$_attr = $this->getAttributes ( $compiler, $args );
			$this->openTag ( $compiler, 'nocache', [ $compiler->nocache ] );
			// enter nocache mode
			$compiler->nocache = TRUE;
			// this tag does not return compiled code
			$compiler->has_code = FALSE;

			return TRUE;
		}
	}

	/**
	 * Smarty Internal Plugin Compile Nocacheclose Class
	 * @package    Smarty
	 * @subpackage Compiler
	 */
	class Smarty_Internal_Compile_Nocacheclose extends Smarty_Internal_CompileBase {
		/**
		 * Compiles code for the {/nocache} tag
		 * This tag does not generate compiled output. It only sets a compiler flag.
		 * @param  array $args array with attributes from parser
		 * @param  object $compiler compiler object
		 * @return bool
		 */
		public function compile ( $args, $compiler ) {
			$_attr = $this->getAttributes ( $compiler, $args );
			// leave nocache mode
			list( $compiler->nocache ) = $this->closeTag ( $compiler, [ 'nocache' ] );
			// this tag does not return compiled code
			$compiler->has_code = FALSE;

			return TRUE;
		}
	}
