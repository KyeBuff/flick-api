<?php

namespace App\Custom;
use Illuminate\Support\Collection;

use GuzzleHttp;
use Config;

class MediaUtilities {

	private static function normalizeTitle($title) {
 		//Remove symbols
        $title = preg_replace("/[-!$%^&*@#()_+|~=`{}\[\]:\";'<>?,.\/]/", '', $title);

        // Lowercase and remove whitespace
        return strtolower(preg_replace('/\s+/', '', $title));
	}

	private static function filterFilms($results, $title) 
	{
        return $results->filter(function ($media) use ($title) {
            return MediaUtilities::normalizeTitle($media->title) === MediaUtilities::normalizeTitle($title);
        });
	}

		private static function filterSeries($results, $title) 
	{
        return $results->filter(function ($media) use ($title) {
            return MediaUtilities::normalizeTitle($media->name) === MediaUtilities::normalizeTitle($title);
        });
	}

	public static function getImageUrl($title, $type)
    {
     	$api_key = Config::get('services.tmdb.api_key');
        $api_url = Config::get('services.tmdb.endpoint');

        $client = new GuzzleHttp\Client();

        $res = $client->get($api_url.$type.'?api_key='.$api_key.'&query='.$title, [
            'headers' => [
                'Accept' => 'application/json',
            ]
        ]);

        $response_body = json_decode($res->getBody()->getContents());

        $results = $response_body->results;

        if(count($results) === 1) {
            $poster = $results[0]->poster_path;
            return 'http://image.tmdb.org/t/p/w342'.$poster;
        } else {
            $results = collect($results);

            if($type === 'movie') {
	            $results = MediaUtilities::filterFilms($results, $title);
            } else {
	            $results = MediaUtilities::filterSeries($results, $title);
            }

            $poster = null;

            if (count($results)) {
                $poster = $results[0]->poster_path;
            }

            dd($poster);

            $image_endpoint = Config::get('services.tmdb.image_endpoint');
            return $poster ? $image_endpoint.$poster : null;
        }
    }

}