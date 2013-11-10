<?php

namespace Zapoyok\UserPreferencesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('jfx_user_preferences');
        $rootNode

            ->validate()
            ->always()
            ->then(function($v) {
                
                foreach ($v['preferences'] as $key => $preference ) {
                    switch ($preference['type']) {
                    	case 'checkbox' :
                    	    unset($v['preferences'][$key]['attributes']['multiple']);
                    	    break;
                    }
                }

                return $v;
            })
            ->end()
            ->children()
                ->arrayNode('preferences')    
                   ->isRequired()
                   ->requiresAtLeastOneElement()
                   ->useAttributeAsKey('preference')
                   ->prototype("array")
                        ->children()
                            ->scalarNode('type')->isRequired()->end()
                            ->arrayNode('attributes')
                                    ->children()
                                        ->scalarNode('class')->end()
                                        ->scalarNode('label')->end()
                                        ->booleanNode('multiple')->defaultFalse()->end()
                                        ->booleanNode('required')->defaultTrue()->end()
                               ->end()
                            ->end()
                        ->end()
                   ->end()
            ->end()
            ;
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
