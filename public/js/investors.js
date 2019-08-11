class Investors {
	constructor(){
		let app = new App();

		this.invlist = investor_list;

		let form = document.querySelector(".investors");
		this.invlist.forEach((x)=>{
			let div = document.createElement("div");
			div.classList.add("investor");
			let name = app.check(x.name, 11);
			let pay = parseInt(x.pay).toLocaleString();
			div.innerHTML = `
				<div>${x.number}</div>
				<div>${name}</div>
				<div><a href="/profile?email=${x.email}" class="a">${x.nickname}</a></div>
				<div>${pay}원</div>
				<div><canvas width="120" height="30"></canvas>${Math.floor(x.pay / x.total * 100)}%</div>
				<div>${x.datetime}</div>
			`;
			let canvas = div.querySelector("canvas");
			app.makeLine(canvas, x);
			form.append(div);
		});
	}
}

window.addEventListener("load", ()=>{
 	let investors = new Investors();
});