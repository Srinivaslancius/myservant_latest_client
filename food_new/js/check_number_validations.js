$(document).ready(function(){$(".valid_mobile_num").keypress(function(e){if(e.which!=8&&e.which!=0&&(e.which<48||e.which>57)){return!1}});$(".valid_price_dec").keydown(function(event){if(event.shiftKey==!0){event.preventDefault()}
if((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)||event.keyCode==8||event.keyCode==9||event.keyCode==37||event.keyCode==39||event.keyCode==46||event.keyCode==190){}else{event.preventDefault()}
if($(this).val().indexOf('.')!==-1&&event.keyCode==190)
event.preventDefault()})})