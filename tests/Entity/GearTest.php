<?php

namespace Tests\Entity;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Gears\Entity\Gear;

/**
 * @covers \PierInfor\Gears\Entity\Gear::<public>
 */
class GearTest extends PFT
{
    const TEST_ENABLE = true;
    const _EXPECTED_INIT = 0;
    const _EXPECTED_ID = 'A';
    const _EXPECTED_TEETH = 8;
    const _EXPECTED_SPEED = 10;
    const _EXPECTED_TORQUE = 25;
    const _EXPECTED_SERIALIZED = '{"id":"A","teeth":8,"torque":25,"speed":10,"forward":true,"composed":false}';

    /**
     * instance
     *
     * @var Gear|null
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
        $this->instance = new Gear();
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
        $class = new \ReflectionClass(Gear::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Gears\Entity\Gear::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof Gear);
    }

    /**
     * testInit
     * @covers PierInfor\Gears\Entity\Gear::init
     * @covers PierInfor\Gears\Entity\Gear::getId
     * @covers PierInfor\Gears\Entity\Gear::getTeeth
     * @covers PierInfor\Gears\Entity\Gear::getSpeed
     * @covers PierInfor\Gears\Entity\Gear::getTorque
     * @covers PierInfor\Gears\Entity\Gear::getForward
     * @covers PierInfor\Gears\Entity\Gear::getForward
     */
    public function testInit(): void
    {
        $this->assertEmpty($this->instance->getId());
        $this->assertEquals($this->instance->getTeeth(), self::_EXPECTED_INIT);
        $this->assertEquals($this->instance->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($this->instance->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($this->instance->getForward());
        $this->assertFalse($this->instance->getComposed());
    }

    /**
     * testTeeth
     * @covers PierInfor\Gears\Entity\Gear::setTeeth
     * @covers PierInfor\Gears\Entity\Gear::getTeeth
     */
    public function testTeeth(): void
    {
        $this->assertTrue($this->instance->setTeeth(self::_EXPECTED_TEETH) instanceof Gear);
        $this->assertEquals($this->instance->getTeeth(), self::_EXPECTED_TEETH);
    }

    /**
     * testSpeed
     * @covers PierInfor\Gears\Entity\Gear::setSpeed
     * @covers PierInfor\Gears\Entity\Gear::getSpeed
     */
    public function testSpeed(): void
    {
        $this->assertTrue($this->instance->setSpeed(self::_EXPECTED_SPEED) instanceof Gear);
        $this->assertEquals($this->instance->getSpeed(), self::_EXPECTED_SPEED);
    }

    /**
     * testTorque
     * @covers PierInfor\Gears\Entity\Gear::setTorque
     * @covers PierInfor\Gears\Entity\Gear::getTorque
     */
    public function testTorque(): void
    {
        $expected = 60;
        $this->assertTrue($this->instance->setTorque(self::_EXPECTED_TORQUE) instanceof Gear);
        $this->assertEquals($this->instance->getTorque(), self::_EXPECTED_TORQUE);
    }

    /**
     * testForward
     * @covers PierInfor\Gears\Entity\Gear::setForward
     * @covers PierInfor\Gears\Entity\Gear::getForward
     */
    public function testForward(): void
    {
        $this->assertTrue($this->instance->setForward(false) instanceof Gear);
        $this->assertEquals($this->instance->getTeeth(), false);
    }

    /**
     * testSerialize
     * @covers PierInfor\Gears\Entity\Gear::setId
     * @covers PierInfor\Gears\Entity\Gear::setTeeth
     * @covers PierInfor\Gears\Entity\Gear::setSpeed
     * @covers PierInfor\Gears\Entity\Gear::setTorque
     */
    public function testSerialize(): void
    {
        $this->assertTrue($this->instance->setId(self::_EXPECTED_ID) instanceof Gear);
        $this->assertTrue($this->instance->setTeeth(self::_EXPECTED_TEETH) instanceof Gear);
        $this->assertTrue($this->instance->setSpeed(self::_EXPECTED_SPEED) instanceof Gear);
        $this->assertTrue($this->instance->setTorque(self::_EXPECTED_TORQUE) instanceof Gear);
        $this->assertEquals((string) $this->instance, self::_EXPECTED_SERIALIZED);
    }

    /**
     * testHydrate
     * @covers PierInfor\Gears\Entity\Gear::hydrate
     * @covers PierInfor\Gears\Entity\Gear::getId
     * @covers PierInfor\Gears\Entity\Gear::getTeeth
     * @covers PierInfor\Gears\Entity\Gear::getSpeed
     * @covers PierInfor\Gears\Entity\Gear::getTorque
     */
    public function testHydrate(): void
    {
        $this->instance->hydrate(json_decode(self::_EXPECTED_SERIALIZED));
        $this->assertEquals($this->instance->getId(), self::_EXPECTED_ID);
        $this->assertEquals($this->instance->getTeeth(), self::_EXPECTED_TEETH);
        $this->assertEquals($this->instance->getSpeed(), self::_EXPECTED_SPEED);
        $this->assertEquals($this->instance->getTorque(), self::_EXPECTED_TORQUE);
    }
}
