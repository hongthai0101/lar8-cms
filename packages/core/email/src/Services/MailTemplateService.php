<?php

namespace Messi\Email\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Messi\Email\Http\Requests\Admin\MailTemplateRequest;
use Messi\Email\Models\MailTemplate;
use Messi\Email\Repositories\Contracts\MailTemplateRepository;

class MailTemplateService
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
     * @return bool
     */
    public function destroy(int $id): bool
    {
        $item = $this->repository->find($id);
        $isCanDelete = $item->is_can_delete;
        if ($isCanDelete) {
            $this->removeMailClass($item);
            $this->repository->delete($id);
            return true;
        }
        return false;
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

    /**
     * @param int $id
     * @return array
     */
    public function getDataShow(int $id): array
    {
        $item = $this->repository->find($id);
        $fields = [];
        $content = '';
        if (class_exists($item->mailable)) {
            $fields = ($item->mailable)::getVariables();
            $fillable = [];
            foreach ($fields as $field) {
                $fillable[$field] = "{{ $field }}";
            }
            $content = (new ($item->mailable)($fillable))->render();
        }
        return ['fields' => $fields, 'content' => $content];
    }

    /**
     * @param int $id
     * @param array $params
     * @return bool
     */
    public function sendTest(int $id, array $params): bool
    {
        $emailAddress = array_shift($params);
        $fillable = [];
        foreach ($params as $param) {
            $fillable[$param['name']] = $param['value'];
        }
        $item = $this->repository->find($id);
        $email = Arr::get($emailAddress, 'value');
        if ($email && class_exists($item->mailable)) {
            Mail::to($email)->send(new ($item->mailable)($fillable));
            return true;
        }
        return false;
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
