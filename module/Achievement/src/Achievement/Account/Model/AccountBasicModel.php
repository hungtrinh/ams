<?php

namespace Achievement\Account\Model;

class AccountBasicModel implements AccountBasicInterface
{
    /**
     * Account id
     * @var int
     */
    protected $id;

    /**
     * Account username
     * @var [type]
     */
    protected $username;

    /**
     * Account password
     * @var string
     */
    protected $password;

    /**
     * Gets the Account id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the Account username.
     *
     * @return [type]
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the Account password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the Account id.
     *
     * @param int $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Sets the Account username.
     *
     * @param [type] $username the username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Sets the Account password.
     *
     * @param string $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
