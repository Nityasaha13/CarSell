<?php
/*
Plugin Name: Appycodes Leads
Description: Custom plugin for lead management.
Version: 1.0
Author: Your Name
*/

// Plugin activation, deactivation, and uninstall hooks
register_activation_hook(__FILE__, 'appycodes_leads_activate');
register_deactivation_hook(__FILE__, 'appycodes_leads_deactivate');
register_uninstall_hook(__FILE__, 'appycodes_leads_uninstall');

// Activation callback
function appycodes_leads_activate()
{
    // Create the database table
    global $wpdb;
    $table_name = $wpdb->prefix . 'appycodes_leads';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name text NOT NULL,
        email text NOT NULL,
        date_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        PRIMARY KEY  (id)
    )";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Deactivation callback
function appycodes_leads_deactivate()
{
    // Nothing to do here to preserve data on deactivation
}

// Uninstall callback
function appycodes_leads_uninstall()
{
    // Delete the database table and data when the plugin is deleted
    global $wpdb;
    $table_name = $wpdb->prefix . 'appycodes_leads';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

// Add the form to the 'about' page
function appycodes_leads_display_form()
{
    // Your form HTML here
?>
    <form id="appycodes-leads-form" method="post" action="">
        <p><input type="text" name="name" id="name" placeholder="Name" required></p>
        <p><input type="email" name="email" id="email" placeholder="Email" required></p>
        <p><input type="text" name="usermessage" id="usermessage" placeholder="Type your message here" required></p>
        <input type="submit" id="submit-button" value="Submit">
        <div id="message" style="display: none;"></div>
    </form>

<?php
}

// Add a menu to the WordPress admin panel
function appycodes_leads_menu()
{
    add_menu_page(
        'Appycodes Leads',
        'Appycodes Leads',
        'manage_options',
        'appycodes-leads',
        'appycodes_leads_admin_page'
    );
    add_submenu_page(
        'appycodes-leads', // Use the parent menu slug here
        'Settings',
        'AppyCodes Settings', // Updated submenu title
        'manage_options',
        'appycodes-leads-settings', // Updated submenu slug
        'appycodes_leads_settings_cbpage'
    );
}
add_action('admin_menu', 'appycodes_leads_menu');

function appycodes_leads_settings_cbpage()
{
?>
    <div class="wrap">
        <h2>Appycodes Leads Plugin Settings</h2>

        <form method="post" action="options.php">
            <?php settings_fields('custom-plugin-settings-group'); ?>
            <?php do_settings_sections('custom-plugin-settings-group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Email Notifications</th>
                    <td>
                        <label class="switch">
                            <input type="checkbox" name="custom_plugin_email_notifications" value="1" <?php checked(1, get_option('custom_plugin_email_notifications', 0)); ?> />
                            <span class="slider round"></span>
                        </label>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>

<?php

}

function custom_plugin_register_settings()
{
    register_setting('custom-plugin-settings-group', 'custom_plugin_email_notifications');
}
add_action('admin_init', 'custom_plugin_register_settings');

// Admin page callback
function appycodes_leads_admin_page()
{
    // Display the data from the database table here
    global $wpdb;
    $table_name = $wpdb->prefix . 'appycodes_leads';

    $date_filter = isset($_POST['date_filter']) ? sanitize_text_field($_POST['date_filter']) : '';
?>

    <div class="wrap">
        <h2>Appycodes Leads</h2>
        <p>
        <form action="" method="post">
            <input type="date" name="date_filter" value="' . esc_attr($date_filter) . '">
            <input type="submit" name="apply_filter" value="Filter" class="button-primary">
            <button id="export" name="export" class="button-primary">Export in CSV </button>
        </form>
        </p>

        <?php

        if (isset($_POST['apply_filter']) && !empty($date_filter)) {

            $query = "SELECT * FROM $table_name WHERE DATE(date_time) = '$date_filter'";
        } else {

            $query = "SELECT * FROM $table_name";
        }

        $leads = $wpdb->get_results($query);
        ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date/Time</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($leads as $lead) {
                    echo "<tr><td>{$lead->id}</td><td>{$lead->name}</td><td>{$lead->email}</td><td>{$lead->date_time}</td><td>{$lead->usermessage}</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php
}

function appycodes_leads_submit()
{
    if ($_POST['formData']) {
        $form_data = $_POST['formData'];
        global $wpdb;

        $table_name = $wpdb->prefix . 'appycodes_leads';
        $name = $form_data['name'];
        $email = $form_data['email'];
        $usermessage = $form_data['usermessage'];
        $date_time = current_time('mysql');
        //if user exists
        $existing_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));
        if (!$existing_user) {
            $wpdb->insert(
                $table_name,
                array(
                    'name' => $name,
                    'email' => $email,
                    'date_time' => $date_time,
                    'usermessage' => $usermessage,
                )
            );
            $email_notifications_enabled = get_option('custom_plugin_email_notifications', 0);
            if ($email_notifications_enabled) {
                wp_mail('ka0967711@gmail.com', 'New Lead', "Name: $name\nEmail: $email");
                wp_mail($email, 'Thank You for Your Submission', 'Your message has been received.');
            }
            echo 'Success';
            wp_die();
        } else {
            echo "UserExists";
            wp_die();
        }
    }
}
add_action('wp_ajax_appycodes_leads_submit', 'appycodes_leads_submit');
add_action('wp_ajax_nopriv_appycodes_leads_submit', 'appycodes_leads_submit');


function appycodes_leads_export_csv()
{

    global $wpdb;
    $table_name = $wpdb->prefix . 'appycodes_leads';
    $data = $wpdb->get_results("SELECT * FROM $table_name");

    if ($data) {

        $csv_content = "id,name,email,date_time,usermessage\n";
        foreach ($data as $row) {
            $csv_content .= "{$row->id},{$row->name},{$row->email},{$row->date_time},{$row->usermessage}\n";}

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=appycodes_leads.csv');

        echo $csv_content;
        exit;
    }
}

add_action('wp_ajax_appycodes_leads_export_csv', 'appycodes_leads_export_csv');
add_action('wp_ajax_nopriv_appycodes_leads_export_csv', 'appycodes_leads_export_csv');

?>