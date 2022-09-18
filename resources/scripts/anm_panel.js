$(document).ready(function () {
  $.noConflict();
  $("#view_patient_table").dataTable();
});


$("#village").on("change", async () => {
  const village = $("#village").find(":selected").text();
  const resp = await fetch(`${apiUrl}?village=${village}`);
  const resp_json = await resp.json();
  select_aasha = document.getElementById("select_aasha");
  if (resp_json.status === 200) {
    $("#select_aasha").empty();
    if (resp_json.name.length == 1) {
      select_aasha.options.add(new Option(resp_json.name, resp_json.name));
      $("#select_aasha").val(resp_json.name);
    } else if (resp_json.name.length > 1) {
      $("#select_aasha").prop("disabled", false);
      resp_json.name.map((name) => {
        select_aasha.options.add(new Option(name, name));
      });
    }
  }
});
$("#e-aadhar").on("input", () => {
  if ($("#e-aadhar").val().length !== 12) {
    $("#e-aadharError").show();
    $("#edit_patient").prop("disabled", true);
  } else {
    $("#e-aadharError").hide();
    $("#edit_patient").prop("disabled", false);
  }
});

$("#e-mobile").on("input", () => {
  if ($("#e-mobile").val().length !== 10) {
    $("#e-mobileError").show();
    $("#edit_patient").prop("disabled", true);
  } else {
    $("#e-mobileError").hide();
    $("#edit_patient").prop("disabled", false);
  }
});

$("#aadhar").on("input", () => {
  if (isNaN($("#aadhar").val())) {
    $("#aadhar").val("");
    $("#aadharError").show();
    return false;
  } else {
    $("#aadharError").hide();
  }
  if ($("#aadhar").val().length !== 12) {
    $("#aadharError").show();
    $("#add_patient").prop("disabled", true);
  } else {
    $("#aadharError").hide();
    $("#add_patient").prop("disabled", false);
  }
});

$("#mobile").on("input", () => {
  if (isNaN($("#mobile").val())) {
    $("#mobile").val("");
    $("#mobileError").show();
    return false;
  } else {
    $("#mobileError").hide();
  }

  if ($("#mobile").val().length !== 10) {
    $("#mobileError").show();
    $("#add_patient").prop("disabled", true);
  } else {
    $("#mobileError").hide();
    $("#add_patient").prop("disabled", false);
  }
});

async function SetAashaName() {
  const village = $("#e-village").find(":selected").text();
  const resp = await fetch(`${apiUrl}?village=${village}`);
  const resp_json = await resp.json();
  select_aasha = document.getElementById("e-aasha");
  $("#e-aasha").empty();
  if (resp_json.status === 200) {
    if (resp_json.name.length == 1) {
      select_aasha.options.add(new Option(resp_json.name, resp_json.name));
      $("#select_aasha").val(resp_json.name);
    } else if (resp_json.name.length > 1) {
      $("#e-aasha").prop("disabled", false);
      resp_json.name.map((name) => {
        select_aasha.options.add(new Option(name, name));
      });
    }
  }
}

$("#e-village").on("change", async () => {
  SetAashaName();
});

$("body").on("click", ".edit-btn", function () {
  let id = $("#editPatientBtn").attr("data-id");
  console.log(id);
  $.ajax({
    url: apiUrl + `?id=${id}`,
    type: "GET",
    success: function (res) {
      const data = JSON.parse(res).data;
      console.log(data);
      $("#e-name").val(data.name);
      $("#e-husband_name").val(data.husband_name);
      $("#e-aadhar").val(data.aadhar);
      $("#e-mobile").val(data.mobile);
      $("#e-address").val(data.address);
      $("#e-village").val(data.village);
      $("#e-lmp").val(data.lmp);
      $("#uid").val(data.id);
      // setting aasha name in edit section
      SetAashaName();

      data.APH == 1
        ? $("#e-aph").attr("checked", "checked")
        : $("#e-APH").prop("checked", false);
      data.eclampsia == 1
        ? $("#e-Eclampsia").attr("checked", "checked")
        : $("#e-Eclampsia").prop("checked", false);
      data.PIH == 1
        ? $("#e-PIH").attr("checked", "checked")
        : $("#e-PIH").prop("checked", false);
      data.anaemia == 1
        ? $("#e-Anaemia").attr("checked", "checked")
        : $("#e-Anaemia").prop("checked", false);
      data.obstructed_labor == 1
        ? $("#e-Obstructed_Labor").attr("checked", "checked")
        : $("#e-Obstructed_Labor").prop("checked", false);
      data.PPH == 1
        ? $("#e-PPH").attr("checked", "checked")
        : $("#e-PPH").prop("checked", false);
      data.LSCS == 1
        ? $("#e-LSCS").attr("checked", "checked")
        : $("#e-LSCS").prop("checked", false);
      data.congenital_anamaly == 1
        ? $("#e-Congenital_Anamaly").attr("checked", "checked")
        : $("#e-Congenital_Anamaly").prop("checked", false);
      data.abortion == 1
        ? $("#e-Abortion").attr("checked", "checked")
        : $("#e-Abortion").prop("checked", false);
      data.others_1 == 1
        ? $("#e-Others").attr("checked", "checked")
        : $("#e-Others").prop("checked", false);
      data.tuberculosis == 1
        ? $("#e-Tuberculosis").attr("checked", "checked")
        : $("#e-Tuberculosis").prop("checked", false);
      data.hypertension == 1
        ? $("#e-Hypertension").attr("checked", "checked")
        : $("#e-Hypertension").prop("checked", false);
      data.heart_disease == 1
        ? $("#e-Heart_Disease").attr("checked", "checked")
        : $("#e-Heart_Disease").prop("checked", false);
      data.diabetes == 1
        ? $("#e-Diabetes").attr("checked", "checked")
        : $("#e-Diabetes").prop("checked", false);
      data.asthma == 1
        ? $("#e-Asthma").attr("checked", "checked")
        : $("#e-Asthma").prop("checked", false);
      data.other_2 == 1
        ? $("#e-Other").attr("checked", "checked")
        : $("#e-Other").prop("checked", false);
    },
  });
});
$("body").on("click", ".view-single-btn", function () {
  const id = $(this).attr("data-id");
  $("#editPatientBtn").attr("data-id", id);

  $.ajax({
    url: apiUrl + `?id=${id}`,
    type: "GET",
    success: function (res) {
      const data = JSON.parse(res).data;
      $("#v-name").val(data.name);
      $("#v-husband_name").val(data.husband_name);
      $("#v-aadhar").val(data.aadhar);
      $("#v-mobile").val(data.mobile);
      $("#v-address").val(data.address);
      $("#v-village").val(data.village);
      $("#v-lmp").val(data.lmp);
      $("#v-aasha").val(data.aasha);

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
$("body").on("click", "#export_data", function () {
  var from = $("#from").val();
  var to = $("#to").val();
  if (!to || !from) {
    $("#export_error").show();
    setTimeout(5000, () => {
      $("#export_error").hide();
    });
    return false;
  } else {
    window.open(`export.php?from=${from}&to=${to}`, "_blank");
  }
});
$("body").on("click", ".checkup", function () {
  if (window.confirm("Are You sure,to update the checkup")) {
    const id = $(this).attr("data-id");
    const field = $(this).attr("data-field");
    const value = $(this).is(":checked") ? 1 : 0;
    console.log(id, field, value);
    const formData = { id, field, value };
    $.ajax({
      url: apiUrl,
      type: "POST",
      data: formData,
      success: function (res) {
        console.log(res);
      },
    });
  } else return false;
});

// for preventing relsubmissions of from
if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
