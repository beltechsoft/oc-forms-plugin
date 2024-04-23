<?php namespace Beltechsoft\Forms;

use Backend;
use Beltechsoft\Forms\Components\SimpleForm;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'beltechsoft.forms::lang.plugin.name',
            'description' => 'beltechsoft.forms::lang.plugin.description',
            'author' => 'beltechsoft',
            'icon' => 'icon-address-book'
        ];
    }

    public function registerComponents(): array
    {
        return [
            SimpleForm::class => 'SimpleForm'
        ];
    }

    public function registerNavigation(): array
    {
        return [
            'forms' => [
                'label' => 'beltechsoft.forms::lang.menu.forms',
                'icon' => 'icon-address-book',
                'permissions' => ['beltechsoft.forms.*'],
                'order' => 200,
                'sideMenu' => [
                    'result' => [
                        'label' => 'beltechsoft.forms::lang.menu.results',
                        'icon' => 'icon-database',
                        'url' => \Backend\Facades\Backend::url('beltechsoft/forms/results'),
                        'permissions' => ['beltechsoft.forms.*'],
                    ],
                ],
            ],
        ];
    }

}
