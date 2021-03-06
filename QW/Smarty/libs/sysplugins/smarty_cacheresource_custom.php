<?php
	/**
	 * Smarty Internal Plugin
	 * @package    Smarty
	 * @subpackage Cacher
	 */

	/**
	 * Cache Handler API
	 * @package    Smarty
	 * @subpackage Cacher
	 * @author     Rodney Rehm
	 */
	abstract class Smarty_CacheResource_Custom extends Smarty_CacheResource {
		/**
		 * Delete content from cache
		 * @param  string $name template name
		 * @param  string $cache_id cache id
		 * @param  string $compile_id compile id
		 * @param  integer|null $exp_time seconds till expiration time in seconds or null
		 * @return integer      number of deleted caches
		 */
		abstract protected function delete ( $name, $cache_id, $compile_id, $exp_time );

		/**
		 * fetch cached content and its modification time from data source
		 * @param  string $id unique cache content identifier
		 * @param  string $name template name
		 * @param  string $cache_id cache id
		 * @param  string $compile_id compile id
		 * @param  string $content cached content
		 * @param  integer $mtime cache modification timestamp (epoch)
		 * @return void
		 */
		abstract protected function fetch ( $id, $name, $cache_id, $compile_id, &$content, &$mtime );

		/**
		 * Save content to cache
		 * @param  string $id unique cache content identifier
		 * @param  string $name template name
		 * @param  string $cache_id cache id
		 * @param  string $compile_id compile id
		 * @param  integer|null $exp_time seconds till expiration or null
		 * @param  string $content content to cache
		 * @return boolean      success
		 */
		abstract protected function save ( $id, $name, $cache_id, $compile_id, $exp_time, $content );

		/**
		 * Lock cache for this template
		 * @param Smarty $smarty Smarty object
		 * @param Smarty_Template_Cached $cached cached object
		 * @return bool|void
		 */
		public function acquireLock ( Smarty $smarty, Smarty_Template_Cached $cached ) {
			$cached->is_locked = TRUE;
			$id                = $cached->lock_id;
			$name              = $cached->source->name . '.lock';
			$this->save ( $id, $name, $cached->cache_id, $cached->compile_id, $smarty->locking_timeout, '' );
		}

		/**
		 * Empty cache for a specific template
		 * @param  Smarty $smarty Smarty object
		 * @param  string $resource_name template name
		 * @param  string $cache_id cache id
		 * @param  string $compile_id compile id
		 * @param  integer $exp_time expiration time (number of seconds, not timestamp)
		 * @return integer number of cache files deleted
		 */
		public function clear ( Smarty $smarty, $resource_name, $cache_id, $compile_id, $exp_time ) {
			$this->cache = [ ];
			$cache_name  = NULL;

			if ( isset( $resource_name ) ) {
				$_save_stat      = $smarty->caching;
				$smarty->caching = TRUE;
				$tpl             = new $smarty->template_class( $resource_name, $smarty );
				$smarty->caching = $_save_stat;

				if ( $tpl->source->exists ) {
					$cache_name = $tpl->source->name;
				} else {
					return 0;
				}
				// remove from template cache
				if ( $smarty->allow_ambiguous_resources ) {
					$_templateId = $tpl->source->unique_resource . $tpl->cache_id . $tpl->compile_id;
				} else {
					$_templateId = $smarty->joined_template_dir . '#' . $resource_name . $tpl->cache_id . $tpl->compile_id;
				}
				if ( isset( $_templateId[ 150 ] ) ) {
					$_templateId = sha1 ( $_templateId );
				}
				unset( $smarty->template_objects[ $_templateId ] );
				// template object no longer needed
				unset( $tpl );
			}

			return $this->delete ( $cache_name, $cache_id, $compile_id, $exp_time );
		}

		/**
		 * Empty cache
		 * @param  Smarty $smarty Smarty object
		 * @param  integer $exp_time expiration time (number of seconds, not timestamp)
		 * @return integer number of cache files deleted
		 */
		public function clearAll ( Smarty $smarty, $exp_time = NULL ) {
			$this->cache = [ ];

			return $this->delete ( NULL, NULL, NULL, $exp_time );
		}

		/**
		 * Check is cache is locked for this template
		 * @param  Smarty $smarty Smarty object
		 * @param  Smarty_Template_Cached $cached cached object
		 * @return boolean               true or false if cache is locked
		 */
		public function hasLock ( Smarty $smarty, Smarty_Template_Cached $cached ) {
			$id   = $cached->lock_id;
			$name = $cached->source->name . '.lock';

			$mtime = $this->fetchTimestamp ( $id, $name, $cached->cache_id, $cached->compile_id );
			if ( $mtime === NULL ) {
				$this->fetch ( $id, $name, $cached->cache_id, $cached->compile_id, $content, $mtime );
			}

			return $mtime && ( $t = time () ) - $mtime < $smarty->locking_timeout;
		}

		/**
		 * populate Cached Object with meta data from Resource
		 * @param  Smarty_Template_Cached $cached cached object
		 * @param  Smarty_Internal_Template $_template template object
		 * @return void
		 */
		public function populate ( Smarty_Template_Cached $cached, Smarty_Internal_Template $_template ) {
			$_cache_id        = isset( $cached->cache_id ) ? preg_replace ( '![^\w\|]+!', '_', $cached->cache_id ) : NULL;
			$_compile_id      =
			isset( $cached->compile_id ) ? preg_replace ( '![^\w\|]+!', '_', $cached->compile_id ) : NULL;
			$path             = $cached->source->filepath . $_cache_id . $_compile_id;
			$cached->filepath = sha1 ( $path );
			if ( $_template->smarty->cache_locking ) {
				$cached->lock_id = sha1 ( 'lock.' . $path );
			}
			$this->populateTimestamp ( $cached );
		}

		/**
		 * populate Cached Object with timestamp and exists from Resource
		 * @param Smarty_Template_Cached $cached
		 * @return void
		 */
		public function populateTimestamp ( Smarty_Template_Cached $cached ) {
			$mtime =
			$this->fetchTimestamp ( $cached->filepath, $cached->source->name, $cached->cache_id, $cached->compile_id );
			if ( $mtime !== NULL ) {
				$cached->timestamp = $mtime;
				$cached->exists    = ! !$cached->timestamp;

				return;
			}
			$timestamp = NULL;
			$this->fetch ( $cached->filepath, $cached->source->name, $cached->cache_id, $cached->compile_id,
			$cached->content, $timestamp );
			$cached->timestamp = isset( $timestamp ) ? $timestamp : FALSE;
			$cached->exists    = ! !$cached->timestamp;
		}

		/**
		 * Read the cached template and process the header
		 * @param  Smarty_Internal_Template $_template template object
		 * @param  Smarty_Template_Cached $cached cached object
		 * @return boolean                 true or false if the cached content does not exist
		 */
		public function process ( Smarty_Internal_Template $_template, Smarty_Template_Cached $cached = NULL ) {
			if ( !$cached ) {
				$cached = $_template->cached;
			}
			$content   = $cached->content ? $cached->content : NULL;
			$timestamp = $cached->timestamp ? $cached->timestamp : NULL;
			if ( $content === NULL || !$timestamp ) {
				$this->fetch ( $_template->cached->filepath, $_template->source->name, $_template->cache_id,
				$_template->compile_id, $content, $timestamp );
			}
			if ( isset( $content ) ) {
				/** @var Smarty_Internal_Template $_smarty_tpl
				 * used in evaluated code
				 */
				$_smarty_tpl = $_template;
				eval( "?>" . $content );

				return TRUE;
			}

			return FALSE;
		}

		/**
		 * Unlock cache for this template
		 * @param Smarty $smarty Smarty object
		 * @param Smarty_Template_Cached $cached cached object
		 * @return bool|void
		 */
		public function releaseLock ( Smarty $smarty, Smarty_Template_Cached $cached ) {
			$cached->is_locked = FALSE;
			$name              = $cached->source->name . '.lock';
			$this->delete ( $name, $cached->cache_id, $cached->compile_id, NULL );
		}

		/**
		 * Write the rendered template output to cache
		 * @param  Smarty_Internal_Template $_template template object
		 * @param  string $content content to cache
		 * @return boolean                  success
		 */
		public function writeCachedContent ( Smarty_Internal_Template $_template, $content ) {
			return $this->save ( $_template->cached->filepath, $_template->source->name, $_template->cache_id,
			$_template->compile_id, $_template->properties[ 'cache_lifetime' ], $content );
		}

		/**
		 * Fetch cached content's modification timestamp from data source
		 * {@internal implementing this method is optional.
		 *  Only implement it if modification times can be accessed faster than loading the complete cached content.}}
		 * @param  string $id unique cache content identifier
		 * @param  string $name template name
		 * @param  string $cache_id cache id
		 * @param  string $compile_id compile id
		 * @return integer|boolean timestamp (epoch) the template was modified, or false if not found
		 */
		protected function fetchTimestamp ( $id, $name, $cache_id, $compile_id ) {
			return NULL;
		}

		/**
		 * Read cached template from cache
		 * @param  Smarty_Internal_Template $_template template object
		 * @return string  content
		 */
		public function readCachedContent ( Smarty_Internal_Template $_template ) {
			$content   = $_template->cached->content ? $_template->cached->content : NULL;
			$timestamp = NULL;
			if ( $content === NULL ) {
				$timestamp = NULL;
				$this->fetch ( $_template->cached->filepath, $_template->source->name, $_template->cache_id,
				$_template->compile_id, $content, $timestamp );
			}
			if ( isset( $content ) ) {
				return $content;
			}

			return FALSE;
		}
	}
