<?php 

namespace interfaces;

interface Controller
{
    public function get(int $id);
    public function getAll();
    public function create($data);
    public function update(int $id,$data);
    public function delete(int $id);
}