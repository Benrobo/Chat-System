function uploadImg(){
    let uploadForm = document.querySelector("#upload_form");
    let file = document.querySelector("#hidden_file");
    let uploaderr = document.querySelector(".upload_err");
    // let filebtn = document.querySelector("#file_choose_btn");
    let fileuploadbtn = document.querySelector("#file_upload_btn");
    // let fileval = document.querySelector(".fileval");
    let imgpreview = document.querySelector("#img-preview");

    let crun = setInterval(()=>{

        if(file.value == ""){
            uploaderr.textContent = "Inputs cannot be empty";
            fileuploadbtn.setAttribute("disabled", true);
            fileuploadbtn.style.background = "#ccc";
            fileuploadbtn.style.color = "#000";
            return false;
        }
        else if(!fileuploadbtn.getAttribute("disabled")){
            clearInterval(crun);
        }
        else if(file.value){
            uploaderr.textContent = "";
            fileuploadbtn.removeAttribute("disabled");
            fileuploadbtn.style.background = "#122153";
            fileuploadbtn.style.color = "#fff";
            fileuploadbtn.addEventListener("click", (e)=>{
                e.preventDefault();

                let fd = new FormData();
                fd.append("file", file.files[0]);

                    $.ajax({
                    url: "logic/edit_image.php",
                    method: "post",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        switch (data) {
                        case "Invalid File":
                            uploaderr.textContent = "Invalid filetype";
                            break;
                        case "Large":
                            uploaderr.textContent = "File too large";
                            break;
                        case "Failure":
                            uploaderr.textContent = "File couldnt be uploaded";
                            break;
                        
                        case data:
                            imgpreview.src = data;
                            setTimeout(() => {
                                fileuploadbtn.setAttribute("disabled", true);
                                fileuploadbtn.style.background = "#ccc";
                                fileuploadbtn.style.color = "#000";
                                $("#upload_form").reset();
                                window.location.reload(true);
                            }, 1000);
                            break;
                        default:
                            console.log(data);
                            break;
                        }
                    },
                    });
            })   
        }
    }, 100)
}
uploadImg();

function uploadImage(){
  // Get the modal
  let modal = document.getElementById("myModal");

  // Get the button that opens the modal
  let btn = document.getElementById("formuploadbtn");

  // Get the <span> element that closes the modal
  let span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function () {
    modal.style.display = "block";
  };

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  };

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}
uploadImage();
