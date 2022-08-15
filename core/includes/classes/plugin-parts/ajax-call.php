<?php
function add_user_popup(){
   // global $post;
  //  $user_id = $_POST['user_id'] ? $_POST['user_id'] : ''; ?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add user</h5>
      <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="mb-3">
          <label for="new_name_val" class="form-label">Name</label>
          <input type="text" class="form-control new_val" id="new_name_val" aria-describedby="new_name_desc">
          <div id="new_name_desc" class="form-text">5 symbols minimum</div>
        </div>
        <div class="mb-3">
          <label for="email_val" class="form-label">Email</label>
          <input type="email" class="form-control new_val" id="email_val" aria-describedby="email_desc">
          <div id="email_desc" class="form-text">Please enter a valid email</div>
        </div>

      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary disabled" id="add-user-to-db">Add user</button>
    </div>
  </div>
</div>
<script>
jQuery('.new_val').blur(function() {
  if (!jQuery(this).val()) {
    jQuery("#add-user-to-db").addClass('disabled');
  }
});
jQuery(".close").on('click', function() {

  jQuery('.modal-backdrop').remove();

});
jQuery("#new_name_val,#email_val").on('change', function(e) {
  if (jQuery('#new_name_val').val().length > 4 && IsEmail(jQuery("#email_val").val())) {
    jQuery("#add-user-to-db").removeClass('disabled');
  }
});
</script>
<?php wp_die();
}
add_action('wp_ajax_add_user_popup', 'add_user_popup');
add_action('wp_ajax_nopriv_add_user_popup', 'add_user_popup');

function add_user_func(){
  global $wpdb;
  $name = $_POST['name'] ? $_POST['name'] : '';
  $email = $_POST['email'] ? $_POST['email'] : '';
 // adding_users_to_db($name, $email);?>
<tr>
  <th scope="row"><?php echo adding_users_to_db($name, $email);?></th>
  <td><?php echo $name?></td>
  <td><?php echo $email;?></td>
  <td><button class="btn btn-primary users-edit">Edit user</button></td>
  <td><button class="btn btn-primary">User's contacts</button></td>
  <td><button class="btn btn-danger">Delete</button></td>
</tr>

<?php wp_die();
}
add_action('wp_ajax_add_user_func', 'add_user_func');
add_action('wp_ajax_nopriv_add_user_func', 'add_user_func');

function delete_user_func(){
  global $wpdb;
  $id = $_POST['id'] ? $_POST['id'] : '';
  $wpdb->query("UPDATE demo_plugin_users
SET user_show = 0
WHERE demo_id = '$id';");
wp_die();
}
add_action('wp_ajax_delete_user_func', 'delete_user_func');
add_action('wp_ajax_nopriv_delete_user_func', 'delete_user_func');

function add_contact_popup(){
  // global $post;
   $user_id = $_POST['user_id'] ? $_POST['user_id'] : ''; ?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add user</h5>
      <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="mb-3">
          <label for="exampleDataList" class="form-label">Country</label>
          <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
          <datalist id="datalistOptions">
            <?php foreach(get_countries_data() as $item){?>
            <option value="<?php echo $item['country'].'('.$item['code'].')';?>"
              data-code="<?php echo $item['code'];?>">
              <?php }?>
          </datalist>
        </div>
        <div class="fields-row">
          <input type="text" class="form-control" id="code" placeholder="Country Code" disabled>
          <input type="number" class="form-control" id="tel" maxlength="9" placeholder="phone"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            disabled>
        </div>

      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="add-contact-to-db" disabled
        data-user="<?php echo $user_id;?>">Add contact</button>
    </div>
  </div>
</div>
<script>
jQuery("#exampleDataList").change(function() {
  let val = jQuery("#exampleDataList").val();
  let code = jQuery('#datalistOptions option').filter(function() {
    return this.value == val;
  }).data('code');
  jQuery('#code').val(code);
  if (jQuery('#code').val().length > 0) {
    jQuery('#tel').prop("disabled", false);
  }
});
jQuery("#tel").on('change', function(e) {
  if (jQuery(this).val().length > 8) {
    jQuery('#add-contact-to-db').prop("disabled", false);
  } else {
    jQuery('#add-contact-to-db').prop("disabled", true);
  }
});
</script>
<?php wp_die();
}
add_action('wp_ajax_add_contact_popup', 'add_contact_popup');
add_action('wp_ajax_nopriv_add_contact_popup', 'add_contact_popup');

function add_contact_func(){
  global $wpdb;
  $code = $_POST['code'] ? $_POST['code'] : '';
  $number = $_POST['number'] ? $_POST['number'] : '';
  $user_id = $_POST['user_id'] ? $_POST['user_id'] : '';
 // adding_users_to_db($name, $email);?>
<tr>
  <th scope="row"><?php echo adding_contacts_to_db($code, $number, $user_id);?></th>
  <td><?php echo $code?></td>
  <td><?php echo $number;?></td>
  <td><button class="btn btn-primary users-edit">Edit contact</button></td>
  <td><button class="btn btn-danger">Delete</button></td>
</tr>

<?php wp_die();
}
add_action('wp_ajax_add_contact_func', 'add_contact_func');
add_action('wp_ajax_nopriv_add_contact_func', 'add_contact_func');


function delete_contact_func(){
  global $wpdb;
  $id = $_POST['id'] ? $_POST['id'] : '';
  $wpdb->query("UPDATE demo_contacts
SET user_show = 0
WHERE contact_id = '$id';");
wp_die();
}
add_action('wp_ajax_delete_contact_func', 'delete_contact_func');
add_action('wp_ajax_nopriv_delete_contact_func', 'delete_contact_func');

function edit_contact_func(){
  $user_id = $_POST['user_id'] ? $_POST['user_id'] : ''; ?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Add user</h5>
      <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="mb-3">
          <label for="exampleDataList" class="form-label">Country</label>
          <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
          <datalist id="datalistOptions">
            <?php foreach(get_countries_data() as $item){?>
            <option value="<?php echo $item['country'].'('.$item['code'].')';?>"
              data-code="<?php echo $item['code'];?>">
              <?php }?>
          </datalist>
        </div>
        <div class="fields-row">
          <input type="text" class="form-control" id="code" placeholder="Country Code" disabled>
          <input type="number" class="form-control" id="tel" maxlength="9" placeholder="phone"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            disabled>
        </div>

      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" id="add-contact-to-db" disabled
        data-user="<?php echo $user_id;?>">Add contact</button>
    </div>
  </div>
</div>
<script>
jQuery("#exampleDataList").change(function() {
  let val = jQuery("#exampleDataList").val();
  let code = jQuery('#datalistOptions option').filter(function() {
    return this.value == val;
  }).data('code');
  jQuery('#code').val(code);
  if (jQuery('#code').val().length > 0) {
    jQuery('#tel').prop("disabled", false);
  }
});
jQuery("#tel").on('change', function(e) {
  if (jQuery(this).val().length > 8) {
    jQuery('#add-contact-to-db').prop("disabled", false);
  } else {
    jQuery('#add-contact-to-db').prop("disabled", true);
  }
});
</script>
<?php wp_die();
}
add_action('wp_ajax_edit_contact_func', 'edit_contact_func');
add_action('wp_ajax_nopriv_edit_contact_func', 'edit_contact_func');