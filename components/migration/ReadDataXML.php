<?php

namespace plathir\smartblog\components\migration;

class ReadDataXML {

    public $WidgetTypes;
    public $Widgets;
    public $Positions;
    public $Menu;
    public $new_menu;

    public function readxml($xmlfile) {

        $xml = simplexml_load_string($xmlfile);
        $data["WidgetTypes"] = $this->parseElement($xml->widgetTypes->widget_type);
        $data["Widgets"] = $this->parseElement($xml->widgets->widget);
        $data["Positions"] = $this->parseElement($xml->positions->position);
        $h_menu = $this->parseElement($xml->menu->items->item);
        $data["Menu"] = $this->sortMenu($this->NormalizeMenu($h_menu));
        return $data;
    }

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

    public function NormalizeMenu($xmldata, $parent = '') {
        static $newmenu;
        $i = 0;
        static $id;

        foreach ($xmldata as $element_val) {
            $i++;
            $id++;
            foreach ($element_val as $key => $val) {
                if ($key != 'items') {
                    $items[$key] = $val;      
                } else {
                    $this->NormalizeMenu($val, $element_val);
                }
            }

            if ($parent) {             
                $items['parent'] = $parent["name"];
            } else {
                $items['parent'] = '';
            }
            $items['id'] = $id;
            $items['order'] = $i;
            $newmenu[] = $items;

            $items = '';
        }
        
        return $newmenu;
    }

    public function sortMenu($menu) {
        $new_array = '';

//        $id = array_column($menu, 'id');
//
//        array_multisort($id, SORT_ASC, $menu);

        return $menu;
    }

}
