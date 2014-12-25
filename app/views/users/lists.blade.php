@extends('layout')

@section('content')
<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#myModal">Create User</button>
<table class="table">
    <caption>test case</caption>
    <thead>
        <tr>
            <th>id</th>
            <th>email</th>
            <th>username</th>
            <th>activated</th>
            <th>last_login</th>
            <th>created_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user['id'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['first_name'] }}</td>
            <td>{{ $user['activated'] }}</td>
            <td>{{ $user['last_login'] }}</td>
            <td>{{ $user['created_at'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
    aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" 
                    data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add User
                </h4>
            </div>
            <div class="modal-body">
                
                <form class="form-horizontal" role="form" action="{{ URL::route('users.add') }}" method="POST">
                   <div class="form-group">
                      <label for="username" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" id="username" name="username"
                            placeholder="Username">
                      </div>
                   </div>
                   <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" id="email" name="email"
                            placeholder="请输入邮箱">
                      </div>
                   </div>
                   <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                         <input type="password" class="form-control" id="password" name="password"
                            placeholder="请输入密码">
                      </div>
                   </div>
                   <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                         <button type="submit" class="btn btn-default">Add</button>
                      </div>
                   </div>
                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                   data-dismiss="modal">Close
                </button>
            </div>
      </div><!-- /.modal-content -->
</div>
<script type="text/javascript" src="<?= asset('assets/bower/bootstrapvalidator/dist/js/bootstrapValidator.min.js') ?>" charset="UTF-8"></script>
<script src="<?= asset('assets/bower/bootstrapvalidator/dist/js/language/zh_CN.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
</script>

@stop