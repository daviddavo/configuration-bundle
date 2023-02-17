<?php

namespace Sherlockode\ConfigurationBundle\Tests;

use Symfony\Component\DependencyInjection\Definition;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

use Sherlockode\ConfigurationBundle\DependencyInjection\SherlockodeConfigurationExtension;
use Sherlockode\ConfigurationBundle\Manager\ConfigurationManager;
use Sherlockode\ConfigurationBundle\Parameter\ParameterDefinition;
use Sherlockode\ConfigurationBundle\Manager\ParameterManager;

class DefaultValueTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return array(
            new SherlockodeConfigurationExtension()
        );
    }

    public function getMinimalConfiguration(): array
    {
        return [
            'entity_class' => [
                'parameter' => '\\App\\Entity\\Parameter',
            ],
            'parameters' => [
                'path' => [
                    'type'  => 'string',
                    'label' => 'test',
                    'default_value' => '42',
                    'options' => [
                        'subtype' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType'
                    ],
                    'translation_domain' => 'translation',
                ],
            ]
        ];
    }

    public function testGetDefault()
    {

        $this->load();
        $this->assertContainerBuilderHasService('sherlockode_configuration.parameter_manager');
        $this->container;

        // TODO: Use a config and get the value of the parameter
        // It should return the default value (with the correct type and everything)

        // 1. get a Sherlockode\ConfigurationBundle\Manager\ParameterManagerInterface
        $parameterManager = $this->getParameterManager();
        $this->assertEquals($parameterManager->get('path'), '42');

        // TODO: Then, define a custom value and check that it returns that value
        // instead of the default
        $this->assertEquals(-1, 39);

        $this->assertEquals($parameterDefinition, $configurationManager->get('path'));
        $this->assertFalse($configurationManager->has('foo'));
        $this->assertTrue(is_array($configurationManager->getDefinedParameters()));

        $this->expectException('Exception');
        $configurationManager->get('foo');
    }

    public function getParameterManager()
    {
        return $this->container->get('sherlockode_configuration.parameter_manager');
    }
}
