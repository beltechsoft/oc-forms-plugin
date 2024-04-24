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
    private $formType = null;

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

        $this->formType = Type::where('code', $this->property('code'))->first();
        if($this->formType === null){
            throw new \ApplicationException('Form type not found');
        }

        $rules = $this->getParameterForValidator('rules');
        $messages = array_merge($this->getDefaultMessages(),$this->getParameterForValidator('message'));
        $attributes = $this->getParameterForValidator('attributes');


        $validator = Validator::make(post(), $rules, $messages, $attributes);
        if ($validator->fails()){
            throw new ValidationException($validator);
        }
    }

    private function getParameterForValidator(string $type): array
    {
        if($this->formType === null){
            return [];
        }

        return array_pluck((array)$this->formType->{$type}, 'value', 'name');
    }

    private function getDefaultMessages(): array
    {
        return [
            'required' => __('beltechsoft.forms::lang.validator.messages.required'),
        ];
    }
}
