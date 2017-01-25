<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use App\Tracking;
use App\Filters\TrackingFilter;
use App\Http\Requests;
use App\Http\Controllers\ApiController;

class TrackingsController extends ApiController
{
    public function index(TrackingFilter $filter)
    {
        return Tracking::with('users')->filter($filter)->paginate();
    }

    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'code' => 'required|alpha_num|max:255',
            'description' => 'nullable|max:255'
        ]);

        $tracking = Tracking::getByCode($request->code);
        if ($tracking->isEmpty()) {
            Tracking::create(Tracking::getData($request->code));
            $tracking = Tracking::getByCode($request->code);
        }

        if ($user->canAttach($request->code)) {
            $user->trackings()->attach(
                $tracking->first()->id,
                ['description' => $request->description]
            );

            return $this->respondStore();
        }

        return $this->respondWithInternalServerError();
    }

    public function show(Tracking $tracking)
    {
        return $tracking;
    }

    public function update(Request $request, User $user, Tracking $tracking)
    {
        $this->validate($request, [
            'description' => 'required|max:255'
        ]);

        $user->trackings()->updateExistingPivot(
            $tracking->id,
            ['description' => $request->description]
        );

        return $this->respondUpdate();
    }

    public function destroy(User $user, Tracking $tracking)
    {
        $user->trackings()->detach($tracking->id);
        if (User::hasTrackingCode($tracking->code)) {
            Tracking::destroy($tracking->id);
        }
        
        return $this->respondDestroy();
    }
}
