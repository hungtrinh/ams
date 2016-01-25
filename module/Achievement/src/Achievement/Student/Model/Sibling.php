<?php
namespace Achievement\Student\Model;

use Achievement\Student\Model\InvalidArgumentException;
use DateTime;

class Sibling
{
    /**
     * @var string
     */
    protected $fullname;

    /**
     * Date of bird
     * @var \DateTime | null
     */
    protected $dob;

    /**
     * @var int
     */
    protected $relationship;

    /**
     * work description
     * @var string
     */
    protected $work;

    
    /**
     * @return \DateTime | null
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Gets the value of fullname.
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Gets the value of relationship.
     *
     * @return int
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Gets the work description.
     *
     * @return string
     */
    public function getWork()
    {
        return $this->work;
    }
    
    /**
     * @param \DateTime | null $dob
     */
    public function setDob($dob)
    {
        if (null !== $dob && ! $dob instanceof DateTime) {
            throw new InvalidArgumentException('dob is null or datetime type');
        }
        $this->dob = $dob;

        return $this;
    }
    
    /**
     * Sets the value of fullname.
     *
     * @param string $fullname the fullname
     *
     * @return self
     */
    public function setFullname($fullname)
    {
        if (empty($fullname)) {
            throw InvalidArgumentException('fullname required');
        }
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Sets the value of relationship.
     *
     * @param int $relationship the relationship
     *
     * @return self
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;

        return $this;
    }

    /**
     * Sets the work description.
     *
     * @param string $work the work
     *
     * @return self
     */
    public function setWork($work)
    {
        $this->work = $work;

        return $this;
    }
}
