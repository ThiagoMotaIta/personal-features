// Changes city according to state selected
$('#state').on('change', function(event) {
    
    $('#city').html("<option value=''>Select One</option>");
    $('#city').removeAttr("disabled");

    if ($('#state').val() == "SP"){
        $("#city").append("<option value='Santos'>Santos</option>");
        $("#city").append("<option value='Bauru'>Bauru</option>");
    }

    if ($('#state').val() == "RJ"){
        $("#city").append("<option value='Rio de Janeiro'>Rio de Janeiro</option>");
        $("#city").append("<option value='Angra dos Reis'>Angra dos Reis</option>");
    }

    if ($('#state').val() == "CE"){
        $("#city").append("<option value='Fortaleza'>Fortaleza</option>");
        $("#city").append("<option value='Caucaia'>Caucaia</option>");
    }

});


// Changes city according to state selected on edit mode
$('#stateEdit').on('change', function(event) {
    
    $('#cityEdit').html("<option value=''>Select One</option>");

    if ($('#stateEdit').val() == "SP"){
        $("#cityEdit").append("<option value='Santos'>Santos</option>");
        $("#cityEdit").append("<option value='Bauru'>Bauru</option>");
    }

    if ($('#stateEdit').val() == "RJ"){
        $("#cityEdit").append("<option value='Rio de Janeiro'>Rio de Janeiro</option>");
        $("#cityEdit").append("<option value='Angra dos Reis'>Angra dos Reis</option>");
    }

    if ($('#stateEdit').val() == "CE"){
        $("#cityEdit").append("<option value='Fortaleza'>Fortaleza</option>");
        $("#cityEdit").append("<option value='Caucaia'>Caucaia</option>");
    }

});


// Initiates clients array
var formFields = [];

// Validates Add new Client from Main FORM
function validateForm(){

    var validated = true;

    if ($("#name").val() == ""){
        $("#name").css("border", "1px solid red");
        validated = false;
    } else {
        $("#name").removeAttr("style");
    }

    if ($("#cpf").val() == ""){
        $("#cpf").css("border", "1px solid red");
        validated = false;
    } else {
        $("#cpf").removeAttr("style");
    }

    if ($("#birth-date").val() == ""){
        $("#birth-date").css("border", "1px solid red");
        validated = false;
    } else {
        $("#birth-date").removeAttr("style");
        var formDateCad = $("#birth-date").val().split("/");
        var dayCad = formDateCad[0];
        var monthCad = formDateCad[1];

        if (dayCad > 31 || monthCad > 12){
            $("#birth-date").css("border", "1px solid red");
            validated = false;
        } else {
            $("#birth-date").removeAttr("style");
        }
    }    


    if ($("#state").val() == ""){
        $("#state").css("border", "1px solid red");
        validated = false;
    } else {
        $("#state").removeAttr("style");
    }


    if ($("#city").val() == ""){
        $("#city").css("border", "1px solid red");
        validated = false;
    } else {
        $("#city").removeAttr("style");
    }

    // If everything is ok, go one
    if (validated){

        var client = {
            id: formFields.length + 1,
            name: $("#name").val(),
            cpf: $("#cpf").val(),
            birth: $("#birth-date").val(),
            state: $("#state").val(),
            city: $("#city").val(),
        }

        formFields.push(client);
        console.log(formFields);

        $("#msn").removeAttr("class");
        $("#msn").attr("class", "alert alert-success alert-dismissible fade show");
        $("#msn").html("Client successfuly added!");
        $("#msn").append("<button type='button' class='close' onclick='desmissAlert()'><span aria-hidden='true'>&times;</span></button>");

        listAllClients();
        document.getElementById("formClients").reset();
        $("#name").focus();
        $("#city").attr("disabled", "disabled");

    } else {
        $("#msn").removeAttr("class");
        $("#msn").attr("class", "alert alert-danger alert-dismissible fade show");
        $("#msn").html("Please, verify red bordered field(s)");
        $("#msn").append("<button type='button' class='close' onclick='desmissAlert()'><span aria-hidden='true'>&times;</span></button>");
    }

}


// Lists all clients from Array
function listAllClients(){

    $("#clients-table").html("");
    $("#clients-table").append(" <thead style='background-color: #ccc;'><tr><th>FULL NAME</th> <th>ID</th> <th>BIRTH</th>"+
                                "<th>AGE</th> <th>STATE</th> <th>CITY</th> <th>EDIT</th> <th>DELETE</th></tr></thead>")

    if (formFields.length > 0){

        for (let i = 0; i < formFields.length; i++) {

        var formDate = formFields[i].birth.split("/");
        var newDate = formDate[2]+"/"+formDate[1]+"/"+formDate[0];
 
         $("#clients-table").append("<tr><td>"+formFields[i].name+"</td> <td>"+formFields[i].cpf+"</td> <td>"+formFields[i].birth+"</td>"+
                                "<td>"+getAge(newDate)+"</td> <td>"+formFields[i].state+"</td> <td>"+formFields[i].city+"</td>"+ 
                                "<td align='center'><a href='#' onclick='editItemModal("+formFields[i].id+")'><img src='img/icon-2.svg'></a></td> <td align='center'><a href='#' onclick='deleteItem("+formFields[i].id+")'><img src='img/icon-1.svg'></a></td></tr>");

        }

    }

}


