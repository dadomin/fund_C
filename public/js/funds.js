class Funds {
	constructor(){
		let app = new App();

		this.fundlist = fund_list;
		this.investlist = invest_list;
		this.user = user;

		let form = document.querySelector(".fund-form");
		this.fundlist.forEach((x)=>{
			let div = document.createElement("div");
			div.classList.add("fund");
			div.innerHTML = this.fundTemp(x, app);
			if(new Date(x.endDate) < new Date()){
				div.querySelector(".fund-status").innerHTML = "모집완료";
			}
			form.append(div);
			let canvas = div.querySelector("canvas");
			app.makeGraph(canvas, x);
			div.querySelector(".go-look").addEventListener("click", ()=>{
				this.makePopup(x, app);
			});
			div.querySelector(".go-fund").addEventListener("click", ()=>{
				this.makeFundup(x, app);
			});
		});
	}

	fundTemp(x, app) {
		let name = app.check(x.name, 40);
		let total = parseInt(x.total).toLocaleString();
		let current = parseInt(x.current).toLocaleString();
		let owner = app.check(x.owner, 40);
		let temp = `
			<div class="fund-title">
				<h3>${x.number}</h3>
				<h2>${name}</h2>
				<div class="fund-status">모집중</div>
			</div>
			<div class="fund-views">
				<canvas width="220" height="220"></canvas>
				<div class="fund-notice">
					<div>
						<h3>모집마감일</h3>
						<div class="line50"></div>
						<p>${x.endDate}</p>
					</div>
					<div>
						<h3>모집금액</h3>
						<div class="line50"></div>
						<p>${total}원</p>
					</div>
					<div>
						<h3>현재금액</h3>
						<div class="line50"></div>
						<p>${current}원</p>
					</div>
					<div>
						<h3>펀드등록자</h3>
						<div class="line50"></div>
						<p>${owner}</p>
					</div>
				</div>
			</div>
			<div class="fund-btns">
				<button class="go-fund">투자하기</button>
				<button class="go-look">상세보기</button>
			</div>
		`;

		return temp;
	}

	makeFundup(x, app) {
		app.drawed = false;
		app.signStatus = true;
		let back = document.createElement("div");
		back.classList.add("back");
		back.innerHTML = this.fundupTemp(x, this.user);
		document.querySelector("body").append(back);
		$(".pop").on("click", ()=>{
			app.remove(back);
		});
		$(".close-pop").on("click",()=>{
			app.remove(back);
		});
		$(".fundup-cancel").on("click", ()=>{
			app.remove(back);
		});
		$(".sign-thin").on("click",()=>{
			app.signStatus = true;
		});
		$(".sign-bold").on("click", ()=>{
			app.signStatus = false;
		});
		$("canvas").on("mousedown", (e)=>{
			app.prevX = e.offsetX;
			app.prevY = e.offsetY;
			app.drawing = true;
		});
		$("canvas").on("mousemove", (e)=>{
			if(app.drawing == true){
				app.drawSign(e.target, e.offsetX, e.offsetY, app.signStatus);
				app.prevX = e.offsetX;
				app.prevY = e.offsetY;
			}
		});
		$("canvas").on("mouseup", (e)=>{
			app.drawing = false;
		});
		$(".fundup-email").on("focusout", (e)=>{
			app.checkword(e.target, "투자자명이");
		});
		$(".fundup-pay").on("focusout", (e)=>{
			app.checkNum(e.target, "투자금액이");
		});
		$(".fundup-done").on("click", (e)=>{
			let ep = e.target.parentNode.parentNode;
			let email = ep.querySelector(".fundup-email");
			let pay = ep.querySelector(".fundup-pay");
			let canvas = ep.querySelector("canvas");
			app.checkword(email, "투자자명이");
			app.checkNum(pay, "투자금액이");
			app.checkSign(canvas);
			let warning = ep.getElementsByClassName("warning");
			if(warning.length == 0){
				app.toast("해당펀드에 성공적으로 투자되었습니다."); 
				app.remove(ep.parentNode);
			}
		});
	}

	fundupTemp(x, u){
		let temp = `
			<div class="pop"></div>
			<div class="up">
				<span class="close-pop">&times</span>
				<div class="up-box">
					<div class="up-left">펀드번호</div>
					<span>${x.number}</span>
				</div>
				<div class="up-box">
					<div class="up-left">창업펀드명</div>
					<span>${x.name}</span>
				</div>
				<div class="up-box">
					<div class="up-left">투자자명</div>
					<input type="text" value="${u.nickname}" class="fundup-email" disabled readonly/>
				</div>
				<div class="up-box">
					<div class="up-left">투자금액</div>
					<input type="number" class="fundup-pay" />
				</div>
				<div class="up-box">
					<div class="up-left">서명란</div>
					<div class="up-right">
						<canvas width="250" height="100"></canvas>
						<div class="up-right-btns">
							<button class="sign-thin">얇게</button>
							<button class="sign-bold">굵게</button>
						</div>
					</div>
				</div>
				<div class="up-btns">
					<button class="fundup-done">투자</button>
					<button class="fundup-cancel">취소</button>
				</div>
			</div>
		`;
		return temp;
	}

	makePopup(x, app) {
		let back = document.createElement("div");
		back.classList.add("back");
		back.innerHTML = this.popupTemp(x);
		let form = back.querySelector(".up-inv-form");
		let i = this.investlist.filter(e=> e.number == x.number);
		this.makePopInv(form, i);
		document.querySelector("body").append(back);
		$(".pop").on("click", ()=>{
			app.remove(back);
		});
		$(".close-pop").on("click",()=>{
			app.remove(back);
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
					<span><a href="/profile?email${x.cnt}" class="a">${x.nick}</a></span>
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
}

window.addEventListener("load", ()=>{
	let funds = new Funds();
})