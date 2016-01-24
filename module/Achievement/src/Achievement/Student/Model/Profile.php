<?php

namespace Achievement\Student\Model;

use Achievement\Account\Model\AccountBasicInterface;
use DateTime;

/**
 * Student profile
 * @implements ProfileInterface
 */

class Profile implements ProfileInterface
{
    /**
     * @var string
     */
    protected $registrationCode;
    
    /**
     * @var string
     */
    protected $phoneticName;
    
    /**
     * @var string
     */
    protected $fullname;
    
    /**
     * @var \DateTime | null
     */
    protected $dob;
    
    /**
     * @var string
     */
    protected $gender;
    
    /**
     * @var string
     */
    protected $grade;
    
    /**
     * @var \Achievement\Account\Model\AccountBasicInterface
     */
    protected $account;

    /**
     * @var []\Achievement\Student\Model\Sibling | null
     */
    protected $siblings;

    /**
     * Gets the value of registrationCode.
     *
     * @return mixed
     */
    public function getRegistrationCode()
    {
        return $this->registrationCode;
    }

    /**
     * Sets the value of registrationCode.
     *
     * @param mixed $registrationCode the registration code
     *
     * @return self
     */
    public function setRegistrationCode($registrationCode)
    {
        $this->registrationCode = $registrationCode;

        return $this;
    }

    /**
     * Gets the value of phoneticName.
     *
     * @return mixed
     */
    public function getPhoneticName()
    {
        return $this->phoneticName;
    }

    /**
     * Sets the value of phoneticName.
     *
     * @param mixed $phoneticName the phonetic name
     *
     * @return self
     */
    public function setPhoneticName($phoneticName)
    {
        $this->phoneticName = $phoneticName;

        return $this;
    }

    /**
     * Gets the value of fullame.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Sets the value of fullame.
     *
     * @param mixed $fullname the fullame
     *
     * @return self
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Gets the value of dob.
     *
     * @return \DateTime | null
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Sets the value of dob.
     *
     * @param null | \DateTime $dob the dob
     *
     * @return self
     */
    public function setDob($dob)
    {
        if (null !== $dob && ! $dob instanceof DateTime) {
            throw new InvalidArgumentException;
        }
        
        $this->dob = $dob;

        return $this;
    }

    /**
     * Gets the value of gender.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets the value of gender.
     *
     * @param mixed $gender the gender
     *
     * @return self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Gets the value of grade.
     *
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Sets the value of grade.
     *
     * @param mixed $grade the grade
     *
     * @return self
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Gets the value of account.
     *
     * @return \Achievement\Account\Model\AccountBasicInterface
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Sets the value of account.
     *
     * @param mixed $account the account
     *
     * @return self
     */
    public function setAccount(AccountBasicInterface $account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return []\Achievement\Student\Model\Sibling | null
     */
    public function getSiblings()
    {
        return $this->siblings;
    }

    /**
     * Set the value of siblings
     *
     * @param []\Achievement\Student\Model\Sibling | null
     *
     * @return self
     */
    public function setSiblings($siblings)
    {
        $this->siblings = $siblings;

        return $this;
    }
}
