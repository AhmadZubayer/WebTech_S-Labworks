function loadData() {
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "AjaxTask.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);

            document.getElementById("result").innerHTML =
                "<strong>Name:</strong> " + data.name + "<br>" +
                "<strong>ID:</strong> " + data.id + "<br>" +
                "<strong>Department:</strong> " + data.department + "<br>" +
                "<strong>CGPA:</strong> " + data.cgpa;
        }
    };

    xhr.send();
}