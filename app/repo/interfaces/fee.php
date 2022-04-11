<?php

namespace App\repo\interfaces;

interface fee{


    public function getAllFee();

    public function store($request);

    public function update($request);

    public function delete($id);

}
