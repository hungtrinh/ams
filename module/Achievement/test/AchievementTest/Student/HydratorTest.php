<?php

namespace AchievementTest\Student;

use PHPUnit_Framework_TestCase;
use Achievement\Student\Hydrator;

class HydatorTest extends PHPUnit_Framework_TestCase
{
    public function testHasConstProfileFormHydratorSupportAccessGetHydratorByHydratorManager()
    {
        $this->assertEquals('ProfileFormHydrator', Hydrator::PROFILE_FORM_HYDRATOR);
    }

    public function testHasConstProfileMapperHydratorSupportAccessGetHydratorByHydratorManager()
    {
        $this->assertEquals('ProfileMapperHydrator', Hydrator::PROFILE_MAPPER_HYDRATOR);
    }
}
