<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // $table->foreignId('city_id')->after('email');
            // $table->foreignIdFor(City::class)->after('email'); // generate foreign id name from model name
            // $table->foreignId('city_id')->after('email');
            // $table->foreign('city_id')->on('cities')->references('id');   // this to create index for created foreign id exist before
            // another way to create index 
            $table->foreignId('city_id')->after('email')->constrained();
            // $table->foreignIdFor(City::class)->after('email')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
};
