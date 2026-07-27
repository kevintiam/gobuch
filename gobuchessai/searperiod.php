<?php session_cache_limiter('private_no_expire,must-revalidate');
session_start();
require 'connectC.php';   require 'lesmenusgerer.php'; require 'lesfunctions.php'; 
    
 
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
  <title> </title>

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
function modetuteur(str){
       if(str==" "){
           document.getElementById("tuteur").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("tuteur").innerHTML=this.responseText;
               }
           };
           xmlhttp.open("POST","modetuteur.php?q="+str,true);
           xmlhttp.send();
       }
   }



 function conclure1(){
 document.emploi1.ensb.value=document.emploi1.day.value+"@"+document.emploi1.debut.value
+"@"+document.emploi1.duree.value+"@"+document.emploi1.matie.value;
document.getElementById("tot").value=document.getElementById("tau").value*document.getElementById("dure").value;
document.getElementById("totu").value=document.getElementById("tautu").value*document.getElementById("dure").value;
}


function trituteur(str){
         str= document.emploi1.day.value+"@"+document.emploi1.debut.value
+"@"+document.emploi1.duree.value+"@"+document.emploi1.matie.value
+"@"+document.emploi1.clax.value;  //  
       if(str==" "){
           document.getElementById("triteur").innerHTML=" ";
           return ;
       }
       else{
           var xmlhttp=new XMLHttpRequest();
           xmlhttp.onreadystatechange=function(){
               if(this.readyState==4 && this.status==200 ){
                   document.getElementById("triteur").innerHTML=this.responseText;
               }
           };
            
           xmlhttp.open("POST","trituteur.php?q="+str,true);
           xmlhttp.send();
       }
   }




</script>




</head>
<body class="hold-transition register-page">




<?php 
 if(isset($_GET['idrecu'])){
    $_SESSION['idrecu']=$_GET['idrecu'];
 }
   if($_SESSION['idrecu']>0){ 
    $lsql="SELECT * FROM estsollicitee  ORDER BY idestsollicitee DESC";
           $reponse = $bdd->query($lsql);
           $trouve=0;  $cpt=0;
          while ($donnees = $reponse->fetch() AND $trouve==0)
          {

           $idestsollicitee=$donnees['idestsollicitee'];
            $idenseign=$donnees['idenseign'];
            $idmatiere=$donnees['idmatiere'];
            $duree=$donnees['duree']+0;
            $horairedeb=$donnees['horairedeb'];
              $ijourcours=$donnees['jourcours'];
               $th=$donnees['th']+0;
            $decision=$donnees['decision']; //O POUR ACTIF 1 POUR PASSER
              $montant=$donnees['montant']+0;
               $montantens=$donnees['montantensei']+0;
               $thens=$donnees['tauxensei']+0;
               $oldetat=$idmatiere."@".$_SESSION['mdclas']."@".$ijourcours."@".$horairedeb."@".$duree;
if($idestsollicitee==$_SESSION['idrecu']){ 
  $trouve=1;

}
$cpt++;
                }
          $reponse->closeCursor();  
          }  
          $_SESSION['mdindens']=$idenseign;
 ?>





<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center"  style='background-color:#F6F2E8';>
     
      
      <?php  echo "<form action='detailadm.php' method='POST'>"; ?>
     <button type="submit" class="btn"  style='color:white';>
      <i class="fas fa-arrow-left text-muted"> Retour</i>
    </button>
     </form> 
    
   
     
    <?php /* if($_SESSION['result']==1){ ?>
  <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"> Votre enregistrement a été effectué avec succès .Le 683584205/654407772/674494384 vous contactera. </i></h5>
                  
                </div>
                <?php  $_SESSION['result']=0; } */?>               
        <!--img src="imagerepet.jpg" alt="user-avatar" height="150px" width="190px"-->
       
    </div>
    <div class="card-body" >
      <p class="login-box-msg"><B>Modification de l'emploi de temps</B></p>
 




 <?php 
  echo "<form  method='POST' action='executereq.php'  name='emploi1' oninput='conclure1()'>";

