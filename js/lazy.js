function donate_image_lazy_load() {
    let elem = document.getElementById("modal-body-74921");
    str = elem.innerHTML;
    if (str[0] != "<") {
        elem.innerHTML = "<img src=" + str + " style=\"width: 100%; height: auto;\">";
    }
}