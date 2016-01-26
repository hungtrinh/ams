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
    const SIBLING_TABLE_NAME = 'sibling';

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
        HydratorInterface $studenMysqlHydrator
    ) {
        $this->adapter  = $adapter;
        $this->hydrator = $studenMysqlHydrator;
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
            $this->insertListSibling($studentProfile['siblings']);
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
        $username = $profile->getAccount()->getUsername();
        $profileRaw = $this->hydrator->extract($profile);
        $profileRaw['user'] = $username;
        $userRaw = $profileRaw['account'];
        $siblings = $profileRaw['siblings'];
        
        if ($siblings && is_array($siblings)) {
            foreach ($siblings as &$sibling) {
                $sibling['username'] = $username;
            }
        }

        unset($profileRaw['account']);
        unset($profileRaw['siblings']);
        unset($userRaw['id']);

        return [
            'profile' => $profileRaw,
            'account' => $userRaw,
            'siblings' => $siblings,
        ];
    }

    /**
     * Insert user account to persistent store
     * @return int autoincrement id
     */
    private function insertAccount($userRaw)
    {
        $userTable    = new TableGateway(self::USER_TABLE_NAME, $this->adapter);
        $userTable->insert($userRaw);
        return$userTable->getLastInsertValue();
    }

    /**
     * Insert user profile to persistent store
     * @return null | int autoincrement id
     */
    private function insertProfile($profileRaw)
    {
        $studentTable = new TableGateway(self::STUDENT_TABLE_NAME, $this->adapter);
        $studentTable->insert($profileRaw);
        return null;
    }

    /**
     * Insert sibling to persistent store
     * @return null | int autoincrement id
     */
    private function insertSibling($siblingRaw)
    {
        $siblingTable = new TableGateway(self::SIBLING_TABLE_NAME, $this->adapter);
        $siblingTable->insert($siblingRaw);
        return $siblingTable->getLastInsertValue();
    }

    /**
     * Insert multiple sibling to persistent store
     * @param  array $listSiblingRaw
     * @return void
     */
    private function insertListSibling($listSiblingRaw)
    {
        if (!is_array($listSiblingRaw)) {
            return;
        }
        foreach ($listSiblingRaw as $siblingRaw) {
            $this->insertSibling($siblingRaw);
        }
    }
}
