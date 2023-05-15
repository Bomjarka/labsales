<?php
namespace base;

include "API\BaseApi.php";
include "API\Articles.php";
include "API\Categories.php";
include "API\CategoryArticles.php";

use api\Categories as Categories;
use api\CategoryArticles as CategoryArticles;
use api\Articles as Articles;

$categories = new Categories();
$categoriesArticles = new CategoryArticles();
$articles = new Articles();

$categoriesData = $categories->getCategories();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper mb-5 mt-5">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <?php foreach ($categoriesData as $key => $category) {
                    if ($key === 0) { ?>
                        <a class="nav-item nav-link active" id="nav-<? echo $category->category_id ?>-tab"
                           data-toggle="tab" href="#nav-<? echo $category->category_id ?>" role="tab"
                           aria-controls="nav-<? echo $category->category_id ?>"
                           aria-selected="true"><?php echo $category->name ?></a>
                    <? } else { ?>
                        <a class="nav-item nav-link" id="nav-<? echo $category->category_id ?>-tab" data-toggle="tab"
                           href="#nav-<? echo $category->category_id ?>" role="tab"
                           aria-controls="nav-<? echo $category->category_id ?>"
                           aria-selected="true"><?php echo $category->name ?></a>
                    <? } ?>

                <? } ?>
            </div>
        </nav>
        <? foreach ($categoriesData as $category) { ?>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade active show" id="nav-<? echo $category->category_id ?>" role="tabpanel">
            <div class="row mb-4">
                <?
                foreach ($categoriesArticles->getCategoryArticles($category->category_id) as $categoryArticle) {
                    $article = $articles->getArticleData($categoryArticle->article_id);
                    ?>
                    <div class="col-12 mt-3 mb-3">
                        <h2><? echo $article->name ?></h2>
                        <p><i><? echo $article->date ?></i></p>
                        <p><? echo $article->text ?></p>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
    <? } ?>
</div>
</div>
</body>
<script>
    $('.nav-item').on('click', function () {
        let blockToOpen = $(this).attr('aria-controls');
        $('.tab-pane').each(function () {
            if ($(this).attr("id") !== blockToOpen) {
                $(this).removeClass('active show');
            }
       });
    });
</script>
</html>        