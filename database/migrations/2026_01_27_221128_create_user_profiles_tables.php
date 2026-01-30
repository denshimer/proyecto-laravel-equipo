<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. USERS (Tabla Base)
        // Agregamos discriminador y estado
        Schema::table('users', function (Blueprint $table) {
        // Borramos la columna antigua 'name'
        $table->dropColumn('name');
        
        // Agregamos las nuevas separadas AL INICIO
        $table->string('last_name')->after('id');  // Apellido
        $table->string('first_name')->after('id'); // Nombre
        
        // El resto sigue igual...
        $table->string('profile_type')->nullable(); // 'student', 'teacher', 'admin'
        $table->boolean('is_active')->default(true);
        $table->softDeletes(); // Para soft delete de usuarios
        });

        // 2. TABLA ESTUDIANTES (Perfil Académico)
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // Relación 1:1 con Users (Si se borra el user, se va el perfil)
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            
            // Datos Académicos
            $table->string('university_code')->nullable()->unique(); // RU (Puede ser null si es externo)
            $table->integer('semester')->nullable(); // 1 al 10
            
            // Datos Personales
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            
            // Estado (Activo, Egresado)
            $table->string('academic_status')->default('active'); 
            
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. TABLA DOCENTES (Perfil Profesional)
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            
            // Relación 1:1 con Users
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->unique();
            
            // Datos Profesionales
            $table->string('academic_degree')->default('Ing.'); // Ing., MSc., PhD.
            $table->string('specialty')->nullable(); // Ej: "IA", "Redes"
            
            // Datos Públicos (Para mostrar en eventos/ponencias)
            $table->text('bio')->nullable(); 
            $table->string('website_url')->nullable();
            
            // Datos de Contacto Interno
            $table->string('phone')->nullable(); 
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('students');
        
        Schema::table('users', function (Blueprint $table) {
        // Revertir cambios
        $table->dropColumn(['first_name', 'last_name', 'profile_type', 'is_active']);
        $table->string('name'); // Volver a crear name
        });   
    }
};
