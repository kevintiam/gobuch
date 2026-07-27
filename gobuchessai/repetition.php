<?php session_cache_limiter('private_no_expire,must-revalidate');
session_start();
require 'connectC.php';  require 'lesmenus.php'; require 'lesfunctions.php';
$_SESSION['numrepetok']=0;      
 
/* 
try 
{
 $bdd = new PDO(host(),UTIL(),mtp());
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
}
  
  $_SESSION['result']=0;  
  if(isset($_POST['envoi'])){
    $klassewahl=array();
    $num=$_POST['tel'];
    $lieu=$_POST['lieu'];
    $ville=$_POST['ville'];
    $qtier=$_POST['qtier'];
    $klassewahl=$_POST['clas'];
    $totaligne=count($klassewahl);
    if($totaligne>0){  
        for($i=0;$i<$totaligne;$i++){
            $date=date('Y-m-d');
            $heur=date('H:i');
            $clas=$klassewahl[$i];
            $req = $bdd->prepare('INSERT INTO repetitionmsg(idclas,tel,ville,quartier,lieu,date,heure,marque,localisation) VALUES(?,?,?,?,?,?, ?,?,?)'); 
            $req->execute(array($clas,$num,$ville,$qtier,$lieu,$date,$heur,' ',' ')); 
        }
    }
    $_SESSION['result']=1;  
  }
*/


if($_SESSION['numpage']==0){
  $_SESSION['back']="index.php";
}
if($_SESSION['numpage']==1){
  $_SESSION['back']="programmegen.php";
}
if($_SESSION['numpage']==2){
  $_SESSION['back']="cours.php";
}
if($_SESSION['numpage']=='lecon'){
  $_SESSION['back']="lecon.php";
}
if($_SESSION['numpage']==3){
  $_SESSION['back']="exercice.php";
}
if($_SESSION['numpage']==4){
  $_SESSION['back']="examensgen.php";
}
if($_SESSION['numpage']==5){
  $_SESSION['back']="examensgen2.php";
}
if($_SESSION['numpage']==6){
  $_SESSION['back']="evaluation.php";
}
if($_SESSION['numpage']==7){
  $_SESSION['back']="evaluation2.php";
}
try 
{
 $bdd = new PDO(host(),UTIL(),mtp());
 } 
 catch(Exception $e) 
 {       
 die('Erreur : '.$e->getMessage());
}
  

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cours de répétitions - gobuch</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<script>
 function modeconclure(str){
       if(str==" "){
           document.getElementById("subm").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("subm").innerHTML=this.responseText;
               }
           };
           xmlhttp.open("POST","repetitionajax.php?q="+str,true);
           xmlhttp.send();
       }
   }
</script>



