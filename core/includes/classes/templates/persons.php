<div class="loading d-none"></div>
<h1 class="text-center">Persons admin page</h1>
<button class="btn btn-primary adding-user">Add User</button>
<?php global $wpdb; 
$users = $wpdb->get_results( "SELECT * FROM `demo_plugin_users`
WHERE user_show = 1;");?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Edit user</th>
      <th scope="col">See contacts</th>
      <th scope="col">Delete user</th>
    </tr>
  </thead>
  <tbody id="tbody">
    <?php foreach($users as $user){?>
    <tr id="<?php echo $user->demo_id;?>">
      <th scope="row"><?php echo $user->demo_id;?></th>
      <td class="name"><?php echo $user->demo_name;?></td>
      <td class="email"><?php echo $user->user_email;?></td>
      <td><button class="btn btn-primary users-edit" data-user="<?php echo $user->demo_id;?>">Edit user</button></td>
      <td><a href="admin.php?page=persons-contact-page&user=<?php echo $user->demo_id;?>" class="btn btn-primary"
          target="_blank">User's contacts</a></td>
      <td><button class="btn btn-danger user-delete" data-user="<?php echo $user->demo_id;?>">Delete</button></td>
    </tr>
    <?php }?>
  </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>