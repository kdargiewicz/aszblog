// skrypt obsugujacy zakładki na górze formularza w cms -> edycja dodanie arta
document.querySelectorAll('.tablink').forEach(button => {
    button.addEventListener('click', function (e) {
        const tabName = this.dataset.tab;
        openTab(e, tabName);
    });
});

function openTab(evt, tabName) {
    const x = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }

    const tablinks = document.getElementsByClassName("tablink");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("w3-light-blue");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.add("w3-light-blue");
}
