<?php

class ProductFilter {
    public function apply($filters = [], $query){
        foreach($filters as $filter){
            if($filter['name']){
                $query->where('name', $filter['name']);
            }
            if($filter['price']){
                $query->where('price', $filter['price']);
            }
        }
        return $query;
    }
}
