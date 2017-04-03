<?php
use Dinamiko\Nonces\Verify;
use Brain\Monkey;
use Brain\Monkey\Functions;

class VerifyTest extends \PHPUnit\Framework\TestCase {

  protected function setUp(){
    parent::setUp();
    Monkey::setUpWP();
  }

  protected function tearDown(){
    Monkey::tearDownWP();
    parent::tearDown();
  }

  public function test_verify_nonce() {
    Functions::when('wp_verify_nonce')->justReturn( 1 );

    $verify = new Verify();
    $this->assertEquals( 1, $verify->verify_nonce( '62a9e9c072', 'my-action' ) );
  }

  public function test_verify_nonce_admin() {
    Functions::when('check_admin_referer')->justReturn( true );

    $verify = new Verify();
    $this->assertEquals( true, $verify->verify_nonce_admin( 'my-action', 'nonce-name' ) );
  }

  public function test_verify_nonce_ajax() {
    Functions::when('check_ajax_referer')->justReturn( true );

    $verify = new Verify();
    $this->assertEquals( true, $verify->verify_nonce_ajax( 'my-action', 'nonce-name', false ) );
  }

}
