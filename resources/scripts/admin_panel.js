$(document).ready(function () {
  $.noConflict();
  $("#view_patient_table").dataTable();
});


$('#select_block').on('change', async function() {
      const resp = await fetch(`${adminApiUrl}?block=${this.value}`);
     const resp_json = await resp.json();
     if(resp_json.blocks.length > 0){
      $('#select_SHC').empty();
      $('#select_village').empty();
      $('#select_SHC').append(`<option disabled selected value="-1">Select SHC</option>`);
      $('#select_village').append(`<option disabled selected value="-1">Select Village</option>`);
      resp_json.blocks.map((item)=>{
         $('#select_SHC').append(`<option value="${item}">${item}</option>`);
      })
     }
   });


   $('#select_SHC').on('change', async function() {
      const resp = await fetch(`${adminApiUrl}?shc=${this.value}`);
     const resp_json = await resp.json();
     if(resp_json.blocks.length > 0){
      $('#select_village').empty();
      $('#select_village').append(`<option disabled selected value="-1">Select Village</option>`);
      resp_json.blocks.map((item)=>{
         $('#select_village').append(`<option value="${item}">${item}</option>`);
      })
     }
   });

   $('#search_data').on('click', async function(e) {
      e.preventDefault();
      
      $blockName=$('#select_block').val();
      $shcName=$('#select_SHC').val();
      $villageName=$('#select_village').val();
      $toDate=$('#to').val();
      $fromDate=$('#from').val();
      if($blockName && $villageName && $villageName && $toDate && $fromDate){
         $("#errorMessage").hide();
         $("#search_data_form").submit();  
      }else{
         $("#errorMessage").html('Please fill all the details');
         $("#errorMessage").show();
         setTimeout(5000, () => {
      $("#errorMessage").hide();
    });
      }
   });
   
   
 
$("body").on("click", ".view-single-btn", function () {
  const id = $(this).attr("data-id");
  $("#editPatientBtn").attr("data-id", id);
  $.ajax({
    url: apiUrl + `?id=${id}`,
    type: "GET",
    success: function (res) {

      const data = JSON.parse(res).data;
      console.log(data);
      $("#v-name").val(data.name);
      $("#v-husband_name").val(data.husband_name);
      $("#v-aadhar").val(data.aadhar);
      $("#v-mobile").val(data.mobile);
      $("#v-address").val(data.address);
      $("#v-village").append(`<option selected>${data.village}</option>`);
      $("#v-lmp").val(data.lmp);
      $("#v-aasha").val(data.aasha);
      $("#v-SHC").val(data.SHC);
      $("#v-block").val(data.block);
      $("#v-city").val(data.city);

      data.APH == 1
        ? $("#v-aph").attr("checked", "checked")
        : $("#v-APH").prop("checked", false);
      data.eclampsia == 1
        ? $("#v-Eclampsia").attr("checked", "checked")
        : $("#v-Eclampsia").prop("checked", false);
      data.PIH == 1
        ? $("#v-PIH").attr("checked", "checked")
        : $("#v-PIH").prop("checked", false);
      data.anaemia == 1
        ? $("#v-Anaemia").attr("checked", "checked")
        : $("#v-Anaemia").prop("checked", false);
      data.obstructed_labor == 1
        ? $("#v-Obstructed_Labor").attr("checked", "checked")
        : $("#v-Obstructed_Labor").prop("checked", false);
      data.PPH == 1
        ? $("#v-PPH").attr("checked", "checked")
        : $("#v-PPH").prop("checked", false);
      data.LSCS == 1
        ? $("#v-LSCS").attr("checked", "checked")
        : $("#v-LSCS").prop("checked", false);
      data.congenital_anamaly == 1
        ? $("#v-Congenital_Anamaly").attr("checked", "checked")
        : $("#v-Congenital_Anamaly").prop("checked", false);
      data.abortion == 1
        ? $("#v-Abortion").attr("checked", "checked")
        : $("#v-Abortion").prop("checked", false);
      data.others_1 == 1
        ? $("#v-Others").attr("checked", "checked")
        : $("#v-Others").prop("checked", false);
      data.tuberculosis == 1
        ? $("#v-Tuberculosis").attr("checked", "checked")
        : $("#v-Tuberculosis").prop("checked", false);
      data.hypertension == 1
        ? $("#v-Hypertension").attr("checked", "checked")
        : $("#v-Hypertension").prop("checked", false);
      data.heart_disease == 1
        ? $("#v-Heart_Disease").attr("checked", "checked")
        : $("#v-Heart_Disease").prop("checked", false);
      data.diabetes == 1
        ? $("#v-Diabetes").attr("checked", "checked")
        : $("#v-Diabetes").prop("checked", false);
      data.asthma == 1
        ? $("#v-Asthma").attr("checked", "checked")
        : $("#v-Asthma").prop("checked", false);
      data.other_2 == 1
        ? $("#v-Other").attr("checked", "checked")
        : $("#v-Other").prop("checked", false);
    },
  });
});


// for preventing relsubmissions of from
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
