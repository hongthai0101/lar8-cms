<?php

namespace Messi\Email\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Messi\Email\Http\Requests\Admin\MailTemplateRequest;
use Messi\Email\Models\MailTemplate;
use Messi\Email\Repositories\Contracts\MailTemplateRepository;

class MailService
{
    /**
     * @var MailTemplateRepository
     */
    protected MailTemplateRepository $repository;

    /**
     * @param MailTemplateRepository $repository
     */
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

        $makeClass = $this->makeMailClass($name, $request->input('field_replace_to_content'));
        if ($makeClass) {
            $data = array_merge($request->validated(), [
               'mailable' => "App\Mail\\$name"
            ]);
            $this->repository->create($data);
            return true;
        }

        return false;
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        $item = $this->repository->find($id);
        $this->removeMailClass($item);
        return $this->repository->delete($id);
    }

    /**
     * @param int $id
     * @param MailTemplateRequest $request
     * @return bool
     */
    public function update(int $id, MailTemplateRequest $request): bool
    {
        $item = $this->repository->find($id);
        $isCanDelete = $item->is_can_delete;
        if ($isCanDelete) {
            $name = self::generateClassName($request->input('name'));

            if (!$name) return false;

            $this->removeMailClass($item);
            $this->makeMailClass($name, $request->input('field_replace_to_content'));
        }

        $this->repository->update($request->validated(), $id);
        return true;
    }

    public function sendTest(int $id)
    {
        $item = $this->repository->find($id);
        $email = 'thailh.work@gmail.com';
        if (class_exists($item->mailable)) {
            $fields = ($item->mailable)::getVariables();
            Mail::to($email)->send(new ($item->mailable)('123', 'thaile'));
        }
    }

    /**
     * @return array
     */
    public function getSuggestFillable(): array
    {
        $fillable = [];
        foreach (config('core.email.mail-template.model') as $model) {
            if (class_exists($model)) {
                $fillable = array_merge($fillable, app($model)->getFillable());
            }
        }
        return array_unique($fillable);
    }

    /**
     * @param MailTemplate $mailTemplate
     * @return void
     */
    private function removeMailClass(MailTemplate $mailTemplate)
    {
        if (class_exists($mailTemplate->mailable)) {
            $reflector = new \ReflectionClass($mailTemplate->mailable);
            $fullPath = $reflector->getFileName();
            unlink($fullPath);
        }
    }

    /**
     * @param string $name
     * @param array|null $fields
     * @return bool
     */
    private function makeMailClass(string $name, array | null $fields = []): bool
    {
        $publicFields = $fields ? implode(',', $fields) : '';
        $exitCode = \Artisan::call('make:mailable', [
            'name' => $name,
            '--fields' => $publicFields
        ]);
        return $exitCode === 1;
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
}
