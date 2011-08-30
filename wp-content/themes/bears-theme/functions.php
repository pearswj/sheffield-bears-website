<?php
function bears_excerpt_length( $length ) {
	return 33;
}
add_filter( 'excerpt_length', 'bears_excerpt_length');

function new_excerpt_more($more) {
	return '[.....]';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>
