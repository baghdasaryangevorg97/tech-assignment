<?php

namespace App\Repositories;

use App\Contracts\WebsiteRepositoryInterface;
use App\Models\Report;
use App\Models\Website;


class WebsiteRepository implements WebsiteRepositoryInterface
{
    public function getWebsites($paginate){
        return Website::orderBy('id', 'desc')->paginate($paginate);
    }

    public function create(array $data){
       return Website::create($data);
    }

    public function edit(int $id, string $url){
        return Website::where('id', $id)->update(['url' => $url]);
    }

    public function destroy(int $id){
        return Website::where('id', $id)->delete();
    }
    

}
