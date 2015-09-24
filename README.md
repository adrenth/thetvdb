# adrenth/thetvdb

[![Build Status](https://travis-ci.org/adrenth/thetvdb.svg?branch=master)](https://travis-ci.org/adrenth/thetvdb)
[![Latest Stable Version](https://poser.pugx.org/adrenth/thetvdb/v/stable)](https://packagist.org/packages/adrenth/thetvdb) [![Total Downloads](https://poser.pugx.org/adrenth/thetvdb/downloads)](https://packagist.org/packages/adrenth/thetvdb) [![Latest Unstable Version](https://poser.pugx.org/adrenth/thetvdb/v/unstable)](https://packagist.org/packages/adrenth/thetvdb) [![License](https://poser.pugx.org/adrenth/thetvdb/license)](https://packagist.org/packages/adrenth/thetvdb)

This is an API client for the thetvdb.com website. It's using the XML feeds that are publicly available.

## API Key Registration

To use this PHP package, you need to request an API Key from the thetvdb.com website: [http://thetvdb.com/?tab=apiregister](http://thetvdb.com/?tab=apiregister).

Please follow these guidelines:

* If you will be using the API information in a commercial product or website, you must email [scott@thetvdb.com](mailto:scott@thetvdb.com) and wait for authorization before using the API. However, you MAY use the API for development and testing before a public release.
* If you have a publicly available program, you MUST inform your users of this website and request that they help contribute information and artwork if possible.
* You MUST familiarize yourself with our data structure, which is detailed in the wiki documentation.
* You MUST NOT perform more requests than are necessary for each user. This means no downloading all of our content (we'll provide the database if you need it). Play nice with our server.
* You MUST NOT directly access our data without using the documented API methods.
* You MUST keep the email address in your account information current and accurate in case we need to contact you regarding your key (we hate spam as much as anyone, so we'll never release your email address to anyone else).
* Please feel free to contact us and request changes to our site and/or API. We'll happily consider all reasonable suggestions.

*Source: thetvdb.com*

## Installation

Install this package using composer:

````
$ composer require adrenth/thetvdb
````

## Usage

Create a Client instance:

````
$apiKey = 'yourapikey';
$cache = new \Doctrine\Common\Cache\FilesystemCache('path/to/cache');
$client = new Client($cache, $apiKey);
````
### Cache
````
$client->setCacheTtl(3600); // in seconds
````

### Language
````
$language = new Language('nl');

echo $language->getCode();
// 'nl'
echo $language->getLabel();
// 'Nederlands'

$language = $client->getUserPreferredLanguage($accountId);
````

#### Managing User Ratings
````
// Returns a UserFavoritesResponse
$favorites = $client->getUserFavorites($accountId);
$seriesIds = $favorites->getSeriesIds();

$favorites = $client->addUserFavorite($accountId, $seriesId);
$seriesIds = $favorites->getSeriesIds();

$favorites = $client->removeUserFavorite($accountId, $seriesId);
$seriesIds = $favorites->getSeriesIds();
````

#### Managing User Ratings
````
$rating = $client->addUserRatingForEpisode($accountId, $episodeId, $rating);
$rating = $client->removeUserRatingForEpisode($accountId, $episodeId);
$rating = $client->addUserRatingForSeries($accountId, $seriesId, $rating);
$rating = $client->removeUserRatingForSeries($accountId, $seriesId);

echo $rating->getUserRating();
// 7
echo $rating->getCommunityRating();
// 7.65
````

#### Searching / Fetching Series
````
$language = new Language('nl');
$response = $client->getSeries('Ray Donovan', $language, $accountId);
$seriesCollection = $response->getSeries();

foreach ($seriesCollection as $series) {
	echo $series->getName();
}

$response = $client->getSeriesByImdbId('tt0290978');
$response = $client->getSeriesByImdbId('tt0290978', new \Adrenth\Thetvdb\Language('de'));
$response = $client->getSeriesByZap2itId('EP01579745', new \Adrenth\Thetvdb\Language('nl'));
```` 

## Caching

This package requires a Doctrine `Cache` instance. To disable caching (which I will never recommend!) just provide a `VoidCache` or `ArrayCache` instance.

For more information about Doctrine Cache visit [https://github.com/doctrine/cache](https://github.com/doctrine/cache)

## Contributing

Please contribute to make this package even better.