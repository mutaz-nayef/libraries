<?php

namespace App\Http\Controllers;

use App\Http\Resources\CityResource;
use App\Http\Resources\CityResourceCollection;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(City::class, 'city');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::withCount('users')->get();
        if ($request->expectsJson()) {
            // return response()->json(['data' => $cities]);
            // return CityResource::collection($cities);
            // return new CityResource($cities[0]);
            return new CityResourceCollection($cities);
        } else {
            return response()->view('cms.cities.index', [
                'cities' => $cities
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes =  $request->validate([
            'name_en' => 'required|string|min:3|max:50',
            'name_ar' => 'required|string|min:3|max:50',
            'active' => 'nullable|string|in:on',
        ], [
            'name_en.required' => 'Enter City English Name',
            'name_ar.required' => 'Enter City Arabic Name',
        ]);
        $attributes['active'] = $request->has('active');
        $city = City::create($attributes);
        if ($city) {
            session()->flash('message', 'city created successfully');
            // return redirect()->route('cities.index');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city) // here the name of variblae city must be like varible name you sent
    {
        return response()->view('cms.cities.edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $attributes =  $request->validate([
            'name_en' => 'required|string|min:3|max:50',
            'name_ar' => 'required|string|min:3|max:50',
            'active' => 'nullable|string|in:on',
        ], [
            'name_en.required' => 'Enter City English Name',
            'name_ar.required' => 'Enter City Arabic Name',
        ]);
        $attributes['active'] = $request->has('active');
        $update =   $city->update($attributes);
        if ($update) {
            // session()->flash('message', 'city updated successfully');
            return redirect()->route('cities.index');
            // return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $deleted =  $city->delete();
        if ($deleted) {
            return redirect()->back();
        }
    }
}
