GRABBER
===============================
### Run check and delete for double urls

```
 ./yii maintenance/check-for-double-urls
 ./yii maintenance/delete-double-urls

```

### Run memcached

```
memcached -u memcached -d -m 30 -l 127.0.0.1 -p 11211

```
### Add cron work
```
Download video:
* * * * * php /path/to/grabber/yii download/download-now > /dev/null 2>&1
Parse pages to find new video:
* * * * * php /path/to/grabber/yii parse/parse-start-links > /dev/null 2>&1
```

#### Setup auto start

Make sure you use the version number that got installed previously:

    mkdir -p ~/Library/LaunchAgents
    cp /usr/local/opt/php56/homebrew.mxcl.php56.plist ~/Library/LaunchAgents/

Start PHP-FPM:

    launchctl load -w ~/Library/LaunchAgents/homebrew.mxcl.php56.plist

To debug turn of PHP-FPM:

    launchctl unload -w ~/Library/LaunchAgents/homebrew.mxcl.php56.plist
    
Check that PHP-FPM is listening on port 9000:

    lsof -Pni4 | grep LISTEN | grep php


