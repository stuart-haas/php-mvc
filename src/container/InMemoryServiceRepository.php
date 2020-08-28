<?php

namespace app\container;

class InMemoryServiceRepository implements ServiceRepository {

    private $services = [];

    public function add($id, $service)
    {
        $this->services[$id] = $service;
    }

    public function get($id) 
    {
        if(!isset($this->services[$id])) {
            return null;
        }

        return $this->services[$id];
    }
}