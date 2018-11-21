<?php
namespace hibpwp\view\admin;

use hibpwp\controller\adapter\Hibpwp_Adapter;

$hibpwp_adapter = new Hibpwp_Adapter();
?>
<div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h1>Have I Been Pwned Settings</h1>
    <form method="post" action="options.php">
            <?php
            settings_fields("hibpwp_options");

            do_settings_sections("hibpwp_options");

            submit_button();
            ?>
    </form>
    <p><a href="<?php echo admin_url('options-general.php?page=hibpwp_log') ?>">View log</a></p>
</div>