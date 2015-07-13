<?php

namespace Desk\Core\Services\Config;


class EnvironmentConfigReader implements ConfigReader {
    public function get($property = null){
        if($this->has($property)){
            return getenv($property);
        }
        throw new \Exception("Invalid property");
    }
    public function has($property){
        if(!getenv($property)){
            return false;
        }
        return true;
    }
}