<?php

    class musical_piece_transposer {
        private $musical_pieces;

        public function __construct($musical_pieces) {
            $this->musical_pieces = $musical_pieces;
        }

        public function transpose($semi_tones) {
            $transposed_piece = [];
            foreach ($this->musical_pieces as $note) {
                $transposed_note = $this->transpose_note($note, $semi_tones);
                if ($this->is_note_in_range($transposed_note)) {
                    $transposed_piece[] = $transposed_note;
                } else {
                    echo "Error: Transposed notes are out of range.\n";
                    exit; // Terminate the script with an error status
                }
            }
            return $transposed_piece;
        }

        private function transpose_note($note, $semi_tones) {
            $new_octave = $note[0];
            $new_note_number = $note[1] + $semi_tones;

            while ($new_note_number > 12) {
                $new_octave++;
                $new_note_number -= 12;
            }

            while ($new_note_number < 1) {
                $new_octave--;
                $new_note_number += 12;
            }

            return [$new_octave, $new_note_number];
        }

        private function is_note_in_range($note) {
            if ($note[0] < -3 || $note[0] > 5) { // Validation for the specified octave range
                return;
            } else if (($note[0] == -3 && $note[1] < 10)|| ($note[0] == 5 && $note[1] > 1) ) { // Validation for first and last note
                return;
            } else if ($note[0] > -3 && $note[0] < 5 && $note[1] < 1 && $note[1] > 12) { // Validation for valid note range 
                return;
            } else {
                return true;
            }
        }
    }
