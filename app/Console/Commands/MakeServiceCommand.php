<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear archivo de servicio en app/Services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Services/{$name}.php");

        if (file_exists($path)) {
            $this->error("El servicio $name ya existe.");
            return;
        }

        $stub = "<?php\n\nnamespace App\Services;\n\nclass $name\n{\n    // ...\n}";

        file_put_contents($path, $stub);

        $this->info("Service creado: app/Services/$name.php");
    }
}
