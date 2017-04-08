<?php
namespace Dinamiko\Nonces;

interface NonceInterface {

  /**
   * Returns action name
   * @return string
   */
  public function action(): string;

  /**
   * Returns nonce value
   * @return string
   */
  public function __toString(): string;

  /**
   * Validates the nonce
   * @param  string $request_value
   * @return bool
   */
  public function is_valid( $request_value ): bool;

}
