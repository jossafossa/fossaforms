<?php 

function ff_form($form_id) {
  $form = FF_Forms::get_data($form_id);

}

function ff_get_form_data($form_id) {
  return FF_Forms::get_data($form_id);
}

function ff_get_field_attributes($field) {
  return FF_Forms::get_field_attributes($field);

}
?>
