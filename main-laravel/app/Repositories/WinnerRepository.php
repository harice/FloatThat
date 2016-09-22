<?php namespace App\Repositories;

use App\Winner;

class WinnerRepository {

    public function create($data) {
        return Winner::create($data);
    }

}
