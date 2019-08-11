class Adapt {
	constructor(){ 

		let app = new App();

		// 펀드번호
		let num = parseInt(fund_cnt) + 1;
		num = "000" + num;
		num = "A" + num.substring(num.length, num.length-4);
		document.querySelector(".adapt-number").value = num;

		let name = document.querySelector(".adapt-name");
		let endDate = document.querySelector(".adapt-endDate");
		let total = document.querySelector(".adapt-total");
		let des = document.querySelector(".adapt-des");
		let file = document.querySelector(".adapt-file");

		name.addEventListener("focusout", (e)=>{
			app.checkword(e.target, "창업펀드명이");
		});
		endDate.addEventListener("focusout", (e)=>{
			app.checkDate(e.target, "모집마감일이");
		});
		total.addEventListener("focusout", (e)=>{
			app.checkNum(e.target, "모집금액이");
		});
		des.addEventListener("focusout", (e)=>{
			app.checkDes(e.target);
		});
		file.addEventListener("change", (e)=>{
			app.checkFile(e.target);
		});

		document.querySelector(".adapt-done").addEventListener("click", (e)=>{
			app.checkword(name, "창업펀드명이");
			app.checkDate(endDate, "모집마감일이");
			app.checkNum(total, "모집금액이");
			app.checkDes(des);
			app.checkNull(file, "펀드이미지가");
			let ep = e.target.parentNode;
			console.log(ep);
			let warning = ep.getElementsByClassName("warning");
			if(warning.length == 0){
				app.toast("펀드를 성공적으로 등록하였습니다.");
				ep.querySelector(".adapt-ok").click();
			}
		});
	}
}

window.addEventListener("load", ()=>{
	let adapt = new Adapt();
})