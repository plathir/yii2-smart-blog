<?php
namespace plathir\smartblog\components\migration;

class ReadDataXML {

    public $WidgetTypes;
    public $Widgets;
    public $Positions;
    public $Menu;
    public $new_menu;

/**
 *  Read XML
 * 
 * @param type $xmlfile
 * @return type
 */
    public function readxml($xmlfile) {

        $xml = simplexml_load_string($xmlfile);
        $data["WidgetTypes"] = $this->parseElement($xml->widgetTypes->widget_type);
        $data["Widgets"] = $this->parseElement($xml->widgets->widget);
        $data["Positions"] = $this->parseElement($xml->positions->position);
        $data["Menu"] = $this->normalizeMenu($this->parseElement($xml->menu->items->item));
        $data["Layouts"] = $this->parseElement($xml->layouts->layout);
        return $data;
    }

    /**
     * Parse Element
     * 
     * @param type $xmldata
     * @return string
     */
    public function parseElement($xmldata) {
        $h_element = '';
        $h_elements = '';
        foreach ($xmldata as $element_val) {
            foreach ($element_val as $key => $val) {
                if ($key == 'items') {
                    $h_element[$key] = $this->parseElement($val->item);
                } else {
                    $h_element[$key] = (string) $val;
                }
            }
            $h_elements[] = $h_element;
            $h_element = '';
        }
        return $h_elements;
    }

    /**
     *  Flaten  array
     * 
     * @staticvar type $id
     * @param type $arr
     * @param type $parent
     * @return type
     */
    function flatten($arr, $parent = '') {
        $result = [];
        static $id;

        if (is_array($arr)) {
            foreach ($arr as $item) {
                $id++;
                $item["id"] = $id;
                if (isset($item['items'])) {
                    $result = array_merge($result, $this->flatten($item['items'], $item));
                }
                unset($item['items']);
                $item["parent_id"] = ($parent) ? $parent["id"] : '';
                $result[] = $item;
            }
        }
        return $result;
    }

    public function sortMenu($menu) {
        $id = array_column($menu, 'id');
        array_multisort($id, SORT_ASC, $menu);
        return $menu;
    }

    /**
     * Array Set Depth
     * 
     * @param type $array
     * @param type $depth
     * @return type
     */
    function array_set_depth($array, $depth = -1) {
        $subdepth = $depth + 1;
        if ($depth < 0) {
            foreach ($array as $key => $subarray) {
                $temp[$key] = $this->array_set_depth(($subarray), $subdepth);
            }
            return $temp;
        }
        $array['depth'] = $depth;
        if (isset($array['items'])) {
            if (is_array($array['items'])) {
                foreach ($array['items'] as $key => $subarray) {
                    $temp[$key] = $this->array_set_depth($subarray, $subdepth);
                }
                unset($array['items']);
                $array['items'] = $temp;
            }
        }
        return $array;
    }

    /**
     *  Normalize Menu
     * 
     * @param type $array
     * @return type
     */
    public function normalizeMenu($array) {
        $array = $this->array_set_depth($array);
        return $this->sortMenu($this->flatten($array));
    }

}
