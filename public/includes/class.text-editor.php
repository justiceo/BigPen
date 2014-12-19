<?php

/*
*
*	Class responsible for building the template redirect
*
*/
class aesopEditorTextEditor {

	function __construct() {

		add_action( 'wp_footer', array($this,'editor_nav'));

	}

	function editor_nav( ) {

		?><nav style="z-index:999;position:fixed;bottom:20px;right:2=80px;" >
			<a href="#" id="aesop-editor--edit" class="aesop-editor--button__primary">edit</a>
			<a href="#" data-post-id="<?php echo get_the_ID();?>" id="aesop-editor--save" class="aesop-editor--button aesop-editor--button__success">save</a>
		</nav><?php

	}
}
new aesopEditorTextEditor;