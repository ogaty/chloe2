<?php

class HelpIndexPageTest extends TestCase
{
    use InteractsWithDatabase, CreatesUser;

    /** @test */
    public function it_can_refresh_the_user_page()
    {
        $this->be($this->user);
        $response = $this->get(route('canvas.admin.help'));
        $response->assertStatus(200);
        $response->assertDontSee('Sign in');
    }
}
