<?php 

namespace App\repo\interfaces;

interface parents{


public function getAllParent();


public function store($request);

public function delete($id);

public function update($request);


public function delete_image($id);

public function save_image($request,$father_name);

}
