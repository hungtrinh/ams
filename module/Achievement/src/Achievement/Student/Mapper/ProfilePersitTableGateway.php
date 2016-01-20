<?php

namespace Achievement\Student\Mapper;

use Achievement\Student\Model\ProfileInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;

/**
 * Transformer student profile between database and application model
 * by using mysql table gateway adapter
 * @author hungtd
 */
class ProfilePersitTableGateway implements ProfilePersitInterface
{
    const STUDENT_TABLE_NAME = 'student';
    const USER_TABLE_NAME = 'user';

    /**
     * @var \Zend\Db\Adapter\AdapterInterface
     */
    protected $adapter;

    /**
     * @var \Zend\Stdlib\Hydrator\AbstractHydrator
     */
    protected $hydrator;

    public function __construct(
        AdapterInterface $adapter,
        HydratorInterface $studenMapperHydrator
    ) {
        $this->adapter  = $adapter;
        $this->hydrator = $studenMapperHydrator;
    }

    public function addNew(ProfileInterface $profile)
    {
        $userTable    = new TableGateway(self::USER_TABLE_NAME, $this->adapter);
        $studentTable = new TableGateway(self::STUDENT_TABLE_NAME, $this->adapter);
        try {
            $this->adapter->getDriver()->getConnection()->beginTransaction();

            $profileRaw = $this->hydrator->extract($profile);
            $userRaw = $profileRaw['account'];
            unset($profileRaw['account']);
            unset($userRaw['id']);
            $userTable->insert($userRaw);
            $userId = $userTable->getLastInsertValue();
            $profileRaw['user'] = $profile->getAccount()->getUsername();
            $studentTable->insert($profileRaw);
            
            $profile->getAccount()->setId($userId);

            $this->adapter->getDriver()->getConnection()->commit();
        } catch (\Exception $e) {
            $this->adapter->getDriver()->getConnection()->rollback();
        }
        return $profile;
    }
}
