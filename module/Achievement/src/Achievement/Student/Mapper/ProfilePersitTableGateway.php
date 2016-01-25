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

    /**
     * Persit an student profile
     *
     * @param ProfileInterface $profile
     *
     * @return null | ProfileInterface null when persit not success
     */
    public function addNew(ProfileInterface $profile)
    {
        try {
            $this->adapter->getDriver()->getConnection()->beginTransaction();
            
            $studentProfile = $this->extractAccountAndProfilePersitFormat($profile);
            $this->insertProfile($studentProfile['profile']);
            $userId = $this->insertAccount($studentProfile['account']);
            $profile->getAccount()->setId($userId);

            $this->adapter->getDriver()->getConnection()->commit();
        } catch (\Exception $e) {
            $this->adapter->getDriver()->getConnection()->rollback();
            throw $e;
        }
        return $profile;
    }

    /**
     * Extract from profile objct in app format to profile persit data format
     * @return ['profile' => [], 'account' => []]
     */
    private function extractAccountAndProfilePersitFormat($profile)
    {
        $profileRaw = $this->hydrator->extract($profile);
        $profileRaw['user'] = $profile->getAccount()->getUsername();
        $userRaw = $profileRaw['account'];
        unset($profileRaw['account']);
        unset($profileRaw['siblings']);
        unset($userRaw['id']);
        return [
            'profile' => $profileRaw,
            'account' => $userRaw,
        ];
    }

    /**
     * Insert user account to persistent
     * @return int autoincrement id
     */
    private function insertAccount($userRaw)
    {
        $userTable    = new TableGateway(self::USER_TABLE_NAME, $this->adapter);
        $userTable->insert($userRaw);
        return$userTable->getLastInsertValue();
    }

    /**
     * Insert user profile to persistent
     * @return null | int autoincrement id
     */
    private function insertProfile($profileRaw)
    {
        $studentTable = new TableGateway(self::STUDENT_TABLE_NAME, $this->adapter);
        $studentTable->insert($profileRaw);
        return null;
    }
}
