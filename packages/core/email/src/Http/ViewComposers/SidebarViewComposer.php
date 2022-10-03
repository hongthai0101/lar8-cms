<?php
namespace Messi\Email\Http\ViewComposers;

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
                'title'        => __('Mail Setting'),
                'icon'        => 'fa flaticon-multimedia-3',
                'permissions' => ['viewAny-mailtemplate'],
                'selected' => [
                    'admin.mail-templates',
                    'admin.mail-setting'
                ],
                'subs' => [
                    [
                        'title' => __('Template'),
                        'url' => route('admin.mail-templates.index'),
                        'permissions' => ['viewAny-mailtemplate'],
                        'selected' => [
                            'admin.mail-templates'
                        ]
                    ],
                    [
                        'title' => __('Setting'),
                        'url' => route('admin.mail-setting.index'),
                        'permissions' => ['viewAny-mailtemplate'],
                        'selected' => [
                            'admin.mail-setting'
                        ]
                    ]
                ],
                'position' => 5
            ]
        ];
        $view->with('mailSidebar', $sidebars);
    }
}
