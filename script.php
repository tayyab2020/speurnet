<?php


$words = [
    'aberration' => 'a state or condition markedly different from the norm',
    'convivial' => 'occupied with or fond of the pleasures of good company',
    'diaphanous' => 'so thin as to transmit light',
    'elegy' => 'a mournful poem; a lament for the dead',
    'ostensible' => 'appearing as such but not necessarily so'
];

// Finding a random word
$key = array_rand($words);
$value = $words[$key];

\Mail::raw("{$key} -> {$value}", function ($mail) {
    $mail->from('info@tutsforweb.com');
    $mail->to('tayyabkhurram62@gmail.com')
        ->subject('Word of the Day');
});


