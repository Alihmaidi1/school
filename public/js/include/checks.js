let selectAll = document.getElementById("box2");
let checks = document.getElementsByClassName("box1");
let btn_delete_row = document.getElementById("btn_delete_row");
let id_all = document.getElementById("id_all");

selectAll.onchange = function() {

    if (selectAll.checked == true) {

        for (var i = 0; i < checks.length; i++) {

            checks[i].checked = true;
            id_all.value += checks[i].value + ",";
            btn_delete_row.removeAttribute("disabled")

        }

    } else {

        for (var i = 0; i < checks.length; i++) {

            checks[i].checked = false;
            id_all.value = "";
            btn_delete_row.setAttribute("disabled", true);

        }



    }


}
count_checked = 0;
for (let i = 0; i < checks.length; i++) {

    checks[i].onchange = function() {
        id_all.value = "";
        if (checks[i].checked == true) {
            count_checked++;
            for (let j = 0; j < checks.length; j++) {

                if (checks[j].checked == true) {

                    id_all.value += checks[j].value + ",";

                }



            }



            btn_delete_row.removeAttribute("disabled");

        } else {

            count_checked--;
            if (count_checked == 0) {

                btn_delete_row.setAttribute("disabled", true);

            }

        }


    }




}