<?php

namespace Tests\Entity;

use PHPUnit\Framework\TestCase as PFT;
use PierInfor\Gears\Components\System;
use PierInfor\Gears\Entity\Gears;

/**
 * @covers \PierInfor\Gears\Components\System::<public>
 */
class SystemTest extends PFT
{
    const TEST_ENABLE = true;

    const _METHOD_RATIO = 'ratio';
    const _METHOD_TORQUE_OUT = 'torqueOut';
    const _METHOD_SPEED_OUT = 'speedOut';
    const _EXPECTED_INIT = 0;
    const _ONE = 1;
    const _EXPECTED_NB_GEAR = 4;
    const _EXPECTED_ID = 'A';
    const _EXPECTED_TEETH = 8;
    const _EXPECTED_SPEED = 150;
    const _EXPECTED_TORQUE = 20;
    const _FIXTURE_DISTINCT_LOAD_PATH = '/tests/fixtures/Entity/Gears4distinct.json';
    const _FIXTURE_COMPOSED_LOAD_PATH = '/tests/fixtures/Entity/Gears4composed.json';

    /**
     * instance
     *
     * @var System|null
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
        $this->instance = new System();
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
        $class = new \ReflectionClass(System::class);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        unset($class);
        return $method;
    }

    /**
     * testInstance
     * @covers PierInfor\Gears\Components\System::__construct
     */
    public function testInstance(): void
    {
        $this->assertTrue($this->instance instanceof System);
    }

    /**
     * testLoad
     * @covers PierInfor\Gears\Components\System::load
     * @covers PierInfor\Gears\Components\System::getGears
     * @covers PierInfor\Gears\Entity\Gears::getGears
     */
    public function testLoad(): void
    {
        $this->instance->load(getcwd() . self::_FIXTURE_DISTINCT_LOAD_PATH);
        $sysGears = $this->instance->getGears();
        $this->assertTrue($sysGears instanceof Gears);
        $gears = $sysGears->getGears();
        $this->assertTrue(is_array($gears));
        $this->assertEquals(count($gears), self::_EXPECTED_NB_GEAR);
        unset($gears);
        unset($sysGears);
    }

