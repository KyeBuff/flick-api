<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTest extends TestCase
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
    public function testMediaFilmPost()
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
    public function testMediaFilmPostNoTitle()
    {
        $title = $this->title;
        unset($title['title']);
        $response = $this->json('POST', 'api/amazon/films', $title);

        $response
            ->assertStatus(422);
    }

    /**
     * Test netflix title POST empty title
     *
     * @return void
     */
    public function testMediaFilmPostEmptyTitle()
    {
        $title = $this->title;
        $title['title'] = '';
        $response = $this->json('POST', 'api/bbc/films', $title);

        $response
            ->assertStatus(422);
    }

    /**
     * Test netflix title POST without synopsis
     *
     * @return void
     */
    public function testMediaFilmPostNoSynopsis()
    {
        $title = $this->title;
        unset($title['synopsis']);

        $response = $this->json('POST', 'api/c-four/films', $title);

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
    public function testMediaFilmPostEmptySynopsis()
    {
        $title = $this->title;
        $title['synopsis'] = '';
        $response = $this->json('POST', 'api/google/films', $title);

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
    public function testMediaFilmPostNoImage()
    {
        $title = $this->title;
        unset($title['img_url']);

        $response = $this->json('POST', 'api/itunes/films', $title);

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
    public function testMediaFilmPostEmptyImage()
    {
        $title = $this->title;
        $title['img_url'] = '';

        $response = $this->json('POST', 'api/itv/films', $title);

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
    public function testMediaFilmPostNoGenres()
    {
        $title = $this->title;
        unset($title['genres']);

        $response = $this->json('POST', 'api/rakuten/films', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'img_url' => $this->title['img_url'],
                'synopsis' => $this->title['synopsis'],
            ]);
    }
    /**
     * Test netflix title POST success
     *
     * @return void
     */
    public function testMediaSeriesPost()
    {
        $response = $this->json('POST', 'api/google/series', $this->title);

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
    public function testMediaSeriesPostNoTitle()
    {
        $title = $this->title;
        unset($title['title']);
        $response = $this->json('POST', 'api/netflix/series', $title);

        $response
            ->assertStatus(422);
    }

    /**
     * Test netflix title POST empty title
     *
     * @return void
     */
    public function testMediaSeriesPostEmptyTitle()
    {
        $title = $this->title;
        $title['title'] = '';
        $response = $this->json('POST', 'api/itv/series', $title);

        $response
            ->assertStatus(422);
    }

    /**
     * Test netflix title POST without synopsis
     *
     * @return void
     */
    public function testMediaSeriesPostNoSynopsis()
    {
        $title = $this->title;
        unset($title['synopsis']);

        $response = $this->json('POST', 'api/itunes/series', $title);

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
    public function testMediaSeriesPostEmptySynopsis()
    {
        $title = $this->title;
        $title['synopsis'] = '';
        $response = $this->json('POST', 'api/rakuten/series', $title);

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
    public function testMediaSeriesPostNoImage()
    {
        $title = $this->title;
        unset($title['img_url']);

        $response = $this->json('POST', 'api/netflix/series', $title);

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
    public function testMediaSeriesPostEmptyImage()
    {
        $title = $this->title;
        $title['img_url'] = '';

        $response = $this->json('POST', 'api/bbc/series', $title);

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
    public function testMediaSeriesPostNoGenres()
    {
        $title = $this->title;
        unset($title['genres']);

        $response = $this->json('POST', 'api/amazon/series', $title);

        $response
            ->assertStatus(201)
            ->assertJson([
                'title' => $this->title['title'],
                'img_url' => $this->title['img_url'],
                'synopsis' => $this->title['synopsis'],
            ]);
    }
}
