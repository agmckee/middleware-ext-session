<?php namespace agmckee\SessionMiddleware;

class ConfigProvider {

    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'aliases' => [
                SessionPersistenceInterface::class => SessionPersistence::class,
            ],
            'invokables' => [
                SessionPersistence::class => SessionPersistence::class,
            ],
        ];
    }
}