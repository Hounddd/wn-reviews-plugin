<?php namespace Hounddd\Reviews\Tests;

use Hounddd\Reviews\Plugin;
use System\Tests\Bootstrap\PluginTestCase;

class ReviewsPluginTest extends PluginTestCase
{
    public function setUp(): void
    {
        $this->plugin = new Plugin($this->createApplication());
    }

    public function testPluginDetails(): void
    {
        $details = $this->plugin->pluginDetails();

        $this->assertIsArray($details);
        $this->assertArrayHasKey('name', $details);
        $this->assertArrayHasKey('description', $details);
        $this->assertArrayHasKey('icon', $details);
        $this->assertArrayHasKey('author', $details);

        $this->assertEquals('Hounddd', $details['author']);
    }

    public function testRegisterPermissions(): void
    {
        $permissions = $this->plugin->registerPermissions();

        $this->assertIsArray($permissions);
    }
}
