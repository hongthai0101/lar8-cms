<?php

namespace Messi\Email\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MailableCommand extends GeneratorCommand
{
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:mailable {name} {--fields=}';

    /**
     * @var string
     */
    protected $type = 'Mail';

    /**
     * @var string
     */
    protected string $mailClass = '';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @return bool
     * @throws FileNotFoundException
     */
    public function handle(): bool
    {
        $this->setMailClass();
        $path = $this->getPath('Mail/' . $this->mailClass);
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');
            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->mailClass));

        $this->info($this->type.' created successfully.');

        return true;
    }

    /**
     * Set mail class name
     *
     * @return  void
     */
    private function setMailClass(): void
    {
        $this->mailClass = ucwords($this->argument('name'));
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        if(!$this->argument('name')){
            throw new InvalidArgumentException("Missing required argument model name");
        }
        $stub = parent::replaceClass($stub, $name);
        $inputFields = explode(',', $this->option('fields'));
        $publicFields = $this->makePublicFields($inputFields);
        $fields = $this->makeFields($inputFields);
        $mapPublicFields = $this->makeMapPublicFields($inputFields);

        return str_replace(
            ['$CLASS$', '$PUBLIC_FIELDS$'],
            [$this->mailClass, $publicFields],
            $stub
        );
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return  base_path().'/packages/core/email/stubs/mailable.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Mail';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }

    /**
     * @param array $fields
     * @return string
     */
    private function makePublicFields(array $fields): string
    {
        $results = '';
        if (!empty($fields) && Arr::get($fields, 0) !== "") {
            foreach ($fields as $field) {
                $publicField = trim($field);
                $results .= "public mixed $$publicField" . ';' . PHP_EOL . "\t";
            }
        }
        return $results;
    }

    /**
     * @param array $fields
     * @return string
     */
    private function makeFields(array $fields): string
    {
        $results = '';
        if (empty($fields)) return $results;

        foreach ($fields as $field) {
            $publicField = trim($field);
            $results .= "mixed $$publicField, ";
        }
        return substr($results, 0, -2);
    }

    /**
     * @param array $fields
     * @return string
     */
    private function makeMapPublicFields(array $fields): string
    {
        $results = '';
        if (!empty($fields) && Arr::get($fields, 0) !== "") {
            foreach ($fields as $field) {
                $publicField = trim($field);
                $results .= '$this->' . $publicField . ' = ' . "$$publicField" . ';' . PHP_EOL . "\t\t";
            }
        }
        return $results;
    }
}
