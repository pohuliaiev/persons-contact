<?php
function jira_user_popup(){
   // global $post;
  //  $user_id = $_POST['user_id'] ? $_POST['user_id'] : ''; ?>
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">User title</h5>
      <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <form>
        <div class="mb-3">
          <label for="booked_plus" class="form-label">Change Time In Minutes</label>
          <input type="number" class="form-control" id="booked_plus" aria-describedby="add_time">
          <div id="add_time" class="form-text">Change user's booked time </div>
        </div>
        <div class="mb-3">
          <label for="message_time" class="form-label">Notes</label>
          <textarea class="form-control" id="message_time" rows="3"></textarea>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary update-user-time" data-user-id="1">Save changes</button>
    </div>
  </div>
</div>
<script>
jQuery(".close").on('click', function() {

  jQuery('.modal-backdrop').remove();

});
jQuery("#booked_plus").on('change', function(e) {
  jQuery("#billable_plus").prop('disabled', jQuery(this).val().length > 0);
});
jQuery("#billable_plus").on('change', function(e) {
  jQuery("#booked_plus").prop('disabled', jQuery(this).val().length > 0);
});
</script>
<?php wp_die();
}
add_action('wp_ajax_jira_user_popup', 'jira_user_popup');
add_action('wp_ajax_nopriv_jira_user_popup', 'jira_user_popup');