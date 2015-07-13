<?php

namespace Desk\Core\Services\Config;


interface ConfigReader {
    public function get($property = null);
    public function has($property);
}