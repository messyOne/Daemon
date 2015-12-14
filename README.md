# Daemon
Simple PHP daemon which handles database tasks

## Usage
See example folder. There is an implemantation using Doctrine 2 for persisting and Monolog for logging. 

### How to run
Just run the `daemon.php` in a own PHP instance. 

I suggest using of a tool for daemonizing approaches. Such a tool could be [an example](http://supervisord.org/ "Supervisor"). An example config looks like:

```
  [program:daemon]
  command=/usr/bin/php /var/www/myproject/daemon/daemon.php
  user=www-data
  autostart=true
  autorestart=true
```
