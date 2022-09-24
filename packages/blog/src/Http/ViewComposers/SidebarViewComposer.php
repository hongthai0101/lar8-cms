<?php
namespace Messi\Blog\Http\ViewComposers;

use Illuminate\View\View;

class SidebarViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param    View  $view
     * @return  void
     */
    public function compose(View $view)
    {
        $sidebars = [
            [
                'title'        => __('Blog'),
                'icon'        => 'flaticon-edit-1',
                'permissions' => ['viewAny-blog'],
                'selected' => [
                    'admin.posts',
                    'admin.categories',
                    'admin.tags'
                ],
                'position' => 2,
                'subs' => [
                    [
                        'title' => __('Post'),
                        'url' => route('admin.posts.index'),
                        'permissions' => ['viewAny-blog'],
                        'selected' => [
                            'admin.posts'
                        ]
                    ],
                    [
                        'title' => __('Category'),
                        'url' => route('admin.categories.index'),
                        'permissions' => ['viewAny-blog'],
                        'selected' => [
                            'admin.categories'
                        ]
                    ],
                    [
                        'title' => __('Tag'),
                        'url' => route('admin.tags.index'),
                        'permissions' => ['viewAny-blog'],
                        'selected' => [
                            'admin.tags'
                        ]
                    ]
                ]
            ],
            [
                'title'        => __('Gallery'),
                'icon'        => 'fa fa-camera-retro',
                'permissions' => ['viewAny-blog'],
                'selected' => [
                    'admin.galleries'
                ],
                'url' => route('admin.galleries.index'),
                'position' => 3
            ]
        ];
        $view->with('blogSidebar', $sidebars);
    }
}
