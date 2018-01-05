<?php

namespace Aheenam\Mozhi\Test;

use Spatie\Snapshots\MatchesSnapshots;

class FrontControllerTest extends TestCase
{
    use MatchesSnapshots;

    /** @test */
    public function it_renders_correct_view_on_route()
    {
        \Mozhi::routes();

        $response = $this->get('/no-template')
            ->assertStatus(200);

        $this->assertMatchesSnapshot($response->getContent());
    }

    /** @test */
    public function it_returns_a_404_if_route_not_found()
    {
        $this->get('/not-found')
            ->assertStatus(404);
    }

    /** @test */
    public function it_looks_for_a_index_page_if_slug_is_empty()
    {
        \Mozhi::routes();
        $response = $this->get('/')
            ->assertStatus(200);

        $this->assertMatchesSnapshot($response->getContent());
    }
}
