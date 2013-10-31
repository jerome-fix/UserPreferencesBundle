<?php

namespace Jfx\UserPreferencesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Jfx\UserPreferencesBundle\Model\PreferenceInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Preference
 *
 * @ORM\Table(name="jfx__user__preferences")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Jfx\UserPreferencesBundle\Entity\PreferenceRepository")
 */
class Preference implements PreferenceInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="\Application\Sonata\UserBundle\Entity\User", inversedBy="preferences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull(message = "jfx_user_preferences.user.not_null")
     */
    private $user;
        
    /**
     * @var json_array
     *
     * @ORM\Column(name="data", type="json_array")
     */
    private $data;
        
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \Application\Sonata\UserBundle\Entity\User $user
     * @return Preference
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }


    /**
     * Set data
     *
     * @param array $data
     * @return Preference
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }
}