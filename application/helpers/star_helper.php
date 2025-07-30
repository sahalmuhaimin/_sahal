<?php
function show_stars($rating, $max = 5) {
    $output = '';
    $full = floor($rating);
    $half = ($rating - $full) >= 0.5 ? 1 : 0;
    $empty = $max - $full - $half;
    for ($i = 0; $i < $full; $i++) {
        $output .= '<span style="color:#ffc700;font-size:1.2em;">&#9733;</span>';
    }
    if ($half) {
        $output .= '<span style="color:#ffc700;font-size:1.2em;">&#9733;</span>'; // Bisa diganti setengah bintang jika ada icon
    }
    for ($i = 0; $i < $empty; $i++) {
        $output .= '<span style="color:#ddd;font-size:1.2em;">&#9733;</span>';
    }
    return $output;
}