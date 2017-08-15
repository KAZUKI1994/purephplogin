{block name='meta'}
    <title>ログイン</title>
    <style type="text/css">
        .login-box, .register-box{
            margin: 20px auto;
        }
    </style>
{/block}
{block name='content'}
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>Admin</b></a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">サインインしてセッションを開始する</p>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="email" class="form-control"  placeholder="メールアドレス">
                    <span class="glyphicon glyphicon-envelope form-controll-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control"  placeholder="パスワード">
                    <span class="glyphicon glyphicon-lock form-controll-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-5 col-xs-offset-7">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            サインイン
                        </button>
                    </div>
                </div>
            </form>
            <a href="remind.php">パスワードを忘れましたか？</a>
        </div>
        <!-- /.Login-box-body -->
    </div>
    <!-- /.Login-box -->
{/block}
{block name="script"}
{/block}
