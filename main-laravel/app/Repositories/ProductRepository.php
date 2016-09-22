<?php namespace App\Repositories;

use App\Product;

class ProductRepository {

    public function getAll() {
        return Product::all();
    }

    public function getActive() {
        return Product::active()->get();
    }

    public function getById($id) {
        return Product::find($id);
    }

}
