<?php

namespace Koko\Http;

class Client
{
    public function getData(): string
    {
        return file_get_contents('https://jsonplaceholder.typicode.com/posts');
    }
}