<?php

namespace entities;

require_once "utility/DataBase.php";
require_once "utility/YiiArrayHelper.php";
use utility\DataBase;
use utility\YiiArrayHelper;

class Books
{

    public static  function actionIndex(){

        $query = "SELECT
             B.name AS 'title',
             A.name AS 'name'
            FROM
             bx_books B, bx_authors A, bx_authors_assignments baa
            WHERE
             B.id = baa.book_id
            AND
             A.id = baa.author_id
            GROUP BY
             A.name
            ORDER BY
             B.name
             ";
        $data = DataBase::query($query);
        $result = YiiArrayHelper::index($data, null, 'title');
        return $result;
    }

    public static function actionIndexMore(){


        $query = "SELECT
             B.name AS 'title',
             A.name AS 'name',
             baa.book_id, COUNT(*) as 'count'
            FROM
             bx_books B, bx_authors A, bx_authors_assignments baa
            WHERE
             B.id = baa.book_id
            AND
             A.id = baa.author_id
             GROUP BY
             baa.book_id
             having 
             COUNT(*) > 1
             ORDER BY
             B.name
        ";
        $data = DataBase::query($query);
        $result = YiiArrayHelper::index($data, null, 'title');
        return $result;
    }
    public static function actionIndexTags(){
        $query = "SELECT
             B.name AS 'title',
             T.tag AS 'tag',
             bta.book_id, COUNT(*) as 'count'
            FROM
             bx_books B, bx_tags T, bx_tags_assignments bta
            WHERE
             B.id = bta.book_id
            AND
             T.id = bta.tag_id
             GROUP BY
             bta.book_id
             having 
             COUNT(*) > 0
             ORDER BY
             B.name
        ";
        $data = DataBase::query($query);
        $result = YiiArrayHelper::index($data, null, 'title');
        return $result;
    }
    public static function actionFindTags($tags){
        $tags = str_replace(' ','',$tags);
        $tags = explode(',',$tags);
        $in = '("' . implode('", "', $tags) .'")';
        $query = "SELECT
                 B.id, B.name
                FROM
                 bx_books B
                INNER JOIN
                 bx_tags_assignments bta ON B.id = bta.book_id
                INNER JOIN bx_tags t ON bta.tag_id = t.id
                WHERE t.tag IN ".$in."
        ";
        $data = DataBase::query($query);
        $result = YiiArrayHelper::index($data, null, 'name');
        return $result;
    }

}