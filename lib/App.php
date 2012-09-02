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