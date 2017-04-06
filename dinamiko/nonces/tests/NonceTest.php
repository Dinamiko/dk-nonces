<?php
use Dinamiko\Nonces\Nonce;
use Brain\Monkey;
use Brain\Monkey\Functions;

class NonceTest extends \PHPUnit\Framework\TestCase {

  protected function setUp(){
    parent::setUp();
    Monkey::setUpWP();
  }

  protected function tearDown(){
    Monkey::tearDownWP();
    parent::tearDown();
  }

  /**
   * [test_to_string description]
   * @return [type] [description]
   */
  public function test_to_string() {
    Functions::when( 'wp_create_nonce' )->justReturn( '62a9e9c072' );

    $nonce = new Nonce( 'my-action' );
    $this->assertEquals( '62a9e9c072', (string) $nonce );
  }

  /**
   * [test_is_valid description]
   * @return boolean [description]
   */
  public function test_is_valid() {
    Functions::expect( 'wp_verify_nonce' )->with( 'bar', 'my-action' )->andReturn( true );

    $nonce = new Nonce( 'my-action' );

    $_POST['foo'] = 'bar';
    $_SERVER['REQUEST_METHOD'] = 'POST';

    self::assertTrue( $nonce->is_valid( $_POST['foo'] ) );
  }


}
