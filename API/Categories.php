<?php

namespace api;

use CurlHandle;

class Categories extends BaseApi
{
    const CATEGORIES_URL = 'https://test.labsales.ru/tasks/articles/rest/categories';

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $categoriesUrl = $this->prepareCURL(self::CATEGORIES_URL);
        $res = json_decode(curl_exec($categoriesUrl));
        $this->closeCURL($categoriesUrl);
        if (!empty($res->error)) {
            echo $res->error;
        }
        return $res->data;
    }

    /**
     * @param int|null $parameter
     */
    protected function prepareCURL(string $url, int $parameter = null)
    {
        $categoriesCURL = curl_init($url);
        curl_setopt($categoriesCURL, CURLOPT_USERPWD, parent::LOGIN . ':' . parent::PASSWORD);
        curl_setopt($categoriesCURL, CURLOPT_RETURNTRANSFER, 1);

        return $categoriesCURL;
    }

    /**
     * @param $curl
     * @return void
     */
    protected function closeCURL($curl): void
    {
        curl_close($curl);
    }

}
