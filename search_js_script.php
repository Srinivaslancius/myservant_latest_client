
 <!-- Auto complete home page search -->           
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>    
 <!-- Auto complete home page search -->           
<script type="text/javascript">
$(document).ready(function() {
    
    //autocomplete
    $(".auto").autocomplete({
        source: function(request, response) {
        $.ajax({
          url: "get_product_names.php",
          dataType: "json",
          data: request,                    
          success: function (data) {
            // No matching result
            if (!data || data.length == 0) {
              response([{ label: 'No results found.', val: -1}]);
            }
            else {
              response(data);
            }
          }});
        },
        // source: "get_product_names.php",
        minLength: 2,
        select: function(event, ui) {
            $('#search_form').submit();
        }
    });
});
</script>
    <!-- End home page search -->