<?php namespace Beltechsoft\Forms\Components;

use Beltechsoft\Forms\Models\Result;
use Beltechsoft\Forms\Models\Type;
use Cms\Classes\ComponentBase;
use Validator;
use October\Rain\Exception\ValidationException;
use Event;
/**
 * Forms Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class SimpleForm extends ComponentBase
{
    public ?Type $type = null;

    public function componentDetails()
    {
        return [
            'name' => 'beltechsoft.forms::lang.component.name',
            'description' => 'beltechsoft.forms::lang.component.description',
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties(): array
    {
        return [
            'type' => [],
            'partial_form' => [],
        ];
    }

    public function onRender()
    {
        $partial = $this->property('partial_form') ?: '@controls.htm';

        return $this->renderPartial($partial,
            [
                '__SELF__' => $this->alias,
                'type' => $this->type,
                'fields' => $this->getFields(),
            ]);
    }

    public function init()
    {
        $this->type = Type::where('code', $this->property('type'))->first();
        if($this->type === null){
            throw new \ApplicationException('Form type not found');
        }
    }
    public function onRun()
    {
        $this->addJs('/plugins/beltechsoft/forms/assets/js/beltechsoft-form.js', ['defer' => true]);
    }

    public function onSubmitForm(): void
    {

        $rules = $this->getDefaultRules() + $this->getParameterForValidator('rules');
        $messages = $this->getDefaultMessages() + $this->getParameterForValidator('message');
        $attributes = $this->getParameterForValidator('attributes');
        $post = post();


        $validator = Validator::make($post, $rules, $messages, $attributes);
        if ($validator->fails()){
            throw new ValidationException($validator);
        }

        Event::fire('beltechsoft.form.beforeSaveResult', [&$post, $this]);

        $result = new Result();
        $result->fill(['type_id' => $this->type->id, 'data' => array_except($post, ['_token'])]);
        $result->save();
    }

    private function getParameterForValidator(string $type): array
    {
        if($this->type === null){
            return [];
        }

        return array_filter(array_pluck((array)$this->type->{$type}, 'value', 'name'));
    }

    private function getDefaultMessages(): array
    {
        $messages = [
            'required' => __('beltechsoft.forms::lang.validator.messages.required'),
        ];

        if(array_get($this->type, 'options.check_form_token')){
            $messages['_token.required'] = 'Are you a bot?';
        }

        return $messages;
    }

    private function getDefaultRules(): array
    {
        $rules = [];

        if(array_get($this->type, 'options.check_form_token')){
            $rules['_token'] = 'required';
        }
        return $rules;
    }

    private function getFields(){
        $result = [];
        $rules = $this->getDefaultRules() + $this->getParameterForValidator('rules');


        foreach ((array)$this->type->fields as $field){
            $result[$field['name']] = $field + ['required' => key_exists($field['name'], $rules)];
        }

        return $result;
    }
}
