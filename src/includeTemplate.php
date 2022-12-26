<?php

function includeTemplate($templatePath, $data = [])
{
    extract($data);

    include dirname(__DIR__) . '/src/' . ltrim($templatePath, '/');
}
