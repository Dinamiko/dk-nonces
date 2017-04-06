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
   * [action description]
   * @return string [description]
   */
  public function action(): string {
		return $this->action;
	}

  /**
   * Returns nonce value as string
   * @return string
   */
  public function __toString(): string {
		return (string) wp_create_nonce( $this->action );
	}

  /**
   * [is_valid description]
   * @param  [type] $request_value [description]
   * @return bool                  [description]
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
   * [create_field description]
   * @return [type] [description]
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
   * [create_url description]
   * @param  string $url [description]
   * @return [type]      [description]
   */
  public function create_url( string $url ) {

    return esc_url_raw( add_query_arg( $this->action, (string) wp_create_nonce( $this->action ), $url ) );

  }

}
