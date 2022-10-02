<?php

namespace Messi\Blog\Forms;

use Illuminate\Support\Collection;
use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Http\Requests\Admin\CategoryRequest;
use Messi\Blog\Models\Category;
use Messi\Blog\Repositories\Contracts\CategoryRepository;

class CategoryForm extends FormAbstract
{
    /**
     * @return void
     */
    public function buildForm()
    {
        /** @var CategoryRepository $categoryRepo */
        $categoryRepo = app(CategoryRepository::class);
        /** @var Collection $categories */
        $categories = $categoryRepo->findWhere(['parent_id' => 0], ['id', 'title']);
        $metaSeo = null;
        $showParent = true;
        if ($model = $this->model) {
            $categories = $categories->filter(function ($item) use ($model) {
                return  $item->id !== $model->id;
            });
            $metaSeo = $model->metaSeo;
            $showParent = $model->children->count() == 0;
        }

        $categories = $categories->pluck('title', 'id')->toArray();
        $url = $this->model ? route('admin.categories.update', $this->model->id) : route('admin.categories.store');
        $statuses = MasterData::statuses();
        $this
            ->setupModel(new Category())
            ->setValidatorClass(CategoryRequest::class)
            ->setFormOption('url', $url)
            ->setCancelUrl(route('admin.categories.index'))
            ->withCustomFields()
            ->setMetaBoxes($metaSeo ?? [FormAbstract::META_BOX_SEO => []])
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
            ]);
        if ($showParent) {
            $this->add('parent_id', 'customSelect', [
                'label'      => __('Parent Category'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => [0 => __('Please chose parent category')] + $categories,
            ]);
        }

        $this->add('order', 'number', [
            'label'         => __('Order'),
            'label_attr'    => ['class' => 'control-label'],
            'attr'          => [
                'placeholder' => __('Order'),
            ],
            'default_value' => 0,
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
            ->setBreakFieldPoint('status');
    }
}
