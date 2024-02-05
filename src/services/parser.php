<?php

function get_current_price_from_url($url)
{
    $price = 0;

    $html = file_get_contents($url);

    $dom = new DOMDocument();

    libxml_use_internal_errors(true);

    $dom->loadHTML($html);

    $xpath = new DOMXPath($dom);

    $elements = $xpath->query('//h3[contains(@class, "css-12vqlj3")]');

    if ($elements->length > 0) {
        foreach ($elements as $element) {
            echo 'Текущая цена: ' . $element->textContent . '<br>';
            $price = $element->textContent;
        }
    }


    return $price;
}

function get_name_from_url($url)
{
    $olx_name = '';

    $html = file_get_contents($url);

    $dom = new DOMDocument();

    libxml_use_internal_errors(true);

    $dom->loadHTML($html);

    $xpath = new DOMXPath($dom);

    $elements_name = $xpath->query('//h4[contains(@class, "css-1juynto")]');

    if ($elements_name->length > 0) {
        foreach ($elements_name as $element) {
            echo 'Обьявление: ' . $element->textContent . '<br>';
            $olx_name = $element->textContent;
        }
    }


    return $olx_name;
}