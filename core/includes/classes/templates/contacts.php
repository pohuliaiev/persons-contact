<div class="loading d-none"></div>
<?php global $wpdb; 
$id = $_GET['user'];
$users = $wpdb->get_results( "SELECT * FROM `demo_plugin_users`
WHERE demo_id = '$id';");?>
<h1 class="text-center">Contacts of the user <?php echo $users[0]->demo_name;?></h1>
<button class="btn btn-primary adding-contact" data-user="<?php echo $id;?>">Add New Contact</button>
<?php global $wpdb; 
$users = $wpdb->get_results( "SELECT * FROM `demo_plugin_users`
WHERE user_show = 1;");
$contacts = $wpdb->get_results( "SELECT * FROM `demo_contacts`
WHERE holder_id = '$id'
AND user_show = 1;");?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Contry Code</th>
      <th scope="col">Number</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody id="tbody">
    <?php foreach($contacts as $contact){?>
    <tr id="<?php echo $contact->contact_id;?>">
      <th scope="row"><?php echo $contact->contact_id;?></th>
      <td class="counrty_code"><?php echo $contact->country_code;?></td>
      <td class="number"><?php echo $contact->contact_number;?></td>
      <td><button class="btn btn-primary contact-edit" data-contact="<?php echo $contact->contact_id;?>"
          data-country="<?php echo $contact->country_code;?>" data-number="<?php echo $contact->contact_number;?>">Edit
          contact</button></td>
      <td><button class="btn btn-danger contact-delete"
          data-contact="<?php echo $contact->contact_id;?>">Delete</button></td>
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