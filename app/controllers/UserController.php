<?php

class UserController extends \BaseController
{

    private $pageSize = 20;

    public function index()
    {
        $userModel = new User();
        $users = $userModel->lists(Input::all())
                            ->paginate($this->pageSize)
                            ->toArray();

        $roles = Group::all();

        // $groupModel = new  Group;
        // $users = $groupModel->addGroupName($users);

        // var_dump($users);
        // var_dump($roles);
        return View::make('users.lists', ['users'=>$users['data']]);
    }

    public function create()
    {
        // $roles = Group::all();
        return View::make('users.create');
    }

    public function store()
    {
        $validator = Validator::make(['email' => Input::get('email')], ['email' => 'unique:users']);

        if($validator->fails()) {
            Session::flash('tips', ['success' => false, 'message' => "email error!"]);
        } else {
            $userModel = new User;
            $userModel->store(Input::all());
        }

        return Redirect::route('users');
    }

    public function add()
    {
        $validator = Validator::make(
            ['email' => Input::get('email'), 'first_name' => Input::get('username')],
            ['email' => 'unique:users', 'first_name' => 'unique:users']
        );

        if($validator->fails()) {
            Session::flash('tips', ['success' => false, 'message' => "email error!"]);
        } else {
            $data = Input::all();
            $data['last_name'] = 'test';
            $data['activated'] = 1;
            $userModel = new User;
            $userModel->store($data);
        }

        return Redirect::route('users');
    }

    public function emailValidate()
    {
        $validator = Validator::make(
            ['email' => Input::get('email')], ['email' => 'unique:users']
        );

        return json_encode([
            'valid' => (!$validator->fails())
        ]);
    }

    public function usernameValidate()
    {
        $validator = Validator::make(
            ['first_name' => Input::get('username')], ['first_name' => 'unique:users']
        );

        return json_encode([
            'valid' => (!$validator->fails())
        ]);
    }
    
    public function test()
    {
        return "test";
    }
}