<?php

namespace App\repo\interfaces;

interface classroom{


public function getAllClassroom();
public function store($request);
public function update($request);

public function delete($request);

public function get_classes_by_grade($id);


public function delete_group_class($array);

}
