<?php

namespace Messi\Email\Services;

use Illuminate\Support\Str;
use Messi\Email\Exceptions\CannotRenderTemplateMailable;
use Messi\Email\Interfaces\MailTemplateInterface;
use Mustache_Engine;

class TemplateMailableRenderer
{
    public const RENDER_HTML_LAYOUT = 0;
    public const RENDER_TEXT_LAYOUT = 1;

    /**
     * @var TemplateMailable
     */
    protected TemplateMailable $templateMailable;

    /**
     * @var MailTemplateInterface
     */
    protected MailTemplateInterface $mailTemplate;

    /**
     * @var Mustache_Engine
     */
    protected Mustache_Engine $mustache;

    /**
     * @param TemplateMailable $templateMailable
     * @param Mustache_Engine $mustache
     */
    public function __construct(TemplateMailable $templateMailable, Mustache_Engine $mustache)
    {
        $this->templateMailable = $templateMailable;
        $this->mustache = $mustache;
        $this->mailTemplate = $templateMailable->getMailTemplate();
    }

    /**
     * @param array $data
     * @return string
     * @throws CannotRenderTemplateMailable
     */
    public function renderHtmlLayout(array $data = []): string
    {
        $body = $this->mustache->render(
            $this->mailTemplate->getHtmlTemplate(),
            $data
        );

        return $this->renderInLayout($body, static::RENDER_HTML_LAYOUT, $data);
    }

    /**
     * @param array $data
     * @return string|null
     * @throws CannotRenderTemplateMailable
     */
    public function renderTextLayout(array $data = []): ?string
    {
        if (! $this->mailTemplate->getTextTemplate()) {
            return $this->textView ?? null;
        }

        $body = $this->mustache->render(
            $this->mailTemplate->getTextTemplate(),
            $data
        );

        return $this->renderInLayout($body, static::RENDER_TEXT_LAYOUT, $data);
    }

    /**
     * @param array $data
     * @return string
     */
    public function renderSubject(array $data = []): string
    {
        return $this->mustache->render(
            $this->mailTemplate->getSubject(),
            $data
        );
    }

    /**
     * @param string $body
     * @param int $layoutType
     * @param array $data
     * @return string
     * @throws CannotRenderTemplateMailable
     */
    protected function renderInLayout(string $body, int $layoutType, array $data = []): string
    {
        $method = $layoutType === static::RENDER_HTML_LAYOUT ? 'getHtmlLayout' : 'getTextLayout';
        $layout = $this->templateMailable->$method()
            ?? (method_exists($this->mailTemplate, $method) ? $this->mailTemplate->$method() : null)
            ?? '{{{ body }}}';

        $this->guardAgainstInvalidLayout($layout);

        $data = array_merge(['body' => $body], $data);

        return $this->mustache->render($layout, $data);
    }

    /**
     * @param string $layout
     * @return void
     * @throws CannotRenderTemplateMailable
     */
    protected function guardAgainstInvalidLayout(string $layout): void
    {
        if (! Str::contains($layout, [
            '{{{body}}}',
            '{{{ body }}}',
            '{{body}}',
            '{{ body }}',
            '{{ $body }}',
            '{!! $body !!}',
        ])) {
            throw CannotRenderTemplateMailable::layoutDoesNotContainABodyPlaceHolder($this->templateMailable);
        }
    }
}
