<?php namespace Beltechsoft\Forms\Components;

use Cms\Classes\ComponentBase;

/**
 * Forms Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class SimpleForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'beltechsoft.forms::lang.component.name',
            'description' => 'beltechsoft.forms::lang.component.description'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties(): array
    {
        return [
            'rules' => [
                'title' => 'beltechsoft.forms::lang.component_properties.rules_title',
                'type' => 'dictionary',
                'group' => 'beltechsoft.forms::lang.component_properties.rules_group',
                'showExternalParam' => false,
            ],
            'labels' => [

            ],
        ];
    }

    public function onSubmitForm(){

    }
}
