

    var today = new Date();
    var day = today.getDate();
    var month = today.getMonth() + 1; // Os meses começam em 0 (janeiro), então somamos 1.
    var year = today.getFullYear();

    if (day < 10) {
        day = "0" + day;
    }

    if (month < 10) {
        month = "0" + month;
    }

    var formattedDate = year + "-" + month + "-" + day;

    document.getElementById("dataAtual").value = formattedDate;

