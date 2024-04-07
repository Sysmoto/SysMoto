<?php

const SPACING_X   = 1;
const SPACING_Y   = 0;
const LINE_Y_CHART = '|';


function draw_table($table)
{

    $nl              = "\n";
    $columns_headers = columns_headers($table);
    $columns_lengths = columns_lengths($table, $columns_headers);
    $row_spacer      = row_spacer($columns_lengths);
    $row_headers     = row_headers($columns_headers, $columns_lengths);

    echo '<pre>';

    echo row_separator($columns_lengths, "=") . $nl;
    echo str_repeat($row_spacer . $nl, SPACING_Y);
    echo $row_headers . $nl;
    echo str_repeat($row_spacer . $nl, SPACING_Y);
    echo row_separator($columns_lengths, "-") . $nl;
    echo str_repeat($row_spacer . $nl, SPACING_Y);
    foreach ($table as $row_cells) {
        $row_cells = row_cells($row_cells, $columns_headers, $columns_lengths);
        echo $row_cells . $nl;
        echo str_repeat($row_spacer . $nl, SPACING_Y);
    }
    echo row_separator($columns_lengths, "=") . $nl;

    echo '</pre>';

}

/**
* Functions that count columns.
*/

function columns_headers($table)
{
    $key = [];
    foreach ($table as $value) {
        /**
        * Looking for unique array headers of keys. Using two functions array_unique and array_merge.
        */
        $key = array_unique(array_merge($key, array_keys($value)));
    };
    sort($key);
    
    return $key;
}

/**
* Functions that count columns length.
*/

function columns_lengths($table, $columns_headers)
{
    $lengths = [];
    foreach ($columns_headers as $header) {
        $header_length = strlen($header);
        $max           = $header_length;
        /**
        * Looking for the max length of values. Using function strlen.
        */
        foreach ($table as $row) {
            if (isset($row[$header])) {
            $length = strlen($row[$header]);
            if ($length > $max) {
                $max = $length;
            }
            }
        }
        if (($max % 2) != ($header_length % 2)) {
            $max += 1;
        }

        $lengths[$header] = $max;
    }

    return $lengths;
}

/**
* Function that draw rows.
*/

function row_separator($columns_lengths, $separator)
{
    $row = '';
    /**
    * Set up the length of row. Using the function str_repeat.
    */
    foreach ($columns_lengths as $column_length) {
        $row .= $separator . str_repeat($separator, (SPACING_X * 2) + $column_length);
    }
    $row .= $separator;

    return $row;
}

/**
* Function that draw row separators
*/

function row_spacer($columns_lengths)
{
    $row = '';
    /**
    * Set up the row separators. Using the function str_repeat.
    */
    foreach ($columns_lengths as $column_length) {
        $row .= LINE_Y_CHART . str_repeat(' ', (SPACING_X * 2) + $column_length);
    }
    $row .= LINE_Y_CHART;

    return $row;
}

/**
* Function that build cells of header
*/

function row_headers($columns_headers, $columns_lengths)
{
    $row = '';
    /**
    * Drawing the header that right alligned. Using the function str_pad and str_repeat.
    */
    foreach ($columns_headers as $header) {
        $row .= LINE_Y_CHART . str_pad($header, SPACING_X + $columns_lengths[$header], ' ', STR_PAD_LEFT) . str_repeat(' ', SPACING_X);
    }
    $row .= LINE_Y_CHART;

    return $row;
}

/**
* Function that build cells
*/

function row_cells($row_cells, $columns_headers, $columns_lengths)
{
    $row = '';
    /**
    * Drawing the cell's inner that right alligned. Using the function str_pad and str_repeat.
    */
    foreach ($columns_headers as $header) {
        $row .= LINE_Y_CHART . str_pad($row_cells[$header] ?? '', SPACING_X + $columns_lengths[$header], ' ', STR_PAD_LEFT) . str_repeat(' ', SPACING_X);
    }
    $row .= LINE_Y_CHART;

    return $row;
}

