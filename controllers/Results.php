<?php namespace Beltechsoft\Forms\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Beltechsoft\Forms\Models\Result;
use Beltechsoft\Forms\Models\Type;

/**
 *  Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Results extends Controller
{

    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['Beltechsoft.Forms.results'];

    public $type = null;
    public function __construct()
    {
        parent::__construct();

        $this->type = Type::query()->where('code', get('code'))->first();
        BackendMenu::setContext('Beltechsoft.Forms', 'forms', $this->type ?  $this->type->code : 'results');

    }

    public function listExtendQuery($obQuery): void
    {
        if($this->type){
            $obQuery->orderBy('id', 'desc')->where('type_id', $this->type->id);
        }
    }

    public function listOverrideRecordUrl($record, $definition = null)
    {
        if ($this->type) {
            return sprintf('beltechsoft/forms/results/preview/%d?code=%s', $record->id, $this->type->code);
        }
    }

    public function listExtendColumns($list)
    {

        $fields = Result::query()->where('type_id', $this->type->id)->get()->pluck('data')->map(function ($data) {
            return array_keys($data);
        })->flatten()->unique()->take(5);

        foreach ($fields as $field){
            $list->addColumns([
                'data['.$field.']' => [
                    'label' => $field,
                    'type' => 'text',
                    'searchable' => false,
                    'invisible' => false,
                    'sortable' => true,
                    'order' => 200,
                ]
            ]);
        }

    }

    public function preview($recordId = null, $context = null){
        Result::query()->where('id', $recordId)->update(['unread' => false]);
        parent::preview($recordId, $context);
    }
}
