<?php
/*
Plugin Name: Standard Require Login
Plugin URI: https://github.com/eightbit/plugins/tree/master/standard-require-login
Description: Requires that users be logged in before they can view any part of the site.
Version: 1.0
Author: Michael Novotny
Author URI: http://manovotny.com
Author Email: manovotny@gmail.com
License: GNU General Public License v3.0 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/


/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\

    1. Constructor
    2. Actions
    3. Instantiation

/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\/\/\/\/\/\/\
*/


class Standard_Require_Login {

    /* Constructor
    ---------------------------------------------------------------------------------- */

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct() {

        // Add template redirect action.
        add_action( 'template_redirect', array( $this, 'standard_require_login_check' ) );
        add_filter( 'redirect_user_to_login_screen', array( $this, 'is_user_not_logged_in' ), 10, 1 );

    } // end constructor


    /* Actions
    ---------------------------------------------------------------------------------- */

    /**
     * Checks if user is logged in or not.
     *
     * It will redirect the user to the login screen if they are not logged in. Upon
     * successful login, it will take them back to the URL they were trying to access.
     */
    public function standard_require_login_check() {

        // Check if we should redirect to the login page.
        if ( apply_filters( 'redirect_user_to_login_screen', true ) ) {
            auth_redirect();
        }

    } // end standard_require_login_check

    /**
     * Filtering function applied to `redirect_user_to_login_screen`.
     *
     * @param  boolean $require_login Whether login should be required on this page request.
     * @return boolean                If user is not logged in, require login.
     */
    public function is_user_not_logged_in( $require_login ) {
        $require_login = ! is_user_logged_in();
        return $require_login;
    }

} // end class


/* Instantiation
---------------------------------------------------------------------------------- */

new Standard_Require_Login();


?>