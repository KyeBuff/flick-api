<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NetflixTest extends TestCase
{
    /**
     * Test new user sign up
     *
     * @return void
     * @return void
     */

    private $title = [
        "title" => "Ozark", 
        "synopsis" => "A financial adviser drags his family from Chicago to the Missouri Ozarks, where he must launder $500 million in five years to appease a drug boss.", 
        "img_url" => "https://occ-0-2585-299.1.nflxso.net/dnm/api/v5/rendition/.png", 
        "genres" => ["Series, American Programmes, US TV Dramas, Drama Programmes, Crime TV Dramas"]
    ];
    /**
     * Test netflix title POST success
     *
     * @return void
     */
    public function testNetflixFilmPost()
    {
    	$response = $this->json('POST', 'api/netflix/films', $this->title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'synopsis' => $this->title['synopsis'],
                'img_url' => $this->title['img_url'],
            ]);
    }

    /**
     * Test netflix title POST without title
     *
     * @return void
     */
    public function testNetflixFilmPostNoTitle()
    {
        $title = $this->title;
        unset($title['title']);
        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(422);
    }

    /**
     * Test netflix title POST empty title
     *
     * @return void
     */
    public function testNetflixFilmPostEmptyTitle()
    {
        $title = $this->title;
        $title['title'] = '';
        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(422);
    }

    /**
     * Test netflix title POST without synopsis
     *
     * @return void
     */
    public function testNetflixFilmPostNoSynopsis()
    {
        $title = $this->title;
        unset($title['synopsis']);

        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'img_url' => $this->title['img_url'],
            ]);
    }


    /**
     * Test netflix title POST empty title
     *
     * @return void
     */
    public function testNetflixFilmPostEmptySynopsis()
    {
        $title = $this->title;
        $title['synopsis'] = '';
        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'synopsis' => $title['synopsis'],
                'img_url' => $this->title['img_url'],
            ]);
    }

    /**
     * Test netflix title POST without image
     *
     * @return void
     */
    public function testNetflixFilmPostNoImage()
    {
        $title = $this->title;
        unset($title['img_url']);

        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'synopsis' => $this->title['synopsis'],
            ]);
    }

    /**
     * Test netflix title POST without image
     *
     * @return void
     */
    public function testNetflixFilmPostEmptyImage()
    {
        $title = $this->title;
        $title['img_url'] = '';

        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'img_url' =>  $title['img_url'],
                'synopsis' => $this->title['synopsis'],
            ]);
    }

    /**
     * Test netflix title POST without genres
     *
     * @return void
     */
    public function testNetflixFilmPostNoGenres()
    {
        $title = $this->title;
        unset($title['genres']);

        $response = $this->json('POST', 'api/netflix/films', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'img_url' => $this->title['img_url'],
                'synopsis' => $this->title['synopsis'],
            ]);
    }
}
