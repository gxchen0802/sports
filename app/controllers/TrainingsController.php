<?php

class TrainingsController extends Controller {

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->beforeFilter('worker');
        // $this->beforeFilter('admin', ['only' => ['store', 'update']]);
    }


    public function index()
    {
        $trainings = Trainings::notDeleted()->notOver()->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $trainings->getLastPage();

        $total_count = $trainings->getTotal();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $trainings->getFrom();

        $end_index = $trainings->getTo();

        $data = [
            'trainings'     => $trainings,
            'total_pages'   => $total_pages,
            'total_count'   => $total_count,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];

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
                'time'       => date('H:i:s', strtotime(Input::get('date'))),
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
                'time'       => date('H:i:s', strtotime(Input::get('date'))),
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
        $worker_id = Session::get('user_name');

        $training = Trainings::findOrFail($id);

        $history = TrainingsAttendees::where('training_id', $id)->where('worker_id', $worker_id)->first();

        $data = ['training' => $training, 'history' => $history];

        return View::make('cms.trainings.show', $data); // return View('pages.about');
    }

    public function destroy($id)
    {
        Trainings::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
