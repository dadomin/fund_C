class Login {
	constructor(){
		let app = new App();

		let email = document.querySelector(".login-email");
		let pass = document.querySelector(".login-pass");

		email.addEventListener("focusout", (e)=>{
			app.checkNull(e.target, "이메일이");
		});

		pass.addEventListener("focusout", (e)=>{
			app.checkNull(e.target, "비밀번호가");
		});

		document.querySelector(".login-done").addEventListener("click",(e)=>{
			app.checkNull(email, "이메일이");
			app.checkNull(pass, "비밀번호가");

			let ep = e.target.parentNode;
			let warning = ep.getElementsByClassName("warning");
			if(warning.length == 0){
				app.toast("로그인 성공");
				document.querySelector(".login-ok").click();
			}
		});	
	}
}

window.addEventListener("load", ()=>{
	let login = new Login();
})