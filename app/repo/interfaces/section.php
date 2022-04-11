<?php 

namespace App\repo\interfaces;

interface section{

public function store($request);

public function update($request);

public function delete($request);

public function get_section_by_classroom($id);
public function getAllSection();

}