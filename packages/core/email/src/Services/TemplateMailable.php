<?php

namespace Messi\Email\Services;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\HtmlString;
use Messi\Email\Exceptions\CannotRenderTemplateMailable;
use Messi\Email\Models\MailTemplate;
use ReflectionClass;
use ReflectionProperty;
use Messi\Email\Interfaces\MailTemplateInterface;

abstract class TemplateMailable extends Mailable
{
    protected static string $templateModelClass = MailTemplate::class;

    /** @var MailTemplateInterface */
    protected MailTemplateInterface $mailTemplate;

    /**
     * @return array
     */
    public static function getVariables(): array
    {
        return static::getPublicProperties();
    }

    /**
     * @return MailTemplateInterface
     */
    public function getMailTemplate(): MailTemplateInterface
    {
        return $this->mailTemplate ?? $this->resolveTemplateModel();
    }

    /**
     * @return MailTemplateInterface
     */
    protected function resolveTemplateModel(): MailTemplateInterface
    {
        return $this->mailTemplate = static::$templateModelClass::findForMailable($this);
    }

    /**
     * @return array
     * @throws \ReflectionException
     * @throws CannotRenderTemplateMailable
     */
    protected function buildView(): array
    {
        $renderer = $this->getMailTemplateRenderer();

        $viewData = $this->buildViewData();

        $html = $renderer->renderHtmlLayout($viewData);
        $text = $renderer->renderTextLayout($viewData);
        return array_filter([
            'html' => new HtmlString($html),
            'text' => new HtmlString($text),
        ]);
    }

    /**
     * @throws \ReflectionException
     */
    protected function buildSubject($message): TemplateMailable|static
    {
        if ($this->subject) {
            $message->subject($this->subject);

            return $this;
        }

        if ($this->getMailTemplate()->getSubject()) {
            $subject = $this
                ->getMailTemplateRenderer()
                ->renderSubject($this->buildViewData());

            $message->subject($subject);

            return $this;
        }

        return parent::buildSubject($message);
    }

    /**
     * @return string|null
     */
    public function getHtmlLayout(): ?string
    {
        return '<header>Site name!</header>{{{ body }}}<footer>Copyright 2022</footer>';
    }

    /**
     * @return string|null
     */
    public function getTextLayout(): ?string
    {
        return null;
    }

    /**
     * @return $this
     */
    public function build(): static
    {
        return $this;
    }

    /**
     * @return array
     */
    protected static function getPublicProperties(): array
    {
        $class = new ReflectionClass(static::class);

        return collect($class->getProperties(ReflectionProperty::IS_PUBLIC))
            ->map->getName()
            ->diff(static::getIgnoredPublicProperties())
            ->values()
            ->all();
    }

    /**
     * @return array
     */
    protected static function getIgnoredPublicProperties(): array
    {
        $mailableClass = new ReflectionClass(Mailable::class);
        $queueableClass = new ReflectionClass(Queueable::class);

        return collect()
            ->merge($mailableClass->getProperties(ReflectionProperty::IS_PUBLIC))
            ->merge($queueableClass->getProperties(ReflectionProperty::IS_PUBLIC))
            ->map->getName()
            ->values()
            ->all();
    }

    /**
     * @return TemplateMailableRenderer
     */
    protected function getMailTemplateRenderer(): TemplateMailableRenderer
    {
        return app(TemplateMailableRenderer::class, ['templateMailable' => $this]);
    }
}
