<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field
{
    const STRING_TYPE = "string";
    const NUMBER_TYPE = "number";
    const SELECT_TYPE = "select";
    const FOREIGN_TYPE = "foreign";

    const TYPES = [
        self::STRING_TYPE,
        self::NUMBER_TYPE,
        self::SELECT_TYPE,
        self::FOREIGN_TYPE
    ];

    public static function item(
        string $name,
        string $label,
        string $type = 'string',
        string | null $entity = null,
        array | null $values = null,
        int $colSpan = 3,
        bool $show = false,
        bool $showInMobile = false,
        bool $showInDesktop = false,
        string | null $mask = null
    )
    {
        $showInMobile = $show ? true : $showInMobile;
        $showInDesktop = $show ? true : $showInDesktop;

        $returnObj = array(
            "name" => $name,
            "label" => $label,
            "type" => $type,
            "colSpan" => $colSpan,
            "showInMobile" => $showInMobile,
            "showInDesktop" => $showInDesktop
        );

        switch($type) {
            case self::SELECT_TYPE:
                $returnObj["values"] = $values;
                break;
            case self::FOREIGN_TYPE:
                $returnObj["entity"] = $entity;
                $returnObj["values"] = [];
                break;
            default:
                $returnObj['mask'] = $mask;
        }

        return $returnObj;
    }
}
