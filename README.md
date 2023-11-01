# Musical Piece Transposer

This project provides a PHP console script and a class for transposing musical pieces. It includes code for both transposing musical pieces and unit testing using PHPUnit.

## Getting Started

These instructions will help you set up and use the project.

### Prerequisites

You need to have PHP and PHPUnit installed on your system to run the tests. If you don't have PHPUnit, you can install it using [Composer](https://getcomposer.org/).

    composer require --dev phpunit/phpunit


### Usage

1. **Transposing Musical Pieces**: You can use the provided console script `transpose.php` to transpose a musical piece. Run the script with the following command:.
    ```
    php transpose.php input_file.json semitones_to_transpose
    ```
### Test
1. **Unit Testing**: You can run unit tests for the musical_piece_transposer class using PHPUnit. Run the tests with the following command:.
    ```
    php vendor/bin/phpunit tests/musical_piece_transposer_test.php
    ```