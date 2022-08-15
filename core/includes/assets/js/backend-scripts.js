/*------------------------ 
Backend related javascript
------------------------*/

jQuery(document).on("click", ".adding-user", function () {
  jQuery(".loading").removeClass("d-none");

  var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {
    keyboard: false
  });
  /*
  var user_name = jQuery("#new_name_val").val();
  var email = jQuery("#email_val").val();
*/
  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "add_user_popup"
    },
    success: function (data) {
      jQuery("#exampleModal").html(data);
      jQuery(".loading").addClass("d-none");
      myModal.toggle();
    }
  });
});

jQuery(document).on("click", "#add-user-to-db", function () {
  jQuery(".loading").removeClass("d-none");
  jQuery("#exampleModal").hide();
  jQuery("body").removeAttr("style");
  jQuery("body").removeClass("modal-open");
  jQuery(".modal-backdrop").remove();

  var user_name = jQuery("#new_name_val").val();
  var email = jQuery("#email_val").val();
  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "add_user_func",
      name: user_name,
      email: email
    },
    success: function (data) {
      jQuery("#tbody").append(data);
      jQuery(".loading").addClass("d-none");
    }
  });
});

function IsEmail(email) {
  var regex =
    /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if (!regex.test(email)) {
    return false;
  } else {
    return true;
  }
}
