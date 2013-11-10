Ajouter : 

zapoyok_user_preferences:
    resource: "@ZapoyokUserPreferencesBundle//Resources/config/routing/preferences.xml"

au routing

User.orm.xml

<one-to-one field="preferences" target-entity="Zapoyok\UserPreferencesBundle\Entity\Preference" mapped-by="user" />

User.php

	/**
     * @var \Zapoyok\UserPreferencesBundle\Entity\Preference
     */
    protected $preferences;
    
    […]
    
    
    /**
     * Get preferences
     *
     * @return \Zapoyok\UserPreferencesBundle\Entity\Preference
     */
    public function getPreferences()
    {
        return $this->preferences;
    }

    /**
     * 
     * @param \Zapoyok\UserPreferencesBundle\Model\PreferenceInterface $preferences
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function setPreferences(\Zapoyok\UserPreferencesBundle\Model\PreferenceInterface $preferences)
    {
        $this->preferences = $preferences;
        return $this;
    }
    
    
    
zapoyok_user_preferences:
  preferences:
    holidays:
      type: entity
      attributes:
        class: Zapoyok\HolidayBundle\Entity\Area
        multiple: true
        required: false
    notifications_by_email:
      type: checkbox
      attributes:
        label: user_preferences.form.notifications_by_email.label
        required: false    
        
Créer un Bundle propre :  XYZUserPreferencesBundle.

<?php

namespace XYZ\Bundle\UserPreferencesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class XYZUserPreferencesBundle extends Bundle
{
    public function getParent()
    {
        return 'ZapoyokUserPreferencesBundle';
    }
}

Personnaliser le form en copiant et adaptant la vue par exemple.

http://symfony.com/doc/current/cookbook/bundles/inheritance.html



