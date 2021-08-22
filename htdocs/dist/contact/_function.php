<?php

require __DIR__.'/../vendor/autoload.php';

/**
 * Return all fields from POST input.
 * 
 * @return array
 */
function data()
{
    $input = array();

    foreach(fields() as $field) {
        $input[$field] = isset($_POST[$field]) ? $_POST[$field] : null;
    }

    return $input;
}

/**
 * Return key index of input.
 * 
 * @return array
 */
function fields()
{
    // Change array here accordingly to the <input name="">'s name attribute.
    // _token should always be available.
    return [
        '_token', 'email', 'name', 'details', 'item-radio',
    ];
}
?>