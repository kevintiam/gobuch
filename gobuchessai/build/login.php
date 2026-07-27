<?php
session_cache_limiter('private_no_expire,must-revalidate');session_start();
require 'connectC.php';  require 'lesmenus.php';
$_SESSION['addrIp']=$_SERVER['REMOTE_ADDR'];
$_SESSION['fuser']=" "; $_SESSION['fmtp']=" "; 
$_SESSION['fcid']=0; $_SESSION['fposte']=0; $_SESSION['fidag']=0;
$_SESSION['fnomag']=' ';$_SESSION['modecran']=0; $_SESSION['initcprest']=0; $_SESSION['initag']=0; $_SESSION['initzo']=0;
/*
Si l'adresse ip est déjà enregistrée ds la bd et 
parametrer comme se souvenir de moi, on recherche les infos de cette adresse ip
on redirige l'utilisateur vers la page espace.php

*/


/*$souvenir=souvenirip($_SESSION['addrIp']);
try 
{
 $bdd = new PDO(host(),UTIL(),mtp());  
  } 
catch(Exception $e) 
 {       
    die('Erreur : '.$e->getMessage());
 }
 if($souvenir==1){ 
  $_SESSION['yd']=$souvenir;
  $_SESSION['yuser']=userb($_SESSION['yd']);
  $_SESSION['ymtp']=mtpb($_SESSION['yd']);
  $_SESSION['ynom']=nomb($_SESSION['yd']);
  $_SESSION['yemail']=emailb($_SESSION['yd']);
  $_SESSION['yidville']=idvilleb($_SESSION['yd']);
  $_SESSION['yqtier']=qtierb($_SESSION['yd']);
  $_SESSION['yimage']=imageb($_SESSION['yd']);
  $_SESSION['yentrep']=entrepb($_SESSION['yd']);
  header('location:espace.php'); 
  }

*/

  try 
      {
       $bdd = new PDO(host(),UTIL(),mtp());  
       } 
       catch(Exception $e) 
       {       
       die('Erreur : '.$e->getMessage());
       }
     /*  $image=imagecreatefromjpeg("DSC_0573.jpg");
       $max_size=100000;

       $width=200;$height=200;
        $new_width=$width-10;$new_height=$height-10;
        $new_image=imagecreatetruecolor($new_width,$new_height);
        imagecopyresampled($new_image,$image,0,0,0,0,$new_width,$new_height,$width,$height);
        $image_size=filesize("image_resized.jpg");
        $image_size>$max_size;

       imagejpeg($new_image,"image_resized.jpg");
*/
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>je me connecte - gobuch</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">



    <script>
    function quartier(str){
       if(str==" "){
           document.getElementById("quartier").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("quartier").innerHTML=this.responseText;
               }
           };
           xmlhttp.open("POST","inscripquartier.php?q="+str,true);
           xmlhttp.send();
       }
   }
   </script>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>CONNEXION</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg"> </p>

      <!--form action="connexionauth.php" method="post"-->
       <form action="executereq.php" method="post">
       

        <div class="input-group mb-3">
          <input type="text" name="user" class="form-control" placeholder="Nom d'utilisateur">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
         
        <div class="input-group mb-3">
          <input type="password" name="passmot" class="form-control" placeholder="Mot de passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
         
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="souvenir" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Se souvenir de moi 
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="connaccount" class="btn btn-primary btn-block">Valider</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <ul>
      <li><a href="logincreat.php" class="text-center">Je veux creer un compte gobuch</a></li></br>
      <li><a href="forget.php" class="text-center">J'ai oublié mes paramètres de connexion</a></li>
  </ul></div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->




  <!-- /.debut inscription -->
  <div class='modal fade' id='inscrire'>  
<div class="modal-dialog">
  <div class="modal-content ">
    <div class="modal-header">
      <h4 class="modal-title">Inscription</h4>
       
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
    <!--form action='saveinscrip.php' method='POST'-->
    <form action='connexionauth.php' method='POST'>
    </br>
    <label for="exampleInputEmail1">Noms et prénoms*</label>
    <div class="input-group mb-3">
          <input type="text" name="nom" required class="form-control">
          <div class="input-group-append">
             
          </div>
        </div>
        <label for="exampleInputPassword1">Numéro de téléphone*</label>
        <div class="input-group mb-3">
            <div class="input-group-text">
              +237
            </div>
          <input name="tel" required class="form-control">
          <div class="input-group-append">
            
          </div>
        </div>
        

        <label for="exampleInputEmail1">Adresse email</label>
    <div class="input-group mb-3">
          <input type="text" name="email" class="form-control">
          <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
        </div>

        <p><div class="select2-purple">
