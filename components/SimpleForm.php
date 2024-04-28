<?php namespace Beltechsoft\Forms\Components;

use Beltechsoft\Forms\Models\Result;
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
    private $type = null;

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
            'type' => [],
        ];
    }

    public function onRun()
    {
        $this->addJs('/plugins/beltechsoft/forms/assets/js/beltechsoft-form.js', ['defer' => true]);
    }

    public function onSubmitForm(): void
    {

        $this->type = Type::where('code', $this->property('code'))->first();
        if($this->type === null){
            throw new \ApplicationException('Form type not found');
        }

        $rules = $this->getDefaultRules() + $this->getParameterForValidator('rules');
        $messages = $this->getDefaultMessages() + $this->getParameterForValidator('message');
        $attributes = $this->getParameterForValidator('attributes');
        $post = post();


        $validator = Validator::make($post, $rules, $messages, $attributes);
        if ($validator->fails()){
            throw new ValidationException($validator);
        }

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
        $messages = [];
        if($this->type->check_form_token){
            $messages['_token.required'] = 'Are you a bot?';
        }

        return $messages + [
            'required' => __('beltechsoft.forms::lang.validator.messages.required'),
        ];
    }

    private function getDefaultRules(): array
    {
        $rules = [];
        if($this->type->check_form_token){
            $rules['_token'] = 'required';
        }
        return $rules;
    }
}
