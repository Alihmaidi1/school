<?php

namespace App\repo\interfaces;

interface exam{


    public function getAllExam();
    public function store($request);

    public function delete($id);


    public function update($request);




}
