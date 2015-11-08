<?php

namespace Achievement\Student\Domain\Model;

/**
 * @implements ProfileInterface
 */

class Profile implements ProfileInterface
{
    protected $registrationCode;

    protected $phoneticName;

    protected $fullname;

    protected $dob;

    protected $gender;

    protected $grade;

    protected $account;

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
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Sets the value of fullame.
     *
     * @param mixed $fullame the fullame
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
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Sets the value of dob.
     *
     * @param mixed $dob the dob
     *
     * @return self
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Gets the value of gender.
     *
     * @return mixed
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
     * @return mixed
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
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }
}
