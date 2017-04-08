<?php
namespace Dinamiko\Nonces;

final class Nonce implements NonceInterface {

  /**
   * @var string $action
   */
  private $action;

  /**
   * @var array $allowed_request_methods
   */
  private $allowed_request_methods = [ 'POST', 'GET' ];

  /**
   * @param string $action
   */
  public function __construct( string $action ) {
    $this->action = $action;
  }

  /**
   * @return string
   */
  public function action(): string {
		return $this->action;
	}

  /**
   * @return string
   */
  public function __toString(): string {
		return (string) wp_create_nonce( $this->action );
	}

  /**
   * Checks if server request method is valid and verifies the nonce using wp_verify_nonce
   * @param  string $request_value
   * @return bool
   */
  public function is_valid( $request_value ): bool {

    $http_method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : null;

    if( $http_method == null || ! in_array( $http_method, $this->allowed_request_methods ) ) {
      return false;
    }

    $nonce = filter_var( $request_value );

    return (bool) wp_verify_nonce( $nonce, $this->action );

  }

  /**
   * Returns an input hidden field with action name and nonce value
   * @return string
   */
  public function create_field() {

    return sprintf(
        '<input type="hidden" id="%s" name="%s" value="%s" />',
        esc_attr( $this->action ),
        esc_attr( $this->action ),
        esc_attr( (string) wp_create_nonce( $this->action ) )
    );

  }

  /**
   * Adds action name and nonce value to the given URL
   * @param  string $url
   * @return string
   */
  public function create_url( string $url ) {

    return esc_url_raw( add_query_arg( $this->action, (string) wp_create_nonce( $this->action ), $url ) );

  }

}
