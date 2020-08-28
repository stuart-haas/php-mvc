<?php

namespace app\container;

interface ServiceFactory {

    public function create($id, Container $container);
}