
User.orm.xml

<one-to-one field="preferences" target-entity="Jfx\UserPreferencesBundle\Entity\Preference" mapped-by="user" />

User.php

	/**
     * @var \Jfx\UserPreferencesBundle\Entity\Preference
     */
    protected $preferences;
    
    […]
    
    
    /**
     * Get preferences
     *
     * @return \Jfx\UserPreferencesBundle\Entity\Preference
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * 
     * @param \Jfx\UserPreferencesBundle\Model\PreferenceInterface $preferences
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function setPreferences(\Jfx\UserPreferencesBundle\Model\PreferenceInterface $preferences)
    {
        $this->preferences = $preferences;
        return $this;
    }
    
    
    
jfx_user_preferences:
  preferences:
    holidays:
      type: entity
      attributes:
        class: Jfx\HolidayBundle\Entity\Area
        multiple: true
        required: false
    notifications_by_email:
      type: checkbox
      attributes:
        label: user_preferences.form.notifications_by_email.label
        required: false    