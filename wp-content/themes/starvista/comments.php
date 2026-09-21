<?php
/**
 * Comments fallback — comments are optional for this newsroom demo.
 *
 * @package StarVista
 */

if ( post_password_required() ) {
	return;
}
