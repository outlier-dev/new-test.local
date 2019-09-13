<?php


namespace utility;

class ArrayHelper
{

    public static function makeTree(array $flatArray, $parentId = null) {
        $arrLevel = [];
        foreach ($flatArray as $aNode) {
            if ($aNode['parent_id'] == $parentId) {
                //ad recursion for make sub-sub levels
                $subLevel = self::makeTree($flatArray, $aNode['id']);
                if ($subLevel) {
                    $aNode['children'] = $subLevel;
                }
                $arrLevel[$aNode['id']] = $aNode;
            }
        }
        return $arrLevel;
    }

    public static function flattenTree(array $tree)
    {
        $arrFlat = [];
        foreach ($tree as $key => $tNode) {
            if ($tNode['children']){
                $arrFlat = array_merge($arrFlat, self::flattenTree($tNode['children']));
                unset($tNode['children']);
                $arrFlat[] = $tNode;
            } else {
                $arrFlat[] = $tNode;
            }
        }
        uasort($arrFlat, function($a, $b){
            return strnatcmp($a['id'], $b['id']);
        });
        $arrFlat = array_values($arrFlat);
        return $arrFlat;
    }
// 3. Given a tree structure implement a function able to retrieve nested
// element by its path or return default value.
//
// Implement both recursive and iterative versions.
//
// Path looks is a set of components separated by dot (".").
// E.g. db.connection.dsn
    public static function getValueIterative($path, $array, $default = null)
    {
        // may be not a good idea
        if (is_object($default)) {$default = null;}
        $arrExploded = explode ( '.' , $path);
        $aeCount = count($arrExploded);
        $string = $array;
        for ($i=0; $i < $aeCount; $i++){
            $string = $string[$arrExploded[$i]];
        }
        return $string ? $string : $default;
    }

    public static function getValueRecursive($path, $array, $default = null)
    {
        if (is_object($default)) {$default = null;}
        $arrExploded = explode ( '.' , $path);
        foreach ($arrExploded as $k) {
            $array = $array[$k];
        }
        return $array ? $array : $default;
    }

    //Something from WEB
    public static function getValueByKey($key, array $data, $default = null)
    {
        // @assert $key is a non-empty string
        // @assert $data is a loopable array
        // @otherwise return $default value
        if (!is_string($key) || empty($key) || !count($data))
        {
            return $default;
        }

        // @assert $key contains a dot notated string
        if (strpos($key, '.') !== false)
        {
            $keys = explode('.', $key);

            foreach ($keys as $innerKey)
            {
                // @assert $data[$innerKey] is available to continue
                // @otherwise return $default value
                if (!array_key_exists($innerKey, $data))
                {
                    return $default;
                }

                $data = $data[$innerKey];
            }

            return $data;
        }

        // @fallback returning value of $key in $data or $default value
        return array_key_exists($key, $data) ? $data[$key] : $default;
    }
// 4. Theoretical. Which of the above implementations (recursive or iterative)
// would you chose for production? Why?
// really thing from web seems more solid choice / but im IMO recursive get is not so bad

}