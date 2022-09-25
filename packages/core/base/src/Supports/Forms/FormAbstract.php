<?php

namespace Messi\Base\Supports\Forms;

use Messi\Base\Supports\Forms\Fields\AutocompleteField;
use Messi\Base\Supports\Forms\Fields\ColorField;
use Messi\Base\Supports\Forms\Fields\CustomRadioField;
use Messi\Base\Supports\Forms\Fields\CustomSelectField;
use Messi\Base\Supports\Forms\Fields\DateField;
use Messi\Base\Supports\Forms\Fields\EditorField;
use Messi\Base\Supports\Forms\Fields\HtmlField;
use Messi\Base\Supports\Forms\Fields\ICheckboxField;
use Messi\Base\Supports\Forms\Fields\MediaFileField;
use Messi\Base\Supports\Forms\Fields\MediaImageField;
use Messi\Base\Supports\Forms\Fields\MediaImagesField;
use Messi\Base\Supports\Forms\Fields\OnOffField;
use Messi\Base\Supports\Forms\Fields\RepeaterField;
use Messi\Base\Supports\Forms\Fields\TimeField;
use Exception;
use Illuminate\Support\Str;
use JsValidator;
use Kris\LaravelFormBuilder\Fields\FormField;
use Kris\LaravelFormBuilder\Form;
use Messi\Base\Supports\Forms\Fields\TinyMceField;

abstract class FormAbstract extends Form
{
    const META_BOX_SEO = 'seo';
    const META_BOX_GALLERY = 'gallery';

    /**
     * @var array
     */
    protected array $options = [];

    /**
     * @var string
     */
    protected string $title = '';

    /**
     * @var string
     */
    protected string $validatorClass = '';

    /**
     * @var string
     */
    protected string $actionButtons = '';

    /**
     * @var string
     */
    protected string $breakFieldPoint = '';

    /**
     * @var string
     */
    protected string $wrapperClass = 'form-body';

    /**
     * @var string
     */
    protected $template = 'core/base::forms.form';

    /**
     * @var array
     */
    protected array $metaBoxes = [];

    /**
     * @var string
     */
    protected string $cancelUrl = '/';

