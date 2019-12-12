<div class="index-auth">
    <form action="/?login = 'yes'" method="POST">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="iat">
                    <?php if (!isset($_COOKIE['login'])) : ?>
                        <label for="login_id">Ваш email:</label>
                        <input id="login_id" size="30" name="login" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>">
                    <?php endif ?>

                </td>
            </tr>
            <tr>
                <td class="iat">
                    <label for="password_id">Ваш пароль:</label>
                    <input id="password_id" size="30" name="password" type="password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Войти" name="send"></td>
            </tr>
        </table>
    </form>
</div>
