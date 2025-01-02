<?php

class ProductFilter {
    public function apply($filters = [], $query){
        if($filters['name']){
            $query->where('name', $filters['name']);
        }
        if($filters['price']){
            $query->where('price', $filters['price']);
        }
        return $query;
    }
}
