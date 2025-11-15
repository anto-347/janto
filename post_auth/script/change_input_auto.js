const input1_field = document.getElementById("jour-d");
const input2_field = document.getElementById("jour-u");
const input3_field = document.getElementById("mois-d");
const input4_field = document.getElementById("mois-u");
const input5_field = document.getElementById("année-m");
const input6_field = document.getElementById("année-c");
const input7_field = document.getElementById("année-d");
const input8_field = document.getElementById("année-u");

const bouton = document.getElementById("submit-btn");

input1_field.addEventListener('input', () => {
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

    if (
        input1 == "" &&
        input1_field.classList.contains("filled")
    ) {
        input1_field.classList.remove("filled");
    }
})

input2_field.addEventListener('input', () => {
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

    if (
        input2 == "" &&
        input2_field.classList.contains("filled")
    ) {
        input2_field.classList.remove("filled");
    } 
})

input3_field.addEventListener('input', () =>{
    const input3 = input3_field.value;
    const restrictions_ipt3 = input3 === "0" || input3 === "1";

    if (
        input2_field.classList.contains("filled") &&
        input3 !== "" &&
        restrictions_ipt3
    ) {
        input4_field.focus();
        input3_field.classList.add("filled");
    } else {
        if (!restrictions_ipt3) {
            input3_field.value = "";
        }
    }

    if (
        input3 == "" && 
        input3_field.classList.contains("filled")
    ) {
        input3_field.classList.remove("filled");
    }
})

input4_field.addEventListener('input', () => {
    const input4 = input4_field.value;
    const restrictions_ipt4 = /\d/.test(input4);

    if (
        input3_field.classList.contains("filled") &&
        input4 !== "" &&
        restrictions_ipt4
    ) {
        input5_field.focus();
        input4_field.classList.add("filled");
    } else {
        if (!restrictions_ipt4) {
            input4_field.value = "";
        }
    }

    if (
        input4 == "" &&
        input4_field.classList.contains("filled")
    ) {
        input4_field.classList.remove("filled");
    }
})

input5_field.addEventListener('input', () => {
    const input5 = input5_field.value;
    const restrictions_ipt5 = input5 === "1" || input5 === "2";

    if (
        input4_field.classList.contains("filled") &&
        input5 !== "" &&
        restrictions_ipt5
    ) {
        input6_field.focus();
        input5_field.classList.add("filled");
    } else {
        if (!restrictions_ipt5) {
            input5_field.value = "";
        }
    }

    if (
        input5 == "" &&
        input5_field.classList.contains("filled")
    ) {
        input5_field.classList.remove("filled");
    }
})

input6_field.addEventListener('input', () => {
    const input6 = input6_field.value;
    const restrictions_ipt6 = input6 === "0" || input6 === "9";

    if (
        input5_field.classList.contains("filled") &&
        input6 !== "" &&
        restrictions_ipt6
    ) {
        input7_field.focus();
        input6_field.classList.add("filled");
    } else {
        if (!restrictions_ipt6) {
            input6_field.value = "";
        }
    }

    if (
        input6 == "" &&
        input6_field.classList.contains("filled")
    ) {
        input6_field.classList.remove("filled");
    }
})

input7_field.addEventListener('input', () => {
    const input7 = input7_field.value;
    const restrictions_ipt7 = /\d/.test(input7);

    if (
        input6_field.classList.contains("filled") &&
        input7 !== "" &&
        restrictions_ipt7
    ) {
        input8_field.focus();
        input7_field.classList.add("filled");
    } else {
        if (!restrictions_ipt7) {
            input7_field.value = "";
        }
    }

    if (
        input7 == "" &&
        input7_field.classList.contains("filled")
    ) {
        input7_field.classList.remove("filled");
    }
})

input8_field.addEventListener('input', () => {
    const input8 = input8_field.value;
    const restrictions_ipt8 = /\d/.test(input8);

    if (
        input7_field.classList.contains("filled") &&
        input8 !== "" &&
        restrictions_ipt8
    ) {
        input8_field.blur();
        bouton.classList.add("clic");
        input8_field.classList.add("filled");
    } else {
        if (!restrictions_ipt8) {
            input8_field.value = "";
        }
    }

    if (
        input8 == "" &&
        input8_field.classList.contains("filled")
    ) {
        input8_field.classList.remove("filled");
    }
})

document.addEventListener('keydown', (e) => {
    if (e.key === 'Backspace') {
        delete_car();
    }
})

bouton.addEventListener('click', (e) => {
    if (!bouton.classList.contains("clic")) {
        e.preventDefault();
    }
})