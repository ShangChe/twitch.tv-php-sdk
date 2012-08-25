twitch.tv-php-sdk
=================

A PHP SDK to interface with the public endpoints of http://twitch.tv REST API.

Notes
-----

I had a requirement to interact with the twitch.tv REST API and quickly through this together. It's not perfect but it works.

Please note that this SDK only supports the public endpoints of the Twitch API but support for authenticated endpoints is planned.

Files Included
--------------

twitch.php - contains the following classes:

* TwitchTV - the main class which provides all of the functionality.
* TwitchTV_Endpoints - a simple enum which contains all of the endpoints to the various resources on the Twitch API

cacert.pm - Mozilla's CA certificate bundle for SSL Certificate comparison in order to prevent MITM attacks, obtained from: http://curl.haxx.se/docs/caextract.html

Quickstart guide
----------------

Add both of the files provided ( twitch.tv, cacert.pem ) to your project and include them into the file/project where you wish to use the Twitch.TV API.

All of the methods are static so you do not need to initialize the class. Each method returns a JSON decoded array of the response from Twitch.

### Get a User

```php
$user = TwitchTV::get_user( 'darrentaytay' );
```

### Get a Channel

```php
$channel = TwitchTV::get_channel( 'darrentaytay' );
```

### Get a Stream for a specific channel

```php
$stream = TwitchTV::get_stream( 'darrentaytay' );
```

### Get Featured Streams

Get a list of all the streams currently featured on Twitch with support for optional `limit` and `offset` parameters.

```php
// Get all featured streams
$featured_streams = TwitchTV::get_featured_streams();

// Get all featured streams limit by 10
$featured_streams = TwitchTV::get_featured_streams( 10 );
```

### Get Streams for a particular game

Get a list of all the streams on Twitch for a particular game with support for optional `limit` and `offset` parameters.

```php
// Get all League of Legends streams
$streams = TwitchTV::get_streams_by_game( 'League of Legends' );

// Get all League of Legends streams limit by 10
$streams = TwitchTV::get_streams_by_game( 'League of Legends', 10 );
```

### Get Streams for a specified list of channels

Get only the streams which exist and are live for an array of channels with support for optional `limit` and `offset` parameters.

```php
// This example would return streams for whichever of the channels below (ipllol or mlglol) are streaming
$channels = array( 'ipllol', 'mlglol' );
$streams = TwitchTV::get_streams_by_channel( $channels );
```

Planned Features
----------------

* Error Handling
* Support for authenticated endpoints
* Make documentation better!
