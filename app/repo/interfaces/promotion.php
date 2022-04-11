<?php

namespace App\repo\interfaces;

interface promotion{


    public function getAllpromotion();


    public function store($student,$request);

    public function backStudent($id);

}
