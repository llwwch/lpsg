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

        $groupModel = new  Group;
        $users = $groupModel->addGroupName($users);

        var_dump($users);
        var_dump($roles);
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
    
}