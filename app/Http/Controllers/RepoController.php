<?php

namespace App\Http\Controllers;

use App\RepositoryInterfaces\VersionControlRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepoController extends Controller
{
    public $gitRepository;
    function __construct(VersionControlRepositoryInterface $gitRepository) {
        $this->gitRepository = $gitRepository;
    }

    public function filterRepo(Request $request)
    {
        //Validate
        $data = Validator::make($request->all(),[
                'username' =>'required'
            ]);
        // IF FAIL
        if($data->fails())
            return response()->json(['status' => false, 'message' => $data->errors()->first()]);
        // GET FILTLER LIST
        $repositories = $this->gitRepository->filterList($request);
        $repositories = collect($repositories)->map(fn ($item) => ['full_name' => $item->full_name, 'url' => $item->url]);

        return response()->json(['username' => $request->username,'repositories' => $repositories]);
    }
}
