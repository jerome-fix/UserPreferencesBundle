<?php

namespace Jfx\UserPreferencesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Jfx\UserPreferencesBundle\Form\DataTransformer\EntityTransformer;

class PreferencesType extends AbstractType
{

    
    private $preferences;
    
    public function __construct($preferences) 
    {
        $this->preferences = $preferences;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $entityManager = $options['em'];
        $modelTransformer = new EntityTransformer($entityManager);
        
        foreach ( $this->preferences as $key => $type) {
            switch ( $type['type'] ) {
            	case 'entity' :
            	    $builder->add(
            	        $builder->create($key, $type['type'], $type['attributes'])
            	        ->addModelTransformer($modelTransformer)
            	    );
            	    break;
            	    
        	    default:
        	        $builder->add($key, $type['type'], $type['attributes']);
            }
           
        }
        
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\FormTypeInterface::getName()
     */
    public function getName()
    {
        return 'jfx_user_preferences_preferences_form';
    }
    
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Form\AbstractType::setDefaultOptions()
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setRequired(array(
            'em',
        ));
        
        $resolver->setAllowedTypes(array(
            'em' => 'Doctrine\Common\Persistence\ObjectManager',
        ));
    }    
}