// Calculates age according to form birth date filled
function getAge(dateString) {
    const today = new Date();
    const birthDate = new Date(dateString);
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    return age;
}


// Closes modal
function desmissAlert(){
    $("#msn").removeAttr("class");
    $("#msn").html("");
}



// Deleting a item from array
function deleteItem(id) {
  var i = 0;
  while (i <= formFields.length) {
    if (formFields[i].id === id) {
        $("#msn").removeAttr("class");
        $("#msn").attr("class", "alert alert-success alert-dismissible fade show");
        $("#msn").html("Client <strong>"+formFields[i].name+"</strong> successfuly deleted!");
        $("#msn").append("<button type='button' class='close' onclick='desmissAlert()'><span aria-hidden='true'>&times;</span></button>");
        formFields.splice(i, 1);

        if (formFields.length > 0){
            listAllClients();
        } else {
            $("#clients-table").html("");
        }
    } else {
      ++i;
    }
  }
  
}


// Calling modal with edit Form
function editItemModal(id){

    $('#editClientModal').modal('show');

    var newArray = formFields.filter((item) => item.id === id);
            
    $("#nameEdit").val(newArray[0].name);
    $("#cpfEdit").val(newArray[0].cpf);
    $("#birth-dateEdit").val(newArray[0].birth);
    $("#stateEdit").val(newArray[0].state);

    if ($('#stateEdit').val() == "SP"){
        $("#cityEdit").append("<option value='Santos'>Santos</option>");
        $("#cityEdit").append("<option value='Bauru'>Bauru</option>");
    }

    if ($('#stateEdit').val() == "RJ"){
        $("#cityEdit").append("<option value='Rio de Janeiro'>Rio de Janeiro</option>");
        $("#cityEdit").append("<option value='Angra dos Reis'>Angra dos Reis</option>");
    }

    if ($('#stateEdit').val() == "CE"){
        $("#cityEdit").append("<option value='Fortaleza'>Fortaleza</option>");
        $("#cityEdit").append("<option value='Caucaia'>Caucaia</option>");
    }

    $("#cityEdit").val(newArray[0].city);

    $("#tbn-edit-client").removeAttr("onclick");
    $("#tbn-edit-client").attr("onclick", "editItem("+id+")");

}


// Updates the values of a item
function editItem(id) {

  var validated = true;

    if ($("#nameEdit").val() == ""){
        $("#nameEdit").css("border", "1px solid red");
        validated = false;
    } else {
        $("#nameEdit").removeAttr("style");
    }

    if ($("#cpfEdit").val() == ""){
        $("#cpfEdit").css("border", "1px solid red");
        validated = false;
    } else {
        $("#cpfEdit").removeAttr("style");
    }

    if ($("#birth-dateEdit").val() == ""){
        $("#birth-dateEdit").css("border", "1px solid red");
        validated = false;
    } else {
        $("#birth-dateEdit").removeAttr("style");
        var formDateEdit = $("#birth-dateEdit").val().split("/");
        var dayEdit = formDateEdit[0];
        var monthEdit = formDateEdit[1];

        if (dayEdit > 31 || monthEdit > 12){
            $("#birth-dateEdit").css("border", "1px solid red");
            validated = false;
        } else {
            $("#birth-dateEdit").removeAttr("style");
        }
    }


    if ($("#stateEdit").val() == ""){
        $("#stateEdit").css("border", "1px solid red");
        validated = false;
    } else {
        $("#stateEdit").removeAttr("style");
    }  


    if (validated){
        
          for (var i = 0; i < formFields.length; i++) {
              if (formFields[i].id === id) {
                
                $('#editClientModal').modal('hide');

                formFields[i].name = $("#nameEdit").val();
                formFields[i].cpf = $("#cpfEdit").val();
                formFields[i].birth = $("#birth-dateEdit").val();
                formFields[i].state = $("#stateEdit").val();
                formFields[i].city = $("#cityEdit").val();

                $("#msn").removeAttr("class");
                $("#msn").attr("class", "alert alert-success alert-dismissible fade show");
                $("#msn").html("Client <strong>"+formFields[i].name+"</strong> successfuly updated!");
                $("#msn").append("<button type='button' class='close' onclick='desmissAlert()'><span aria-hidden='true'>&times;</span></button>");
                

                listAllClients();
            }
          }
    }
  
}


// Validates CPF
function validateCPF(cpf) {  
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)      
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)       
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}