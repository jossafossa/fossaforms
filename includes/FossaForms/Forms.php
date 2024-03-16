<?php

class FF_Forms {

  public static function get_mock() {
    return [
      "id" => 1,
      "name" => "Test form",
      "fields" => [
        [
          "id" => 1,
          "label" => "Name",
          "name" => "name",
          "type" => "text",
          "required" => true
        ],
        [
          "id" => 2,
          "label" => "Email",
          "name" => "email",
          "type" => "email",
          "required" => true
        ],
        [
          "id" => 3,
          "label" => "Phone",
          "name" => "phone",
          "type" => "phone",
          "required" => false
        ]
      ]
    ];
  }

  public static function render_form($form_id) {
    $form = self::get_data($form_id);

    // bail if form not found
    if (!$form) {
      return "Form not found";
    }

    $fields = $form["fields"] ?? [];

    $fields_html = [];
    foreach ($fields as $field) {
      $type = $field['type'];
      $field_html = apply_filters("ff_form_field_{$type}_html", '', $form);
      $field_html = apply_filters('ff_form_field_html', $field_html, $form);
      $fields_html[] = $field_html;
    }

    $field_html = implode("", $field_html);
  }

  public static function get_data($form_id) {
    $data = self::get_mock();

    $data = apply_filters('ff_form', $data, $form_id);

    foreach ($data['fields'] as $key => $field) {
      $type = $field['type'];
      $data['fields'][$key] = apply_filters("ff_form_field_{$type}", $field, $form_id);
      $data['fields'][$key] = apply_filters('ff_form_field', $field, $form_id);
    }

    $data['fields'] = apply_filters('ff_form_fields', $data['fields'], $form_id);
  }

  public function get_field_attributes($field) {
    $attrs = [
      "name" => $field['name'] ?? null,
      "id" => join("_", ["field", $field['id']]),
      "required" => $field['required'] ? "required" : null,
    ];

    $attrs = array_map(function($value) {
      return $value ? "{$key}='{$value}'" : null;
    }, $attrs);

    $type = $field['type'];
    $attrs = apply_filters("ff_form_field_{$type}_attributes", $attrs, $field);
    $attrs = apply_filters('ff_form_field_attributes', $attrs, $field);

    // filter out empty
    $attrs = array_filter($attrs);

    return $attrs;
  }

}
