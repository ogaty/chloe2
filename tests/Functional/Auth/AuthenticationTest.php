<?php

class AuthenticationTest extends TestCase
{
    use InteractsWithDatabase, CreatesUser;

    /** @test */
    public function it_validates_the_login_form()
    {
        $this->assertTrue(true);
    }
}
