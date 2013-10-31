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
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class PreferenceManager
{

    protected $em;
    protected $preferences;

    public function __construct(EntityManager $em, $preferences)
    {
        $this->em = $em;
        $this->preferences = $preferences;
    }

    /**
     * 
     * @param \Symfony\Component\Security\Core\User\AdvancedUserInterface $user
     * @param string $prefs
     * @return mixte
     */
    public function getPreference(AdvancedUserInterface $user, $prefs)
    {

        if (!in_array($prefs, array_keys($this->preferences))) {
            throw new \Exception(sprintf("The %s preference does not exist.", $prefs));
        }

        if (null === ($preference = $this->findOneBy(array('user' => $user)) )) {
            return null;
        }

        $out = null;
        $datas = $preference->getData();
        switch ($this->preferences[$prefs]['type']) {
            case 'entity' :
                $out = $this->em->getRepository($this->preferences[$prefs]['attributes']['class'])
                                ->findBy(array('id' => $datas[$prefs]));
                break;
            default :
                $out = $datas[$prefs];
        }
        return $out;
    }

    /**
     * 
     * @return \Jfx\UserPreferencesBundle\Entity\Preference
     */
    public function createPreference()
    {
        return new \Jfx\UserPreferencesBundle\Entity\Preference();
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
