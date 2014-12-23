<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//		Eloquent::unguard();

		// $this->call('UserTableSeeder');

        $user = Sentry::register([
            'password'  => 'bili.bili',
            'email'     => 'admin@ltbl.cn',
            'first_name' => 'admin',
            'last_name'  =>  '管理员',
            'activated' => 1
        ]);

        // group
        $group = Sentry::createGroup([
            'name'        => '管理员',
            'permissions' => [
                'users.index' => 1,
                'users.create' => 1,
                'users.edit' => 1,
                'users.delete' => 1,
                'roles.index' => 1,
                'roles.create' => 1,
                'roles.edit' => 1,
                'roles.delete' => 1
            ],
        ]);

        // add to group
        $user->addGroup($group);
	}

}
