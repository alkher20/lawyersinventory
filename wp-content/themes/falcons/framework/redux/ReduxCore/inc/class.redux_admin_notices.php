<?php

    /**
     * Redux Framework Admin Notice Class
     * Makes instantiating a Redux object an absolute piece of cake.
     *
     * @package     Redux_Framework
     * @author      Kevin Provance
     * @author      Dovy Paukstys
     * @subpackage  Core
     */

    // Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    // Don't duplicate me!
    if ( ! class_exists( 'Redux_Admin_Notices' ) ) {

        /**
         * Redux API Class
         * Simple API for Redux Framework
         *
         * @since       1.0.0
         */
        class Redux_Admin_Notices {

            static public $_parent;

            public static function load() {
                add_action( 'wp_ajax_redux_hide_admin_notice', array(
                    'Redux_Admin_Notices',
                    'dismissAdminNoticeAJAX'
                ) );
            }

            /**
             * adminNotices - Evaluates user dismiss option for displaying admin notices
             *
             * @since       3.2.0
             * @access      public
             * @return      void
             */
            public static function adminNotices( $notices = array() ) {
                global $current_user, $pagenow;

                // Check for an active admin notice array
                if ( ! empty( $notices ) ) {

                    // Enum admin notices
                    foreach ( $notices as $notice ) {

                        $add_style = '';
                        if ( strpos( $notice['type'], 'redux-message' ) != false ) {
                            $add_style = 'style="border-left: 4px solid ' . esc_attr($notice['color']) . '!important;"';
                        }
						
                        ?>
                        <script>
                            jQuery( document ).ready(
                                function( $ ) {
                                    $( '.redux-notice.is-dismissible' ).on(
                                        'click', '.notice-dismiss', function( event ) {
                                            var $data = $( this ).parent( '.redux-notice:first' ).find( '.dismiss_data' );
                                            $.post(
                                                ajaxurl, {
                                                    action: 'redux_hide_admin_notice',
                                                    id: $data.attr( 'id' ),
                                                    nonce: $data.val()
                                                }
                                            );
                                        }
                                    );
                                }
                            );
                        </script>
                        <?php
                        /*

                         */

                    }


                    // Clear the admin notice array
                    self::$_parent->admin_notices = array();
                }
            }

            /**
             * dismissAdminNotice - Updates user meta to store dismiss notice preference
             *
             * @since       3.2.0
             * @access      public
             * @return      void
             */
            public static function dismissAdminNotice() {
                global $current_user;

                // Verify the dismiss and id parameters are present.
                if ( isset( $_GET['dismiss'] ) && isset( $_GET['id'] ) ) {
                    if ( 'true' == $_GET['dismiss'] || 'false' == $_GET['dismiss'] ) {

                        // Get the user id
                        $userid = $current_user->ID;

                        // Get the notice id
                        $id  = $_GET['id'];
                        $val = $_GET['dismiss'];

                        // Add the dismiss request to the user meta.
                        update_user_meta( $userid, 'ignore_' . $id, $val );
                    }
                }
            }

            /**
             * dismissAdminNotice - Updates user meta to store dismiss notice preference
             *
             * @since       3.2.0
             * @access      public
             * @return      void
             */
            public static function dismissAdminNoticeAJAX() {
                global $current_user;
                if ( ! wp_verify_nonce( $_POST['nonce'], $_POST['id'] . 'nonce' ) ) {
                    die(0);
                } else {
                    // Get the user id
                    $userid = $current_user->ID;

                    // Get the notice id
                    $id = $_POST['id'];

                    // Add the dismiss request to the user meta.
                    update_user_meta( $userid, 'ignore_' . $id, true );
                }
            }
        }

        Redux_Admin_Notices::load();
    }
