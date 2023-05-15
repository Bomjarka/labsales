<?php
namespace api;

class Articles extends BaseApi
{
    const LOGIN = 'labsales_test';
    const PASSWORD = '18765gR5';
    const ARTICLES_URL = 'https://test.labsales.ru/tasks/articles/rest/article/';

    public function getArticleData($articleID)
    {
        $articlesURL = $this->prepareCURL(self::ARTICLES_URL, $articleID);
        $res = json_decode(curl_exec($articlesURL));
        $this->closeCURL($articlesURL);
        if (!empty($res->error)) {
            echo $res->error . ' - ' . $articleID;
        }
        return $res->data;
    }

    protected function prepareCURL(string $url, int $parameter = null)
    {
        if (is_null($parameter)) {
            return 'No parameter';
        }

        $articlesCURL = curl_init($url . $parameter);
        curl_setopt($articlesCURL, CURLOPT_USERPWD, self::LOGIN . ':' . self::PASSWORD);
        curl_setopt($articlesCURL, CURLOPT_RETURNTRANSFER, 1);

        return $articlesCURL;
    }

    protected function closeCURL($curl): void
    {
        curl_close($curl);
    }
}
