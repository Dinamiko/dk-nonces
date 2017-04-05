<?php
namespace Dinamiko\Nonces;

final class Nonce implements NonceInterface {

  private $action;

  private $whitelist_request_methods = [
		'POST' => INPUT_POST,
		'GET'  => INPUT_GET,
	];

  public function __construct( string $action ) {
    $this->action = $action;
  }

  public function action(): string {
		return $this->action;
	}

  public function __toString(): string {
		return (string) wp_create_nonce( $this->action );
	}

  public function is_valid( $context ): bool {

    $http_method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : null;

    if( $http_method == null ) {
      return false;
    }

    return (bool) wp_verify_nonce( $context, $this->action );

  }

}
