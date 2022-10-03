<?php
namespace Messi\Email\Models;

use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Messi\Base\Models\BaseModel;
use Messi\Base\Traits\ModelTrait;
use Messi\Email\Exceptions\MissingMailTemplate;
use Messi\Email\Interfaces\MailTemplateInterface;

class MailTemplate extends BaseModel implements MailTemplateInterface
{
    use ModelTrait, SoftDeletes;

    protected $table = 'mail_templates';
    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'mailable',
        'subject',
        'html_template',
        'text_template',
        'status',
        'is_footer',
        'is_header',
        'is_can_delete',
        'fields',
        'created_id',
        'updated_id'
    ];

    protected $casts = [
        'is_footer' => 'boolean',
        'is_header' => 'boolean',
        'is_can_delete' => 'boolean',
        'fields' => 'array'
    ];

    protected $guarded = [];

    public function scopeForMailable(Builder $query, Mailable $mailable): Builder
    {
        return $query->where('mailable', get_class($mailable));
    }

    /**
     * @throws MissingMailTemplate
     */
    public static function findForMailable(Mailable $mailable): self
    {
        $mailTemplate = static::forMailable($mailable)->first();

        if (! $mailTemplate) {
            throw MissingMailTemplate::forMailable($mailable);
        }

        return $mailTemplate;
    }

    public function getHtmlLayout(): ?string
    {
        return null;
    }

    public function getTextLayout(): ?string
    {
        return null;
    }

    public function getVariables(): array
    {
        $mailableClass = $this->mailable;

        if (! class_exists($mailableClass)) {
            return [];
        }

        return $mailableClass::getVariables();
    }

    public function getVariablesAttribute(): array
    {
        return $this->getVariables();
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getHtmlTemplate(): string
    {
        return $this->html_template;
    }

    public function getTextTemplate(): ?string
    {
        return $this->text_template;
    }
}
