const input1_field = document.getElementById("jour-d");
const input2_field = document.getElementById("jour-u");
const input3_field = document.getElementById("mois-d");
const input4_field = document.getElementById("mois-u");
const input5_field = document.getElementById("année-m");
const input6_field = document.getElementById("année-c");
const input7_field = document.getElementById("année-d");
const input8_field = document.getElementById("année-u");

const bouton = document.getElementById("submit-btn");

input1_field.addEventListener('input', function() {
    const input1 = input1_field.value;
    const restrictions_ipt1 = input1 === "0" || input1 === "1" || input1 === "2" || input1 === "3";

    if (
        input1 !== "" &&
        restrictions_ipt1
    ) {
        input2_field.focus();
        input1_field.classList.add("filled");
    } else {
        if (!restrictions_ipt1) {
            input1_field.value = "";
        }
    }

    if (input1 == "") {
        input1_field.classList.remove("filled");
    }
})

input2_field.addEventListener('input', function() {
    const input2 = input2_field.value;
    const restrictions_ipt2 = /\d/.test(input2);

    if (
        input1_field.classList.contains("filled") && 
        input2 !== "" &&
        restrictions_ipt2
    ) {
        input3_field.focus();
        input2_field.classList.add("filled");
    } else {
        if (!restrictions_ipt2) {
            input2_field.value = "";
        }
    }

    if (input2 == "") {
        input2_field.classList.remove("filled");
    } 
})

document.addEventListener('keydown', function(e) {
    if (e.key === 'Delete') {
        
    }
})