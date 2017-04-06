<?php
namespace Dinamiko\Nonces;

interface NonceInterface {

  /**
   * [action description]
   * @return string [description]
   */
  public function action(): string;

  /**
   * [__toString description]
   * @return string [description]
   */
  public function __toString(): string;

  /**
   * [is_valid description]
   * @param  [type] $request_value [description]
   * @return bool                  [description]
   */
  public function is_valid( $request_value ): bool;

}
