<?php

class HomeIndexPageTest extends TestCase
{
    use InteractsWithDatabase, CreatesUser;

    /** @test */
    public function it_can_preview_the_blog_from_the_home_page()
    {
        $this->be($this->user);
        $response = $this->get(route('canvas.admin'));
        $response->assertStatus(200);
        $response->assertDontSee('Sign in');
    }
}
