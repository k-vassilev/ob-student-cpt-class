<?php
class Custom_Post_Type {
 
	public function __construct() {
		add_action( 'init', array( $this, 'ob_student_post_type' ) );
		add_action( 'init', array( $this, 'ob_enrolment_taxonomy' ) );
		add_action( 'manage_student_posts_columns', array( $this, 'ob_student_custom_column_head' ) );
		add_action( 'manage_student_posts_custom_column', array( $this, 'ob_student_custom_column_data' ),10 , 2 );
		add_action( 'wp_ajax_checkbox', array( $this, 'checkbox' ) );
	}

	/**
 	* Creates the student post type
 	*
 	* @return void
 	*/
	public function ob_student_post_type() {

		$args = array(
			'labels'      => array(
				'name'          => 'Students',
				'singular_name' => 'student',
			),
			'public'      => true,
			'has_archive' => true,
			'menu_icon'   => 'dashicons-universal-access',
			'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt', 'catecogy', 'content' ),
		);

		register_post_type( 'student', $args );
	}

	/**
 	* Adds enrolment taxonomy
 	*
 	* @return void
 	*/
	public function ob_enrolment_taxonomy() {

		$args = array(
			'labels'       => array(
				'name'          => 'Subjects',
				'singular_name' => 'Subject',
			),
			'public'       => true,
			'hierarchical' => true, // true for category, false for tag.
		);
		register_taxonomy( 'subjects', array( 'student' ), $args );
	}

	/**
 	* Tackles the "header" of the column
 	*
 	* @param object $columns is the custom enable/disable column.
 	* @return void
 	*/
	public function ob_student_custom_column_head( $columns ) {
		// $columns contains all currently available columns (Default).
		$columns['enable_student'] = 'Active Student'; // Adding to all currently present.
		return $columns;
	}

	/**
 	* Checks if the status of a given student is active or not (true or false)
 	*
 	* @param object $column is the custom enable/disable column.
 	* @param object $post_id is the id of the WordPress post.
 	* @return void
 	*/
	public function ob_student_custom_column_data( $column, $post_id ) {
		$current_status = get_post_meta( $post_id, '_is_active_student', true );
		switch ( $column ) {
			case 'enable_student':
				?>
				<input type="checkbox" name="activeStudent" id="activeStudent_<?php echo $post_id; ?>" 
				<?php
				if (
					'true' === $current_status ) {
					echo 'checked'; }
				?>
					>
				<?php
		}
	}

	/**
 	* AJAX handler
 	*
 	* @return void
 	*/
	public function checkbox() {
		$checkbox_value = sanitize_text_field( $_POST['isActive'] );
		$student_id = $_POST['studentId'];
		update_post_meta( $student_id, '_is_active_student', $checkbox_value );
	
		echo (wp_send_json_success( $checkbox_value, $student_id ));
	}
}
 
$ob_custom_post_type = new Custom_Post_Type();
 