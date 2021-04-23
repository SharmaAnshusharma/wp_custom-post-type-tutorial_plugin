<?php
/*
Plugin Name: Custom Post Type
Plugin URL:
Description:
Author: Anshu Sharma
version:1.1
*/
function create_custom_post_type_Tutorial()
{
	$args = array(
		'public'=>true,
		'label'=>"Tutorial"
	);
	register_post_type('Tutorial',$args);
}
add_action('init','create_custom_post_type_Tutorial');

   function create_metabox_author_for_tutorial()
   {
   		add_meta_box('author_id','Aauthor','callback_function','Tutorial','side','high');
   }
	add_action('add_meta_boxes','create_metabox_author_for_tutorial');

function callback_function($post)
{
	$author_name = get_post_meta($post->ID,'Author',true);
	?>
	<input type="text" name="author_name" value="<?php echo $author_name; ?>" ><br> 
	<?php
}



function to_save_metabox_tutorial_author_value($post_id,$post)
{
	$author_name = (isset($_POST['author_name']))?$_POST['author_name'] : "";

	update_post_meta($post_id,'Author',$author_name);
}
add_action('save_post','to_save_metabox_tutorial_author_value',2,10);

/*Register a taxonomy*/

function create_custome_taxonomy_for_Tutorial()
{
	$args = array(
		'hierarchical'=> true, 
		'label'=>'Categories'
	);
	register_taxonomy( 'Categories', [ 'Tutorial' ], $args );
}
add_action('init','create_custome_taxonomy_for_Tutorial');


?>