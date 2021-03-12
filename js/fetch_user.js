setInterval(() => {
    function fetchUser(){
      const usersCont = $("#users-cont");
      const searchinp = document.querySelector("#searchinp");
      const statuscont = 

      $.ajax({
          url:"logic/users.php",
          method: "post",
          dataType:"text",
          data:{
              fetchUser: "fetchUser",
          },
          success:(data, status)=>{
              if(status = "200"){
                  if(!searchinp.classList.contains("is-searched")){
                    usersCont.html(data);
                  }
              }else{
                  console.log("Nothing to show");
              }
          }
      });
    }
    fetchUser()
},1000);




function searchUsers(){
    const usersCont = $("#users-cont");
    const searcherr = $("#search-error");
    const searchinp = $("#searchinp");

    searchinp.on("input", (e)=>{
        let searchval = searchinp.val();
        if(searchval != ""){
          searchinp.addClass("is-searched");
        }else{
          searchinp.removeClass("is-searched")
        }
        $.ajax({
          url: "logic/search_users.php",
          method: "post",
          dataType: "text",
          data: {
            searchUsers: "searchUsers",
            searchinp: searchinp.val(),
          },
          success: (data, status) => {
            if (data) {
              usersCont.html(data);
            }
            else if (!data) {
              console.log(data);
              searcherr.html(data);
            }
          },
        });
    })
}

searchUsers();



