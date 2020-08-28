<?php

namespace app\container;

interface ServiceRepository {

    public function add($id, $service);

    public function get($id);
}