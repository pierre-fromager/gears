<?php

declare(strict_types=1);

namespace PierInfor\Gears\Entity;

use PierInfor\Gears\Entity\GearInterface;

/**
 * Gear entity accessors
 *
 */
class Gear extends Serializable implements \JsonSerializable, GearInterface
{
    use JsonSerializer;

    /** @var string */
    protected string $id;

    /** @var float */
    protected float $teeth;

    /** @var float */
    protected float $torque;

    /** @var float */
    protected float $speed;

    /** @var bool */
    protected bool $forward;

    /** @var bool */
    protected bool $composed;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * init default values
     */
    protected function init(): void
    {
        $this->id = '';
        $this->torque = $this->speed = $this->teeth =  0;
        $this->forward = true;
        $this->composed = false;
    }

    /**
     * returns gear id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * set gear id
     */
    public function setId(string $id): Gear
    {
        $this->id = $id;
        return $this;
    }

    /**
     * returns number of tooth
     */
    public function getTeeth(): float
    {
        return $this->teeth;
    }

    /**
     * set number of tooth
     */
    public function setTeeth(float $teeth): Gear
    {
        $this->teeth = $teeth;
        return $this;
    }

    /**
     * returns torque in N.m
     */
    public function getTorque(): float
    {
        return $this->torque;
    }

    /**
     * set torque in N.m
     */
    public function setTorque(float $torque): Gear
    {
        $this->torque = $torque;
        return $this;
    }

    /**
     * returns speed in Rpm
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * set speed in Rpm
     */
    public function setSpeed(float $speed): Gear
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * returns true if forward direction
     */
    public function getForward(): bool
    {
        return $this->forward;
    }

    /**
     * set forward direction
     */
    public function setForward(bool $forward): Gear
    {
        $this->forward = $forward;
        return $this;
    }

    /**
     * returns true if composed
     */
    public function getComposed(): bool
    {
        return $this->composed;
    }

    /**
     * set true if composed
     */
    public function setComposed(bool $composed): Gear
    {
        $this->composed = $composed;
        return $this;
    }
}
