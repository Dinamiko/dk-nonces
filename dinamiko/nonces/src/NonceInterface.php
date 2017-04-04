<?php
namespace Dinamiko\Nonces;

interface NonceInterface {

  public function action(): string;

  public function __toString(): string;

  public function is_valid(): bool;

}
