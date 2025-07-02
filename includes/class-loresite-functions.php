<?php

if(!defined('ABSPATH') || !defined('FILE_ACCESSS'))
{
    exit('No Direct Acces Is Allowed');
}

/**
 * Generates an input field HTML element.
 *
 * @param string $formName The name of the input field.
 * @param string $labelText The label text for the input field.
 * @param string $inputType The type of input (e.g. text, date, checkbox).
 * @param bool $required Whether the input field is required.
 * @param mixed $formarr The formdata to fill in when you are using edit
 * @return string The HTML for the input field.
 */
function inputField($formName, $labelText, $inputType, bool $required, $formArr)
{
    $html = '<div class="row"> <div class="col-xl-3">
    <label for="' . $formName . '">' . $labelText . '</label>' .
    (($required === true) ? '<span style="color: red;">*</span>' : '') .
    '</div>  <div class="col-xl-9">';

    if ($inputType === 'checkbox') 
    {
        $html .= '<input type="' . $inputType . '" id="' . $formName . '" name="' . $formName . '"true"' .
        (($required === true) ? ' required' : '') .
        ((!empty($formArr)) ? ' checked' : '') . ' class="form-control">';
    } 
    else 
    {
        $html .= '<input type="' . $inputType . '" id="' . $formName . '" name="' . $formName . '" value="' .
        ((!empty($formArr)) ? $formArr : '') . '"' .
        (($required === true) ? 'required' : '') . ' class="form-control">';
    }

    $html .= '</div> </div>';

    return $html;
}

/**
 * Generates a text area HTML element.
 *
 * @param string $formName The name of the text area.
 * @param string $labelText The label text for the text area.
 * @param bool $required Whether the text area is required.
 * @param mixed $formarr The formdata to fill in when you are using edit
 * @return string The HTML for the text area.
 */
function inputTextArea($formName, $labelText, bool $required, $formArr)
{
    $html = '<div class="row"> <div class="col-xl-3">
    <label for="' . $formName . '">' . $labelText . '</label>' .
    (($required === true) ? '<span style="color: red;">*</span>' : '') .
    '</div>  <div class="col-xl-9">
    <textarea id="' . $formName . '" name="' . $formName . '" ' .
    (($required === true) ? 'required' : '') . ' rows="5" cols="50" class="form-control">' .
    ((!empty($formArr)) ? $formArr : '') . 
    '</textarea> </div> </div>';

    return $html;
}

/**
 * Generates a select HTML element.
 *
 * @param string $formName The name of the select input.
 * @param string $labelText The label text for the select input.
 * @param string $select The options tags for the select input.
 * @param bool $required Whether the select input is required.
 * @param mixed $formarr The formdata to fill in when you are using edit
 * @return string The HTML for the select input.
 */
function inputSelect($formName, $labelText, $select, bool $required, $formArr)
{
    $html = '<div class="row"> <div class="col-xl-3">
    <label for="' . $formName . '">' . $labelText . '</label>' .
    (($required === true) ? '<span style="color: red;">*</span>' : '') .
    '</div>  <div class="col-xl-9">
    <select id="' . $formName . '" name="' . $formName . '" class="form-control">' . $select .
    '</select> </div> </div>';

    return $html;
}

/**
 * Generates a input list HTML element.
 *
 * @param string $formName The name of the input list.
 * @param string $labelText The label text for the input list.
 * @param string $select The options tags for the input list.
 * @param array $formArr The data that was used to prefill the forms in the edit form.
 * @param bool   $required Whether the input list is required.
 * @param string $text Optional text to place after the input list
 * @return string The HTML for the input list input.
 */
function inputList( $formName, $labelText, $select, $formArr, bool $required, $text = '' ) 
{
    $html = '<div class="input-row"> <div class="input-label">
    <label for="' . $formName . '">' . $labelText . '</label>' .
    ( ( $required === true ) ? '<span style = "color: red;">*</span>' : '' ) .
        '</div> <div class="input-field">
    <input list="'.$formName.'-input" id="'.$formName.'" name="'.$formName.'"value="'.$formArr. '"' .
    ( ( $required === true ) ? 'required' : '' ) . '>
    <datalist id="' . $formName . '-input" name="' . $formName . '">' . $select .
        '</datalist>' . $text . ' </div> </div>';

    return $html;
}

/**
 * Generates a button HTML element.
 *
 * @param string $buttonId The ID of the button.
 * @param string $buttonText The text to display on the button.
 * @param string $buttonClass The class for the button, to give it its own styling
 * @return string The HTML for the button.
 */
function inputButton( $buttonId, $buttonText, $buttonClass = '') 
{
    $html = '<button id="' . $buttonId . '" name="' . $buttonId . '"'. $buttonClass . '>' . $buttonText . '</button>';

    return $html;
}

/**
 * Styles the content of a input string.
 *
 * @param string $text The input
 * For links, do [ref]PAGELINK|PAGE NAME[/ref]
 * For images, do [img]image.png[/img]
 * @return string The HTML for the styled output
 */
function contentStyler( $text )
{
    $text =  htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

    // bold text
    $text = str_replace("[b]", "<b>", $text);
    $text = str_replace("[/b]", "</b>", $text);

    // Italic
    $text = str_replace("[i]", "<i>", $text);
    $text = str_replace("[/i]", "</i>", $text);

    // Underline
    $text = str_replace("[u]", "<u>", $text);
    $text = str_replace("[/u]", "</u>", $text);

    // Strikethrough
    $text = str_replace("[s]", "<s>", $text);
    $text = str_replace("[/s]", "</s>", $text);

    // Line break
    $text = str_replace("[br]", "<br>", $text);

    // Lists
    $text = str_replace("[ul]", "<ul>", $text);
    $text = str_replace("[/ul]", "</ul>", $text);

    $text = str_replace("[ol]", "<ol>", $text);
    $text = str_replace("[/ol]", "</ol>", $text);

    $text = str_replace("[li]", "<li>", $text);
    $text = str_replace("[/li]", "</li>", $text);

    // Headings h1-h7
    for ($i = 1; $i <= 7; $i++) {
        $text = str_replace("[h$i]", "<h$i>", $text);
        $text = str_replace("[/h$i]", "</h$i>", $text);
    }

    // Links
    $text = preg_replace_callback('/\[ref\](.*?)\|(.*?)\[\/ref\]/i', function ($matches) {
            $link = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
            $linkText = htmlspecialchars($matches[2], ENT_QUOTES, 'UTF-8');
            return '<a href="index.php?page=' . $link . '">' . $linkText . '</a>';
        },
        $text
    );

    // image 
    $text = preg_replace_callback(
        '/\[img\](.*?)\[\/img\]/i',
        function ($matches) {
            $filename = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
            return '<img src="documentation/' . $filename . '" alt="No Image Found" class="img-fluid border rounded" width="300" height="300">';
        },
        $text
    );

    return $text;
}