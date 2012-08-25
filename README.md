twitch.tv-php-sdk
=================

A PHP SDK to interface with the public endpoints of http://twitch.tv REST API.


Quickstart guide
----------------

Add both of the files provided ( twitch.tv, cacert.pem ) to your project and include them into the file/project where you wish to use the Twitch.TV API.

All of the methods are static so you do not need to initialize the class.

### Get a User

TwitchTV::user( 'darrentaytay' );

### Notes

I had a requirement to interact with the twitch.tv REST API and quickly through this together. It's not perfect but it works.

Please note that this SDK only supports the public endpoints of the Twitch API but support for authenticated endpoints is planned.

### Planned Features

* Error Handling
* Support for authenticated endpoints

