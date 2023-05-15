<?php

namespace api;

abstract class BaseApi
{
    const LOGIN = 'labsales_test';
    const PASSWORD = '18765gR5';

    /**
     * @param string $url
     * @param int|null $parameter
     */
    abstract protected function prepareCURL(string $url, int $parameter = null);

    /**
     * @param $curl
     * @return void
     */
    abstract protected function closeCURL($curl): void;
}
