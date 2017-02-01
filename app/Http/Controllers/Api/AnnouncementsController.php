<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Announcement;

class AnnouncementsController extends ApiController
{
    public function index()
    {
        return Announcement::paginate();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required|max:255',
            'message'    => 'required'
        ]);

        Announcement::create($request->all());
        return $this->respondStore();
    }

    public function update()
    {
        
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return $this->respondDestroy();
    }
}
