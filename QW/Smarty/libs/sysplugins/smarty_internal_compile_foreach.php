<?php
	/**
	 * Smarty Internal Plugin Compile Foreach
	 * Compiles the {foreach} {foreachelse} {/foreach} tags
	 * @package    Smarty
	 * @subpackage Compiler
	 * @author     Uwe Tews
	 */

	/**
	 * Smarty Internal Plugin Compile Foreach Class
	 * @package    Smarty
	 * @subpackage Compiler
	 */
	class Smarty_Internal_Compile_Foreach extends Smarty_Internal_CompileBase {
		/**
		 * Attribute definition: Overwrites base class.
		 * @var array
		 * @see Smarty_Internal_CompileBase
		 */
		public $required_attributes = [ 'from', 'item' ];
		/**
		 * Attribute definition: Overwrites base class.
		 * @var array
		 * @see Smarty_Internal_CompileBase
		 */
		public $optional_attributes = [ 'name', 'key' ];
		/**
		 * Attribute definition: Overwrites base class.
		 * @var array
		 * @see Smarty_Internal_CompileBase
		 */
		public $shorttag_order = [ 'from', 'item', 'key', 'name' ];

		/**
		 * Compiles code for the {foreach} tag
		 * @param  array $args array with attributes from parser
		 * @param  object $compiler compiler object
		 * @param  array $parameter array with compilation parameter
		 * @return string compiled code
		 */
		public function compile ( $args, $compiler, $parameter ) {
			// check and get attributes
			$_attr = $this->getAttributes ( $compiler, $args );

			$from = $_attr[ 'from' ];
			$item = $_attr[ 'item' ];
			if ( !strncmp ( "\$_smarty_tpl->tpl_vars[$item]", $from, strlen ( $item ) + 24 ) ) {
				$compiler->trigger_template_error ( "item variable {$item} may not be the same variable as at 'from'",
				$compiler->lex->taglineno );
			}

			if ( isset( $_attr[ 'key' ] ) ) {
				$key = $_attr[ 'key' ];
			} else {
				$key = NULL;
			}

			$this->openTag ( $compiler, 'foreach', [ 'foreach', $compiler->nocache, $item, $key, TRUE ] );
			// maybe nocache because of nocache variables
			$compiler->nocache = $compiler->nocache | $compiler->tag_nocache;

			if ( isset( $_attr[ 'name' ] ) ) {
				$name          = trim ( $_attr[ 'name' ], '\'"' );
				$has_name      = TRUE;
				$SmartyVarName = "\$smarty.foreach.{$name}.";
			} else {
				$has_name = FALSE;
			}
			$ItemVarName = '$' . trim ( $item, '\'"' ) . '@';
			// evaluates which Smarty variables and properties have to be computed

			if ( $has_name ) {
				$useSmartyForeach = $usesSmartyFirst = strpos ( $compiler->lex->data, $SmartyVarName . 'first' ) !== FALSE;
				$useSmartyForeach =
				( $usesSmartyLast = strpos ( $compiler->lex->data, $SmartyVarName . 'last' ) !== FALSE ) ||
				$useSmartyForeach;
				$useSmartyForeach =
				( $usesSmartyIndex = strpos ( $compiler->lex->data, $SmartyVarName . 'index' ) !== FALSE ) ||
				$useSmartyForeach;
				$useSmartyForeach = ( $usesSmartyIteration =
				( !$usesSmartyIndex && ( $usesSmartyFirst || $usesSmartyLast ) ) ||
				strpos ( $compiler->lex->data, $SmartyVarName . 'iteration' ) !== FALSE ) || $useSmartyForeach;
				$useSmartyForeach =
				( $usesSmartyShow = strpos ( $compiler->lex->data, $SmartyVarName . 'show' ) !== FALSE ) ||
				$useSmartyForeach;
				$useSmartyForeach = ( $usesSmartyTotal =
				$usesSmartyLast || strpos ( $compiler->lex->data, $SmartyVarName . 'total' ) !== FALSE ) ||
				$useSmartyForeach;
			} else {
				$usesSmartyFirst  = FALSE;
				$usesSmartyLast   = FALSE;
				$usesSmartyTotal  = FALSE;
				$usesSmartyShow   = FALSE;
				$useSmartyForeach = FALSE;
			}

			$usesPropKey       = strpos ( $compiler->lex->data, $ItemVarName . 'key' ) !== FALSE;
			$usesPropFirst     = strpos ( $compiler->lex->data, $ItemVarName . 'first' ) !== FALSE;
			$usesPropLast      = strpos ( $compiler->lex->data, $ItemVarName . 'last' ) !== FALSE;
			$usesPropIndex     = strpos ( $compiler->lex->data, $ItemVarName . 'index' ) !== FALSE;
			$usesPropIteration = ( !$usesPropIndex && ( $usesPropFirst || $usesPropLast ) ) ||
			strpos ( $compiler->lex->data, $ItemVarName . 'iteration' ) !== FALSE;
			$usesPropShow      = strpos ( $compiler->lex->data, $ItemVarName . 'show' ) !== FALSE;
			$usesPropTotal     = $usesPropLast || strpos ( $compiler->lex->data, $ItemVarName . 'total' ) !== FALSE;

			$keyTerm = '';
			if ( $usesPropKey ) {
				$keyTerm = "\$_smarty_tpl->tpl_vars[$item]->key => ";
			} elseif ( $key != NULL ) {
				$keyTerm = "\$_smarty_tpl->tpl_vars[$key]->value => ";
			}
			// generate output code
			$output = "<?php\n";
			$output .= "\$_from = $from;\n";
			$output .= "if (!is_array(\$_from) && !is_object(\$_from)) {\n";
			$output .= "settype(\$_from, 'array');\n";
			$output .= "}\n";
			$output .= "\$_smarty_tpl->tpl_vars[$item] = new Smarty_Variable;\n";
			$output .= "\$_smarty_tpl->tpl_vars[$item]->_loop = false;\n";
			if ( $key != NULL ) {
				$output .= "\$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable;\n";
			}
			if ( $usesPropTotal ) {
				$output .= "\$_smarty_tpl->tpl_vars[$item]->total= \$_smarty_tpl->_count(\$_from);\n";
			}
			if ( $usesPropIteration ) {
				$output .= "\$_smarty_tpl->tpl_vars[$item]->iteration=0;\n";
			}
			if ( $usesPropIndex ) {
				$output .= "\$_smarty_tpl->tpl_vars[$item]->index=-1;\n";
			}
			if ( $usesPropShow ) {
				if ( $usesPropTotal ) {
					$output .= "\$_smarty_tpl->tpl_vars[$item]->show = (\$_smarty_tpl->tpl_vars[$item]->total > 0);\n";
				} else {
					$output .= "\$_smarty_tpl->tpl_vars[$item]->show = (\$_smarty_tpl->_count(\$_from) > 0);\n";
				}
			}
			if ( $has_name ) {
				$prop = [ ];
				if ( $usesSmartyTotal ) {
					$prop[ 'total' ] = "'total' => ";
					$prop[ 'total' ] .= $usesSmartyShow ? '$total = ' : '';
					$prop[ 'total' ] .= '$_smarty_tpl->_count($_from)';
				}
				if ( $usesSmartyIteration ) {
					$prop[ 'iteration' ] = "'iteration' => 0";
				}
				if ( $usesSmartyIndex ) {
					$prop[ 'index' ] = "'index' => -1";
				}
				if ( $usesSmartyShow ) {
					$prop[ 'show' ] = "'show' => ";
					if ( $usesSmartyTotal ) {
						$prop[ 'show' ] .= "(\$total > 0)";
					} else {
						$prop[ 'show' ] .= "(\$_smarty_tpl->_count(\$_from) > 0)";
					}
				}
				if ( $useSmartyForeach ) {
					$_vars      = 'array(' . join ( ', ', $prop ) . ')';
					$foreachVar = "'__foreach_{$name}'";
					$output .= "\$_smarty_tpl->tpl_vars[$foreachVar] = new Smarty_Variable({$_vars});\n";
				}
			}
			$output .= "foreach (\$_from as {$keyTerm}\$_smarty_tpl->tpl_vars[$item]->value) {\n";
			$output .= "\$_smarty_tpl->tpl_vars[$item]->_loop = true;\n";
			if ( $key != NULL && $usesPropKey ) {
				$output .= "\$_smarty_tpl->tpl_vars[$key]->value = \$_smarty_tpl->tpl_vars[$item]->key;\n";
			}
			if ( $usesPropIteration ) {
				$output .= "\$_smarty_tpl->tpl_vars[$item]->iteration++;\n";
			}
			if ( $usesPropIndex ) {
				$output .= "\$_smarty_tpl->tpl_vars[$item]->index++;\n";
			}
			if ( $usesPropFirst ) {
				if ( $usesPropIndex ) {
					$output .= "\$_smarty_tpl->tpl_vars[$item]->first = \$_smarty_tpl->tpl_vars[$item]->index == 0;\n";
				} else {
					$output .= "\$_smarty_tpl->tpl_vars[$item]->first = \$_smarty_tpl->tpl_vars[$item]->iteration == 1;\n";
				}
			}
			if ( $usesPropLast ) {
				if ( $usesPropIndex ) {
					$output .= "\$_smarty_tpl->tpl_vars[$item]->last = \$_smarty_tpl->tpl_vars[$item]->index + 1 == \$_smarty_tpl->tpl_vars[$item]->total;\n";
				} else {
					$output .= "\$_smarty_tpl->tpl_vars[$item]->last = \$_smarty_tpl->tpl_vars[$item]->iteration == \$_smarty_tpl->tpl_vars[$item]->total;\n";
				}
			}
			if ( $has_name ) {
				if ( $usesSmartyIteration ) {
					$output .= "\$_smarty_tpl->tpl_vars[$foreachVar]->value['iteration']++;\n";
				}
				if ( $usesSmartyIndex ) {
					$output .= "\$_smarty_tpl->tpl_vars[$foreachVar]->value['index']++;\n";
				}
				if ( $usesSmartyFirst ) {
					if ( $usesSmartyIndex ) {
						$output .= "\$_smarty_tpl->tpl_vars[$foreachVar]->value['first'] = \$_smarty_tpl->tpl_vars[$foreachVar]->value['index'] == 0;\n";
					} else {
						$output .= "\$_smarty_tpl->tpl_vars[$foreachVar]->value['first'] = \$_smarty_tpl->tpl_vars[$foreachVar]->value['iteration'] == 1;\n";
					}
				}
				if ( $usesSmartyLast ) {
					if ( $usesSmartyIndex ) {
						$output .= "\$_smarty_tpl->tpl_vars[$foreachVar]->value['last'] = \$_smarty_tpl->tpl_vars[$foreachVar]->value['index'] + 1 == \$_smarty_tpl->tpl_vars[$foreachVar]->value['total'];\n";
					} else {
						$output .= "\$_smarty_tpl->tpl_vars[$foreachVar]->value['last'] = \$_smarty_tpl->tpl_vars[$foreachVar]->value['iteration'] == \$_smarty_tpl->tpl_vars[$foreachVar]->value['total'];\n";
					}
				}
			}
			$itemName = trim ( $item, "'\"" );
			$output .= "\$foreach_{$itemName}_Sav = \$_smarty_tpl->tpl_vars[$item];\n";
			$output .= "?>";

			return $output;
		}
	}

	/**
	 * Smarty Internal Plugin Compile Foreachelse Class
	 * @package    Smarty
	 * @subpackage Compiler
	 */
	class Smarty_Internal_Compile_Foreachelse extends Smarty_Internal_CompileBase {
		/**
		 * Compiles code for the {foreachelse} tag
		 * @param  array $args array with attributes from parser
		 * @param  object $compiler compiler object
		 * @param  array $parameter array with compilation parameter
		 * @return string compiled code
		 */
		public function compile ( $args, $compiler, $parameter ) {
			// check and get attributes
			$_attr = $this->getAttributes ( $compiler, $args );

			list( $openTag, $nocache, $item, $key, $foo ) = $this->closeTag ( $compiler, [ 'foreach' ] );
			$this->openTag ( $compiler, 'foreachelse', [ 'foreachelse', $nocache, $item, $key, FALSE ] );
			$itemName = trim ( $item, "'\"" );
			$output   = "<?php\n";
			$output .= "\$_smarty_tpl->tpl_vars[$item] = \$foreach_{$itemName}_Sav;\n";
			$output .= "}\n";
			$output .= "if (!\$_smarty_tpl->tpl_vars[$item]->_loop) {\n?>";

			return $output;
		}
	}

	/**
	 * Smarty Internal Plugin Compile Foreachclose Class
	 * @package    Smarty
	 * @subpackage Compiler
	 */
	class Smarty_Internal_Compile_Foreachclose extends Smarty_Internal_CompileBase {
		/**
		 * Compiles code for the {/foreach} tag
		 * @param  array $args array with attributes from parser
		 * @param  object $compiler compiler object
		 * @param  array $parameter array with compilation parameter
		 * @return string compiled code
		 */
		public function compile ( $args, $compiler, $parameter ) {
			// check and get attributes
			$_attr = $this->getAttributes ( $compiler, $args );
			// must endblock be nocache?
			if ( $compiler->nocache ) {
				$compiler->tag_nocache = TRUE;
			}

			list( $openTag, $compiler->nocache, $item, $key, $restore ) =
			$this->closeTag ( $compiler, [ 'foreach', 'foreachelse' ] );
			$itemName = trim ( $item, "'\"" );
			$output   = "<?php\n";
			if ( $restore ) {
				$output .= "\$_smarty_tpl->tpl_vars[$item] = \$foreach_{$itemName}_Sav;\n";
			}
			$output .= "}\n?>";

			return $output;
		}
	}
