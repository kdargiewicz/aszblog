document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");

    document.querySelectorAll("img:not(.no-modal)").forEach(function (img) {
        img.addEventListener("click", function () {
            modalImage.src = this.src;
            modal.style.display = "flex";
        });
    });

    modal.addEventListener("click", function () {
        modal.style.display = "none";
        modalImage.src = "";
    });
});
