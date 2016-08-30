# Minneola Framework
This is the main source of the Minneola Framework. You can find a sample
installation on [https://github.com/Minneola/Foo](https://github.com/Minneola/Foo).

## Contributor
- Tobias Maxham [<git2016@maxham.de>](mailto:git2016@maxham.de)
- Heiko Stark (former DengoPHP employee)
- Nobert For (former DengoPHP employee)

# Installation
```
composer require minneola/testfoo
```

# Documentation
We will provide a full documentation on the Wiki section of GitHub.
You can find it here: [Full Wiki Documentation](https://github.com/Minneola/Foo/wiki)
While we work on it here is a short one for getting started.

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$app = new \Minneola\TestFoo\Core\Application(realpath(__DIR__.'/../'));
$app->boot();
$app->run();
```


# Licence

[MIT](LICENCE)
