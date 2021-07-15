<?php
/**
 * Shortcode class for displaying a single student
 */
class Ob_Student_Shortcode {

	public function __construct() {
		add_shortcode( 'student', array( $this, 'ob_student_shortcode' ) );
	}

	/**
	 * Shortcode logic
	 *
	 * @param string $atts are all the attributes used in the function.
	 * @return void
	 */
	public function ob_student_shortcode( $atts ) {

		// Adds student_id as attribute.
		$attribute = shortcode_atts( array( 'student_id' => 'placeholder' ), $atts );

		// Checks if the attribute is numeric.
		$student_id_checker = intval( $attribute['student_id'] );
		if ( ! $student_id_checker ) {
			return 'Student ID must be numeric';
		}

		// Stores the info needed for the query (p = post ID).
		$post_info = array(
			'post_type' => 'student',
			'p'         => $student_id_checker,
		);

		// Query to get the student info based on the post_info.
		$student_query = new WP_Query( $post_info );

		// Returns the content of the student if it exists.
		if ( ! $student_query->have_posts() ) {
			return 'No student found';
		} else {
			$student_query->the_post();?>
			<div style="width:300px;">
			<h4 style="text-align: center; padding:5px;"><?php the_title(); ?></h4>
			<?php
			the_post_thumbnail( 'thumbnail' );
			?>
			<h4 style="text-align: center; padding:5px;">Student is: <?php echo get_post_meta( get_the_ID(), '_student_class_value_key' )[0]; ?></h4>
			</div>
			<?php
		}
	}
}

$ob_student_shortcode = new Ob_Student_Shortcode();
