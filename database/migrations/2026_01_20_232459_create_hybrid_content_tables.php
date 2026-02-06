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
        // 1. TIPOS DE CONTENIDO
        Schema::create('content_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: 'Noticia', 'Evento'
            $table->string('key')->unique(); // Ej: 'post', 'event' (para uso interno del código)
            $table->timestamps();
        });

        // 2. CATEGORÍAS
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('color')->nullable(); // Para CSS en el front
            $table->timestamps();
            $table->softDeletes();
        });

        // 3. POSTS
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('content_type_id')->constrained();
            
            // Contenido
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // Controlador asigna '' si está vacío
            $table->longText('body');
            $table->string('image_path')->nullable(); // Controlador asigna 'posts/default.jpg' si está vacío
            
            // Estados
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false)->index();
            
            $table->timestamps();
            $table->softDeletes();
        });

        // 4. DETALLES DE EVENTOS (Tabla Hija - Extensión 1 a 1)
        Schema::create('event_details', function (Blueprint $table) {
            $table->id();
            
            // Relación 1:1 con Posts
            $table->foreignId('post_id')->unique()->constrained()->onDelete('cascade');
            
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location');
            
            // ESTRATEGIA HÍBRIDA:
            // Si tiene link, usamos Google Forms/Teams. Si es null, usamos nuestra DB.
            // Controlador asigna '' si está vacío
            $table->string('external_registration_link')->nullable(); 
            
            // Controlador asigna 0 si está vacío (0 = ilimitado)
            $table->unsignedInteger('max_attendees')->nullable();
            
            $table->timestamps();
        });

        // 5. INSCRIPCIONES (Solo usadas si no hay link externo)
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            
            $table->enum('status', ['confirmed', 'cancelled', 'attended'])->default('confirmed');
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            // Evitar duplicados
            $table->unique(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('event_details');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('content_types');
    }
};
