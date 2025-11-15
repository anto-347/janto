function delete_car() {
    const element_focus = document.activeElement;
    const element_id = element_focus.id;

    const lst_ipt = [
        input1_field,
        input2_field,
        input3_field,
        input4_field,
        input5_field,
        input6_field,
        input7_field,
        input8_field
    ]

    console.log("in function");
    let after = false;

    for (let i = 0; i < lst_ipt.length; i++) {
        let ipt = lst_ipt[i];
        if (ipt.id === element_id) {
            var id_element = i;
            after = true;
        } else if (after) {
            if (ipt.classList.contains("filled")) {
                ipt.value = "";
                ipt.classList.remove("filled");
            }
        }
    }

    if (lst_ipt[id_element].classList.contains("filled")) {
        lst_ipt[id_element].classList.remove("filled");
    }
    lst_ipt[id_element].value = "";
    lst_ipt[id_element - 1].focus();

    if (bouton.classList.contains("clic")) {
        bouton.classList.remove("clic");
    }
}