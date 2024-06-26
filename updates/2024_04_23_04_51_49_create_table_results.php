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
        Schema::create('beltechsoft_forms_results', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->text('data')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('type')->nullable();
            $table->string('ip')->nullable();
            $table->boolean('unread')->default(1);
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('beltechsoft_forms_results');
    }
};
