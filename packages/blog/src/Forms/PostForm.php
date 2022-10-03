<?php

namespace Messi\Blog\Forms;

use Messi\Base\Supports\Forms\Fields\TagField;
use Messi\Base\Supports\Forms\FormAbstract;
use Messi\Base\Types\MasterData;
use Messi\Blog\Forms\Fields\CategoryMultiField;
use Messi\Blog\Http\Requests\Admin\PostRequest;
use Messi\Blog\Models\Post;
use Messi\Blog\Repositories\Contracts\CategoryRepository;
use Messi\Blog\Repositories\Contracts\TagRepository;

class PostForm extends FormAbstract
{
    protected $template = 'blog::post.form';
    /**
     * @return void
     */
    public function buildForm()
    {
        $categories = $this->getCategories();
        $tags = app(TagRepository::class)->all(['id', 'title'])->pluck('title', 'id')->toArray();

        if (!$this->formHelper->hasCustomField('categoryMulti')) {
            $this->formHelper->addCustomField('categoryMulti', CategoryMultiField::class);
        }

        $categorySelected = [];
        $tagSelected = [];
        $url = route('admin.posts.store');
        $metaBoxes = [
            FormAbstract::META_BOX_SEO => [],
        ];
        if ($item = $this->model) {
            $url = route('admin.posts.update', $item->id);
            $categorySelected = $item->categories()->pluck('category_id')->all();
            $tagSelected = $item->tags()->pluck('tag_id')->all();
            $metaBoxes[FormAbstract::META_BOX_SEO] = $item->metaSeo;
        }

        $statuses = MasterData::statuses();
        $this
            ->setupModel(new Post())
            ->setValidatorClass(PostRequest::class)
            ->setFormOption('url', $url)
            ->setCancelUrl($url)
            ->withCustomFields()
            ->setMetaBoxes($metaBoxes)
            ->addCustomField('tags', TagField::class)
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
            ->add('content', 'editor', [
                'label'      => __('Content'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'rows'            => 4,
                    'placeholder'     => __('Content')
                ],
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
            ->add('categories[]', 'categoryMulti', [
                'label'      => __('Categories'),
                'label_attr' => ['class' => 'control-label required'],
                'choices'    => $categories,
                'value'      => $categorySelected,
            ])
            ->add('tags[]', 'tags', [
                'label'      => __('Tags'),
                'label_attr' => ['class' => 'control-label'],
                'value'      => $tagSelected,
                'choices'    => $tags,
            ])
            ->setBreakFieldPoint('status');
    }

    /**
     * @return array
     */
    private function getCategories(): array
    {
        /** @var CategoryRepository $categoryRepo */
        $categoryRepo = app(CategoryRepository::class);
        $categories = $categoryRepo->all(['id', 'title', 'parent_id']);
        $result = array();

        foreach ($categories as $category) {
            if ($category->parent_id != 0) {
                continue;
            }
            $result[] = [
                'id' => $category->id,
                'title' => $category->title,
                'subs' => $this->getCategoriesSubs($categories, $category->id)
            ];
        }
        return $result;
    }

    /**
     * @param $categories
     * @param $parentId
     * @return array
     */
    private function getCategoriesSubs($categories, $parentId): array
    {
        $subCategories = $categories->filter(function ($item) use ($parentId) {
            return $item->parent_id == $parentId;
        });
        $subs = [];
        foreach ($subCategories as $category) {
            $subs[] = [
                'id' => $category->id,
                'title' => $category->title
            ];
        }
        return $subs;
    }
}
