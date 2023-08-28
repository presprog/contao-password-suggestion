<?php declare(strict_types=1);


namespace PresProg\PasswordSuggestion\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('password_suggestion');

        $treeBuilder
            ->getRootNode()
            ->children()
                ->scalarNode('characters')
                    ->cannotBeEmpty()
                    ->defaultValue('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?-_.')
                ->end()
                ->scalarNode('password_length')
                    ->cannotBeEmpty()
                    ->defaultValue(8)
                ->end()
        ;

        return $treeBuilder;
    }
}