    /**
     * FormAbstract constructor.
     */
    public function __construct()
    {
        $this->setMethod('POST');
        $this->setFormOption('template', $this->template);
        $this->setFormOption('class', 'core-custom-form');
        $this->setFormOption('id', strtolower(Str::slug(Str::snake(get_class($this)))));
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return string
     */
    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

    /**
     * @param string $url
     * @return FormAbstract
     */
    public function setCancelUrl(string $url): self
    {
        $this->cancelUrl = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param null $route
     * @return string
     */
    public function getActionButtons($route = null): string
    {
        if ($this->actionButtons === '') {
            return view('core/base::forms.partials.form-actions', compact('route'))->render();
        }

        return $this->actionButtons;
    }

    /**
     * @param string $actionButtons
     * @return $this
     */
    public function setActionButtons(string $actionButtons): self
    {
        $this->actionButtons = $actionButtons;
        return $this;
    }

    /**
     * @return $this
     */
    public function removeActionButtons(): self
    {
        $this->actionButtons = '';

        return $this;
    }

    /**
     * @return string
     */
    public function getBreakFieldPoint(): string
    {
        return $this->breakFieldPoint;
    }

    /**
     * @param string $breakFieldPoint
     * @return $this
     */
    public function setBreakFieldPoint(string $breakFieldPoint): self
    {
        $this->breakFieldPoint = $breakFieldPoint;
        return $this;
    }

    /**
     * @return string
     */
    public function getWrapperClass(): string
    {
        return $this->wrapperClass;
    }

    /**
     * @param string $wrapperClass
     * @return $this
     */
    public function setWrapperClass(string $wrapperClass): self
    {
        $this->wrapperClass = $wrapperClass;
        return $this;
    }

    /**
     * @return $this
     */
    public function withCustomFields(): self
    {
        $customFields = [
            'customSelect' => CustomSelectField::class,
            'editor'       => EditorField::class,
            'onOff'        => OnOffField::class,
            'customRadio'  => CustomRadioField::class,
            'mediaImage'   => MediaImageField::class,
            'mediaImages'  => MediaImagesField::class,
            'mediaFile'    => MediaFileField::class,
            'customColor'  => ColorField::class,
            'time'         => TimeField::class,
            'date'         => DateField::class,
            'autocomplete' => AutocompleteField::class,
            'html'         => HtmlField::class,
            'repeater'     => RepeaterField::class,
            'tinymce'      => TinyMceField::class,
            'iCheckbox'    => ICheckboxField::class
        ];

        foreach ($customFields as $key => $field) {
            if (!$this->formHelper->hasCustomField($key)) {
                $this->addCustomField($key, $field);
            }
        }
        return $this;
    }

    /**
     * @param string $name
     * @param string $class
     * @return $this|Form
     */
    public function addCustomField($name, $class)
    {
        parent::addCustomField($name, $class);

        return $this;
    }

    /**
     * @return $this
     */
    public function hasTabs(): self
    {
        $this->setFormOption('template', 'core/base::forms.form-tabs');

        return $this;
    }

    /**
     * @return int
     */
    public function hasMainFields()
    {
        if (!$this->breakFieldPoint) {
            return count($this->fields);
        }

        $mainFields = [];

        /**
         * @var FormField $field
         */
        foreach ($this->fields as $field) {
            if ($field->getName() == $this->breakFieldPoint) {
                break;
            }

            $mainFields[] = $field;
        }

        return count($mainFields);
    }

    /**
     * @return $this
     */
    public function disableFields()
    {
        parent::disableFields();

        return $this;
    }

    /**
     * @param array $options
     * @param bool $showStart
     * @param bool $showFields
     * @param bool $showEnd
     * @return string
     */
    public function renderForm(array $options = [], $showStart = true, $showFields = true, $showEnd = true): string
    {
        return parent::renderForm($options, $showStart, $showFields, $showEnd);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function renderValidatorJs(): string
    {
        $element = null;
        if ($this->getFormOption('id')) {
            $element = '#' . $this->getFormOption('id');
        } elseif ($this->getFormOption('class')) {
            $element = '.' . $this->getFormOption('class');
        }

        return JsValidator::formRequest($this->getValidatorClass(), $element);
    }

    /**
     * @return string
     */
    public function getValidatorClass(): string
    {
        return $this->validatorClass;
    }

    /**
     * @param string $validatorClass
     * @return $this
     */
    public function setValidatorClass($validatorClass): self
    {
        $this->validatorClass = $validatorClass;

        return $this;
    }

    /**
     * Setup model for form, add namespace if needed for child forms.
     *
     * @param string $model
     * @return $this
     */
    protected function setupModel($model): self
    {
        if (!$this->model) {
            $this->model = $model;
            $this->setupNamedModel();
        }

        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setMetaBoxes($data): FormAbstract
    {
        $this->metaBoxes = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMetaBoxes(): mixed
    {
        return $this->metaBoxes;
    }

    /**
     * @return string
     */
    public function renderMetaBoxes(): string
    {
        $html = '';
        $metaBoxes = $this->metaBoxes;
        foreach ($metaBoxes as $key => $metaBox) {
            $template = $this->getTemplateMetaBox($key);
            $html .= $template != '' ? view($template, ['data' => $metaBox]) : '';
        }
        return $html;
    }

    /**
     * @param $key
     * @return string
     */
    private function getTemplateMetaBox($key): string
    {
        return match ($key) {
            self::META_BOX_SEO => 'core/base::components.meta_seo',
            self::META_BOX_GALLERY => 'core/base::components.galleries',
            default => '',
        };
    }
}
