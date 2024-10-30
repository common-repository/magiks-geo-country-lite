=== MaGiKS Geo Country Lite ===
Contributors: kjlock75
Donate link: http://magiksinc.com/
Tags: geo, geotarget, geotargeting, wp geo, ip to geo, geo targeting, geo wordpress, wordpress geo, ip country script
Requires at least: 3.0.4
Tested up to: 3.0.4
Stable tag: 0.1.0

Make your visitors feel welcome by displaying their country name and/or flag on your blog automatically.

== Description ==

MaGiKS Geo Country Lite automatically determines the IP Address of the visitor to your blog. Simply insert a shortcode into posts/pages/wdigets and theme files with the appropriate 'token' to display country-specific messages to your visitors. With these tokens you may display a larger flag of the visitor's country, a smaller flag of the visitor's country, their 2-character country code (i.e. CA), the name of the country (i.e. Canada) and/or the IP Address.

This plugin doesn't allow for 'conditional' targeting... meaning it does not allow you to display different content (such as ads) for each location. The [Geo City Plus Package](http://geotargetingscripts.com/products/geo-city-plus/ "IP to Geo City-Region-Country Targeting WP Plugin and Script") and [Geo Targeting Country Bundle](http://geotargetingscripts.com/products/geo-country-bundle/ "IP to Geo Country-Targeting WP Plugin and Script") (which include BOTH a WordPress plugin AND PHP Script) was designed to do just that (and more).

== Installation ==

1. Upload `magiks_geo_lite` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Use the `[m_quickgeo]` shortcode in posts/pages/widgets (learn how to use the shortcode/tokens in theme files by reading the accompanying `readme.html`)
1. As an example: `[m_quickgeo]{flag-small} Shipping directly to {country-name}![/m_quickgeo]`
1. Available tokens include:

`{flag-large}` - displays a larger flag of the visitor's country (image width: 80px, height: varies slightly for each flag)
`{flag-small}` - displays a smaller flag of the visitor's country (image width: 16px, height: 11px)
`{country}` - displays the 2-character country code (i.e. CA)
`{country-name}` - displays the name of the country (i.e. Canada)
`{ip-address}` - displays the IP Address of the visitor


== Frequently Asked Questions ==

= Can I create geotargeted dynamic landing pages with MaGiKS Geo Country Lite? =

This plugin allows you to display 'messaging' that includes local terminology only... such as the name of the country or the country's flag. Creating a geotargeted dynamic landing page where the ad graphic or product offer might change, while the rest of the copy remains static, would require use of either the [Geo City Plus Package](http://geotargetingscripts.com/products/geo-city-plus/ "IP to Geo City-Region-Country Targeting WP Plugin and Script") or the [Geo Targeting Country Bundle](http://geotargetingscripts.com/products/geo-country-bundle/ "IP to Geo Country-Targeting WP Plugin and Script").

= Can I restrict visitors from specific locations from seeing certain promotions with this plugin? =

Again, that would require the 'conditional' targeting features of the [Geo City Plus Package](http://geotargetingscripts.com/products/geo-city-plus/ "IP to Geo City-Region-Country Targeting WP Plugin and Script") and [Geo Targeting Country Bundle](http://geotargetingscripts.com/products/geo-country-bundle/ "IP to Geo Country-Targeting WP Plugin and Script").

== Changelog ==

= 1.0.0 =
* Inital public release.