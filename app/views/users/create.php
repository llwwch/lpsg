<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <div>
        <form action="<?= URL::route('users.store') ?>" method="post">
            <labal>username</label><input name="username" />
            <labal>realname</label><input name="realname" />
            <labal>email</label><input name="email" />
            <labal>password</label><input type="password" name="password" />
            <input type="hidden" name="activated" value="1" />
            <input type="submit" value="submit" />
        </form>
    </div>
</body>
</html>