    /**
     * testProcessDistinct
     * @covers PierInfor\Gears\Components\System::load
     * @covers PierInfor\Gears\Components\System::getGears
     * @covers PierInfor\Gears\Components\System::process
     * @covers PierInfor\Gears\Components\System::__toString
     * @covers PierInfor\Gears\Entity\Gears::getGears
     */
    public function testProcessDistinct(): void
    {
        $this->instance->load(getcwd() . self::_FIXTURE_DISTINCT_LOAD_PATH);
        $sysGears = $this->instance->getGears();
        $this->assertTrue($sysGears instanceof Gears);
        $gearsBefore = $sysGears->getGears();
        $this->assertTrue(is_array($gearsBefore));
        $nbGearBefore = count($gearsBefore);
        $this->assertEquals($nbGearBefore, self::_EXPECTED_NB_GEAR);
        $cursor = 0;
        $this->assertEquals($gearsBefore[$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getTeeth(), self::_EXPECTED_TEETH);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_SPEED);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_TORQUE);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        $this->assertNotEquals($gearsBefore[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        $this->assertNotEquals($gearsBefore[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        $this->assertNotEquals($gearsBefore[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        unset($gearsBefore);
        $this->instance->process();
        $gearsAfter = $sysGears->getGears();
        $nbGearAfter = count($gearsAfter);
        $this->assertTrue(is_array($gearsAfter));
        $this->assertEquals($nbGearAfter, self::_EXPECTED_NB_GEAR);
        $cursor = 0;
        $this->assertEquals($gearsAfter[$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getTeeth(), self::_EXPECTED_TEETH);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), self::_EXPECTED_SPEED);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), self::_EXPECTED_TORQUE);
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertTrue($gearsAfter[$cursor]->getForward());
        $this->assertNotEquals($gearsAfter[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), 120);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), 25);
        $this->assertFalse($gearsAfter[$cursor]->getForward());
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertNotEquals($gearsAfter[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), 60);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), 50);
        $this->assertTrue($gearsAfter[$cursor]->getForward());
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertNotEquals($gearsAfter[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), 150);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), 20);
        $this->assertEquals($gearsAfter[$cursor]->getForward(), false);
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertNotEmpty((string) $this->instance);
        unset($gearsAfter);
    }

    /**
     * testProcessComposed
     * @covers PierInfor\Gears\Components\System::load
     * @covers PierInfor\Gears\Components\System::getGears
     * @covers PierInfor\Gears\Components\System::process
     * @covers PierInfor\Gears\Components\System::__toString
     * @covers PierInfor\Gears\Entity\Gears::getGears
     */
    public function testProcessComposed(): void
    {
        $this->instance->load(getcwd() . self::_FIXTURE_COMPOSED_LOAD_PATH);
        $sysGears = $this->instance->getGears();
        $this->assertTrue($sysGears instanceof Gears);
        $gearsBefore = $sysGears->getGears();
        $this->assertTrue(is_array($gearsBefore));
        $nbGearBefore = count($gearsBefore);
        $this->assertEquals($nbGearBefore, self::_EXPECTED_NB_GEAR);
        $cursor = 0;
        $this->assertEquals($gearsBefore[$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getTeeth(), self::_EXPECTED_TEETH);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_SPEED);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_TORQUE);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        $this->assertNotEquals($gearsBefore[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        $this->assertNotEquals($gearsBefore[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertTrue($gearsBefore[$cursor]->getComposed());
        $this->assertNotEquals($gearsBefore[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsBefore[$cursor]->getSpeed(), self::_EXPECTED_INIT);
        $this->assertEquals($gearsBefore[$cursor]->getTorque(), self::_EXPECTED_INIT);
        $this->assertTrue($gearsBefore[$cursor]->getForward());
        $this->assertFalse($gearsBefore[$cursor]->getComposed());
        unset($gearsBefore);
        $this->instance->process();
        $gearsAfter = $sysGears->getGears();
        $nbGearAfter = count($gearsAfter);
        $this->assertTrue(is_array($gearsAfter));
        $this->assertEquals($nbGearAfter, self::_EXPECTED_NB_GEAR);
        $cursor = 0;
        $this->assertEquals($gearsAfter[$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getTeeth(), self::_EXPECTED_TEETH);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), self::_EXPECTED_SPEED);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), self::_EXPECTED_TORQUE);
        $this->assertTrue($gearsAfter[$cursor]->getForward());
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertNotEquals($gearsAfter[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), 120);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), 25);
        $this->assertFalse($gearsAfter[$cursor]->getForward());
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertNotEquals($gearsAfter[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), 120);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), 25);
        $this->assertFalse($gearsAfter[$cursor]->getForward());
        $this->assertTrue($gearsAfter[$cursor]->getComposed());
        $this->assertNotEquals($gearsAfter[++$cursor]->getId(), self::_EXPECTED_ID);
        $this->assertEquals($gearsAfter[$cursor]->getSpeed(), 300);
        $this->assertEquals($gearsAfter[$cursor]->getTorque(), 10);
        $this->assertTrue($gearsAfter[$cursor]->getForward());
        $this->assertFalse($gearsAfter[$cursor]->getComposed());
        $this->assertNotEmpty((string) $this->instance);
        unset($gearsAfter);
    }

    /**
     * data provider for protected methods
     * @return float[][]
     */
    public function protectedProvider(): array
    {
        return [
            [self::_EXPECTED_INIT, self::_EXPECTED_INIT, self::_EXPECTED_INIT],
            [self::_ONE, self::_EXPECTED_INIT, self::_EXPECTED_INIT],
            [self::_EXPECTED_INIT, self::_ONE, self::_EXPECTED_INIT],
            [self::_ONE, self::_ONE, self::_ONE],
        ];
    }

    /**
     * testRatio
     * @covers PierInfor\Gears\Components\System::ratio
     * @dataProvider protectedProvider
     */
    public function testRatio(float $teethIn, float $teethOut, float $expected): void
    {
        $this->assertEquals(
            self::getMethod(self::_METHOD_RATIO)->invokeArgs($this->instance, [$teethIn, $teethOut]),
            $expected
        );
    }

    /**
     * testTorqueOut
     * @covers PierInfor\Gears\Components\System::torqueOut
     * @dataProvider protectedProvider
     */
    public function testTorqueOut(float $ratio, float $torqueIn, float $expected): void
    {
        $this->assertEquals(
            self::getMethod(self::_METHOD_TORQUE_OUT)->invokeArgs($this->instance, [$ratio, $torqueIn]),
            $expected
        );
    }

    /**
     * testSpeedOut
     * @covers PierInfor\Gears\Components\System::speedOut
     * @dataProvider protectedProvider
     */
    public function testSpeedOut(float $speedIn, float $ratio, float $expected): void
    {
        $this->assertEquals(
            self::getMethod(self::_METHOD_SPEED_OUT)->invokeArgs($this->instance, [$speedIn, $ratio]),
            $expected
        );
    }
}
