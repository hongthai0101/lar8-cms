<?php

namespace Messi\Email\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Messi\Email\Http\Requests\Admin\MailTemplateRequest;
use Messi\Email\Repositories\Contracts\MailTemplateRepository;

class MailService
{
    protected MailTemplateRepository $repository;

    public function __construct(MailTemplateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param MailTemplateRequest $request
     * @return bool
     */
    public function store(MailTemplateRequest $request): bool
    {
        $name = self::generateClassName($request->input('name'));

        if (!$name) return false;

        $exitCode = \Artisan::call('make:mailable', [
            'name' => $name,
            '--fields' => 'full_name, user_id, phone, content'
        ]);
        if ($exitCode === 1) {
            $data = array_merge($request->validated(), [
               'mailable' => "App\Mail\\$name"
            ]);
            $this->repository->create($data);
            return true;
        }

        return false;
    }

    /**
     * @param string $input
     * @return string|bool
     */
    private function generateClassName(string $input): string | bool
    {
        $suffix = 'Mail';

        if (strtolower($input) === strtolower($suffix)) {
            return false;
        }

        // Avoid MailMail as a class name suffix
        $suffix = substr_compare($input, 'mail', -4, 4, true) === 0
            ? ''
            : $suffix;

        /**
         * - Suffix is needed to avoid usage of reserved word.
         * - Str::slug will remove all forbidden characters.
         */
        $name = Str::studly(Str::slug($input, '_')).$suffix;

        /**
         * Removal of reserved keywords.
         */
        if (! preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/', $name) ||
            substr_compare($name, $suffix, -strlen($suffix), strlen($suffix), true) !== 0
        ) {
            return false;
        }

        return $name;
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        $item = $this->repository->find($id);
        if (class_exists($item->mailable)) {
            $reflector = new \ReflectionClass($item->mailable);
            $fullPath = $reflector->getFileName();
            unlink($fullPath);
        }
        return $this->repository->delete($id);
    }

    public function update(int $id)
    {

    }

    public function sendTest(int $id)
    {
        $mailTemplate = $this->repository->find($id);
        $email = 'thailh.work@gmail.com';
        Mail::to($email)->send(new ($mailTemplate->mailable)('123'));
    }
}
