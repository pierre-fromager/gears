<?php

declare(strict_types=1);

namespace PierInfor\Gears\Entity;

/**
 * Gears contract for Gears class
 * 
 * @author      Pierre Fromager <info@pier-infor.fr>
 * @version     1.0
 * @copyright   GNU Public License.
 */
interface GearsInterface
{
    /**
     * returns gears
     * @return Gear[]
     */
    public function getGears(): array;


    /**
     * set gears
     * @param Gear[] $gears
     * @return Gears
     */
    public function setGears(array $gears): Gears;
}
