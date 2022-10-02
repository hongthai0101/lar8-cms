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
                'title'        => __('Mail Template'),
                'icon'        => 'fa fa-camera-retro',
                'permissions' => ['viewAny-mailtemplate'],
                'selected' => [
                    'admin.emails'
                ],
                'url' => route('admin.mail-templates.index'),
                'position' => 5
            ]
        ];
        $view->with('mailSidebar', $sidebars);
    }
}
