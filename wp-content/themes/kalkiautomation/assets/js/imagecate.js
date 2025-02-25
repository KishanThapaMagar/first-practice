jQuery(document).ready(function ($) {
  // Event listener for the image upload button
  $(".z_upload_image_button").on("click", function (event) {
    event.preventDefault();

    let button = $(this);

    // Open WordPress media uploader
    let frame = wp.media({
      title: "Select Image",
      button: {
        text: "Use this image",
      },
      multiple: false,
    });

    // When an image is selected, update the input fields
    frame.on("select", function () {
      var attachment = frame.state().get("selection").first();
      var attachmentUrl = attachment.attributes.url;
      var attachmentId = attachment.attributes.id;

      // Update input fields and preview
      button
        .closest("td, .form-field")
        .find("#zci_taxonomy_image")
        .val(attachmentUrl);
      button
        .closest("td, .form-field")
        .find("#zci_taxonomy_image_id")
        .val(attachmentId);
      button
        .closest("td, .form-field")
        .find(".zci-taxonomy-image")
        .attr("src", attachmentUrl)
        .show();
    });

    // Open the media frame
    frame.open();
  });

  // Event listener for removing the image
  $(".z_remove_image_button").on("click", function (event) {
    event.preventDefault();

    let button = $(this);
    button
      .closest("td, .form-field")
      .find(".zci-taxonomy-image")
      .attr("src", "")
      .hide();
    button.closest("td, .form-field").find("#zci_taxonomy_image").val("");
    button.closest("td, .form-field").find("#zci_taxonomy_image_id").val("");
  });
});
