<?php
/* Template Name: Login Page */

get_header();

if (is_user_logged_in()) {
?>
    <meta http-equiv="refresh" content="0;url=<?php echo home_url('/user-dashboard/'); ?>">
<?php
}
?>
    <div class="container">
        <h1>Login</h1>
        <form id="user-loginForm" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="btn-container">
                <input type="submit" id="submit-button" value="Submit">
            </div>
            <div id="message" style="display: none;"></div>
        </form>
        <div class="switch-form">
            <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Forgot password?</a><br>
            Don't have an account? <a href="<?php echo esc_url(home_url('/signup/')); ?>">Sign up</a>
        </div>
    </div>


<?php
get_footer();
?>