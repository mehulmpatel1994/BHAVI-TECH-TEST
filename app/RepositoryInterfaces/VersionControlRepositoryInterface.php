<?php
namespace App\RepositoryInterfaces;

interface VersionControlRepositoryInterface{


    public function login(string $username , string $token);
    public function create($repoName);
    public function list();
    public function remove($repoName);
    public function filterList($request);
}
