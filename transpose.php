<?php

require 'musical_piece_transposer.php'; // Music piece transposer class

if (count($argv) != 3) {
    echo "Usage: php transpose.php input_file.json semi_tones_to_transpose\n";
    exit(1);
}

$input_file = $argv[1];
$semi_tones_to_transpose = (int)$argv[2];

$input_json = file_get_contents($input_file);

// Validate for file is readable or not
if ($input_json === false) {
    echo "Error: Unable to read the input file.\n";
    exit;
}

$musical_pieces = json_decode($input_json, true);

// Validate for 
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error: Invalid JSON format in the input file.\n";
    exit;
}

// Validate each child array in the input JSON
foreach ($musical_pieces as $note) {
    if (!is_array($note) || count($note) !== 2 || !is_numeric($note[0]) || !is_numeric($note[1])) {
        echo "Error: Invalid format in one or more child arrays of the input JSON.\n";
        exit;
    } else if ($note[0] < -3 || $note[0] > 5) { // Validation for the specified octave range
        echo "Error: Invalid note values in the input JSON. Octave must be within the range of -3 to 5.\n";
        exit;
    } else if (($note[0] == -3 && $note[1] < 10) || ($note[0] == 5 && $note[1] > 1) ) { // Validation for first and last note
        echo "Error: Invalid note values in the input JSON. Note must be within the range of -3, 10 to 5, 1.\n";
        exit;
    } else if ($note[0] > -3 && $note[0] < 5 && $note[1] < 1 && $note[1] > 12) { // Validation for valid note range 
        echo "Error: Invalid note values in the input JSON. Note must be within the range of 1 to 12 for -2, -1, 0, 1, 2, 3 and 4 octaves.\n";
        exit;
    }
}

$transposer = new musical_piece_transposer($musical_pieces);
$transposed_pieces = $transposer->transpose($semi_tones_to_transpose);

if ($transposed_pieces === null) {
    echo "Error: Transposed notes are out of range.\n";
    exit;
} else {
    $output_file = 'transposed_output.json';
    file_put_contents($output_file, json_encode($transposed_pieces));
    echo "Transposed piece saved to $output_file\n";
    exit;
}
