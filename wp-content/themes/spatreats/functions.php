<?php if( ! defined('IAMD_BASE_URL' ) ){	define( 'IAMD_BASE_URL',  get_template_directory_uri().'/'); }
define( 'IAMD_FW_URL', IAMD_BASE_URL . 'framework/' );
define('IAMDFW',TEMPLATEPATH.'/framework/');
#ALL BACKEND DETAILS WILL BE IN include.php
include_once(IAMDFW.'include.php');
if ( ! isset( $content_width ) ) $content_width = 960;?>