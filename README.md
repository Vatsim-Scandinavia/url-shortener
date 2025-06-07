# URL Shortener
Super simple but working url shortener

## Configuration
You can configure the URLs by pull requesting to the `redirects.php` file.

## Caching
This application uses the OPCache to cache the compiled PHP code. Default setting is for production which means that the cache is not cleared automatically. To clear the cache, you need to restart the container if you change a file.

For development, change validate_timestamps to 1 in the /usr/local/etc/php/php.ini file to make sure that the cache is cleared automatically when a file is changed.