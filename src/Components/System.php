<?php

declare(strict_types=1);

namespace PierInfor\Gears\Components;

use PierInfor\Gears\Entity\Gears;
use PierInfor\Gears\Entity\Gear;

/**
 * System calculate system of gears
 * 
 */
class System implements SystemInterface
{
    /** @var Gears */
    protected Gears $gears;

    /** @var Gear */
    protected Gear $previousGear;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->gears = (new Gears());
    }

    /**
     * load gears from json file
     */
    public function load(string $filename): System
    {
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            $obj = json_decode($content);
            unset($content);
            if (false != $obj) {
                $this->gears->hydrate($obj);
            }
            unset($obj);
        }
        return $this;
    }

    /**
     * process gear system
     */
    public function process(): System
    {
        $cpt = 0;
        $gears = $this->gears->getGears();
        if (count($gears) > 0) {
            $forward = $gears[0]->getForward();
            foreach ($gears as $gear) {
                if ($gear instanceof Gear) {
                    if ($cpt != 0) {
                        if (!$gear->getComposed()) {
                            $forward = !$forward;
                        }
                        $gears[$cpt]->setForward($forward);
                        $ratio = $this->ratio($this->previousGear->getTeeth(), $gear->getTeeth());
                        $rpm = (!$gear->getComposed())
                            ? $this->speedOut($this->previousGear->getSpeed(), $ratio)
                            : $this->previousGear->getSpeed();
                        $gears[$cpt]->setSpeed($rpm);
                        $torque = (!$gear->getComposed())
                            ? $this->torqueOut($ratio, $this->previousGear->getTorque())
                            : $this->previousGear->getTorque();
                        $gears[$cpt]->setTorque($torque);
                    }
                    $this->previousGear = $gear;
                }
                $cpt++;
            }
            $this->gears->setGears($gears);
        }
        return $this;
    }

    /**
     * returns gears
     * @return Gears
     */
    public function getGears(): Gears
    {
        return $this->gears;
    }

    /**
     * returns system as string
     * @return string
     */
    public function __toString(): string
    {
        $lines = sprintf(
            static::_TITLE_FMT,
            static::_ID,
            static::_TEETH,
            static::_TORQUE,
            static::_SPEED,
            static::_FORWARD,
            static::_COMPOSED
        );
        $gears = $this->getGears()->getGears();
        foreach ($gears as $gear) {
            $lines .= sprintf(
                static::_ITEMS_FMT,
                $gear->getId(),
                $gear->getTeeth(),
                $gear->getTorque(),
                $gear->getSpeed(),
                $gear->getForward() ? static::_TRUE : static::_FALSE,
                $gear->getComposed() ?  static::_TRUE : static::_FALSE,
            );
        }
        unset($gears);
        return $lines;
    }

    /**
     * returns teeth ratio
     */
    protected function ratio(float $nbTeethIn, float $nbTeethOut): float
    {
        if ($nbTeethIn == 0) {
            return 0;
        }
        return $nbTeethOut / $nbTeethIn;
    }

    /**
     * returns speed in Rpm
     */
    protected function speedOut(float $rmpIn, float $ratio): float
    {
        if ($ratio == 0) {
            return 0;
        }
        return $rmpIn / $ratio;
    }

    /**
     * return torque in Nm
     */
    protected function torqueOut(float $ratio, float $torqueIn): float
    {
        return $ratio * $torqueIn;
    }
}
