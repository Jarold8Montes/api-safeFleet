<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Reglas de Cálculo de BPM
    |--------------------------------------------------------------------------
    |
    | Aquí se definen las reglas para calcular el puntaje de riesgo y determinar
    | los rangos de BPM recomendados para los operadores.
    |
    */

    // Puntuación por edad
    'age_threshold' => 50,
    'age_score' => 1,

    // Puntuación por factores de riesgo
    'risk_factors' => [
        'Hipertensión arterial' => 2,
        'Diabetes o prediabetes' => 2,
        'Sistema inmunológico debilitado' => 2,
        'Obesidad o sobrepeso' => 1.5,
        'Niveles elevados de colesterol o triglicéridos' => 1,
        'Trastornos hormonales' => 1,
    ],

    // Umbrales de puntuación para determinar el rango
    'score_thresholds' => [
        'wide_range' => 3, // Puntuación máxima para tener el rango amplio
    ],

    // Rangos de BPM
    'ranges' => [
        'wide' => ['min' => 50, 'max' => 110],
        'optimal' => ['min' => 60, 'max' => 100],
    ],
];