</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center"  style='background-color:#F6F2E8';>
     
     
   
     
    <?php /* if($_SESSION['result']==1){ ?>
  <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"> Votre enregistrement a été effectué avec succès .Le 683584205/654407772/674494384 vous contactera. </i></h5>
                  
                </div>
                <?php  $_SESSION['result']=0; } */?>               
        <img src="imagerepet.jpg" alt="user-avatar" height="150px" width="190px">
       
    </div>
    <div class="card-body"  style='background-color:#F6F2E8';>
      <p class="login-box-msg"><B>Veuillez remplir le formulaire pour recevoir un accompagement, puis cliquer sur suivant</B></p>

      <form action="emploi.php" method="post">
        <label for="exampleInputPassword1">Matière(s) sollicitée(s) </label>
        <div class="select2-purple">
        <select name="matiere[]" multiple="multiple"   data-placeholder="Cliquer ici  pour choisir la matière(s)" class="form-control select2" style="width: 100%;" id="exampleInputPassword1" >
       
         
       <?php 
                  
                     $reponse = $bdd->query("SELECT * FROM matiere ");
                     while ($donnees = $reponse->fetch()){                            
                      $phrase =$donnees['idmatiere'] ; 
       
         
        echo "<option value='".$phrase."'>".$donnees['nomatiere']."</option>" ; 
                      } 
                 $reponse->closeCursor(); 
                   ?>
             </select>
        </div> </br>

        <label for="exampleInputPassword1">Classe </label>
        <div class="select2-purple">
        <select name="classe"   data-placeholder="Cliquer ici  pour choisir la matière(s)" class="form-control select2" style="width: 100%;">
       
         
       <?php 
                  
                     $reponse = $bdd->query("SELECT * FROM classe ");
                     while ($donnees = $reponse->fetch()){                            
                      $phrase =$donnees['idclasse'] ; 
       
         
        echo "<option value='".$phrase."'>".$donnees['nomclasse']."</option>" ; 
                      } 
                 $reponse->closeCursor(); 
                   ?>
             </select>
        </div> </br>
       
        <label for="exampleInputPassword1">Quand souhaitez-vous commencer ? </label>
        <div class="select2-purple">
        <select name="periodesouh"   class="form-control select2" style="width: 100%;" id="exampleInputPassword2" >
       
        <?php 
                  
                     $reponse = $bdd->query("SELECT * FROM momentsouh ");
                     while ($donnees = $reponse->fetch()){                            
                      $phrase =$donnees['idmomentouch'] ; 
       
         
        echo "<option value='".$phrase."'>".$donnees['libelle']."</option>" ; 
                      } 
                 $reponse->closeCursor(); 
              // pattern='[0-9]{9}'     ?>
        </select>
        </div> </br>

        <label for="exampleInputPassword1">NUMERO(S) DE TELEPHONE</label>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              +237
            </div>
          </div>
          <input name="tel" class="form-control" onChange="modeconclure(this.value)" placeholder='671234567' type='text' minlength='9' maxlength='9' step='5' required>  
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lg fa-phone"></span>
            </div>
          </div>
        </div></br>
        <label for="exampleInputPassword1">Genre de l'enseignant(e)</label>
        <div class="input-group mb-3">
        <select name="genresouh"    class="form-control" style="width: 100%;" id="exampleInputPassword1" >
        <option value='1'>Masculin</option><option value='2'>Feminin</option><option value='3'>Peu importe</option>
        <?php 
                 /*   
                     $reponse = $bdd->query("SELECT * FROM repetitionville WHERE sup='0'");
                     while ($donnees = $reponse->fetch()){                            
                      $phrase =$donnees['idville'] ; 
       
         
        echo "<option value='".$phrase."'>".$donnees['nomville']."</option>" ; 
                      } 
                 $reponse->closeCursor(); */
                   ?>
             </select>
       </div>  </br>

       <label for='exampleInputPassword1'>Lieu</label><br><textarea cols='38' rows='3' name='lieu' required> </textarea></br></br></br>
       <!--label for="exampleInputPassword1">QUARTIER</label>
        <div class="input-group mb-3">
          <input name="qtier" class="form-control" required >
        </div>
       <label for="exampleInputPassword1">LIEU DE RESIDENCE EXACTE</label>
        <div class="input-group mb-3">
          <input name="lieu" class="form-control" required >
        </div>
        

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
               
            </div>
          </div-->
          <!-- /.col -->
          <div class="btn-group w-100 mb-2">
          <?php // $x="12.5"; echo ctype_digit($x);  
          echo  "<!--a class='btn btn-danger' href='".$_SESSION['back']."' data-filter='2'><<  retour</a>"; ?>
          <button type="submit" name="envoi" class="btn btn-success" value="send"> suivant >></button-->
    
        </div>
         <div id='subm'>

     </div>
          <!-- /.col -->
        </div>


      </form>

      

      
 </div><!-- /.card -->
 </br></br></br>
<!-- /.register-box --> </body>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>






<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultInfo').click(function() {
      Toast.fire({
        icon: 'info',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultError').click(function() {
      Toast.fire({
        icon: 'error',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultWarning').click(function() {
      Toast.fire({
        icon: 'warning',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.swalDefaultQuestion').click(function() {
      Toast.fire({
        icon: 'question',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultInfo').click(function() {
      toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultError').click(function() {
      toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    $('.toastrDefaultWarning').click(function() {
      toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });

    $('.toastsDefaultDefault').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultTopLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'topLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomRight').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomRight',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultBottomLeft').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        position: 'bottomLeft',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultAutohide').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        autohide: true,
        delay: 750,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultNotFixed').click(function() {
      $(document).Toasts('create', {
        title: 'Toast Title',
        fixed: false,
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultFull').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        icon: 'fas fa-envelope fa-lg',
      })
    });
    $('.toastsDefaultFullImage').click(function() {
      $(document).Toasts('create', {
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        image: 'dist/img/user3-128x128.jpg',
        imageAlt: 'User Picture',
      })
    });
    $('.toastsDefaultSuccess').click(function() {
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultInfo').click(function() {
      $(document).Toasts('create', {
        class: 'bg-info',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultWarning').click(function() {
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
    $('.toastsDefaultMaroon').click(function() {
      $(document).Toasts('create', {
        class: 'bg-maroon',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
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






</body>
</html>
