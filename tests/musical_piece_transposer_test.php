<?php

require 'musical_piece_transposer.php'; // Include the class definition

use PHPUnit\Framework\TestCase;

class musical_piece_transposer_test extends TestCase {
    public function test_transpose_in_bounds() {
        $original_piece = [[2, 1], [2, 6], [2, 1]];
        $transposer = new musical_piece_transposer($original_piece);

        $transposed_piece = $transposer->transpose(2);

        // Assert that the transposed piece is as expected
        $expected_piece = [[2, 3], [2, 8], [2, 3]];
        $this->assertEquals($expected_piece, $transposed_piece);
    }

    public function test_transpose_out_of_bounds() {
        $original_piece = [[5, 1], [5, 2], [5, 3]];
        $transposer = new musical_piece_transposer($original_piece);

        $transposed_piece = $transposer->transpose(3);

        // Assert that it's out of bounds, so the result should be null
        $this->assertNull($transposed_piece);
    }
}
