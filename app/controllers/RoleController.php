<?php

class RoleController extends \BaseController
{
    
    public function index()
    {
        $groupModel = new Group();
        $groups = $groupModel->lists(Input::all())
                            ->paginate(20)
                            ->toArray();

        $departments = Config::get(department);

        var_dump($groups);
    }

    public function create()
    {
        $departments = Config::get('department');
        $permissions = Config::get('permissions');

        var_dump($permissions);
    }

    public function store()
    {
        $groupModel = new Group();
        if($groupModel->store(Input::all())) {
            return Redirect::route('roles.index');
        } else {
            return Redirect::back();
        }
    }

    public function edit($id)
    {
        $group = Group::find($id);

        $departments = Config::get('department');
        $permissions = Config::get('permissions');

        //
    }

    public function update($id)
    {
        $permissions = [];
        foreach(Input::get('permissions', []) as $permission) {
            $permissions[$permission] = 1;
        }

        $data = [
            'name' => Input::get('name'),
            'department' => Input::get('department'),
            'permissions' => json_encode($permissions);
        ];

        if(! $group = Group::find($id)) {
            Session::flash('tips', ['success' => false, 'message' => "{$id} not exist"]);
        } elseif ($group->update($data)) {
            Session::flash('tips', ['success' => true, 'message' => "{$id} success"]);

            //add log

        } else {
            Session::flash('tips', ['success' => false, 'message' => "{$id} failure"]);
            return Redirect::back();
        }

        return Redirect::route('roles.index');
    }

    public function destroy($id)
    {
        try {
            $group = Sentry::findGroupById($id);
            $group->delete();
        }
    }
}