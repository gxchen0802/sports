<?php

class CategoriesController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => ['storeParent', 'storeChild']]);   
    }


    public function index()
    {
        $data = ['categories' => Categories::notDeleted()->get()];

        return View::make('cms.categories.index', $data);
    }


    // public function show($id)
    // {
    //     $record = News::findOrFail($id);

    //     $data = ['record' => $record];

    //     return View::make('cms.news.show', $data); // return View('pages.about');
    // }


    public function createParent()
    {
        return View::make('cms.categories.createParent');
    }

    public function createChild()
    {
        $data['records'] = Categories::distinct('parent')->notDeleted()->get();

        return View::make('cms.categories.createChild', $data);
    }

    public function storeParent()
    {
        Categories::create([
            'parent' => Input::get('parent'),
            ]);

        return Redirect::to("cms/1st_categories/create?success=创建成功");
    }

    public function storeChild()
    {
        Categories::create([
            'parent' => Input::get('parent'),
            'child'  => Input::get('child'),
            ]);

        return Redirect::to("cms/1st_categories/create?success=创建成功");
    }


    // public function edit($id)
    // {
    //     $training = Trainings::find($id);

    //     $data = ['training' => $training];

    //     return View::make('cms.trainings.edit', $data);
    // }

    // public function update($id)
    // {
    //     try 
    //     {
    //         Trainings::where('id', $id)->update([
    //             'title'      => Input::get('title'),
    //             'content'    => Input::get('content'),
    //             'date'       => date('Y-m-d', strtotime(Input::get('date'))),
    //             'time'       => date('H:i:s', strtotime(Input::get('time'))),
    //             'speaker'    => Input::get('speaker'),
    //             'location'   => Input::get('location'),
    //             'seats'      => Input::get('seats'),
    //             'seats_left' => Input::get('seats'),
    //             'score'      => Input::get('score')
    //             ]);
    //     } 
    //     catch (Exception $e) 
    //     {
    //         Log::error('[Create Trainings] '.$e->getMessage());

    //         return Redirect::to("trainings/{$id}/edit?error=参数有误!");
    //     }

    //     return Redirect::to("trainings/{$id}/edit?success=创建成功");
    // }


    // public function destroy($id)
    // {
    //     News::where('id', $id)->update(['status' => 'deleted']);

    //     return Redirect::back()->with('message', '删除成功');
    // }
}
