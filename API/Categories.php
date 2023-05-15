<?php

namespace api;

class Categories extends BaseApi
{
    const CATEGORIES_URL = 'https://test.labsales.ru/tasks/articles/rest/categories';

    public function getCategories()
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
     * @param string $url
     * @param int|null $parameter
     */
    protected function prepareCURL(string $url, int $parameter = null)
    {
        $categoriesCURL = curl_init($url);
        curl_setopt($categoriesCURL, CURLOPT_USERPWD, self::LOGIN . ':' . self::PASSWORD);
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
