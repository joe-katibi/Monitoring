<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
{
    $name = $this->argument('name');
    $serviceClass = studly_case($name).'Service';
    $serviceNamespace = 'App\Services';

    $stub = file_get_contents(base_path('stubs/service.stub'));
    $stub = str_replace('{{class}}', $serviceClass, $stub);
    $stub = str_replace('{{namespace}}', $serviceNamespace, $stub);

    $servicePath = app_path('Services/'.$serviceClass.'.php');

    if (file_exists($servicePath)) {
        $this->error('Service already exists!');
        return;
    }

    file_put_contents($servicePath, $stub);

    $this->info('Service created successfully.');
}

}
