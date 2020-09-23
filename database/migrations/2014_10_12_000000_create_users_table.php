<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateUsersTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('users', function (Blueprint $table)
            {
                $table->id();
                $table->string('display_name')->nullable();
                $table->string('username')->nullable();
                $table->string('email')->nullable()->unique();
                $table->string('password');
                $table->string('avatar')->nullable();
                $table->string('country')->nullable();
                $table->string('href')->nullable();
                $table->string('uri')->nullable();
                $table->string('access_token');
                $table->string('refresh_token');
                $table->dateTime('token_expires_at');
                $table->rememberToken();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(): void
        {
            Schema::dropIfExists('users');
        }
    }
