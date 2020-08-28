<?php

namespace app\container;

class JsonServiceFactory implements ServiceFactory {

    private $serviceList;
    private $jsonObj;
    private $jsonConfigFile;

    public function __construct($configFile)
    {
        $this->jsonConfigFile = $configFile;
        $this->loadServiceList();
    }

    private function loadServiceList()
    {
        $this->loadJsonFile();

        foreach($this->jsonObj->services as $service) {
            $this->serviceList[$service->id] = $service;
        }
    }

    private function loadJsonFile()
    {
        $string = file_get_contents($this->jsonConfigFile);
        $this->jsonObj = json_decode($string);
    }

    private function instantiateService($id, $container)
    {
        $serviceData = $this->serviceList[$id];

        $reflector = new \ReflectionClass($serviceData->class);

        return $reflector->newInstanceArgs($this->getArgs($serviceData, $container));
    }

    private function getArgs(\stdClass $serviceData, Container $container)
    {
        $args = [];
        if(isset($serviceData->arguments)) {
            foreach($serviceData->arguments as $arg) {
                $args[] = $container->get($arg->id);
            }
        }

        return $args;
    }

    public function create($id, Container $container)
    {
        if(!isset($this->serviceList[$id])) {
            throw new \InvalidArgumentException("'$id' is not a registered service");
        }

        return $this->instantiateService($id, $container);
    }
}