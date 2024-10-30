<?php

/*
Plugin Name: MaGiKS Geo Country Lite
Plugin URI: http://geotargetingscripts.com/products/geo-country-lite/
Description: Display unique messages to your blog visitors based on their geographic location
Version: 1.0
Author: Keith Lock
Author URI: http://keithjameslock.com
*/

#########################################################################
#                                                                       #
#                  MaGiKS Geo Country Wordpress Plugin                  #
#                                                                       #
#########################################################################
# COPYRIGHT NOTICE                                                      #
# Copyright 2010-Now  All Rights Reserved.                              #
#                                                                       #
# This script may be only used and modified in accordance to the        #
# license agreement attached except where expressly noted within        #
# commented areas of the code body. This copyright notice and the       #
# comments above and below must remain intact at all times.             #
# By using this code you agree to indemnify GeoTargetingScripts.com,    #
# its corporate agents and affiliates, from any liability that might    #
# arise from its use.                                                   #
#                                                                       #
# Selling the code for this program without prior written consent is    #
# expressly forbidden and in violation of Domestic and International    #
# copyright laws.                                                       #
#########################################################################

class magiks_geo_country_shortcode_class
{
    public $geo_country;        // Country code (i.e. "CA")
    public $geo_country_name;   // Country name (i.e. "Canada")
    public $geo_ip_address;     // IP Address

    /**
     * Constructor
     * @uses    $this->magiks_geo_country_init()
     * @return  Instance of magiks_geo_country_shortcode_class
     */
    function __construct()
    {
        $this->magiks_geo_country_init();
    }

    /**
     * Old-style constructor (for backwards compatibility with PHP < 5)
     * @uses    $this->magiks_geo_country_init()
     * @return  Instance of magiks_geo_country_shortcode_class
     */
    function magiks_geo_country_shortcode_class()
    {
        $this->magiks_geo_country_init();
    }

    /**
     * Initialize object. Determine country code and country name
     * based on IP address of the client.
     * @uses    Net_GeoIP class
     * @return  void
     */
    function magiks_geo_country_init()
    {
        // Determine IP Address of client.
        if ( ! empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif ( ! empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        // Grab first listed IP if necessary.
        if (strpos($ip_address, ',') !== false)
        {
            $ip_address = explode(',', $ip_address);
            $ip_address = $ip_address[0];
        }

        // Get country code and country name.
        if (isset($_COOKIE['magiks_geo_country']) AND isset($_COOKIE['magiks_geo_country_name']))
        {
            // Try to get country from cookie, if set.
            $this->geo_country = $_COOKIE['magiks_geo_country'];
            $this->geo_country_name = $_COOKIE['magiks_geo_country_name'];
        }
        else
        {
            // Get country from Net_GeoIP library.
            require_once(dirname(__FILE__).'/GeoIP.php');
            $magiks_geoip = Net_GeoIP::getInstance(dirname(__FILE__).'/GeoIP/GeoIP.dat');
            $this->geo_country = $magiks_geoip->lookupCountryCode($ip_address);
            $this->geo_country_name = $magiks_geoip->lookupCountryName($ip_address);
            $magiks_geoip->close();

            // Store country in a cookie for next time.
            setcookie('magiks_geo_country', $this->geo_country, time()+604800, '/');
            setcookie('magiks_geo_country_name', $this->geo_country_name, time()+604800, '/');
        }

        $this->geo_ip_address = $ip_address;
    }

    /**
     * Replace tokens in content with generated values
     * @param   string $content     Content to filter
     * @return  string $content     Content with tokens replaced
     */
    function magiks_geo_replace_content_tokens($content)
    {
        // Build HTML for flag icons.
        $flag_path = WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)).'/flags';
        $flag_html_sm = '<img src="'.$flag_path.'/sm/'.strtolower($this->geo_country).'.png" alt="'.$this->geo_country_name.'" border="0" />';
        $flag_html_lg = '<img src="'.$flag_path.'/lg/'.strtolower($this->geo_country).'.png" alt="'.$this->geo_country_name.'" border="0" />';

        // Replace tokens with respective values.
        $tokens = array('{country}', '{country-name}', '{flag-small}', '{flag-large}', '{ip-address}');
        $values = array($this->geo_country, $this->geo_country_name, $flag_html_sm, $flag_html_lg, $this->geo_ip_address);
        $content = str_replace($tokens, $values, $content);

        return $content;
    }

    /**
     * Handler for [m_quickgeo] shortcodes
     * Simply replaces tokens in contents of shortcode tag.
     * @param   array $atts         Attributes passed in by shortcode
     * @param   string $content     Contents of shortcode
     * @uses    $this->magiks_geo_replace_content_tokens()
     * @return  string              Contents with tokens replaced
     */
    function magiks_quickgeo_shortcode_handler($atts, $content="")
    {
        // Only replace tokens.
        return $this->magiks_geo_replace_content_tokens($content);
    }

}

// Instantiate an object of magiks_geo_country_shortcode_class.
$magiks_geo_country_shortcode_class = new magiks_geo_country_shortcode_class;

// Add shortcodes.
add_shortcode('m_quickgeo', array($magiks_geo_country_shortcode_class, 'magiks_quickgeo_shortcode_handler'));
add_filter('widget_text', 'do_shortcode');

?>