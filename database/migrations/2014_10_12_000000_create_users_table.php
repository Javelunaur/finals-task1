<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained(table:'roles')->onDelete(action: 'cascade');
            $table->foreignId('status')->constrained(table:'userstatus')->onDelete(action: 'cascade');
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('phone');
            $table->string('uname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
          //  $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });

            $users = [
                {
                    'fname'=> 'Admin',
                    'lname'=> 'Admin',
                    'email'=> 'admin@gmail.com',
                    'password'=>Hash::make(value: 'password'),
                    'role_id'=> 1,
                    'status' => 1,
                }
            ];

            foreach($users as $user){
                User::create(attributes: $user);
            }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
