<?php

class AuthenticationTest extends TestCase
{
    use InteractsWithDatabase, CreatesUser;

    /** @test */
    public function it_validates_the_login_form()
    {
        $response = $this->get(route('canvas.admin'));
        $response->assertStatus(200);
    }
}
