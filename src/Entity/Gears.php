<?php

declare(strict_types=1);

namespace PierInfor\Gears\Entity;

use PierInfor\Gears\Entity\Gear;

/**
 * Gears entity accessors
 * 
 */
class Gears extends Serializable implements \JsonSerializable, GearsInterface
{
    use JsonSerializer;

    /** @var Gear[] */
    protected array $gears;

    /**
     * ctor
     */
    public function __construct()
    {
    }

    /**
     * returns gears
     * @return Gear[]
     */
    public function getGears(): array
    {
        return $this->gears;
    }

    /**
     * set gears
     * @param Gear[] $gears
     * @return Gears
     */
    public function setGears(array $gears): Gears
    {
        $gstack = [];
        if ($gears[0] instanceof Gear) {
            $this->gears = $gears;
            return $this;
        }
        foreach ($gears as $p) {
            if ($p instanceof \stdClass) {
                $gstack[] = (new Gear())->hydrate($p);
            }
        }
        $this->gears = $gstack;
        return $this;
    }
}
