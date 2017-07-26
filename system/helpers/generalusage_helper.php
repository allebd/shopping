<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('getCurrentUrl'))
{
    /* this get us the current web url and returns
    concantenated valu of controller and action */

    function getCurrentUrl()
    {
        $response = substr(current_url(), strlen(base_url()));
        return $response;
    }
}

if (!function_exists('getAdminLoggedInUser'))
{
    function getAdminLoggedInUser()
    {
        $CI =& get_instance();
        if( $CI->session->userdata('admin_username') ){
            $currentAdminUser = $CI->session->userdata('admin_username');

            return $currentAdminUser;
        }
    }
}

if (!function_exists('getCurrentTimestamp'))
{
    function getCurrentTimestamp()
    {
        return date('Y-m-d H:i:s');
    }
}
