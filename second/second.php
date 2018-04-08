#!/usr/bin/php
<?php

function parse($str) {
    $components = parse_url($str);
    if (false === $components) {
        throw new InvalidArgumentException(sprintf('Bad url: %s', $str));
    }

    $params = [];
    if (isset($components['query'])) {
        parse_str($components['query'], $params);
    }

    while ($key = array_search('3', $params, true)) {
        unset($params[$key]);
    }

    if ($params) {
        arsort($params);
    }

    if (isset($components['path'])) {
        $params['url'] = $components['path'];
    }

    $query = [];
    foreach ($params as $key => $value) {
        $query[] = $key . '=' . urlencode($value);
    }

    $result = $components['scheme']  . '://'
        . $components['host'] . '/?'
        . implode('&', $query);

    return $result;
}

if (!empty($argv)) {
    $str = 'https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3';
    if ($argc > 1) {
        $str = $argv[1];
    }
    echo parse($str) . PHP_EOL;
}

