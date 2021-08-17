<?php
namespace App\Components;

use App\Models\Category;
class Recusive{
    private $data;
    private $htmlSelected='';
    public function __construct($data){
        $this->data = $data;
    }

    // public function categoryRecusiveAdd($parent_id = 0,$subMark = ''){
    //     $this->data = Category::where('parent_id',$parent_id)->get();
    //     foreach($this->data as $item){
    //         $this->html .= '<option value=" '.$item->id.'"> '.$subMark .$item->name.' </option>';
    //         $this->categoryRecusiveAdd($item->id,$subMark .'--');
    //     }
    //     return $this->html;
    // }   

    function categoryRecusive($parentId,$id = 0, $text=''){
        foreach ($this->data as $value){
            if($value['parent_id'] == $id){
                if(!empty($parentId) && $parentId == $value['id']){
                    $this->htmlSelected .="<option selected value='".$value['id']."'>" .$text .$value['name'] . "</option>";
                }
                else{
                    $this->htmlSelected .="<option value='".$value['id']."'>" .$text .$value['name'] . "</option>";
                }
                $this->categoryRecusive($parentId,$value['id'],$text .'--');
            }
        }
        return $this->htmlSelected;
    }
    
}
