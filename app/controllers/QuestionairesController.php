<?php

class QuestionairesController extends BaseController {

    const PER_PAGE = 20;

    public function __construct()
    {
        $this->beforeFilter('admin');

        $this->beforeFilter('csrf', ['only' => ['store', 'update', 'vote']]);  
    }

    public function create()
    {
        return View::make('cms.questionaires.create');
    }

    public function store()
    {
        try 
        {
            $questionaire_id = Questionaires::insertGetId([
                'title'       => Input::get('name'),
                'start_time'  => Input::get('startTime'),
                'end_time'    => Input::get('endTime'),
                // 'type'        => Input::get('type'),
                'status'      => Input::get('status'),
                'description' => Input::get('remark'),
                ]);

            $questions = Input::get('itmes');

            foreach ($questions as $q) 
            {
                $question = $q['title'];  // string

                // Insert Questions:
                $question_id = Questions::insertGetId([
                        'questionaire_id' => $questionaire_id,
                        'question'        => $question,
                    ]);

                // Insert Answers:
                $rows = [];

                foreach ($q['option'] as $option) 
                {
                    $row = [];
                    $row['questionaire_id'] = $questionaire_id;
                    $row['question_id']     = $question_id;
                    $row['answer']          = $option['name'];

                    $rows[]= $row;                    
                }

                Answers::insert($rows);
            }
        } 
        catch (Exception $e) 
        {
            Log::error('[Create Questionaires] '.$e->getMessage());

            $error_response = [
                'code'    => 400,
                'message' => '创建失败',
                'result'  => $e->getMessage()
            ];

            return $error_response;
        }

        $response = [
            'code'    => 200,
            'message' => '创建成功',
            'result'  => 'success'
        ];

        return $response;
    }

    public function index()
    {
        $questionaires = Questionaires::notDeleted()->orderBy('created_at', 'desc')->paginate(self::PER_PAGE);

        $current_page = Input::get('page') ? (int)Input::get('page') : 1;

        $total_pages = $questionaires->getLastPage();

        $total_count = $questionaires->getTotal();

        $previous_page = ($current_page - 1 <= 0) ? 1 : ($current_page - 1);

        $next_page = ($current_page + 1 > $total_pages) ? $total_pages : ($current_page + 1);

        $start_index = $questionaires->getFrom();

        $end_index = $questionaires->getTo();

        $data = [
            'questionaires' => $questionaires,
            'total_pages'   => $total_pages,
            'total_count'   => $total_count,
            'start_index'   => $start_index,
            'end_index'     => $end_index,
            'current_page'  => $current_page,
            'previous_page' => $previous_page,
            'next_page'     => $next_page,
            ];

        return View::make('cms.questionaires.index', $data);
    }

    public function show($questionaire_id)
    {
        $data = [];

        $questionaire = Questionaires::where('id', $questionaire_id)->notExpire()->isActive()->notDeleted()->first();

        $vote_history = VoteHistory::where('questionaire_id', $questionaire_id)->where('ip', Request::ip())->first();

        $data['questionaire_expired'] = false;
        $data['already_voted']        = false;

        if ( ! $questionaire) 
        {
            $data['questionaire_expired'] = true;

            return View::make('pages.questionaires', $data);
        }
        elseif ($vote_history) 
        {
            $data['questionaire']  = $questionaire;
            $data['already_voted'] = true;

            return View::make('pages.questionaires', $data);
        }
        else
        {
            $data['questionaire'] = $questionaire;
        }

        if ($questionaire->type == 'multiple') 
        {
            $data['radio_checkbox'] = 'checkbox';
        }
        else 
        {
            $data['radio_checkbox'] = 'radio';
        }

        // Format the questions to be : 
        // 
        // ['question_id' => ['answer_id', 'answer', 'question'],
        //  ...
        // ]
        $quesitons = Questions::join('questionaires_answers', 'questionaires_questions.id', '=', 'questionaires_answers.question_id')
            ->select(
                'questionaires_questions.id as question_id', 
                'questionaires_questions.question as question', 
                'questionaires_answers.id as answer_id', 
                'questionaires_answers.answer')
            ->where('questionaires_questions.questionaire_id', $questionaire_id)->where('questionaires_questions.status', 'active')->get();

        $quesitons_array = [];

        foreach ($quesitons as $q) 
        {
            $a = ['answer_id' => $q->answer_id, 'answer' => $q->answer, 'question' => $q->question];

            $quesitons_array[$q->question_id][] = $a;
        }

        $data['questions'] = $quesitons_array;

        return View::make('pages.questionaires', $data);

    }

    public function vote($questionaire_id)
    {
        $rows = [];

        foreach (Input::all() as $key => $value) 
        {
            if ($key == '_token') continue;

            $row = [];
            $row['questionaire_id'] = $questionaire_id;
            $row['question_id']     = $key;
            $row['answer_id']       = $value;

            $rows[]= $row;
        }        

        try 
        {
            VoteHistory::create([
                'questionaire_id' => $questionaire_id,
                'ip' => Request::ip(),
                ]);

            Votes::insert($rows);
        } 
        catch (Exception $e) 
        {
            Log::error('[Questionaires Vote] '.$e->getMessage());

            return Redirect::to("/questionaires/{$questionaire_id}?result=error");
        }

        return Redirect::to("/questionaires/{$questionaire_id}?result=success");
    }

