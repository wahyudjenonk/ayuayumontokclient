<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * reCaptcha File Config
 *
 * File     : recaptcha.php
 * Created  : May 14, 2013 | 4:22:40 PM
 * 
 * Author   : Andi Irwandi Langgara <irwandi@ourbluecode.com>
 */
/*
$config['public_key']   = '6Le13iETAAAAAM07B9yj_W7CIoxGt73qNpypbjzT';
$config['private_key']  = '6Le13iETAAAAACrdU736_A5_goWa7X52WR7RjAeo';
$config['recaptcha_options']  = array(
    'theme'=>'red', // red/white/blackglass/clean
    'lang' => 'en' // en/nl/fl/de/pt/ru/es/tr
    //  'custom_translations' - Use this to specify custom translations of reCAPTCHA strings.
    //  'custom_theme_widget' - When using custom theming, this is a div element which contains the widget. See the custom theming section for how to use this.
    //  'tabindex' - Sets a tabindex for the reCAPTCHA text box. If other elements in the form use a tabindex, this should be set so that navigation is easier for the user
);
*/


$config['recaptcha_sitekey']   = '6Le13iETAAAAAM07B9yj_W7CIoxGt73qNpypbjzT';
$config['recaptcha_secretkey']  = '6Le13iETAAAAACrdU736_A5_goWa7X52WR7RjAeo';
$config['lang'] = 'en';


// Set Recaptcha options
// Reference at https://developers.google.com/recaptcha/docs/customization

?>
