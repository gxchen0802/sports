<?php

class NewsController extends Controller {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => []]);   
    }


    public function index()
    {
        $data = ['news' => News::notDeleted()->get()];

        return View::make('cms.news.index', $data); // return View('pages.about');
    }


    public function show($id)
    {
        $record = News::findOrFail($id);

        $data = ['record' => $record];

        return View::make('cms.news.show', $data); // return View('pages.about');
    }


    public function create()
    {
        return View::make('cms.news.create');
    }

    public function store()
    {
        // try 
        // {
            News::create([
                'title'      => Input::get('title'),
                'content'    => Input::get('content'),
                'date'       => date('Y-m-d', strtotime(Input::get('date'))),
                'author'    => Input::get('author'),
                'document'   => Input::get('document'),
                ]);
        // } 
        // catch (Exception $e) 
        // {
        //     Log::error('[Create News] '.$e->getMessage());

        //     return Redirect::to("cms/news/create?error=参数有误!");
        // }

        return Redirect::to("cms/news/create?success=创建成功");
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




    public function destroy($id)
    {
        News::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
