<?php

/*
 * This file is part of the CCDN ProfileBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 
 * 
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\ProfileBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 * 
 * @author Reece Fowell <reece@codeconsortium.com> 
 * @version 1.0
 */
class CCDNUserProfileExtension extends Extension
{
	
	
	
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

		$container->setParameter('ccdn_user_profile.user.profile_route', $config['user']['profile_route']);
		$container->setParameter('ccdn_user_profile.template.engine', $config['template']['engine']);
		
		$this->getProfileSection($container, $config);
    }
	
	
	
	/**
	 *
	 * @access private
	 * @param $container, $config
	 */
	private function getProfileSection($container, $config)
	{
		$container->setParameter('ccdn_user_profile.profile.edit.layout_template', $config['profile']['edit']['layout_template']);
		$container->setParameter('ccdn_user_profile.profile.edit.form_theme', $config['profile']['edit']['form_theme']);
		
		$container->setParameter('ccdn_user_profile.profile.show.layout_template', $config['profile']['show']['layout_template']);
		$container->setParameter('ccdn_user_profile.profile.show.member_since_datetime_format', $config['profile']['show']['member_since_datetime_format']);
		$container->setParameter('ccdn_user_profile.profile.show.last_login_datetime_format', $config['profile']['show']['last_login_datetime_format']);
		
	}
	
	
}
