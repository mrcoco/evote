<!DOCTYPE html>
<html>
    <body>
        <?php if (!$signed_in): ?>
            <?php if ($signin_fail): ?><h3>Sign In failed!</h3><?php endif; ?>
            <form method="post" action="<?php echo site_url('/auth_test/signin'); ?>">
                <input type="text" name="NIM" placeholder="NIM" />
                <input type="text" name="password" placeholder="Password" />
                <button type="submit">Sign In</button> 
            </form>
        <?php else: ?>
            <div>You're signed in! Click <a href="<?php echo site_url('/auth_test/logout'); ?>">here</a> to sign out.</div>
            <div><a href="<?php echo site_url('/vote'); ?>">Click here to vote.</a></div>
            <pre><?php echo $pemilih['NIM'] . "\n" . $pemilih['has_vote'] ?></pre>
        <?php endif; ?>
    </body>
</html>
