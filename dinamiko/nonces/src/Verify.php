<?php
namespace Dinamiko\Nonces;

class Verify {
/*
nonce
nonce_admin
nonce_ajax
*/

  public function verify_nonce( $nonce, $action = -1 ) {
    return wp_verify_nonce( $nonce, $action );
  }

  public function verify_nonce_admin( $action = -1, $query_arg = '_wpnonce' ) {
    return check_admin_referer( $action, $query_arg );
  }

  public function verify_nonce_ajax( $action = -1, $query_arg = false, $die = true ) {
    return check_ajax_referer( $action, $query_arg, $die );
  }

}
