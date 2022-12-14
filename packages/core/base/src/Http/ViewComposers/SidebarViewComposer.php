<?php
namespace Messi\Base\Http\ViewComposers;

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
                'title'        => __('Dashboard'),
                'icon'        => 'flaticon-technology',
                'permissions' => ['viewAny-dashboard'],
                'url' => route('admin.dashboard.index'),
                'selected' => [
                    'admin.dashboard'
                ],
                'position' => 1
            ],
            [
                'title'        => __('User'),
                'icon'        => 'flaticon-user-settings',
                'permissions' => ['viewAny-user', 'viewAny-role'],
                'selected' => [
                    'admin.users',
                    'admin.roles'
                ],
                'position' => 2,
                'subs' => [
                    [
                        'title' => __('User'),
                        'url' => route('admin.users.index'),
                        'permissions' => ['viewAny-user'],
                        'selected' => [
                            'admin.users'
                        ]
                    ],
                    [
                        'title' => __('Role'),
                        'url' => route('admin.roles.index'),
                        'permissions' => ['viewAny-role'],
                        'selected' => [
                            'admin.roles'
                        ]
                    ]
                ]
            ],
            [
                'title'        => __('Media'),
                'icon'        => 'flaticon-file',
                'permissions' => ['viewAny-media'],
                'url' => route('admin.media.index'),
                'selected' => [
                    'admin.media'
                ],
                'position' => 998
            ],
            [
                'title'        => __('Setting'),
                'icon'        => 'flaticon-cogwheel-2',
                'permissions' => ['viewAny-setting'],
                'selected' => [
                    'admin.settings'
                ],
                'position' => 999,
                'subs' => [
                    [
                        'title' => __('General'),
                        'url' => route('admin.settings.general'),
                        'permissions' => ['viewAny-setting'],
                        'selected' => [
                            'admin.settings.general'
                        ]
                    ],
                    [
                        'title' => __('Email'),
                        'url' => route('admin.settings.email'),
                        'permissions' => ['viewAny-setting'],
                        'selected' => [
                            'admin.settings.email'
                        ]
                    ],
                    [
                        'title' => __('Media'),
                        'url' => route('admin.settings.media'),
                        'permissions' => ['viewAny-setting'],
                        'selected' => [
                            'admin.settings.media'
                        ]
                    ]
                ]
            ],
        ];
        $view->with('baseSidebar', $sidebars);
    }
}
