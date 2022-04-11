<?php

namespace App\repo\interfaces;


interface student{


    public function getAllStudent();

    public function store($request);

    public function update($request);
    public function delete($id);

    public function update_level($request,$id);


}
