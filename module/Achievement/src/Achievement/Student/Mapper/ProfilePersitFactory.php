<?php

namespace Achievement\Student\Mapper;

use Zend\ServiceManager\ServiceManager;
use Achievement\Student\Hydrator;

/**
 * Create an instance of ProfilePersitInterface
 */
class ProfilePersitFactory
{
    public function __invoke(ServiceManager $services)
    {
        $databaseAdapter = $services->get('ams');
        $hydrators = $services->get('HydratorManager');
        $profileMapperHydrator = $hydrators->get(Hydrator::PROFILE_MAPPER_HYDRATOR);
        return new ProfilePersitTableGateway(
            $databaseAdapter,
            $profileMapperHydrator
        );
    }
}
