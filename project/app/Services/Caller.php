<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class Caller
{

    private $url;

    public function __construct(string $url)
    {
        $this -> url = $url;
    }

    public function call(string $query)
    {
        $response = Http::get($this ->url . $query);
 
        return $response;
    }
}