<?php

namespace Achievement\Account\Model;

/**
 * Minimal account data access
 */
interface AccountBasicInterface
{
    /**
     * Get account id
     * @return int
     */
    public function getId();

    /**
     * Get account user name
     * @return string
     */
    public function getUsername();

    /**
     * Get account password
     * @return string
     */
    public function getPassword();
}
