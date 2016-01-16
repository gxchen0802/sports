<?php

class LocationsController extends Controller {


    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'rent', 'search']]);   
    }


    public function index()
    {
        $locations = Locations::notDeleted()->get();

        $data = ['locations' => $locations];

        return View::make('cms.locations.index', $data);
    }


    public function create()
    {
        return View::make('cms.locations.create');
    }


    public function store()
    {
        try 
        {
            Locations::create([
                'name'   => Input::get('name'),
                'seats'  => Input::get('seats'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Location store] '.$e->getMessage());

            return Redirect::to("locations/create?error=参数有误!");
        }

        return Redirect::to("locations/create?success=创建成功");
    }


    public function edit($id)
    {
        $location = Locations::find($id);

        $data = ['location' => $location];

        return View::make('cms.locations.edit', $data);
    }


    public function update($id)
    {
        try 
        {
            Locations::where('id', $id)->update([
                'name'  => Input::get('name'),
                'seats' => Input::get('seats'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Location update] '.$e->getMessage());

            return Redirect::to("locations/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("locations/{$id}/edit?success=编辑成功");
    }


    public function show($location_id)
    {
        $data = [];

        $locations_rent = LocationsRent::where('location_id', $location_id)->where('start_date', '>=', date('Y-m-d'))->approved()->orderBy('start_date')->orderBy('start_time')->get();

        $location = Locations::find($location_id);
        
        $data['records']  = $locations_rent;
        $data['location'] = $location;

        return View::make('cms.locations.show', $data);
    }


    public function searchForm()
    {
        $locations = Locations::notDeleted()->lists('name', 'id');

        $data = [];

        $data['locations'] = $locations;
        $data['records']   = [];

        return View::make('cms.locations.search', $data);
    }


    public function search()
    {
        $locations = Locations::notDeleted()->lists('name', 'id');
     
        $data = [];

        $query = LocationsRent::join('locations', 'locations_rent.location_id', '=', 'locations.id')->select('locations_rent.*', 'locations.name')->where('locations_rent.worker_id', Input::get('worker_id'));

        if (Input::get('start_date')) $query->where('locations_rent.start_date', Input::get('start_date'));

        if (Input::get('location_id')) $query->where('locations.id', Input::get('location_id'));

        $records = $query->get();

        $data['locations'] = $locations;
        $data['records']   = $records;

        return View::make('cms.locations.search', $data);
    }


    public function audit()
    {
        $data = [];

        $records = LocationsRent::join('locations', 'locations_rent.location_id', '=', 'locations.id')->where('locations_rent.status', 'auditing')->select('locations_rent.*', 'locations.name')->orderBy('locations_rent.start_date')->orderBy('locations_rent.start_time')->get();

        $data['records'] = $records;

        return View::make('cms.locations.audit', $data);
    }


    public function approve($id)
    {
        LocationsRent::where('id', $id)->update(['status' => 'approved']);

        return Redirect::to("locations_rent/audit?success=审核通过");
    }


    public function disapprove($id)
    {
        LocationsRent::where('id', $id)->update(['status' => 'disapproved']);

        return Redirect::to("locations_rent/audit?success=审核不通过！");
    }




    public function rent($location_id)
    {
        try 
        {
            LocationsRent::create([
                'location_id' => $location_id, 
                'worker_id'   => Input::get('worker_id'),
                'start_date'  => Input::get('start_date'),
                'start_time'  => Input::get('start_time'),
                'end_time'    => Input::get('end_time'),
                'attendees'   => (int)Input::get('attendees'),
                'department'  => Input::get('department'),
                'renter'      => Input::get('renter'),
                'event'       => Input::get('event'),
                'comment'     => Input::get('comment'),
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Location Rent] '.$e->getMessage());

            return Redirect::to("locations/{$location_id}?error=参数有误!");
        }

        // return Redirect::to('locations/'.Input::get('location_id'));
        return Redirect::to("locations/{$location_id}?success=请求已提交，等待审核中");
    }


    public function destroy($id)
    {
        Locations::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
