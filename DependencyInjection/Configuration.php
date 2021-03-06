<?php

/*
 * This file is part of the CCDNUser ProfileBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\ProfileBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ccdn_user_profile');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->arrayNode('user')
                    ->children()
                        ->scalarNode('profile_route')->defaultValue('ccdn_user_profile_show_by_id')->end()
                    ->end()
                ->end()
                ->arrayNode('template')
                    ->children()
                        ->scalarNode('engine')->defaultValue('twig')->end()
                    ->end()
                ->end()
            ->end();

        $this->addSEOSection($rootNode);
        $this->addProfileSection($rootNode);
        $this->addItemBioSection($rootNode);
        $this->addItemSignatureSection($rootNode);
        $this->addSidebarSection($rootNode);

        return $treeBuilder;
    }

    /**
     *
     * @access protected
     * @param ArrayNodeDefinition $node
     */
    protected function addSEOSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('seo')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('title_length')->defaultValue('67')->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addProfileSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('profile')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('edit')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->arrayNode('personal')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('contact')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('avatar')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                        ->scalarNode('enable_bb_editor')->defaultValue(true)->end()
                                    ->end()
                                ->end()
                                ->arrayNode('signature')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('form_theme')->defaultValue('CCDNUserProfileBundle:Form:fields.html.twig')->end()
                                        ->scalarNode('enable_bb_editor')->defaultValue(true)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('show')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('requires_login')->defaultValue(true)->end()
                                ->arrayNode('overview')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                        ->scalarNode('member_since_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                        ->scalarNode('last_login_datetime_format')->defaultValue('d-m-Y - H:i')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('bio')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('layout_template')->defaultValue('CCDNComponentCommonBundle:Layout:layout_body_right.html.twig')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addItemBioSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('item_bio')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('enable_bb_parser')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end();

    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addItemSignatureSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('item_signature')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('enable_bb_parser')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end();
    }

    /**
     *
     * @access private
     * @param ArrayNodeDefinition $node
     */
    private function addSidebarSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('sidebar')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->scalarNode('members_route')->defaultValue('ccdn_user_member_index')->end()
                        ->scalarNode('account_route')->defaultValue('ccdn_user_user_account_show')->end()
                        ->scalarNode('registration_route')->defaultValue('fos_user_registration_register')->end()
                        ->scalarNode('login_route')->defaultValue('fos_user_security_login')->end()
                        ->scalarNode('logout_route')->defaultValue('fos_user_security_logout')->end()
                        ->scalarNode('reset_route')->defaultValue('fos_user_resetting_request')->end()
                    ->end()
                ->end()
            ->end();
    }

}
