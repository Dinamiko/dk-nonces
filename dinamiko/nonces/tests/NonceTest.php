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
   */
  public function test_to_string() {
    Functions::when( 'wp_create_nonce' )->justReturn( '62a9e9c072' );

    $nonce = new Nonce( 'my-action' );
    $this->assertEquals( '62a9e9c072', (string) $nonce );
  }

  /**
   * [test_is_valid description]
   */
  public function test_is_valid() {
    Functions::expect( 'wp_verify_nonce' )->with( 'bar', 'my-action' )->andReturn( true );

    $nonce = new Nonce( 'my-action' );

    $_POST['foo'] = 'bar';
    $_SERVER['REQUEST_METHOD'] = 'POST';

    self::assertTrue( $nonce->is_valid( $_POST['foo'] ) );
  }

  /**
   * [test_create_field description]
   */
  public function test_create_field() {
    Functions::when( 'wp_create_nonce' )->justReturn( '62a9e9c072' );
    Functions::when( 'esc_attr' )->alias(function ( $string ) {
      return filter_var( $string, FILTER_SANITIZE_STRING );
    });

    $nonce = new Nonce( 'my-action' );
    $field = $nonce->create_field();
    $expected = '<input type="hidden" id="my-action" name="my-action" value="62a9e9c072" />';

    $this->assertEquals( $expected, $field );
  }

  /**
   * [test_create_url description]
   */
  public function test_create_url() {
    Functions::when( 'wp_create_nonce' )->justReturn( '62a9e9c072' );
    Functions::when( 'esc_url_raw' )->alias(function ( $url ) {
        return filter_var( $url, FILTER_SANITIZE_URL );
    });
    Functions::when( 'add_query_arg' )->justReturn( 'http://example.com?my-action=62a9e9c072' );

    $nonce = new Nonce( 'my-action' );
    $url = $nonce->create_url( 'http://example.com' );
    $expected = 'http://example.com?my-action=62a9e9c072';

    $this->assertEquals( $expected, $url );
  }

}
