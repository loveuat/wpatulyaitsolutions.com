<?php
class Digio_List_Table extends WP_List_Table {

    public function get_columns() {
        return [
            'entry_id'   => 'Entry ID',
            'name'       => 'Client Name',
            'digio_doc_id'       => 'Document ID',
            'phone'      => 'Phone',
            'status'     => 'Status',
            'digio_updated_at' => 'Date',
            'actions'    => 'Actions'
        ];
    }

    public function prepare_items() {
    global $wpdb;

    $per_page     = 20;
    $current_page = $this->get_pagenum();
    $offset       = ($current_page - 1) * $per_page;

    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

    // 🔎 Search condition
    $search_sql = '';
    if ($search) {
        $search_sql = $wpdb->prepare(
            " AND id IN (
                SELECT entry_id FROM {$wpdb->prefix}frmt_form_entry_meta
                WHERE meta_value LIKE %s
            )",
            '%' . $wpdb->esc_like($search) . '%'
        );
    }
     $selected_form_id = function_exists('carbon_get_theme_option') 
        ? carbon_get_theme_option('selected_forminator_form') 
        : '';
    // sanitize
    $selected_form_id = intval($selected_form_id);
    // 🔢 Total count
    $total_items = $wpdb->get_var("
        SELECT COUNT(*) FROM {$wpdb->prefix}frmt_form_entry
        WHERE form_id = $selected_form_id {$search_sql}
    ");

    // 📄 Fetch paginated entries
    $entries = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT e.* FROM {$wpdb->prefix}frmt_form_entry e INNER JOIN {$wpdb->prefix}frmt_form_entry_meta m ON e.entry_id = m.entry_id WHERE e.form_id = %d AND m.meta_key = %s AND m.meta_value IS NOT NULL AND m.meta_value != '' {$search_sql} ORDER BY e.entry_id DESC LIMIT %d OFFSET %d", $selected_form_id, 'digio_doc_id', $per_page, $offset));

    $data = [];

    foreach ($entries as $entry) {
        $meta = $wpdb->get_results($wpdb->prepare(
            "SELECT meta_key, meta_value
             FROM {$wpdb->prefix}frmt_form_entry_meta
             WHERE entry_id = %d",
            $entry->entry_id
        ), OBJECT_K);

        $data[] = [
            'entry_id'   => $entry->entry_id,
            'name'       => $meta['name-1']->meta_value ?? '',
            'digio_doc_id' =>$meta['digio_doc_id']->meta_value ?? 'Failed by some reason',
            'phone'      => $meta['phone-1']->meta_value ?? '',
            'status'     => $meta['agreement_status']->meta_value ?? 'pending',
            'digio_updated_at' => $meta['digio_updated_at']->meta_value ?? '',
            'actions'    => $meta['digio_doc_id']->meta_value,
        ];
    }

    $this->items = $data;

    // 📌 Pagination
    $this->set_pagination_args([
        'total_items' => $total_items,
        'per_page'    => $per_page,
        'total_pages' => ceil($total_items / $per_page),
    ]);

    $this->_column_headers = [$this->get_columns(), [], []];
}


    public function column_actions($entry_id) {
        //$entry_id = $entry_id['digio_doc_id'];
        $entry_id = $entry_id['entry_id'];
        return sprintf(
            '<button class="button digio-details" data-id="%s">Details</button>
             <a class="button button-primary" href="%s">Download</a>',
            $entry_id,
            admin_url("admin-ajax.php?action=digio_download&entry_id=$entry_id")
        );
    }

    public function column_default($item, $column_name) {
        return $item[$column_name] ?? '';
    }
}