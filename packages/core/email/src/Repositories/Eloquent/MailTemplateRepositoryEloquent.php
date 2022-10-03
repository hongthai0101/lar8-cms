<?php
namespace Messi\Email\Repositories\Eloquent;

use Messi\Base\Repositories\BaseRepository;
use Messi\Email\Models\MailTemplate;
use Messi\Email\Repositories\Contracts\MailTemplateRepository;

class MailTemplateRepositoryEloquent extends BaseRepository implements MailTemplateRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return MailTemplate::class;
    }
}
