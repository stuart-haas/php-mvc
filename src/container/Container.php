<?php

namespace app\container;

class Container {

    private $repository;
    private $factory;
    private $servicesCreating = [];

    public static function instance(ServiceFactory $factory, ServiceRepository $repository = null) {
        return new Container($factory, $repository);
    }

    private function __construct(ServiceFactory $factory, ServiceRepository $repository = null)
    {
        $this->repository = $repository ?: new InMemoryServiceRepository();
        $this->factory = $factory;
    }

    public function add($id, $service)
    {
        $this->repository->add($id, $service);
    }

    public function get($id)
    {
        $service = $this->repository->get($id);

        if(is_null($service)) {
            if(isset($this->servicesCreating[$id])) {
                $msg = 'Circular dependency detected: ' . implode(' => ', array_keys($this->servicesCreating)) . " => {$id}";
                throw new \Exception($msg);
            }

            $this->servicesCreating[$id] = true;

            $service = $this->factory->create($id, $this);

            unset($this->servicesCreating[$id]);

            $this->repository->add($id, $service);
        }

        return $service;
    }
}