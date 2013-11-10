<?php

/**
 * This file is part of the Zapoyok Holiday project.
 *
 * (c) Jérôme FIX <jerome.fix@zapoyok.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zapoyok\UserPreferencesBundle\Model;

use Symfony\Component\Validator\ExecutionContextInterface;

interface PreferenceInterface
{

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();
    
}
