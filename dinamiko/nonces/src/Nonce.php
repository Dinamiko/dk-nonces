<?php
namespace Dinamiko\Nonces;

final class Nonce implements NonceInterface {

  private $action;

  private $allowed_request_methods = [ 'POST', 'GET' ];

  public function __construct( string $action ) {
    $this->action = $action;
  }

  public function action(): string {
		return $this->action;
	}

  public function __toString(): string {
		return (string) wp_create_nonce( $this->action );
	}

  public function is_valid( $request_value ): bool {

    $http_method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : null;

    if( $http_method == null || ! in_array( $http_method, $this->allowed_request_methods ) ) {
      return false;
    }

    $nonce = filter_var( $request_value );

    return (bool) wp_verify_nonce( $nonce, $this->action );

  }

}
