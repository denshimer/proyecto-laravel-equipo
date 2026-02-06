<?php

return [
    // Mensajes de Validación en Español
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'max' => [
        'string' => 'El campo :attribute no debe exceder :max caracteres.',
    ],
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
    ],
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'unique' => 'El :attribute ya ha sido registrado.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'image' => 'El campo :attribute debe ser una imagen.',
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'url' => 'El campo :attribute debe ser una URL válida.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    
    // Atributos Personalizados
    'attributes' => [
        'title' => 'título',
        'excerpt' => 'resumen',
        'body' => 'contenido',
        'content_type_id' => 'tipo de contenido',
        'category_id' => 'categoría',
        'image' => 'imagen',
        'start_date' => 'fecha de inicio',
        'end_date' => 'fecha de fin',
        'location' => 'ubicación',
        'max_attendees' => 'cupo máximo',
        'external_registration_link' => 'enlace de inscripción externa',
        'is_published' => 'estado de publicación',
        'is_featured' => 'destacado',
        'first_name' => 'nombre',
        'last_name' => 'apellido',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'university_code' => 'código universitario',
        'semester' => 'semestre',
        'academic_degree' => 'grado académico',
        'specialty' => 'especialidad',
    ],
];
