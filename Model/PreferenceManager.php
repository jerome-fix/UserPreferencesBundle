<?php

/**
 * This file is part of the Nvision Holiday project.
 *
 * (c) Jérôme FIX <jerome.fix@zapoyok.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jfx\UserPreferencesBundle\Model;

use Doctrine\ORM\EntityManager;

class PreferenceManager 
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     *
     */
    public function createPreference()
    {
        return new \Jfx\UserPreferencesBundle\Entity\Preference();
    }
    
    public function retrieve(Array $params)
    {
        return $this->getRepository()->retrieve($params);
    }

    public function getRepository()
    {
        return $this->em->getRepository('JfxUserPreferencesBundle:Preference');
    }
    
    public function findBy(array $criteria, array $orderBy = null)
    {
        return $this->getRepository()->findBy($criteria, $orderBy);
    }
    
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->getRepository()->findOneBy($criteria, $orderBy);
    }
    
    protected function persistAndFlush($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

}
