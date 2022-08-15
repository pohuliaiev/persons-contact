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