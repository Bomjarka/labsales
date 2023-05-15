<?php

namespace api;

class CategoryArticles extends BaseApi
{
    const CATEGORY_ARTICLES_URL = 'https://test.labsales.ru/tasks/articles/rest/category/';

    /**
     * @param int $categoryID
     * @return mixed
     */
    public function getCategoryArticles(int $categoryID): array
    {
        $categoryArticleUSRL = $this->prepareCURL(self::CATEGORY_ARTICLES_URL, $categoryID);
        $res = json_decode(curl_exec($categoryArticleUSRL));
        $this->closeCURL($categoryArticleUSRL);
        if (!empty($res->error)) {
            echo $res->error . ' - ' . $categoryID;
        }
        return $res->data;
    }

    /**
     * @param int|null $parameter
     */
    protected function prepareCURL(string $url, int $parameter = null)
    {
        if (is_null($parameter)) {
            return 'No parameter';
        }

        $categoryArticlesCURL = curl_init(self::CATEGORY_ARTICLES_URL . $parameter);
        curl_setopt($categoryArticlesCURL, CURLOPT_USERPWD, parent::LOGIN . ':' . parent::PASSWORD);
        curl_setopt($categoryArticlesCURL, CURLOPT_RETURNTRANSFER, 1);

        return $categoryArticlesCURL;
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