<label for="exampleInputEmail1">Ville</label>
<select name="ville" onChange='quartier(this.value)' class="select2" data-placeholder="Choisir" data-dropdown-css-class="select2-purple" style="width: 100%;">
               
            <?php 
            echo "<option value='a'>choisir un lieu</option>";
               $v="SELECT * FROM ville   ORDER BY nomville";
 $reponse = $bdd->query($v); 
 while ($donnees = $reponse->fetch() )
{
  $idville=$donnees['idville'];
                    $namville=$donnees['nomville'];
                    echo "<option value='".$idville."'>".$namville."</option>";
} 
$reponse->closeCursor(); 
 
 ?></select></div> </p>

 
<div id='quartier'>  </div></br>
 
<label for="exampleInputEmail1">Nom de votre entreprise</label>
    <div class="input-group mb-3">
          <input type="text" name="entrep" class="form-control">
          <div class="input-group-append">
             
          </div>
        </div>
    

        <label for="exampleInputEmail1">Nom d'utilisateur*</label>
        <div class="input-group mb-3">
          <input type="text" name="user" required class="form-control">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <label for="exampleInputEmail1">Mot de passe*</label>
        <div class="input-group mb-3">
          <input type="password" name="mtp" required class="form-control">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

          

        <p><b><i class="far fa-bell"></i> Si vous voulez recevoir les demandes de services, choisissez votre domaine</b></p>
        <p><div class="select2-purple">
<label for="exampleInputEmail1">Domaine ( Vous ajouterez d'autres domaines après la création de votre compte)</label>
<select name="domaine" class="select2" data-placeholder="Choisir" data-dropdown-css-class="select2-purple" style="width: 100%;">
<option value='a'>Choisir un domaine</option>               
 
            <?php 
              $v="SELECT * FROM domaine   ORDER BY idd DESC";
 $reponse = $bdd->query($v); 
 while ($donnees = $reponse->fetch() )
{
 echo "<option value='".$donnees['idd']."'>".$donnees['nomdo']."</option>";
} 
$reponse->closeCursor(); 
 
 ?></select></div> </p>

 

 <button type="submit" name="saveinscrip" style='width: 100%; height: 5%;' class="btn btn-success" value="send">Enregistrer</button>
           </br> 
              </form> 
    </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
  <!-- /.fin inscription -->



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Ion Slider -->
<script src="plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
<!-- Bootstrap slider -->
<script src="plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
<!-- AdminLTE for demo purposes -->
 
<!-- Page specific script -->
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').bootstrapSlider()

    /* ION SLIDER */
    $('#range_1').ionRangeSlider({
      min     : 0,
      max     : 5000,
      from    : 1000,
      to      : 4000,
      type    : 'double',
      step    : 1,
      prefix  : '$',
      prettify: false,
      hasGrid : true
    })
    $('#range_2').ionRangeSlider()

    $('#range_5').ionRangeSlider({
      min     : 0,
      max     : 10,
      type    : 'single',
      step    : 0.1,
      postfix : ' mm',
      prettify: false,
      hasGrid : true
    })
    $('#range_6').ionRangeSlider({
      min     : -50,
      max     : 50,
      from    : 0,
      type    : 'single',
      step    : 1,
      postfix : '°',
      prettify: false,
      hasGrid : true
    })

    $('#range_4').ionRangeSlider({
      type      : 'single',
      step      : 100,
      postfix   : ' light years',
      from      : 55000,
      hideMinMax: true,
      hideFromTo: false
    })
    $('#range_3').ionRangeSlider({
      type    : 'double',
      postfix : ' miles',
      step    : 10000,
      from    : 25000000,
      to      : 35000000,
      onChange: function (obj) {
        var t = ''
        for (var prop in obj) {
          t += prop + ': ' + obj[prop] + '\r\n'
        }
        $('#result').html(t)
      },
      onLoad  : function (obj) {
        //
      }
    })
  })
</script>

  
 

<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>




<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> 
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> 
</body>
</html>
