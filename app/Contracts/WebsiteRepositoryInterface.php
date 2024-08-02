<?php

namespace App\Contracts;

interface WebsiteRepositoryInterface
{

    public function getWebsites(int $paginate);

    public function create(array $data);

    public function edit(int $id, string $url);

    public function destroy(int $id);
   
    
}