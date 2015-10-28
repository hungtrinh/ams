<?php

namespace Achievement\Account\Validator;

use Zend\Validator\ValidatorPluginManager;
use Zend\Validator\Db\NoRecordExists;

class UsernameUniqueFactory
{
    public function __invoke(ValidatorPluginManager $validatorManager)
    {
        /**
         *  @todo get database adapter and init for NoRecordExist.
         * $databaseAdapter = $validatorManager->getServiceLocator()->get(\Zend\Db\Adapter\Adapter::class);
         */
        return new NoRecordExists([
            'table' => 'user',
            'field' => 'username'
        ]);
    }
}
