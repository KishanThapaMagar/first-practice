    <?php
   

   add_action('admin_init', 'appbokin_migrate_existing_appointments');

    add_action('wp_enqueue_scripts','kalkiautomation_enqueue_assets');
    function kalkiautomation_enqueue_assets()
    {
        wp_enqueue_style('kalki-custom',get_template_directory_uri().'/assets/css/custom.css');
        wp_enqueue_style('kalki-archive',get_template_directory_uri().'/assets/css/archive.css');
        wp_enqueue_style('kalki-single',get_template_directory_uri().'/assets/css/single.css');
        wp_enqueue_style('booking',get_template_directory_uri().'/assets/css/booking.css');
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
        wp_enqueue_script('custom-carousel-js', get_template_directory_uri() . '/assets/js/custom.js', array('swiper-js', 'jquery'), null, true);
        wp_enqueue_script('counter-script', get_template_directory_uri() .'/assets/js/counter.js',array('jquery'),'1.0.0', true);

    }
    function register_my_menus() {
        register_nav_menus([
            'menu1' => __('Main-Menu'),
        ]);
        add_theme_support('post-thumbnails');
    }
    add_action('after_setup_theme', 'register_my_menus');


// add image field in add form
function kalki_admin_style() {
    wp_enqueue_script('custom-category-js', get_template_directory_uri() . '/assets/js/imagecate.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'kalki_admin_style');

add_action('category_add_form_fields', 'zAddTexonomyField_custom');
function zAddTexonomyField_custom() {
    wp_enqueue_media();
    echo '<div class="form-field">
        <input type="hidden" name="zci_taxonomy_image_id" id="zci_taxonomy_image_id" value="" />
        <label for="zci_taxonomy_image">' . __('Image', 'categories-images') . '</label>
        <input type="text" name="zci_taxonomy_image" id="zci_taxonomy_image" value="" />
        <br/>
        <button class="z_upload_image_button button">' . __('Upload/Add image', 'categories-images') . '</button>
    </div>';
}

add_action('category_edit_form_fields', 'zEditTexonomyField_custom');
function zEditTexonomyField_custom($taxonomy) {
    wp_enqueue_media();
    $image_url = get_option('z_taxonomy_image' . $taxonomy->term_id, '');
    $image_id  = get_option('z_taxonomy_image_id' . $taxonomy->term_id, '');
    echo '<tr class="form-field">
        <th scope="row" valign="top"><label for="zci_taxonomy_image">' . __('Image', 'categories-images') . '</label></th>
        <td><input type="hidden" name="zci_taxonomy_image_id" id="zci_taxonomy_image_id" value="' . esc_attr($image_id) . '" />
        <img class="zci-taxonomy-image" src="' . esc_url($image_url) . '" style="max-width: 150px;"/><br/>
        <input type="text" name="zci_taxonomy_image" id="zci_taxonomy_image" value="' . esc_url($image_url) . '" /><br />
        <button class="z_upload_image_button button">' . __('Upload/Add image', 'categories-images') . '</button>
        <button class="z_remove_image_button button">' . __('Remove image', 'categories-images') . '</button>
        </td>
    </tr>';
}

function zSaveTaxonomyImage($term_id) {
    if (isset($_POST['zci_taxonomy_image'])) {
        update_option('z_taxonomy_image' . $term_id, sanitize_text_field($_POST['zci_taxonomy_image']), false);
    }
    if (isset($_POST['zci_taxonomy_image_id'])) {
        update_option('z_taxonomy_image_id' . $term_id, intval($_POST['zci_taxonomy_image_id']), false);
    }
}
add_action('edited_category', 'zSaveTaxonomyImage', 10, 2);
add_action('create_category', 'zSaveTaxonomyImage', 10, 2);

function zGetAttachmentIdByUrl($image_src) {
    global $wpdb;
    $query = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid = %s", $image_src);
    $id = $wpdb->get_var($query);              
    return (!empty($id)) ? $id : null;
}

 //from here the custom post type  begin
 function appbokin_register_appointment_cpt() {
    $labels = array(
        'name'               => __('Appointments', 'appbokin'),
        'singular_name'      => __('Appointment', 'appbokin'),
        'menu_name'          => __('Appointments', 'appbokin'),
        'add_new'            => __('Add Appointment', 'appbokin'),
        'add_new_item'       => __('Add New Appointment', 'appbokin'),
        'edit_item'          => __('Edit Appointment', 'appbokin'),
        'new_item'           => __('New Appointment', 'appbokin'),
        'view_item'          => __('View Appointment', 'appbokin'),
        'search_items'       => __('Search Appointments', 'appbokin'),
        'not_found'          => __('No appointments found', 'appbokin'),
        'not_found_in_trash' => __('No appointments found in Trash', 'appbokin'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-calendar',
        'supports'           => array('title', 'custom-fields'),
        'capability_type'    => 'post',
        'has_archive'        => false,
    );

    register_post_type('appointment', $args);
}
add_action('init', 'appbokin_register_appointment_cpt');
function appbokin_add_appointment_metabox() {
    add_meta_box(
        'appointment_details',
        __('Appointment Details', 'appbokin'),
        'appbokin_appointment_metabox_callback',
        'appointment',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'appbokin_add_appointment_metabox');

function appbokin_appointment_metabox_callback($post) {
    $email = get_post_meta($post->ID, 'email', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $date = get_post_meta($post->ID, 'date', true);
    $time = get_post_meta($post->ID, 'time', true);
    $service = get_post_meta($post->ID, 'service', true);

    wp_nonce_field('save_appointment_details', 'appointment_nonce');

    echo '<label>Email:</label><br>';
    echo '<input type="email" name="email" value="' . esc_attr($email) . '" style="width:100%;" /><br><br>';

    echo '<label>Phone:</label><br>';
    echo '<input type="text" name="phone" value="' . esc_attr($phone) . '" style="width:100%;" /><br><br>';

    echo '<label>Date:</label><br>';
    echo '<input type="date" name="date" value="' . esc_attr($date) . '" style="width:100%;" /><br><br>';

    echo '<label>Time:</label><br>';
    echo '<input type="time" name="time" value="' . esc_attr($time) . '" style="width:100%;" /><br><br>';

    echo '<label>Service:</label><br>';
    echo '<input type="text" name="service" value="' . esc_attr($service) . '" style="width:100%;" /><br>';
}

function appbokin_save_appointment_details($post_id) {
    if (!isset($_POST['appointment_nonce']) || !wp_verify_nonce($_POST['appointment_nonce'], 'save_appointment_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['email'])) {
        update_post_meta($post_id, 'email', sanitize_email($_POST['email']));
    }
    if (isset($_POST['phone'])) {
        update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
    }
    if (isset($_POST['date'])) {
        update_post_meta($post_id, 'date', sanitize_text_field($_POST['date']));
    }
    if (isset($_POST['time'])) {
        update_post_meta($post_id, 'time', sanitize_text_field($_POST['time']));
    }
    if (isset($_POST['service'])) {
        update_post_meta($post_id, 'service', sanitize_text_field($_POST['service']));
    }
}
add_action('save_post', 'appbokin_save_appointment_details');
function appbokin_set_custom_columns($columns) {
    $columns['email'] = __('Email', 'appbokin');
    $columns['phone'] = __('Phone', 'appbokin');
    $columns['date'] = __('Date', 'appbokin');
    $columns['time'] = __('Time', 'appbokin');
    $columns['service'] = __('Service', 'appbokin');
    return $columns;
}
add_filter('manage_appointment_posts_columns', 'appbokin_set_custom_columns');

function appbokin_custom_column_data($column, $post_id) {
    switch ($column) {
        case 'email':
            echo get_post_meta($post_id, 'email', true);
            break;
        case 'phone':
            echo get_post_meta($post_id, 'phone', true);
            break;
        case 'date':
            echo get_post_meta($post_id, 'date', true);
            break;
        case 'time':
            echo get_post_meta($post_id, 'time', true);
            break;
        case 'service':
            echo get_post_meta($post_id, 'service', true);
            break;
    }
}
add_action('manage_appointment_posts_custom_column', 'appbokin_custom_column_data', 10, 2);
function appbokin_migrate_existing_appointments() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'appointments'; // Adjust this if your table name is different

    // Fetch all appointments from the database
    $appointments = $wpdb->get_results("SELECT * FROM $table_name");

    foreach ($appointments as $appointment) {
        // Check if this appointment is already migrated (avoid duplicates)
        $existing_post = get_posts([
            'post_type'  => 'appointment',
            'meta_query' => [
                [
                    'key'   => 'email',
                    'value' => $appointment->email,
                ],
                [
                    'key'   => 'date',
                    'value' => $appointment->date,
                ],
            ],
        ]);

        if ($existing_post) {
            continue; // Skip if appointment already exists
        }

        // Insert new appointment as a post
        $post_id = wp_insert_post([
            'post_title'   => $appointment->name ?: 'Appointment',
            'post_type'    => 'appointment',
            'post_status'  => 'publish',
        ]);

        if ($post_id) {
            // Add appointment metadata
            update_post_meta($post_id, 'email', sanitize_email($appointment->email));
            update_post_meta($post_id, 'phone', sanitize_text_field($appointment->phone));
            update_post_meta($post_id, 'date', sanitize_text_field($appointment->date));
            update_post_meta($post_id, 'time', sanitize_text_field($appointment->time));
            update_post_meta($post_id, 'service', sanitize_text_field($appointment->service));
            update_post_meta($post_id, 'status', sanitize_text_field($appointment->status));
        }
    }

    echo "Appointments migrated successfully!";
}
