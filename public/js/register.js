class Register {
	constructor(){
		let app = new App();

		let email = document.querySelector(".register-email");
		let nick = document.querySelector(".register-nick");
		let pass = document.querySelector(".register-pass");
		let repass = document.querySelector(".register-repass");

		email.addEventListener("focusout", (e)=>{
			app.checkEmail(e.target);
		});
		nick.addEventListener("focusout", (e)=>{
			app.checkNull(e.target, "이름이");
		});
		pass.addEventListener("focusout", (e)=>{
			app.checkPass(e.target);
		});
		repass.addEventListener("focusout",(e)=>{
			app.checkRepass(e.target, pass);
		});

		document.querySelector(".register-done").addEventListener("click",(e)=>{
			app.checkEmail(email);
			app.checkNull(nick, "이름이");
			app.checkPass(pass);
			app.checkRepass(repass, pass);

			let ep = e.target.parentNode;
			let warning = ep.getElementsByClassName("warning");
			if(warning.length == 0){
				app.toast("회원가입 성공");
				document.querySelector(".register-ok").click();
			}
		});		
	}
}

window.addEventListener("load", ()=>{
	let register = new Register();
})