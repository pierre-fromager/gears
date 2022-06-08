<?php

declare(strict_types=1);

namespace PierInfor\Gears\Entity;

/**
 * Gear contract for Gear class
 *
 * @author      Pierre Fromager <info@pier-infor.fr>
 * @version     1.0
 * @copyright   GNU Public License.
 */
interface GearInterface
{
    /**
     * returns gear id
     * @return string
     */
    public function getId(): string;

    /**
     * set gear id
     * @param string $id
     * @return Gear
     */
    public function setId(string $id): Gear;

    /**
     * returns number of tooth
     * @return float
     */
    public function getTeeth(): float;

    /**
     * set number of tooth
     * @param float $teeth
     * @return Gear
     */
    public function setTeeth(float $teeth): Gear;

    /**
     * returns torque in N.m
     * @return float
     */
    public function getTorque(): float;

    /**
     * set torque in N.m
     * @param float $torque
     * @return Gear
     */
    public function setTorque(float $torque): Gear;

    /**
     * returns speed in Rpm
     * @return float
     */
    public function getSpeed(): float;

    /**
     * set speed in Rpm
     * @param float $speed
     * @return Gear
     */
    public function setSpeed(float $speed): Gear;

    /**
     * returns true if forward direction
     * @return bool
     */
    public function getForward(): bool;

    /**
     * set forward direction
     * @param bool $forward
     * @return Gear
     */
    public function setForward(bool $forward): Gear;

    /**
     * returns true if composed
     * @return bool
     */
    public function getComposed(): bool;

    /**
     * set true if composed
     * @param bool $composed
     * @return Gear
     */
    public function setComposed(bool $composed): Gear;
}
