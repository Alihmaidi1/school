<?php

namespace App\repo\interfaces;

interface library{


    public function getAllLibrary();
    public function store($request);

    public function update($request);


    public function delete($request);

}
