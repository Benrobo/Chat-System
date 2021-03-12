let chatCont = document.querySelector(".chat-msg");
let errovl = $(".chat-msg-ovl");
let incoming_id = $("#incoming_id_inp");
let chatInp = $("#send-msg-inp");
let subbtn = $("#send-btn");
let incoming_msg = $("#chat-msg");


chatCont.onmouseenter = ()=>{
  chatCont.classList.add("active");
}

chatCont.onmouseleave = () => {
  chatCont.classList.remove("active");
};

let fetchmsgfunc = setInterval(() => {
  $.ajax({
    url: "logic/messages.php",
    method: "post",
    dataType: "text",
    data: {
      fetch_msg: "true",
      incoming_id: incoming_id.val(),
    },
    success: (data, stat) => {
      if (data == "Null") {
        errovl.show();
        errovl.css("display", "flex");
      } else if (data) {
          errovl.hide();
          errovl.css("display", "none");
          chatCont.innerHTML = data;
        if (!chatCont.classList.contains("active")) {
          scrollmsg();
        }
      }
    }
  });
}, 500);


let sendbtn = document.querySelector("#send-btn");
subbtn.on("click", (e) => {
    e.preventDefault();

    if (chatInp.val() == "") {
        alert("Input cannot be empty");
        return false;
    } else {
        $.ajax({
          url: "logic/insert_msg.php",
          method: "post",
          dataType: "text",
          data: {
          insert_data: "true",
          user_inp: chatInp.val(),
          incoming_id: incoming_id.val(),
          },
          success: (data, stat) => {
          chatInp.val("");
            scrollmsg();
          },
        });
    }
});

function scrollmsg() {
  chatCont.scrollTop = chatCont.scrollHeight;
}
