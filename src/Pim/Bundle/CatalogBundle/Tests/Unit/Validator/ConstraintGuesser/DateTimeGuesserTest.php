<?php

namespace Pim\Bundle\CatalogBundle\Tests\Unit\Validator\ConstraintGuesser;

use Pim\Bundle\CatalogBundle\Validator\ConstraintGuesser\DateTimeGuesser;

/**
 * Datetime guesser test
 *
 * @author    Filips Alpe <filips@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateTimeGuesserTest extends ConstraintGuesserTest
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->target = new DateTimeGuesser();
    }

    /**
     * Test object class
     */
    public function testInstanceOfContraintGuesserInterface()
    {
        $this->assertInstanceOf(
            'Pim\Bundle\FlexibleEntityBundle\Form\Validator\ConstraintGuesserInterface',
            $this->target
        );
    }

    /**
     * Test supportAttribute method
     */
    public function testSupportAttribute()
    {
        $this->assertTrue(
            $this->target->supportAttribute(
                $this->getAttributeMock(array('attributeType' => 'pim_catalog_date'))
            )
        );
    }

    /**
     * Test guessConstraints method
     */
    public function testGuessDateConstraint()
    {
        $constraints = $this->target->guessConstraints(
            $this->getAttributeMock(array('attributeType' => 'pim_catalog_date', 'dateType' => 'datetime'))
        );

        $this->assertContainsInstanceOf('Symfony\Component\Validator\Constraints\DateTime', $constraints);
    }

    /**
     * Test guessConstraints method with an unsupported attribute
     */
    public function testDoNotGuessDateConstraint()
    {
        $constraints = $this->target->guessConstraints(
            $this->getAttributeMock(array('attributeType' => 'pim_catalog_text'))
        );

        $this->assertEquals(0, count($constraints));
    }
}
