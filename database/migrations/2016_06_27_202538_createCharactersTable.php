<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('characters', function(Blueprint $table)
      {
        $table->increments('id');
        $table->string('name');
        $table->string('keywords');
        $table->smallInteger('initiative')->unsigned()->default(0);
        $table->smallInteger('agility')->unsigned()->default(0);
        $table->smallInteger('cunning')->unsigned()->default(0);
        $table->smallInteger('spirit')->unsigned()->default(0);
        $table->smallInteger('strength')->unsigned()->default(0);
        $table->smallInteger('lore')->unsigned()->default(0);
        $table->smallInteger('luck')->unsigned()->default(0);
        $table->smallInteger('maxgrit')->unsigned()->default(0);
        $table->smallInteger('combat')->unsigned()->default(0);
        $table->smallInteger('range')->unsigned()->default(0);
        $table->smallInteger('melee')->unsigned()->default(0);
        $table->smallInteger('health')->unsigned()->default(0);
        $table->smallInteger('defense')->unsigned()->default(0);
        $table->smallInteger('sanity')->unsigned()->default(0);
        $table->smallInteger('willpower')->unsigned()->default(0);
        $table->timestamps();
        $table->softDeletes();
      });
      
      Schema::create('character_group', function(Blueprint $table)
      {
        $table->increments('id');
        $table->integer('group_id')->unsigned();
        $table->integer('character_id')->unsigned();
        $table->foreign('group_id')->references('id')->on('groups');
        $table->foreign('character_id')->references('id')->on('characters');
      });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
