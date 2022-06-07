<?php

namespace Tests\Entity;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Gears\Entity\Gears;
use PierInfor\Gears\Entity\Gear;

/**
 * @covers \PierInfor\Gears\Entity\Gears::<public>
 */
class GearsTest extends PFT
{
    const TEST_ENABLE = true;

    const _FIXTURE_HYDRATE_PATH = '/tests/fixtures/Entity/Gears4distinct.json';
    const _EXPECTED_INIT = 0;
    const _EXPECTED_ID_A = 'A';
    const _EXPECTED_ID_B = 'B';

    const _EXPECTED_TEETH = 8;
    const _EXPECTED_SPEED = 150;
    const _EXPECTED_TORQUE = 20;

    /**
     * instance
     *
     * @var Gears|null
     */
    protected $instance;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        if (!self::TEST_ENABLE) {
            $this->markTestSkipped('Test disabled.');
        }
        $this->instance = new Gears();
        $this->instance->hydrate(json_decode(file_get_contents(getcwd() . self::_FIXTURE_HYDRATE_PATH)));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        $this->instance = null;
    }

    /**
     * get any method from a class to be invoked whatever the scope
     *
     * @param String $name
     * @return \ReflectionMethod
     */
    protected static function getMethod(string $name): \ReflectionMethod
    {
        $class = new \ReflectionClass(Gears::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Gears\Entity\Gears::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Gears);
    }

    /**
     * testGearsGetter
     * @covers PierInfor\Gears\Entity\Gears::getGears
     * @covers PierInfor\Gears\Entity\Gear::getId
     * @covers PierInfor\Gears\Entity\Gear::getTeeth
     * @covers PierInfor\Gears\Entity\Gear::getSpeed
     * @covers PierInfor\Gears\Entity\Gear::getTorque
     */
    public function testGearsGetter(): void
    {
        $gears = $this->instance->getGears();
        $this->assertNotEmpty($gears);
        $this->assertTrue(is_array($gears));
        $this->assertEquals(count($gears), 4);
        $firstGear = $gears[0];
        $this->assertTrue($firstGear instanceof Gear);
        $this->assertEquals($firstGear->getId(), self::_EXPECTED_ID_A);
        $this->assertEquals($firstGear->getTeeth(), self::_EXPECTED_TEETH);
        $this->assertEquals($firstGear->getSpeed(), self::_EXPECTED_SPEED);
        $this->assertEquals($firstGear->getTorque(), self::_EXPECTED_TORQUE);
        $secondeGear = $gears[1];
        $this->assertTrue($secondeGear instanceof Gear);
        $this->assertEquals($secondeGear->getId(), self::_EXPECTED_ID_B);
        $this->assertEquals($secondeGear->getTeeth(), 10);
        $this->assertEquals($secondeGear->getSpeed(), 0);
        $this->assertEquals($secondeGear->getTorque(), 0);
    }

    /**
     * testGearsSetter
     * @covers PierInfor\Gears\Entity\Gears::setGears
     * @covers PierInfor\Gears\Entity\Gears::getGears
     * @covers PierInfor\Gears\Entity\Gear::getId
     */
    public function testGearsSetter(): void
    {
        $g1 = (new Gear())
            ->setId(self::_EXPECTED_ID_A)
            ->setSpeed(self::_EXPECTED_SPEED)
            ->setTorque(self::_EXPECTED_TORQUE)
            ->setTeeth(self::_EXPECTED_TEETH);
        $g2 = clone $g1;
        $g2->setId(self::_EXPECTED_ID_B);
        $this->instance->setGears([$g1, $g2]);
        $gears = $this->instance->getGears();
        $this->assertNotEmpty($gears);
        $this->assertEquals(count($gears), 2);
        $this->assertEquals($gears[0]->getId(), self::_EXPECTED_ID_A);
        $this->assertEquals($gears[1]->getId(), self::_EXPECTED_ID_B);
    }
}
