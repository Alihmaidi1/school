<?php

namespace App\repo\interfaces;

interface queze{


    public function getAllQueze();

    public function store($request);


    public function update($request);

    public function delete($id);


}
