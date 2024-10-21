<?php namespace Beltechsoft\Forms;

use Backend;
use Beltechsoft\Forms\Components\SimpleForm;
use Beltechsoft\Forms\Models\Result;
use Beltechsoft\Forms\Models\Type;
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

        $navigation = [
            'forms' => [
                'label' => 'beltechsoft.forms::lang.menu.forms',
                'icon' => 'icon-address-book',
                'permissions' => ['beltechsoft.forms.*'],
                'order' => 200,
                'sideMenu' => [],
            ],
        ];
        $types = Type::query()->get();
        if($types->isNotEmpty()){
            $navigation['forms']['sideMenu']['section-start'] = ['itemType' => 'ruler'];

            foreach ($types as $type){
                $navigation['forms']['sideMenu'][$type->code] = [
                    'counter' => Result::query()->where('type_id', $type->id)->where('unread', true)->count(),
                    'counterLabel' => 12,
                    'label' => $type->name,
                    'icon' => 'icon-database',
                    'url' => \Backend\Facades\Backend::url('beltechsoft/forms/results?code=' . $type->code),
                ];
            }

            $navigation['forms']['sideMenu']['section-end'] = ['itemType' => 'ruler'];
        }

        $navigation['forms']['sideMenu']['types'] = [
            'label' => 'beltechsoft.forms::lang.menu.types',
            'icon' => ' icon-cog',
            'url' => \Backend\Facades\Backend::url('beltechsoft/forms/types'),
            'permissions' => ['beltechsoft.forms.*'],
        ];

        return $navigation;
    }

}
