<!DOCTYPE html>
<html>
    <body>
        <pre><?php print_r($output_code); ?></pre>
        <ul>
            <?php foreach ($links as $link): ?>
            <li><a href="<?php echo $link[1]; ?>"><?php echo $link[0]; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>