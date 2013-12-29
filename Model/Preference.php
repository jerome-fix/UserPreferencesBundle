<?php

namespace Zapoyok\UserPreferencesBundle\Model;

use Zapoyok\UserPreferencesBundle\Model\PreferenceInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Preference
 */
abstract class Preference implements PreferenceInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @Assert\NotNull(message = "zapoyok_user_preferences.user.not_null")
     */
    protected $user;

    /**
     * @var json_array
     *
     */
    protected $data;

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
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return Preference
     */
    public function setUser(UserInterface $user)
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