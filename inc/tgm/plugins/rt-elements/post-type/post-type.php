<?php 
/** Added all post type
*/
class RT_Elements_Post_Type{
	public function __construct(){
		$this->load_post_type();
	}
	public function load_post_type(){			
		require plugin_dir_path( __FILE__ ). '/canvas-content.php';			
	}	
}
new RT_Elements_Post_Type();