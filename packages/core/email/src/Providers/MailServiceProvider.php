<?php

namespace Messi\Email\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Messi\Base\Traits\LoadPublishServiceTrait;
use Messi\Email\Commands\MailableCommand;
use Messi\Email\Http\ViewComposers\SidebarViewComposer;
use Messi\Email\Repositories\Contracts\MailTemplateRepository;
use Messi\Email\Repositories\Eloquent\MailTemplateRepositoryEloquent;
use Illuminate\Support\ServiceProvider;
use View;

class MailServiceProvider extends ServiceProvider
{
    use LoadPublishServiceTrait;

    /**
     * @var bool
     */
    protected bool $defer = true;

    public function register()
    {
        $this->app->bind(MailTemplateRepository::class, MailTemplateRepositoryEloquent::class);
    }

    /**
     * @throws BindingResolutionException
     * @throws \Exception
     */
    public function boot()
    {
        $this->setNamespace('core/email')
            ->loadPublishConfigurations(['mail-template'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadPublishViews()
            ->loadRoutes()
            ->publishAssets();

        $this->commands([
            MailableCommand::class
        ]);

        $config = $this->app->make('config');
        $config->set([
            'mail.default'         => setting('__mail_driver__', $config->get('mail.default')),
            'mail.mailers.smtp.host'    => setting('__mail_smtp_host__', $config->get('mail.mailers.smtp.host')),
            'mail.mailers.smtp.port' => setting('__mail_smtp_port__', $config->get('mail.mailers.smtp.port')),
            'mail.mailers.smtp.encryption' => setting('__mail_smtp_encryption__', $config->get('mail.mailers.smtp.encryption')),
            'mail.mailers.smtp.username' => setting('__mail_smtp_username__', $config->get('mail.mailers.smtp.username')),
            'mail.mailers.smtp.password' => setting('__mail_smtp_password__', $config->get('mail.mailers.smtp.password')),
            'mail.from.address' => setting('__mail_from_address__', $config->get('mail.from.address')),
            'mail.from.name' => setting('__mail_from_name__', $config->get('mail.from.name'))
        ]);
        View::composer(
            'core/base::layouts.partials.sidebar', SidebarViewComposer::class
        );
    }

    /**
     * Which IoC bindings the provider provides.
     *
     * @return array
     */
    public function provides(): array
    {

    }
}
