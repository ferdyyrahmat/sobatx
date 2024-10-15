let uploadButton = document.getElementById("file-input");
let uploadButton2 = document.getElementById("file-input2");
let uploadButton3 = document.getElementById("file-input3");

let chosenImage = document.getElementById("chosen-image");
let chosenImage2 = document.getElementById("chosen-image2");
let chosenImage3 = document.getElementById("chosen-image3");

let modalImage1 = document.getElementById("modal-image1");
let modalImage2 = document.getElementById("modal-image2");
let modalImage3 = document.getElementById("modal-image3");

let fileName = document.getElementById("file-name");
let fileName2 = document.getElementById("file-name2");
let fileName3 = document.getElementById("file-name3");

uploadButton.onchange = function () {
    let reader1 = new FileReader();
    reader1.readAsDataURL(uploadButton.files[0]);
    reader1.onload = function () {
        chosenImage.setAttribute("src", reader1.result);
        modalImage1.setAttribute("src", reader1.result);
    };
    fileName.textContent = uploadButton.files[0].name;

}
uploadButton2.onchange = function () {
    let reader = new FileReader();
    reader.readAsDataURL(uploadButton2.files[0]);
    reader.onload = function () {
        chosenImage2.setAttribute("src", reader.result);
        modalImage2.setAttribute("src", reader.result);
    };
    fileName2.textContent = uploadButton2.files[0].name;

}
uploadButton3.onchange = function () {
    let reader = new FileReader();
    reader.readAsDataURL(uploadButton3.files[0]);
    reader.onload = function () {
        chosenImage3.setAttribute("src", reader.result);
        modalImage3.setAttribute("src", reader.result);
    };
    fileName3.textContent = uploadButton3.files[0].name;

}