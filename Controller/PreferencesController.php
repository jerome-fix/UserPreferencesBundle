<?php


namespace Zapoyok\UserPreferencesBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class PreferencesController extends ContainerAware
{
   
    /**
     * 
     * @param Request $request
     * @throws AccessDeniedException
     */
    public function editPreferencesAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        if ( null === ($preference = $this->getPreferenceManager()->findOneBy(array("user" => $user))) ) {
            $preference = $this->getPreferenceManager()->createPreference();
            $preference->setUser($user);
        }
        
        $em = $this->container->get('doctrine')->getManager();
        
        if (!$request->isMethod('POST'))  {
            $defaultData = $preference->getData();
        } else {
            $defaultData = null;
        }
        $form =  $this->container
                    ->get('form.factory')
                    ->create("zapoyok_user_preferences_preferences_form", $defaultData, array('em' => $em));

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $preference->setData($form->getData());
            $em->persist($preference);
            $em->flush();
        }

        return $this->container->get('templating')->renderResponse('ZapoyokUserPreferencesBundle:Preferences:edit.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }
    
    /**
     * 
     * @return object
     */
    public function getPreferenceManager() 
    {
        return $this->container->get('zapoyok_user_preferences.preference_manager');
    }
}
