<?php
echo '<script>console.log("it works")</script>';
class Ob_MetaBox {
 
	public function __construct( $id, $label, $key, $html, $field_name ) {
		$this->id         = $id;
		$this->label      = $label;
		$this->key        = $key;
		$this->html       = $html;
		$this->field_name = $field_name;
		add_action( 'add_meta_boxes', array( $this, 'create_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ) );
	}
 
	public function create_meta_box() {
		add_meta_box( $this->id, $this->label, array( $this, 'metabox_html' ), [ 'student'] );
	}
	public function metabox_html( $post ) {
		$value = get_post_meta( $post->ID, $this->key, true );
		$this->html = str_replace( 'insert', esc_attr( $value ), $this->html );
 
		echo $this->html;
 
	}
	public function save_metabox( $post_id ) {
		if ( isset( $_POST[ $this->field_name ] ) ) {
			$meta_value = sanitize_text_field( $_POST[ $this->field_name ] );
			update_post_meta( $post_id, $this->key, $meta_value );
		}
	}
}

$ob_location_id           = 'student_location';
$ob_location_label        = 'Student location';
$ob_location_key          = '_student_location_value_key';
$ob_location_html         = '
							<label for="ob_student_location_field">Lives In (Country, City): </label>
							<input type="text" id="ob_student_location_field" name="ob_student_location_field" value="insert" </input>
							';
$ob_location_field_name   = 'ob_student_location_field';

new Ob_MetaBox( $ob_location_id, $ob_location_label, $ob_location_key, $ob_location_html, $ob_location_field_name );

$ob_address_id            = 'student_address';
$ob_address_label         = 'Student address';
$ob_address_key           = '_student_address_value_key';
$ob_address_html          = '
							<label for="ob_student_address_field">Address: </label>
							<input type="text" id="ob_student_address_field" name="ob_student_address_field" value="insert" </input>
							';
$ob_address_field_name    = 'ob_student_address_field';

new Ob_MetaBox( $ob_address_id, $ob_address_label, $ob_address_key, $ob_address_html, $ob_address_field_name );

$ob_birth_date_id         = 'student_birth_date';
$ob_birth_date_label      = 'Student birth date';
$ob_birth_date_key        = '_student_birth_date_value_key';
$ob_birth_date_html       = '
							<label for="ob_student_birth_date_field">Birth date: </label>
							<input type="date" id="ob_student_birth_date_field" name="ob_student_birth_date_field" value="insert" </input>
							';
$ob_birth_date_field_name = 'ob_student_birth_date_field';

new Ob_MetaBox( $ob_birth_date_id, $ob_birth_date_label, $ob_birth_date_key, $ob_birth_date_html, $ob_birth_date_field_name );

$ob_grade_id              = 'student_class';
$ob_grade_label           = 'Student class';
$ob_grade_key             = '_student_class_value_key';
$ob_grade_html            = '
							<label for="ob_student_class_field">Class / Grade: </label>
							<input type="text" id="ob_student_class_field" name="ob_student_class_field" value="insert" </input>
							';
$ob_grade_field_name      = 'ob_student_class_field';

new Ob_MetaBox( $ob_grade_id, $ob_grade_label, $ob_grade_key, $ob_grade_html,$ob_grade_field_name );