    <?php
    /*
    * Template Name: My Account
    */

    get_header();
    ?>
    

    <div class="woocommerce-account-container">
    <?php if (!is_user_logged_in()) : ?>
        <!-- LOGIN & REGISTER FORM -->
        <div class="woocommerce-login-register">
            <?php if (isset($_GET['action']) && $_GET['action'] === 'register') : ?>
                <div class="register-section">
                    <h2><?php esc_html_e('Register', 'woocommerce'); ?></h2>
                    <form method="post" class="woocommerce-form woocommerce-form-register register">
                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                        <?php do_action('woocommerce_register_form_start'); ?>
                        
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                            <input type="text" name="username" id="reg_username" autocomplete="username" required />
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_email"><?php esc_html_e('Email Address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                            <input type="email" name="email" id="reg_email" autocomplete="email" required />
                        </p>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                            <input type="password" name="password" id="reg_password" autocomplete="new-password" required />
                        </p>

                        <?php do_action('woocommerce_register_form'); ?>

                        <p class="woocommerce-form-row form-row">
                            <button type="submit" class="woocommerce-button button woocommerce-form-register__submit" name="register">
                                <?php esc_html_e('Register', 'woocommerce'); ?>
                            </button>
                        </p>

                        <?php do_action('woocommerce_register_form_end'); ?>
                    </form>

                    <p style="text-align: center; margin-top: 10px;">
                        Already have an account? <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">Login Here</a>
                    </p>
                </div>
            <?php else : ?>
                <div class="login-section">
                    <h2><?php esc_html_e('Login', 'woocommerce'); ?></h2>
                    <?php woocommerce_login_form(); ?>

                    <p style="text-align: center; margin-top: 10px;">
                        New to our site? <a href="<?php echo esc_url(wc_get_page_permalink('myaccount') . '?action=register'); ?>">Register Here</a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
        <?php else : ?>
        <!-- LOGGED-IN USER ACCOUNT DASHBOARD -->
                 <aside class="woocommerce-account-sidebar">
                    <ul>
                        <li class="<?php echo (is_wc_endpoint_url('dashboard') || !is_wc_endpoint_url()) ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('dashboard')); ?>">
                                <i class="dashicons dashicons-dashboard"></i>
                                <?php esc_html_e('Dashboard', 'woocommerce'); ?>
                            </a>
                        </li>
                        <li class="<?php echo is_wc_endpoint_url('orders') ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>">
                                <i class="dashicons dashicons-cart"></i>
                                <?php esc_html_e('Orders', 'woocommerce'); ?>
                            </a>
                        </li>
                        <li class="<?php echo is_wc_endpoint_url('downloads') ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('downloads')); ?>">
                                <i class="dashicons dashicons-download"></i>
                                <?php esc_html_e('Downloads', 'woocommerce'); ?>
                            </a>
                        </li>
                        <li class="<?php echo is_wc_endpoint_url('edit-account') ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>">
                                <i class="dashicons dashicons-admin-users"></i>
                                <?php esc_html_e('Account_Details', 'woocommerce'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(wc_logout_url()); ?>">
                                <i class="dashicons dashicons-external"></i>
                                <?php esc_html_e('Logout', 'woocommerce'); ?>
                            </a>
                        </li>
                    </ul>
                </aside>
                <section class="woocommerce-account-content">
                    <?php
                    do_action('woocommerce_account_content');
                   ?>
                   

                </section>
       
        
        <?php endif;
         ?>
    </div>
    <?php
    get_footer();
    ?>
