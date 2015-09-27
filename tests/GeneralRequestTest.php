<?php

class GeneralRequestTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testHomePage()
	{
        $this->visit('/')
             ->see('E-Mail Address')
             ->see('Password')
             ->see('Remember Me')
             ->see('Forgot your Password')
             ->assertResponseOk();
             
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
	}
    
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testResetPasswordPage()
	{
        $this->visit('/password/email')
             ->see('Reset Password')
             ->see('E-mail Address')
             ->see('Send Password Reset Link')
             ->assertResponseOk();
             
        $response = $this->call('GET', '/password/email');
        $this->assertEquals(200, $response->status());
	}

}
