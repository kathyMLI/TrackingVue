<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use App\Tracking;
use App\Filters\TrackingFilter;
use App\Http\Requests;
use App\Http\Controllers\ApiController;
use App\Notifications\TrackingCreateNotification;
use App\Notifications\TrackingDeleteNotification;

class TrackingsController extends ApiController
{
    public function index(TrackingFilter $filter)
    {
        return Tracking::with('users')->filter($filter)->paginate();
    }

    public function store(Request $request)
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

        if ($request->user()->canAttach($request->code)) {
            $request->user()->trackings()->attach(
                $tracking->first()->id,
                ['description' => $request->description]
            );


            $request
                ->user()
                ->notify(new TrackingCreateNotification(
                    $request->user()->name,
                    $request->code,
                    $request->description
                    ));
            return $this->respondStore();
        }

        return $this->respondWithInternalServerError();
    }

    public function show(Request $request, Tracking $tracking)
    {
        return $request->user()->trackings()->where('id', $tracking->id)->get();
    }

    public function update(Request $request, Tracking $tracking)
    {
        $this->validate($request, [
            'description' => 'required|max:255'
        ]);

        $request->user()->trackings()->updateExistingPivot(
            $tracking->id,
            ['description' => $request->description]
        );
        return $this->respondUpdate();
    }

    public function destroy(Request $request, Tracking $tracking)
    {
        $request->user()->trackings()->detach($tracking->id);
        if (User::hasTrackingCode($tracking->code)) {
            Tracking::destroy($tracking->id);
        }

        $request
            ->user()
            ->notify(new TrackingDeleteNotification(
                $tracking->code,
                $request->user()->name
                ));
        
        return $this->respondDestroy();
    }
    
}
