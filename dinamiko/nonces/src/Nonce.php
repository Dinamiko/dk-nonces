<?php
namespace Dinamiko\Nonces;

class Nonce {

  private $action;
  /*
  nonce
  $nonce = new Nonce('my-action');
  $nonce->create();

  nonce_url
  $nonce = new Nonce('my-action');
  $nonce->create_url( admin_url('options.php?page=my_plugin_settings'), 'nonce-name' );

  nonce_field
  $nonce = new Nonce('my-action');
  wp_nonce_field( 'nonce-name', true, true );
  */

  public function __construct( $action = -1 ) {
    $this->action = $action;
  }

  public function create() {
    return wp_create_nonce( $this->action );
  }

  public function create_url( $actionurl, $name = '_wpnonce' ) {
    return wp_nonce_url( $actionurl, $this->action, $name );
  }

  public function create_field( $name = '_wpnonce', $referer = true, $echo = true ) {
    //<input type="hidden" id="_wpnonce" name="_wpnonce" value="89a9e0c072">
    //<input type="hidden" name="_wp_http_referer" value="/wp-admin/plugins.php?plugin_status=all&amp;paged=1&amp;s">
    return wp_nonce_field( $this->action, $name, $referer, $echo );
  }


}
