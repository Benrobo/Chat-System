
function fileUpload() {
	const file = document.querySelector("#fileupload");
	let filebtn = document.querySelector("#fileupload-btn");
	let isclicked = false
	// let val = "";
	filebtn.addEventListener("click", async (e)=>{
		e.preventDefault();
		file.click();
		let val = await file.value;
		console.log(val);
	});

}
fileUpload()