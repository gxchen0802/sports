<?php

class TrainingsController extends Controller {

    // protected $layout = 'layouts.default';

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => []]);   
    }


    public function index()
    {
        $data = ['trainings' => Trainings::notDeleted()->get()];

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
                'date'       => date('Y-m-d H:i:s', strtotime(Input::get('date'))),
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


    public function update()
    {
        Trainings::where('id', 2)->update(['title' => 'test title 2']);
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
