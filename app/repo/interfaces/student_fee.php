<?php
namespace App\repo\interfaces;

interface student_fee{


    public function store($request);

    public function update($request);


    public function delete($id);

}