    public function stats($questionaire_id)
    {
        $questionaire = Questionaires::find($questionaire_id);

        $data['questionaire'] = $questionaire;

        $questions = Questions::where('questionaire_id', $questionaire_id)->notDeleted()->get();

        $data['questions'] = $questions;


        // Format the questions to be : 
        // 
        // ['question_id' => ['answer_id', 'answer', 'question'],
        //  ...
        // ]
        $lists = Questions::join('questionaires_answers', 'questionaires_questions.id', '=', 'questionaires_answers.question_id')
            ->select(
                'questionaires_questions.id as question_id', 
                'questionaires_questions.question as question', 
                'questionaires_answers.id as answer_id', 
                'questionaires_answers.answer')
            ->where('questionaires_questions.questionaire_id', $questionaire_id)->get();

        $lists_array = [];

        foreach ($lists as $q) 
        {
            $a = ['answer_id' => $q->answer_id, 'answer' => $q->answer, 'question' => $q->question];

            $lists_array[$q->question_id][] = $a;
        }

        $raw_data_votes = [];

        // 'question_id' => ['answer_id', 'answer', 'question']
        foreach ($lists_array as $question_id => $q_arr) 
        {
            $json = [];

            $total_count = 0;

            foreach ($q_arr as $a_arr) 
            {
                $answer_id = $a_arr['answer_id'];
                $answer    = $a_arr['answer'];
                $question  = $a_arr['question'];

                $count = Votes::where('questionaire_id', $questionaire_id)->where('question_id', $question_id)->where('answer_id', $answer_id)->count();

                $a_arr['count'] = $count;

                $json['options'][] = ['name' => $answer, 'count' => $count];

                $total_count += $count;
                // $raw_data_votes[$question_id][$answer_id] = $a_arr;
            }

            $json['total'] = $total_count;
            $json['title'] = $question;
            $json['id']    = $question_id;

            $jsons[] = $json;
        }


        $data['jsons'] = json_encode($jsons);

        return View::make('cms.questionaires.stats', $data);
    }


    public function edit($questionaire_id)
    {
        $questionaire = Questionaires::find($questionaire_id);

        $data['questionaire'] = $questionaire;


// {"id":"Aa001","title":"测试问题00001","options":[{"id":"a001","name":"aaaaaa"},{"id":"a003","name":"bbbbbb"},{"id":"a003","name":"ccccc"},{"id":"a004","name":"dddddd"},{"id":"a005","name":"eeeee"}]}
        $quesitons = Questions::where('questionaire_id', $questionaire_id)->notDeleted()->get();

        $items = [];

        foreach ($quesitons as $q) 
        {
            $item = [];

            $item['id']    = $q->id;
            $item['title'] = $q->question;

            // $a = ['answer_id' => $q->answer_id, 'answer' => $q->answer, 'question' => $q->question];

            $answers = Answers::where('question_id', $q->id)->get();

            $options = [];

            foreach ($answers as $a) 
            {
                $option = [];

                $option['id']   = $a->id;
                $option['name'] = $a->answer;

                $options[] = $option;
            }

            $item['options'] = $options;

            $items[] = $item;
        }

        $data['jsons'] = json_encode($items);

        return View::make('cms.questionaires.edit', $data);
    }

    public function update($questionaire_id)
    {
        try 
        {
            $questionaire_id = Questionaires::where('id', $questionaire_id)->update([
                'title'       => Input::get('name'),
                'start_time'  => Input::get('startTime'),
                'end_time'    => Input::get('endTime'),
                // 'type'        => Input::get('type'),
                'status'      => Input::get('status'),
                'description' => Input::get('remark'),
                ]);

            $questions = Input::get('itmes');

            foreach ($questions as $q) 
            {
                $action      = $q['state'];
                $question_id = $q['id'];  
                $question    = $q['title'];

                if ($action == 0)  // delete
                {
                    Questions::where('id', $question_id)->update(['status' => 'deleted']);

                    Answers::where('question_id', $question_id)->update(['status' => 'deleted']);
                }
                elseif ($action == 2)  // edit 
                {
                    Questions::where('id', $question_id)->update(['question' => $question]);

                    foreach ($q['option'] as $option) 
                    {
                        Answers::where('id', $option['id'])->update(['answer' => $option['name']]);
                    }
                }
                else // $action == 1 : create
                {
                    // Insert Questions:
                    $question_id = Questions::insertGetId([
                            'questionaire_id' => $questionaire_id,
                            'question'        => $question,
                        ]);

                    // Insert Answers:
                    $rows = [];

                    foreach ($q['option'] as $option) 
                    {
                        $row = [];
                        $row['questionaire_id'] = $questionaire_id;
                        $row['question_id']     = $question_id;
                        $row['answer']          = $option['name'];

                        $rows[]= $row;                    
                    }

                    Answers::insert($rows);
                }
            }
        } 
        catch (Exception $e) 
        {
            Log::error('[Update Questionaires] '.$e->getMessage());

            $error_response = [
                'code'    => 400,
                'message' => '创建失败',
                'result'  => $e->getMessage()
            ];

            return $error_response;
        }

        $response = [
            'code'    => 200,
            'message' => '创建成功',
            'result'  => 'success'
        ];

        return $response;
    }

    public function destroy($id)
    {
        Questionaires::where('id', $id)->update(['status' => 'deleted']);

        return Redirect::back()->with('message', '删除成功');
    }
}
