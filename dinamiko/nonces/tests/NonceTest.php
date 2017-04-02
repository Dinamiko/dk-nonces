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

  public function test_create() {
    Functions::when('wp_create_nonce')->justReturn('62a9e9c072');

    $nonce = new Nonce( 'my-action' );
    $this->assertEquals( '62a9e9c072', $nonce->create() );
  }

  public function test_create_url() {
    Functions::when('wp_nonce_url')->justReturn( 'http://my-site.com?nonce-name=62a9e9c072' );

    $nonce = new Nonce( 'my-action' );
    $this->assertEquals( 'http://my-site.com?nonce-name=62a9e9c072', $nonce->create_url( 'http://my-site.com', 'nonce-name' ) );
  }


  public function test_create_field() {
    Functions::when('wp_nonce_field')->justReturn( '<input type="hidden" id="_wpnonce" name="_wpnonce" value="62a9e9c072">
    <input type="hidden" name="_wp_http_referer" value="/">' );
    
    $expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="62a9e9c072">
    <input type="hidden" name="_wp_http_referer" value="/">';

    $nonce = new Nonce( 'my-action' );
    $this->assertEquals( $expected, $nonce->create_field() );
  }

}
