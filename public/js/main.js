class Main {
	constructor() {
		let app = new App();

		this.highlist = fund_list;
		
		let form = document.querySelector(".ranking-form");
		for(let i = 0; i < 4; i++){
			let div = document.createElement("div");
			div.classList.add("ranking");
			div.innerHTML = this.mainRanking(this.highlist[i], app);
			let canvas = div.querySelector("canvas");
			app.makeGraph(canvas, this.highlist[i]);
			form.append(div);
			let btn = div.querySelector("button");
			btn.addEventListener("click", ()=>{
				this.makePopup(this.highlist[i]);	
			});
		}
	}

	mainRanking(x, app) {
		console.log(x);
		let name = app.check(x.name, 13);
		let current = parseInt(x.current).toLocaleString();
		let temp = `
			<canvas width="240" height="200"></canvas>
			<h3>${x.number}</h3>
			<h2>${name}</h2>
			<div class="rank-div">
				<div class="rank-left">달성율</div>
				<span>${x.current / x.total * 100}%</span>
			</div>
			<div class="rank-div">
				<div class="rank-left">모집마감일</div>
				<span>${x.endDate}</span>
			</div>
			<div class="rank-div">
				<div class="rank-left">현재금액</div>
				<span>${current}원</span>
			</div>
			<button>상세보기</button>
		`;
		return temp;
	}

	makePopup(x) {
		let back = document.createElement("div");
		back.classList.add("back");
		back.innerHTML = this.popupTemp(x);
		let form = back.querySelector(".up-inv-form");
		let i = invest_list.filter(e => e.fundnumber == x.number);
		this.makePopInv(form, i);
		document.querySelector("body").append(back);
		$(".pop").on("click", ()=>{
			this.remove(back);
		});
		$(".close-pop").on("click",()=>{
			this.remove(back);
		});
	}

	makePopInv(form, i) {
		for(let j = 0; j < i.length; j++){
			let div = document.createElement("div");
			div.classList.add("up-inv");
			let pay = parseInt(i[j].pay).toLocaleString();
			div.innerHTML = `
				<div>${i[j].email}</div>
				<div>${pay}원</div>
			`
			form.append(div);
		}
	}

	popupTemp(x) {
		let total = parseInt(x.total).toLocaleString();
		let current = parseInt(x.current).toLocaleString();
		let temp = `
			<div class="pop"></div>
			<div class="up">
				<span class="close-pop">&times;</span>
				<div class="up-box">
					<div class="up-left">펀드번호</div>
					<span>${x.number}</span>
				</div>
				<div class="up-box">
					<div class="up-left">창업펀드명</div>
					<span>${x.name}</span>
				</div>
				<div class="up-box">
					<div class="up-left">모집마감일</div>
					<span>${x.endDate}</span>
				</div>
				<div class="up-box">
					<div class="up-left">모집금액</div>
					<span>${total}원</span>
				</div>
				<div class="up-box">
					<div class="up-left">현재금액</div>
					<span>${current}원</span>
				</div>
				<div class="up-box">
					<div class="up-left">펀드등록자</div>
					<span><a href="/profile?email=${x.cnt}" class="a">${x.nick}</a></span>
				</div>
				<div class="up-inv-title">
					<h3>투자자목록</h3>
					<div class="line100"></div>
				</div>
				<div class="up-inv-form">

				</div>
			</div>
		`;
		return temp;
	}

	remove(e) {
		e.parentNode.removeChild(e);
	}

}

window.addEventListener("load", ()=>{
	let main = new Main();
});