<?php
namespace utility;

require_once "OpenBreweryDBException.php";


class OpenBreweryDB extends \stdClass
{

    private static $json_url = 'https://api.openbrewerydb.org/breweries';

    public $pageSettings = [
        'limit' => 40, // кол-во записей на странице
        'show'  => 5, // 5 до текущей и после
        'prev_show' => 0, // не показывать кнопку "предыдущая"
        'next_show' => 0, // не показывать кнопку "следующая"
        'first_show' => 0, // не показывать ссылку на первую страницу
        'last_show' => 0, // не показывать ссылку на последнюю страницу
        'prev_text' => 'назад',
        'next_text' => 'вперед',
        'class_active' => 'active',
        'separator' => ' ... ',
    ];

    public function getBrewery($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this::$json_url . '/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->checkNetworkError($ch);
        $obj = json_decode(curl_exec($ch));
        $this->checkInvalidJson($obj);
        curl_close($ch);
        if (!$obj->id) {
            throw new OpenBreweryDBException($obj->message, 404);
        }
        return $obj;
    }

    public function filter($str)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this::$json_url . '/search?query=' . $str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $this->checkNetworkError($ch);
        $obj = json_decode(curl_exec($ch));
        $this->checkInvalidJson($obj);
        curl_close($ch);
        foreach ($obj as $key => $item) {
            if (mb_stripos($item->name, $str) == false) {
                unset($obj[$key]);
            }
        }
        return $obj;
    }

    public function filterPaging($str,$page)
    {
        $data = $this->filter($str);
        $limit = $this->pageSettings['limit'];
        $start = ($page-1)*$limit;
        $end = $page*$limit;
        foreach ($data as $key => $item) {
            if (($key < $start) || ($key > $end)) {
                unset($data[$key]);
            }
        }
        return $data;
    }


    private function checkNetworkError($ch)
    {
        if (!curl_exec($ch)) {
            throw new OpenBreweryDBException('network error', -1);
        }
    }
    private function checkInvalidJson($object)
    {
        if (!$object) {
            throw new OpenBreweryDBException('invalid response', -2);
        }
    }

}
