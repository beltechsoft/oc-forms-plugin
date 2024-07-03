<?php namespace Beltechsoft\Forms\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 *  Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('beltechsoft_forms_types', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->text('name')->nullable();
            $table->text('code')->nullable();
            $table->text('rules')->nullable();
            $table->text('fields')->nullable();
            $table->text('messages')->nullable();
            $table->text('attributes')->nullable();
            $table->text('options')->nullable();
            $table->timestamps();

        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('beltechsoft_forms_types');
    }
};
