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

jQuery(document).on("click", ".user-delete", function () {
  jQuery(".loading").removeClass("d-none");

  var id = jQuery(this).data("user");
  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "delete_user_func",
      id: id
    },
    success: function (data) {
      jQuery("tr#" + id).remove();
      jQuery(".loading").addClass("d-none");
    }
  });
});

jQuery(document).on("click", ".adding-contact", function () {
  jQuery(".loading").removeClass("d-none");

  var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {
    keyboard: false
  });
  /*
  var user_name = jQuery("#new_name_val").val();
  var email = jQuery("#email_val").val();
*/
  var user_id = jQuery(this).data("user");
  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "add_contact_popup",
      user_id: user_id
    },
    success: function (data) {
      jQuery("#exampleModal").html(data);
      jQuery(".loading").addClass("d-none");
      myModal.toggle();
    }
  });
});

jQuery(document).on("click", "#add-contact-to-db", function () {
  jQuery(".loading").removeClass("d-none");
  jQuery("#exampleModal").hide();
  jQuery("body").removeAttr("style");
  jQuery("body").removeClass("modal-open");
  jQuery(".modal-backdrop").remove();

  var code = jQuery("#code").val();
  var number = jQuery("#tel").val();
  let user_id = jQuery(this).data("user");
  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "add_contact_func",
      code: code,
      number: number,
      user_id: user_id
    },
    success: function (data) {
      jQuery("#tbody").append(data);
      jQuery(".loading").addClass("d-none");
    }
  });
});

jQuery(document).on("click", ".contact-delete", function () {
  jQuery(".loading").removeClass("d-none");

  var id = jQuery(this).data("contact");
  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: {
      action: "delete_contact_func",
      id: id
    },
    success: function (data) {
      jQuery("tr#" + id).remove();
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
