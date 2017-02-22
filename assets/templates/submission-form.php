<?php
if( ! defined( 'ABSPATH' ) ){
  exit;
}
?>
<div class="pw-crm-wrap">
  <form action="post" id="crm-form" >

    <input type="hidden" name="action" value="crm_send" />

    <div>
      <label><?php echo $name; ?></label>
      <input type="text" name="name" maxlength="<?php echo $name_max_length; ?>" required/>
    </div>

    <div>
      <label><?php echo $phone_number; ?></label>
      <input type="tel" name="phone" pattern="^[0-9\-\+\s\(\)]*$" maxlength="<?php echo $phone_max_length; ?>" required/>
    </div>

    <div>
      <label><?php echo $email; ?></label>
      <input type="email" name="email" maxlength="<?php echo $email_max_length; ?>" required/>
    </div>

    <div>
      <label><?php echo $budget; ?></label>
      <input type="number" name="budget" min="-1010100" max="<?php echo $budget_max; ?>" required/>
    </div>

    <div class="pw-row">
      <label><?php echo $message; ?></label>
      <textarea class="pw-textarea" name="message" cols="<?php echo $message_width; ?>" rows="<?php echo $message_height; ?>" required></textarea>
    </div>

    <div>
      <input type="submit" value="Submit" />
    </div>
  </form>
</div><!---.pw-crm_wrap->
