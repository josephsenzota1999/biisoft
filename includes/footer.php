 </div>
 <footer id="foosterNav" class="bg-info">
 	<!-- <div  class="d-xl-none d-md-none footer">
 		<a href="#" class="btn  btn-info">Reports</a>
 		<a href="#" class="btn  btn-info">POS</a>
 		<a href="#" class="btn  btn-info">Invento</a>
 		<a href="#" class="btn  btn-info">Purch</a>
 		<a href="#" class="btn  btn-info">BTN 5</a>
 		<a href="#" class="btn  btn-info">BTN 6</a>


 	
 	</div> -->
       
 </footer>
   <script src="<?php echo MAIN_URL?>/js/jquery-3.4.1.slim.min.js"></script>
   <script src="<?php echo MAIN_URL?>/js/bootstrap.min.js"></script>
   <script src="<?php echo MAIN_URL?>/js/boot.js"></script>
   <script src="<?php echo MAIN_URL?>/js/jquery.dataTables.min.js"></script>
   <script src="<?php echo MAIN_URL?>/js/dataTables.bootstrap.min.js"></script>


   <script>
   	$(document).ready(function(){
        // $("#searchTable").DataTable({
            // "searching": true
        // });
        
       
    });
     // PRINTING
    function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
// printedText
function printedText(){
  document.getElementById('titleHeading').innerHTML = "DRINKS STORE";
}
function purchasesText(){
  document.getElementById('titleHeading').innerHTML = "DRINKS PURCHASES ";
}

function printedText4(){
  document.getElementById('titleHeading4').innerHTML = " LIST OF CREDITORS ";
}
function catText(){
  document.getElementById('textCat').innerHTML = "SALES BY CATEGORY";

}
function catText1(){
  document.getElementById('textCat1').innerHTML = "FOOD AND DRINKS VAT";

}
// salesText
function salesText(){
  document.getElementById('textSales1').innerHTML = "SALES REPORT";

}
function salesText2(){
  document.getElementById('textSales2').innerHTML = "SALES REPORT ";

}
   </script>

</body>
</html>