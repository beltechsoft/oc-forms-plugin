<?php namespace Beltechsoft\Forms\Models;

use Model;

/**
  * @mixin \Model
  * @mixin \October\Rain\Database\Builder
  *
  * @property int $id
  * @property int $active
  * @property int|null $sort_order
  * @property string $name
  * @property string $slug
  * @property string|null $text
  * @property string|null $preview_text
  * @property \October\Rain\Argon\Argon|null $created_at
  * @property \October\Rain\Argon\Argon|null $updated_at
  *
  * @method \October\Rain\Database\Collection|static[] all($columns = ['*'])
  * @method \October\Rain\Database\Collection|static[] get($columns = ['*'])
  * @method \October\Rain\Database\Builder newModelQuery()
  * @method \October\Rain\Database\Builder newQuery()
  * @method static \October\Rain\Database\Builder query()
  * @method \October\Rain\Database\Builder active()
  */
class Result extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'beltechsoft_forms_results';

    public $implement = [];

    public $rules = [];

    public $timestamps = true;

    public $attachOne = [
    ];
    public $attachMany = [
    ];
}