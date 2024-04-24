<?php namespace Beltechsoft\Forms\Components;

use Beltechsoft\Forms\Models\Type;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Request;
use Validator;
use October\Rain\Exception\ValidationException;
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
            'type' => [

            ],
            'rules' => [
                'title' => 'beltechsoft.forms::lang.component_properties.rules_title',
                'type' => 'dictionary',
                'group' => 'beltechsoft.forms::lang.component_properties.rules_group',
                'showExternalParam' => false,
            ],
            'attributes' => [
                'title' => 'beltechsoft.forms::lang.component_properties.attributes_title',
                'type' => 'dictionary',
                'group' => 'beltechsoft.forms::lang.component_properties.attributes_group',
                'showExternalParam' => false,
            ],
        ];
    }

    public function onSubmitForm(){

        $type = Type::where('code', $this->property('type'))->first();
  ;
        if($type === null){
            throw new \ApplicationException('Form type not found');
        }

        $rules = (array)$type->rules;
        $messages = array_merge([
            'required' => __('beltechsoft.forms::lang.validator.messages.required'),
        ],(array)$type->messages);
        $attributes = (array)$type->attributes;


        $validator = Validator::make(post(), $rules, $messages, $attributes);
        if ($validator->fails()){
            throw new ValidationException($validator);
        }
    }
}
