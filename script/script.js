
$(document).ready(function(){
    
    $("input[required], select[required]").attr("oninvalid", "this.setCustomValidity('Harap isi kolom ini')");
    $("input[required], select[required]").attr("oninput", "setCustomValidity('')");
    
    $(".dbboxmenu").click(function() {
        window.location = $(this).find("h5").attr("href"); 
        return false;
    });
    
    $(".caricari").click(function() {
        window.location = $(this).find("h5").attr("href"); 
        return false;
    });
    
    $(".alert").on('click',function(){
        $(this).hide();
    });
    setTimeout(function(){ $(".alert").hide(); }, 8000);
    
    $(".sbbutton1").click(function(){
        $(".dashcontainer1").show();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").show();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton2").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").show();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").show();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton3").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").show();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").show();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton4").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").show();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").show();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton5").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").show();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").show();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton6").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").show();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").show();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton7").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").show();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").show();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton8").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").show();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").show();
        $(".headnav9").hide();
        $(".headnav10").hide();
    });
    $(".sbbutton9").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").show();
        $(".dashcontainer10").hide();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").show();
        $(".headnav10").hide();
    });
    $(".sbbutton10").click(function(){
        $(".dashcontainer1").hide();
        $(".dashcontainer2").hide();
        $(".dashcontainer3").hide();
        $(".dashcontainer4").hide();
        $(".dashcontainer5").hide();
        $(".dashcontainer6").hide();
        $(".dashcontainer7").hide();
        $(".dashcontainer8").hide();
        $(".dashcontainer9").hide();
        $(".dashcontainer10").show();
        
        $(".headnav1").hide();
        $(".headnav2").hide();
        $(".headnav3").hide();
        $(".headnav4").hide();
        $(".headnav5").hide();
        $(".headnav6").hide();
        $(".headnav7").hide();
        $(".headnav8").hide();
        $(".headnav9").hide();
        $(".headnav10").show();
    });
    
                            $("#prodstandar").click(function(){
                                $("#pilbar1").show();
                                $("#pilbar2").hide();
                            });
                            $("#prodcustom").click(function(){
                                $("#pilbar2").show();
                                $("#pilbar1").hide();
                            });
    
    $(".boxentry").submit(function(){
        alert("Data berhasil dimasukkan");
    });
    $(".boxedit").submit(function(){
        alert("Data berhasil dirubah");
    });
    
    
});

function datalookup(id) {
    $("#" + id).show();
}

function datahide(id) {
    $("#" + id).hide();
}



///////////////////////////////////////////////////////////
//input disabler jika ada required input yang belum diisi//
///////////////////////////////////////////////////////////
const inputSelector = ':input[required]:visible';
function checkForm() {
  var isValidForm = true;
  $(this.form).find(inputSelector).each(function() {
    if (!this.value.trim()) {
      isValidForm = false;
    }
  });
  $(this.form).find('.monitored-btn').prop('disabled', !isValidForm);
  return isValidForm;
}
$('.monitored-btn').closest('form')
  .submit(function() {
    return checkForm.apply($(this).find(':input')[0]);
  })
  .find(inputSelector).keyup(checkForm).keyup();
/////////////////////////////////////////////////////////
