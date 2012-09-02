Example of standalone usage of dependency injection container from Symfony

(remember to install vendors first with "composer install")

```php
<?php
include __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.yml');

echo $container->get('app')->hello();
```

Using a yaml file defining services:
```
services:
  app:
    class:     App
    arguments: [@Proxy]
  proxy:
    class:     Proxy
    arguments: [@Curl]
  curl:
    class:     Curl
```

Whith those three classes:

```php
<?php
class App
{
    private $proxy;

    public function __construct(Proxy $proxy)
    {
        $this->proxy = $proxy;
    }

    public function hello()
    {
        return $this->proxy->hello();
    }
}

class Curl
{
    public function doGet()
    {
        return "Hello";
    }
}

class Proxy
{
    private $curl;

    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    public function hello()
    {
        return $this->curl->doGet();
    }
}
```