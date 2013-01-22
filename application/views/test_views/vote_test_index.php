<!DOCTYPE html>
<html>
    <body>
        <div>
            <form method="post" action="<?php echo site_url('vote/vote'); ?>">
                <select name="cakahim">
                    <option value="null">SELECT CAKAHIM</option>
                    <?php foreach ($cakahim_all as $c): ?>
                        <option value="<?php echo $c->id_cakahim; ?>"><?php echo $c->nama_cakahim; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="casenat">
                    <option value="null">SELECT CASENAT</option>
                    <?php foreach ($casenat_all as $c): ?>
                        <option value="<?php echo $c->id_casenat; ?>"><?php echo $c->nama_casenat; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Vote</button>
            </form>
        </div>

        <div style="font-size: 70%">
            <h2>Debug</h2>
            <div>Pemilih:</div>
            <pre><?php print_r($pemilih); ?></pre>
            
            <div>Cakahim:</div>
            <pre><?php print_r($cakahim_all); ?></pre>
            
            <div>Casenat:</div>
            <pre><?php print_r($casenat_all); ?></pre>
        </div>
    </body>
</html>
