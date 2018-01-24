    <div class="site-footer"> Design & Developed By Lancius IT Solutions</div> 
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/index.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Script for dropdown with Search -->
    <script src="js/forms-plugins.min.js"></script>
    <script>
      $( function() {
        $( "#deal_start_date,#deal_end_date,#last_login_visit" ).datepicker();
      } );
    </script>
    <script>
    	function isNumberKey(evt){
  	    var charCode = (evt.which) ? evt.which : event.keyCode
  	    if (charCode > 31 && (charCode < 48 || charCode > 57))
  	        return false;
  	    return true;
    	}
	  </script>
    <script type="text/javascript">
      //$(document).ready(function(){
          $(".click_view").click(function(){
              var modalId = $(this).attr('data-modalId');
              $("#myModal_"+modalId).modal('show');  
          });
      //});
    </script>
	  <script>
      var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        
      };
      var loadFile1 = function(event) {
        var output1 = document.getElementById('output1');
        output1.src = URL.createObjectURL(event.target.files[0]);
      };

      //check status active or not
        $(".check_active").click(function(){
          var check_active_id = $(this).attr("data-incId");
          var table_name = $(this).attr("data-tbname");
          var current_status = $(this).attr("data-status");
          if(current_status == 0) {
            send_status = 1;
          } else {
            send_status = 0;
          }
          $.ajax({
            type:"post",
            url:"changestatus.php",
            data:"check_active_id="+check_active_id+"&table_name="+table_name+"&send_status="+send_status,
            success:function(result){  
              if(result ==1) {
                //alert("Your Status Updated!");
                //location.reload();
                window.location = "?msg=success";
              }
            }
          });
        }); 
      //Set time for messge notifications
      $(document).ready(function () {
        setTimeout(function () {
          $('#set_valid_msg').hide();
        }, 2000);
      });
    </script>
    <!-- Checking for email availability -->
    <script type="text/javascript">
      function checkUserAvailTest() {
        var userInput = document.getElementById("user_input").value;
        var table = document.getElementById("table_name").value;
        var columnName = document.getElementById("column_name").value;
        if (userInput){
          $.ajax({
          type: "POST",
          url: "common_user_avail_check.php",
          data: {
            userInput:userInput,table:table,columnName:columnName,
          },
          success: function (response) {
            if (response > 0){
              $('#input_status').html("<span>Already Exist</span>");
              $("#user_input").val("");
            } else {
              $('#input_status').html("");        
            }
          }
          });          
        }
      }
    </script>
    <!-- Script to get Districts -->
    <script type="text/javascript">
    function getDistricts(val) { 
        $.ajax({
        type: "POST",
        url: "get_districts.php",
        data:'lkp_state_id='+val,
        success: function(data){
            $("#lkp_district_id").html(data);
        }
        });
    }
    function getCities(val) { 
        $.ajax({
        type: "POST",
        url: "get_cities.php",
        data:'lkp_district_id='+val,
        success: function(data){
            $("#lkp_city_id").html(data);
        }
        });
    }
    function getLocations(val) { 
        $.ajax({
        type: "POST",
        url: "get_locations.php",
        data:'lkp_city_id='+val,
        success: function(data){
            $("#lkp_location_id").html(data);
        }
        });
    }
    function getPincode(val) { 
        $.ajax({
        type: "POST",
        url: "get_pinode.php",
        data:'id='+val,
        success: function(data){
            $("#lkp_pincode_id").html(data);
        }
        });
    }
    </script>
    <!-- Below script for ck editor -->
    <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'category_description' );
        CKEDITOR.replace( 'meta_desc' );
    </script>
    <style type="text/css">
        .cke_top, .cke_contents, .cke_bottom {
            border: 1px solid #333;
        }
    </style>
  </body>
  <style>
    .modal-body{
      font-size:15px;
      text-align:justify;
      padding-left:110px;
      padding-top:30px;
      font-family:Roboto,sans-serif;
    }
    .open_cursor {
      cursor: pointer !important;
    }
  </style>
</html>