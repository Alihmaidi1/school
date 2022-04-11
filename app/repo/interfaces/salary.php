<?php 

namespace App\repo\interfaces;

interface salary{


    public function getAllSalary();

    public function store($request);

    public function delete($request);

    public function update($request);

}