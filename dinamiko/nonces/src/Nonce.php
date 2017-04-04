<?php
namespace Dinamiko\Nonces;

final class Nonce implements NonceInterface {

  private $action;

  public function __construct( string $action ) {
    $this->action = $action;
  }

  public function action(): string {
		return $this->action;
	}

  public function __toString(): string {
		return (string) wp_create_nonce( $this->action );
	}

}