echo "<div class='select2-purple'> 
              <label for='exampleInputPassword1'>Jour</label>
              <select name='day'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'>  
               <option value='".$ijourcours."'>".nomjour($ijourcours)."</option>
              <option value='0'>Choisir un jour</option>
        <option value='1'>Lundi</option><option value='2'>Mardi</option><option value='3'>Mercredi</option>
        <option value='4'>Jeudi</option><option value='5'>Vendredi</option><option value='6'>Samedi</option>
        <option value='7'>Dimanche</option>";
            echo "</select></div><br>";

            echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Heure de debut</label>
              <select name='debut'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$horairedeb."'>".nomheure($horairedeb)."</option>
              <option value='1'>08:00</option><option value='2'>09:00</option><option value='3'>10:00</option>
        <option value='4'>11:00</option><option value='5'>12:00</option><option value='6'>13:00</option>
        <option value='7'>14:00</option><option value='8'>15:00</option><option value='9'>16:00</option>
        <option value='10'>17:00</option><option value='11'>17:30</option>
        <option value='12'>18:00</option><option value='13'>18:30</option><option value='14'>19:00</option>
              ";

            echo "</select></div><br>";
 
  

            echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Durée</label>
              <select name='duree'  id='dure' class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$duree."'>".nomduree($duree)."</option>
              <option value='1'>01:00</option><option value='1.5'>01:30</option>
        <option value='2'>02:00</option><option value='2.5'>02:30</option>
        <option value='3'>03:00</option><option value='3.5'>03:30</option>
        <option value='4'>04:00</option><option value='4.5'>04:30</option>
        <option value='5'>05:00</option><option value='5.5'>05:30</option>
        <option value='6'>06:00</option>
              ";
              
            echo "</select></div><br>";

            echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Matière</label>
              <select name='matie'    class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
              echo "<option value='".$idmatiere."'>".nomatiere($idmatiere)."</option>";
             
            echo "</select></div><br>";

            echo "<input style='display:none'; name='uxer' value='".$idenseign."'   class='form-control'></br> ";

            echo "<input style='display:none'; name='oldetat' value='".$oldetat."'   class='form-control'></br> ";
            echo "<input style='display:none'; name='clax' value='".$_SESSION['mdclas']."'   class='form-control'></br> ";
echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Cliquer pour faire la recherche</label>
              <select name='ensb'  onChange='trituteur(this.value)' class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
     echo "<option value=' '>  </option>";
   echo "<option value=' '> Actualiser la recherche</option>";
     echo "</select></div><br>";
 
  echo "<b>Tuteur(e) en cours : ".completname($idenseign)." </b><br><br>";
  echo "<div id='triteur'>

            </div><br>"; 

echo "<label for='exampleInputPassword1'> Taux horaire en FCFA <i>(A payer par le demandeur)</i></label><input name='taux' id='tau'  value='".$th."' class='form-control'></br> ";
 echo "<label for='exampleInputPassword1'> Montant total en FCFA <i>(A payer par le demandeur)</i></label><input name='total' id='tot'  value='".$montant."' class='form-control'></br> ";
 
 echo "<label for='exampleInputPassword1'> Taux horaire en FCFA <i>(A recevoir par le tuteur)</i></label><input name='tauxtu' id='tautu'  value='".$thens."' class='form-control'></br> ";
 echo "<label for='exampleInputPassword1'> Montant total en FCFA <i>(A recevoir par le tuteur)</i></label><input name='totaltu' id='totu' value='".$montantens."' class='form-control'></br> ";
 
 echo "<div class='select2-purple'>
              <label for='exampleInputPassword1'>Etat d'activité</label>
              <select name='decision'   class='select2' data-dropdown-css-class='select2-purple' style='width: 100%;'> "; 
            echo "<option value='".$decision."'>".actifemploi($decision)."</option>
              <option value='0'>Actif</option>
              <option value='1'>Non actif</option> ";

            echo "</select></div><br>";

            ?>
             <div class="modal-footer justify-content-between">
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>Fermer</button>
      
      <button type="submit" name="modempl" value="<?php echo $idestsollicitee; ?>" class="btn btn-primary">Enregistrer</button>
       </div>
</form>

      

      
    
  
  </div><!-- /.card -->
</div></br></br></br>
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
