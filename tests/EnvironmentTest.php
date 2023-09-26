<?php

use PHPUnit\Framework\TestCase;
use NatanaelOliveira\DotEnv\Environment;


require_once 'src/Environment.php';

class EnvironmentTest extends TestCase
{
    protected $env;

    protected function setUp(): void
    {
        $this->env = new Environment('.env.test');
    }

    protected function tearDown(): void
    {

        unlink('.env.test');
    }

    public function testSetAndGet()
    {

        $this->env->set('TEST_KEY', 'test_value');
        $value = $this->env->get('TEST_KEY');
        $this->assertEquals('test_value', $value);
    }

    public function testGetWithDefaultValue()
    {

        $value = $this->env->get('NON_EXISTENT_KEY', 'default_value');
        $this->assertEquals('default_value', $value);
    }

    public function testRemove()
    {

        $this->env->set('TEST_KEY', 'test_value');
        $this->env->remove('TEST_KEY');
        $value = $this->env->get('TEST_KEY');
        $this->assertNull($value);
    }
}
