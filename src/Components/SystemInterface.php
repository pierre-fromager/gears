<?php

declare(strict_types=1);

namespace PierInfor\Gears\Components;

use PierInfor\Gears\Entity\Gears;

/**
 * System contract for System class
 *
 * @author      Pierre Fromager <info@pier-infor.fr>
 * @version     1.0
 * @copyright   GNU Public License.
 */
interface SystemInterface
{
    const _TITLE_FMT = "%s % 6s % 7s % 6s % 8s % 9s\n";
    const _ITEMS_FMT = "%s % 5.0f % 8.0f % 7.0f % 7s % 8s\n";
    const _ID = 'Id';
    const _TEETH = 'Teeth';
    const _TORQUE = 'Torque';
    const _SPEED = 'Speed';
    const _FORWARD = 'Forward';
    const _COMPOSED = 'Composed';
    const _TRUE = 'true';
    const _FALSE = 'false';

    /**
     * load gears from json file
     * @param string $filename
     * @return System
     */
    public function load(string $filename): System;

    /**
     * process gear system
     * @return System
     */
    public function process(): System;

    /**
     * returns gears
     * @return Gears
     */
    public function getGears(): Gears;

    /**
     * returns system as string
     * @return string
     */
    public function __toString(): string;
}
