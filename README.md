# TestForTransfer
What will be transfered

# Installation
```
composer require minneola/testfoo
```

# Documentation
```php
<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \Minneola\TestFoo\Core\Application(realpath(__DIR__.'/../'));
$app->boot();
$app->run();
```


# Licence

[MIT](LICENCE)
