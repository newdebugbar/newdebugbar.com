<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up() : void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('gravatar_hash')->nullable()->after('email_verified_at');
            $table->boolean('has_working_gravatar')->default(false)->after('gravatar_hash');
        });
    }

    public function down() : void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn(['gravatar_hash', 'has_working_gravatar']);
        });
    }
};
