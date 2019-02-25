<?php

namespace Bitfumes\Likker\Tests;

use Bitfumes\Likker\LikkerServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Bitfumes\Likker\Tests\Models\Post;
use Bitfumes\Likker\Tests\Models\User;

class TestCase extends BaseTestCase
{
    public function setup() :void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->artisan('migrate', ['--database' => 'testing']);
        $this->loadMigrations();
        $this->loadFactories();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [LikkerServiceProvider::class];
    }

    protected function loadFactories()
    {
        $this->withFactories(__DIR__ . '/../src/database/factories'); // package factories
        $this->withFactories(__DIR__ . '/database/factories'); // Test factories
    }

    protected function loadMigrations()
    {
        $this->loadLaravelMigrations(['--database' => 'testing']); // package migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations'); // test migrations
    }

    public function createPost($args = [])
    {
        return factory(Post::class)->create($args);
    }

    public function createUser($args = [])
    {
        return factory(User::class)->create($args);
    }

    public function createLoggedInUser($args = [])
    {
        $user = factory(User::class)->create($args);
        $this->actingAs($user);
        return $user;
    }
}
