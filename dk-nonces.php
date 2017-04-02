<?php
/*
 * Plugin Name: DK Nonces
 * Version: 0.1
 * Description: Plugin for testing dinamiko/nonces package.
 * Author: Emili Castells
 * Author URI: http://www.dinamiko.com
 * Requires at least: 4.7.3
 * Tested up to: 4.7.3
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require 'vendor/autoload.php';

/*
use Dinamiko\Nonces\Create;
$nonce = new Create();
echo $nonce->create_nonce();

use Dinamiko\Nonces\Verify;
$nonce = new Verify();
echo $nonce->verify_nonce();
*/
