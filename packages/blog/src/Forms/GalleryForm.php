<?php

namespace Messi\Blog\Forms;

use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Http\Requests\Admin\GalleryRequest;
use Messi\Blog\Models\Gallery;

class GalleryForm extends FormAbstract
{
    protected $template = 'blog::post.form';
    /**
     * @return mixed|void
     */
    public function buildForm()
    {
        $url = route('admin.galleries.store');
        $metaBoxes = [
            FormAbstract::META_BOX_GALLERY => [],
        ];

        if ($item = $this->model) {
            $url = route('admin.galleries.update', $item->id);
            $metaBoxes[FormAbstract::META_BOX_GALLERY] = $item->values;
        }

        $statuses = MasterData::statuses();
        $this
            ->setupModel(new Gallery())
            ->setValidatorClass(GalleryRequest::class)
            ->setFormOption('url', $url)
            ->setCancelUrl($url)
            ->withCustomFields()
            ->setMetaBoxes($metaBoxes)
            ->add('title', 'text', [
                'label'      => __('Title'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => __('Title')
                ],
            ])
            ->add('description', 'textarea', [
                'label'      => __('Description'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'         => 4,
                    'placeholder'  => __('Description')
                ],
            ])
            ->add('is_featured', 'onOff', [
                'label'         => __('Is Featured'),
                'label_attr'    => ['class' => 'control-label'],
                'default_value' => false,
            ])
            ->add('status', 'customSelect', [
                'label'      => __('Status'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $statuses,
            ])
            ->add('thumbnail', 'mediaImage', [
                'label'      => __('Thumbnail'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->setBreakFieldPoint('status');
    }
}
