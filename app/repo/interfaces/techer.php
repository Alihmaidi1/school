<?php

namespace App\repo\interfaces;

interface techer{


public function store($request);
public function getAllTecher();

public function findTecher($id);

public function update($techer,$request);

public function delete($id);

public function store_subject($list,$id);


public function update_subject($request);

}
