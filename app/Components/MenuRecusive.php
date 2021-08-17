<?php
namespace App\Components;
use App\Models\Menu;

class MenuRecusive{
    private $html;
    public function __construct(){
        $this->html='';
    }
    public function menuRecusiveAdd($parent_id = 0,$subMark = ''){
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach($data as $item){
            $this->html .= '<option value=" '.$item->id.'"> '.$subMark .$item->name.' </option>';
            $this->menuRecusiveAdd($item->id,$subMark .'--');
        }
        return $this->html;
    }

    public function menuRecusiveEdit($parentIdEdit,$parent_id = 0,$subMark = ''){
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach($data as $item){
            if($parentIdEdit == $item->id)
            {
                $this->html .= '<option selected value=" '.$item->id.'"> '.$subMark .$item->name.' </option>';
            }
            else{
                $this->html .= '<option value=" '.$item->id.'"> '.$subMark .$item->name.' </option>';

            }
            $this->menuRecusiveEdit($parentIdEdit,$item->id,$subMark .'--');
        }
        return $this->html;

    }
}
