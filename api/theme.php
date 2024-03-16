<?php 

add_filter('ff_form_field_text', function($field, $form_id) {
  $attrs = ff_get_field_attributes($field);
  $field_id = $attrs['id'] ?? '';
  $field_name = $attrs['name'] ?? '';
  $required = $attrs['required'] ?? '';
  $field_type = $field['type'] ?? '';

  return "<input $field_type $field_name $field_id $required>";
}, 10, 2);


?>
