<?php

namespace App\Services;

use App\Transaction;
use Carbon\Carbon;
use App\Interfaces\FileProcessServiceInterface;

class CsvFileService implements FileProcessServiceInterface
{

    private $column;

    private $validChars = [
        '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C',
        'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z'
    ];

    public function __construct(array $column = [])
    {
        $this->column = $column;
    }

    public  function getProcessedData(array $items = []) : array
    {

        $output = [];

        foreach ($items as $line_index => $line) {
            if ($line_index > 0) { // I assume the the first line contains the column names.
                $newLine = [];
                $values = $line;
                foreach ($values as $col_index => $value) {
                    if ($col_index == 1) {
                        $newLine[$this->column[$col_index]] = $value;
                        $newLine[$this->column[5]] = $this->VerifyKey($value);
                    } else {
                        $newLine[$this->column[$col_index]] = $value;
                    }
                }
                $output[] = $newLine;
            }
        }

        return $output;
    }

    public function VerifyKey(string $key): bool
    {

        if (strlen($key) != 10)
            return false;

        $checkDigit = $this->GenerateCheckCharacter(substr(
            strtoupper($key),
            0,
            9
        ));

        return $key[9] == $checkDigit;

    }

    public function GenerateCheckCharacter(string $input)
    {


        $factor = 2;
        $sum = 0;
        $n = count($this->validChars);
         // Starting from the right and working leftwards is easier since
         // the initial "factor" will always be "2"
        for ($i = strlen($input) - 1; $i >= 0; $i--)
        {
        $codePoint = array_search($input[$i], $this->validChars);
        $addend = $factor * $codePoint;
        // Alternate the "factor" that each "codePoint" is multiplied by
        $factor = ($factor == 2) ? 1 : 2;
        // Sum the digits of the "addend" as expressed in base "n"
        $addend = ($addend / $n) + ($addend % $n);
        $sum += $addend;
        }
        // Calculate the number that must be added to the "sum"
        // to make it divisible by "n"
        $remainder = $sum % $n;
        $checkCodePoint = ($n - $remainder) % $n;
        return $this->validChars[$checkCodePoint];
    }
}
