# monolog-xmpp
XMPP handler for [Monolog](https://github.com/Seldaek/monolog), uses [XMPP Library](https://github.com/stanxdev/fabiang-xmpp)

## Installation

Install the latest version with

```bash
$ composer require stanx/monolog-xmpp
```

## Usage

```php
<?php

use Fabiang\Xmpp\Client as XmppClient;
use Fabiang\Xmpp\Options as XmppOptions;
use Monolog\Logger;
use Stanx\Monolog\Handler\XmppHandler;

// Create XMPP Client
$options = new XmppOptions('tcp://jabber.host:5222');
$options->setUsername('username')
        ->setPassword('password')
        ->setTimeout(10);
        
$xmpp = new XmppClient($options);

// Create log channel
$log = new Logger('name');

// Add XmppHandler with XmppClient, receivers and log level as parameters
$log->pushHandler(new XmppHandler($xmpp, ['receiver@jabber.host'], Logger::WARNING));

// Add records to log
$log->waring('Foo');
$log->error('Bar');
```

### License

This library is licensed under the MIT license. See the [LICENSE](./LICENSE) file for details.

