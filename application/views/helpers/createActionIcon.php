<?php
class Zend_View_Helper_CreateActionIcon extends Zend_View_Helper_Abstract
{
    public static function createDataAttributesString($data) {
        $result = '';

        foreach ($data as $key => $val) {
            $result .= " data-{$key}=\"{$val}\"";
        }

        return $result;
    }

    public function createActionIcon($action)
    {
        $result = '';
        $dataAttributes = self::createDataAttributesString(array(
                'timeout'   => $action["recovery_time"]
            ,   'vip'       => $action["vip"]
        ));
        $id = $action["id"];
        $classes = 'action-icon shake ' . $id;
        $title = $action["title"];

        $result .= "<div id='{$id}' title='{$title}' class='{$classes}' {$dataAttributes}></div>";
        $result .= "<em class='timer'></em>";

        return $result;
    }
}