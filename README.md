# Waatch API

[![Latest Version](https://img.shields.io/github/release/defro/waatch-api.svg?style=flat-square)](https://github.com/defro/waatch-api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Total Downloads](https://img.shields.io/packagist/dt/defro/waatch-api.svg?style=flat-square)](https://packagist.org/packages/defro/waatch-api)

This package can get movie, tv series, streaming provider from [waatch.co](https://waatch.co) API.

Get more details on this API on [apiary](https://waatch.docs.apiary.io/). 

Here's a quick example:

```php
$client = new \GuzzleHttp\Client();
$waatch = new \Defro\Waatch\Api($client);
$waatch
    ->setApiKey('YOUR_WAATCH_API_KEY') // on your account profile
    ->setLanguage('fr') // Language ISO-639-1
;
```

## Movie

Get detail info about the movie.

```php
$movie = $waatch
    ->getMovie(857) // The Movie DB ID of "Saving Private Ryan"
;
```

Set country ISO code to filter streaming providers of this country.

```php
$movie = $waatch
    ->setCountry('fr') // All streaming providers in France (ISO-3166)
    ->getMovie(374720) // The Movie DB ID of "Dunkirk"
;
```

Filter streaming provider of one movie.

```php
$movie = $waatch
    ->getMovie('tt0093058', 'netflix') // The IMDB ID of "Full Metal Jacket" and Netfix provider
;
```

## TV Show

Get detail info about a TV show.

```php
$tvShow = $waatch
    ->getTvShow(1668) // The Movie DB ID of "Friends"
;
```

## Streaming provider

Get all providers.

```php
$providers = $waatch
    ->getProviders()
;
```

Get all Movies and TV Shows for a specific provider

```php
$provider = $waatch
    ->getProvider('itun') // iTunes reference ID
;
```


## License

The MIT License (MIT). Please see [license file](LICENSE) for more information.
