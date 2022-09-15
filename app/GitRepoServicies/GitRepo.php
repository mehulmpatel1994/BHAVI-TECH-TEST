<?php

namespace App\GitRepoServicies;


use App\RepositoryInterfaces\VersionControlRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;


class GitRepo implements VersionControlRepositoryInterface
{


    public function login(string $username, string $token)
    {

        // $setEnv = fn($key,$value) => file_put_contents(app()->environmentFilePath(), str_replace(
        //     $key . '=' . env($value),
        //     $key . '=' . $value,
        //     file_get_contents(app()->environmentFilePath())
        // ));

        // $setEnv('GIT_USERNAME',$username);
        // $setEnv('GIT_TOKEN',$token);

        // Artisan::call('config:clear');
    }
    public function create($repoName)
    {

        $response =  Http::github()->post("user/repos", ['name' => $repoName, "private" => false]);

        if ($response->successful()) {
            return 1;
        } else {
            return 0;
        }
    }
    public function remove($repoName)
    {

        $response =  Http::github()->delete("repos/" . env('GITHUB_USERNAME') . "/" . $repoName);

        if ($response->successful()) {
            return 1;
        } else {
            return 0;
        }
    }
    public function list()
    {
        $response =  Http::github()->get("user/repos");

        if ($response->successful()) {

            $data = collect(json_decode($response->body()))->map(function ($item) {
                return ['id' => $item->id, 'name' => $item->name, 'private' => $item->private];
            });

            return $data;
        } else {
            return [];
        }
    }
    public function filterList($request) {


            $response =  Http::withHeaders([

                'Accept' => 'application/vnd.github+json',

            ])->get("https://api.github.com/users/".$request->username."/repos");




        if ($response->successful()) {

            return json_decode($response->body());

        } else {
            return [];
        }
    }


}
