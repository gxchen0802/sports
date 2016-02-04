<?php

class TrainingsController extends Controller {

    // protected $layout = 'layouts.default';

    public function __construct()
    {
        $this->beforeFilter('worker');
        // $this->beforeFilter('admin', ['only' => ['store', 'update']]);
    }


    public function index()
    {
        $data = ['trainings' => Trainings::notDeleted()->notOver()->get()];

        return View::make('cms.trainings.index', $data); // return View('pages.about');
    }

    public function create()
    {
        // $data = ['trainings' => Trainings::notDeleted()->get()];

        return View::make('cms.trainings.create');
    }

    public function store()
    {
        try 
        {
            Trainings::create([
                'title'      => Input::get('title'),
                'content'    => Input::get('content'),
                'date'       => date('Y-m-d', strtotime(Input::get('date'))),
                'time'       => date('H:i:s', strtotime(Input::get('time'))),
                'speaker'    => Input::get('speaker'),
                'location'   => Input::get('location'),
                'seats'      => Input::get('seats'),
                'seats_left' => Input::get('seats'),
                'score'      => Input::get('score')
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Trainings] '.$e->getMessage());

            return Redirect::to("trainings/create?error=参数有误!");
        }

        return Redirect::to("trainings/create?success=创建成功");
    }


    public function edit($id)
    {
        $training = Trainings::find($id);

        $data = ['training' => $training];

        return View::make('cms.trainings.edit', $data);
    }

    public function update($id)
    {
        try 
        {
            Trainings::where('id', $id)->update([
                'title'      => Input::get('title'),
                'content'    => Input::get('content'),
                'date'       => date('Y-m-d', strtotime(Input::get('date'))),
                'time'       => date('H:i:s', strtotime(Input::get('time'))),
                'speaker'    => Input::get('speaker'),
                'location'   => Input::get('location'),
                'seats'      => Input::get('seats'),
                'seats_left' => Input::get('seats'),
                'score'      => Input::get('score')
                ]);
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Trainings] '.$e->getMessage());

            return Redirect::to("trainings/{$id}/edit?error=参数有误!");
        }

        return Redirect::to("trainings/{$id}/edit?success=创建成功");
    }


    public function show($id)
    {
        $training = Trainings::findOrFail($id);

        $data = ['training' => $training];

        return View::make('cms.trainings.show', $data); // return View('pages.about');
        
        // $this->layout->content = View::make('pages.about');
        // echo $id;
    }

    public function destroy($id)
    {
        Trainings::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
