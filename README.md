# Waatch TV API

[![Latest Version](https://img.shields.io/github/release/defro/waatch-api.svg?style=flat-square)](https://github.com/defro/waatch-api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/5d86f539-e1f9-4eb1-9c70-907a68aa8e9b.svg?style=flat-square)](https://insight.sensiolabs.com/projects/5d86f539-e1f9-4eb1-9c70-907a68aa8e9b)
[![Total Downloads](https://img.shields.io/packagist/dt/defro/waatch-api.svg?style=flat-square)](https://packagist.org/packages/defro/waatch-api)

This package can get movie, tv series, streaming provider from [waatch.co](https://waatch.co). Here's a quick example:

```php
$client = new \GuzzleHttp\Client();
$waatch = new Defro\Waatch\Api($client);
$images = $waatch
    ->setApiKey('YOUR_WAATCH_API_KEY')
    ->getLanguage('fr') // The Movie DB ID of Saving Private Ryan
;
```

## Movie

Get detail info about the movie.

```php
$movie = $waatch
    ->getMovie(857) // The Movie DB ID of Saving Private Ryan
;
```

Add country to have providers of the movie.

```php
$movie = $waatch
    ->setCountry('fr') // All streaming providers of France
    ->getMovie(374720) // The Movie DB ID of "Dunkirk"
;
```

## TV Show

Get detail info about a TV show.

```php
$movie = $waatch
    ->getTvShow(1668) // The Movie DB ID of "Friends"
;
```

## Streaming provider

Get all providers.

```php
$movie = $waatch
    ->getProviders()
;
```

Get all Movies and TV Shows for a specific provider

```php
$movie = $waatch
    ->getProvider('itun') // iTunes reference ID
;
```


## License

The MIT License (MIT). Please see [license file](LICENSE) for more information.
