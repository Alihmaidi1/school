<?php

namespace app\repo\interfaces;

interface subject{



    public function getAllsubject();
    public function store($request);

    public function GetStudent($id);

    public function update($request);

    public function delete($id);
}
