<?php

?>
<script type="text/javascript">
  // Wait till the document has loaded
  $(function() {
    // For all anchors inside our table cells, add an onclick event
    $('#calendar td a').click(
      function (event) { 
        // Stop the link from triggering
        event.preventDefault();
        // Stop the body click from triggering
        event.stopPropagation();
        
        // Remove existing tooltips:
        $('#calendar td div').remove();
        
        // Create a simple container for our data
        var tooltip = $('<div/>').css("position", "absolute").addClass('tooltip');

        // Perform the AJAX request to the anchors link
        $.AJAX({
          url: this.href,
          success: function(data) {
            // On success, add the data inside our tooltip
            tooltip.append("<p><b>Event:</b> " + data.title + "<br /> <b>Date:</b> " +data.date+ "</p>");

            // Add the tooltip to the table cell
            this.parent().append(tooltip);
          }
        });
      }
    );
    
    // Add an onclick to the body to remove existing tooltips so the user can move on by clicking anywhere
    $('body').click(function() {
      $('#calendar td div').remove();
    });
  });
</script>