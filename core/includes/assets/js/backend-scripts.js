/*------------------------ 
Backend related javascript
------------------------*/

jQuery(document).on("click", ".users-edit", function () {
  jQuery(".loading").removeClass("d-none");

  var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {
    keyboard: false
  });

  // var user_id = jQuery(this).data( "user-id" );

  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "jira_user_popup"
    },
    success: function (data) {
      jQuery("#userModal").html(data);
      jQuery(".loading").addClass("d-none");
      myModal.toggle();
    }
  });
});
