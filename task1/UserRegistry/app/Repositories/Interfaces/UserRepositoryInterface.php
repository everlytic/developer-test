<?php
namespace App\Repositories;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function all();

    public function create(Request $request);

    public function destroy($id);

    public function getById($id);

}
