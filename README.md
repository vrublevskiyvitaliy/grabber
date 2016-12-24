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
* * * * * php /path/to/grabber/yii download/download-now > /dev/null 2>&1
```
