<?php
namespace MongolidLaravel\Migrations\Commands;

use Illuminate\Foundation\Application;
use Mockery as m;
use MongolidLaravel\Migrations\MigrationRepositoryInterface;
use MongolidLaravel\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class InstallCommandTest extends TestCase
{
    public function testFireCallsRepositoryToInstall()
    {
        $command = new InstallCommand($repo = m::mock(MigrationRepositoryInterface::class));
        $command->setLaravel(new Application());
        $repo->shouldReceive('setSource')->once()->with('foo');
        $repo->shouldReceive('createRepository')->once();

        $this->runCommand($command, ['--database' => 'foo']);
    }

    protected function runCommand($command, $options = [])
    {
        return $command->run(new ArrayInput($options), new NullOutput());
    }
}
