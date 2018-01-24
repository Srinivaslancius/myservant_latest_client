
 <!-- Auto complete home page search -->           
    <script type="text/javascript">   
    // AJAX call for autocomplete 
    $(document).ready(function(){
        $("#search-box").keyup(function(){
            $.ajax({
            type: "POST",
            url: "get_address_results.php",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background","#FFF");
            }
            });
        });
    });
    //To select country name
    function selectCountry(val) {
        $("#search-box").val(val);
        $("#suggesstion-box").hide();
    }
    </script>
    
<style>
#country-list{float:left;list-style:none;margin-top:0px;padding:0;width:485px;position: absolute}
#country-list li{padding: 10px; background: #ffffff;border-bottom:1px solid #DEDEDE}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:0px;}
#suggesstion-box{
    border-radius:30px !important;
}
</style>

    <!-- End home page search -->