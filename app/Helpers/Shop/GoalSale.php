<?php

namespace App\Helpers\Shop;
 

 
class GoalSale {
    
    public static function get_goal($products,$goals) {
        $metas = array();
        foreach($products as $product)
        {
            foreach($goals as $key => $goal)
            {
                if($product->id == $goal->subcategory_id)
                {
                    $metas[] = $goal->goal;
                }
            }
        }
        $sum_metas = array_sum($metas);
        return $sum_metas;
    }

    public static function get_arpu($products,$goals) {
        $arpu = array();
        foreach($products as $product)
        {
            foreach($goals as $key => $goal)
            {
                if($product->id == $goal->subcategory_id)
                {
                    $arpu[] = $goal->arpu;
                }
            }
        }
        
        $sum_arpu = array_sum($arpu);
        return $sum_arpu;
    }
}
