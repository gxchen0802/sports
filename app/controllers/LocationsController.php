<?php

class LocationsController extends Controller {


    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store']]);   
    }


    public function index()
    {
        $locations = Locations::notDeleted()->get();

        $data = ['locations' => $locations];

        return View::make('cms.locations.index', $data);
    }


    public function show($location_id)
    {
        $data = [];

        $locations_rent = LocationsRent::where('location_id', $location_id)->where('start_date', '>=', date('Y-m-d'))->approved()->orderBy('start_date')->orderBy('start_time')->get();

        $location = Locations::find($location_id);

        $data['records'] = $locations_rent;
        $data['location'] = $location;

        // foreach ($locations_rent as $record) 
        // {
        //     $data[] = $record;
        //     var_dump($record->start_date.' '.$record->start_time.' '.$record->end_time);
        // }

        return View::make('cms.locations.show', $data);
    }

    public function create($location_id)
    {
        $data = ['location_id' => $location_id];

        return View::make('cms.locations.create', $data);
    }


    public function store()
    {
        LocationsRent::create([
            'location_id' => Input::get('location_id'), 
            'start_date'  => Input::get('start_date'),
            'start_time'  => Input::get('start_time'),
            'end_time'    => Input::get('end_time'),
            'attendees'   => (int)Input::get('attendees'),
            'department'  => Input::get('department'),
            'renter'      => Input::get('renter'),
            'event'       => Input::get('event'),
            'comment'     => Input::get('comment'),
            ]);

        // return Redirect::to('locations/'.Input::get('location_id'));
        return Redirect::back()->with('message', '请求已提交，等待审核中');
    }


    public function update()
    {
        Trainings::where('id', 2)->update(['title' => 'test title 2']);
    }

    public function destroy($id)
    {
        Locations::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
