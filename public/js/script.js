class App {
	constructor(){

		// 서명
		this.drawed = false;
		this.drawing = false;
		this.prevX = null;
		this.prevY = null;
		this.signStatus = true;

		this.navlist = document.querySelectorAll("#menubar > li > a");
		this.navlist2 = document.querySelectorAll("#login-menu > li > a");
		let now = window.location.href;
		now = now.substring(7, now.length);
		now = now.split("/")[1];
		this.navlist.forEach((e)=>{
			e.classList.remove("click");
			if(e.dataset.target == now){
				e.classList.add("click");
			}
		});
		this.navlist2.forEach((e)=>{
			e.classList.remove("click");
			if(e.dataset.target == now){
				e.classList.add("click");
			}
		});
		if(now == "") {
			document.querySelector("#menu-bar > li:nth-child(1) > a").classList.add("click");
		}
	}

	toast(msg) {
		let div = document.createElement("div");
		div.classList.add("toast");
		div.innerHTML = `
			<span class="toast-close">&times</span>
			<p>${msg}</p>
		`;
		document.querySelector("#toast-back").prepend(div);
		div.querySelector(".toast-close").addEventListener("click",()=>{
			this.remove(div);
		});
		setTimeout(()=>{
			this.remove(div);
		},3000)
	}

	check(v, l) {
		if(v.length > l){
			v = v.substring(0,l-1);
			v += "...";
		}
		return v;
	}

	remove(e) {
		e.parentNode.removeChild(e);
	}

	makePopup(x) {
		let back = document.createElement("div");
		back.classList.add("back");
		back.innerHTML = this.popupTemp(x);
		let form = back.querySelector(".up-inv-form");
		this.makePopInv(form, x.investorList);
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

	makeGraph(canvas, x) {
		let w = canvas.width;
		let h = canvas.height;
		let ctx = canvas.getContext("2d");
		let term = x.current / 45;
		let now = 0;

		let frame = setInterval(()=>{
			now += term;
			if(now >= x.current){
				now = x.current;
				clearInterval(frame);
			}
			this.drawGraph(ctx, now, w, h, x.total); 
		}, 1000/30);
	}

	drawGraph(ctx, now, w, h, total) {
		ctx.clearRect(0, 0, w, h);

		ctx.beginPath();
		ctx.moveTo(w/2, h/2);
		ctx.fillStyle = "#bddff0";
		ctx.arc(w/2, h/2, 90, -Math.PI*2, 3/2*Math.PI);
		ctx.fill();
		ctx.closePath();

		ctx.beginPath();
		ctx.moveTo(w/2, h/2);
		ctx.fillStyle = "#2292d1";
		ctx.arc(w/2, h/2, 90, -Math.PI/2, -Math.PI/2 + (now / total) * ( 2 * Math.PI));
		ctx.fill();
		ctx.closePath();

		ctx.beginPath();
		ctx.moveTo(w/2, h/2);
		ctx.fillStyle = "#fff";
		ctx.arc(w/2, h/2, 60, -Math.PI*2, 3/2*Math.PI);
		ctx.fill();
		ctx.closePath();

		let percent = Math.floor(now / total * 100);
		ctx.fillStyle = "#002758";
		ctx.font = "25px Arial";
		ctx.textAlign = "center";
		ctx.textBaseline = "middle";
		ctx.fillText(percent + "%", w/2, h/2);
	}

	makeLine(canvas, x) {
		let w = canvas.width;
		let h = canvas.height;
		let ctx = canvas.getContext("2d");
		let now = 0;
		let term = x.pay / 45;

		let frame = setInterval(()=>{
			now += term;
			if(now >= x.pay){
				now = x.pay;
				clearInterval(frame);
			}
			this.drawLine(ctx, w, h, now, x.total);
		}, 1000/30);
	}

	drawLine(ctx, w, h, now, total) {
		ctx.clearRect(0,0,w,h);

		ctx.fillStyle = "#bddff0";
		ctx.fillRect(0,0,w,h);

		ctx.fillStyle = "#2292d1";
		ctx.fillRect(0, 0, (now / total) * w,  h);
	}

	makeFundup(x) {
		this.drawed = false;
		this.signStatus = true;
		let back = document.createElement("div");
		back.classList.add("back");
		back.innerHTML = this.fundupTemp(x);
		document.querySelector("body").append(back);
		$(".pop").on("click", ()=>{
			this.remove(back);
		});
		$(".close-pop").on("click",()=>{
			this.remove(back);
		});
		$(".fundup-cancel").on("click", ()=>{
			this.remove(back);
		});
		$(".sign-thin").on("click",()=>{
			this.signStatus = true;
		});
		$(".sign-bold").on("click", ()=>{
			this.signStatus = false;
		});
		$("canvas").on("mousedown", (e)=>{
			this.prevX = e.offsetX;
			this.prevY = e.offsetY;
			this.drawing = true;
		});
		$("canvas").on("mousemove", (e)=>{
			if(this.drawing == true){
				this.drawSign(e.target, e.offsetX, e.offsetY, this.signStatus);
				this.prevX = e.offsetX;
				this.prevY = e.offsetY;
			}
		});
		$("canvas").on("mouseup", (e)=>{
			this.drawing = false;
		});
		$(".fundup-email").on("focusout", (e)=>{
			this.checkword(e.target, "투자자명이");
		});
		$(".fundup-pay").on("focusout", (e)=>{
			this.checkNum(e.target, "투자금액이");
		});
		$(".fundup-done").on("click", (e)=>{
			let ep = e.target.parentNode.parentNode;
			let email = ep.querySelector(".fundup-email");
			let pay = ep.querySelector(".fundup-pay");
			let canvas = ep.querySelector("canvas");
			this.checkword(email, "투자자명이");
			this.checkNum(pay, "투자금액이");
			this.checkSign(canvas);
			let warning = ep.getElementsByClassName("warning");
			if(warning.length == 0){
				this.toast("해당펀드에 성공적으로 투자되었습니다."); 
				this.remove(ep.parentNode);
			}
		});
	}

	checkFile(x) {
		let type = x.files[0].type;
		type = type.split("/")[1];
		let size = x.files[0].size;
		size = size / (1024*1024);
		console.log(size);
		if(type != "jpg" && type != "jpeg" && type !="png"){
			this.toast("펀드이미지는 jpg, png파일만 업로드 할 수 있습니다.");
			x.classList.add("warning");
		}else if(size > 5){
			this.toast("펀드이미지는 5Mbyte 이하의 파일만 업로드 할 수 있습니다.");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	checkDes(x) {
		this.checkNull(x, "상세설명이");
		if($(x).hasClass("warning")==true){
			return;
		}
		if(x.value.length > 500) {
			this.toast("상세설명이 500자를 초과하였습니다. 500자 이내로 입력해주세요.");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	checkDate(x, v) {
		this.checkNull(x,v);
		if($(x).hasClass("warning") == true) {
			this.toast("날짜와 시간을 포함하여 정확히 입력하여 주세요.")
			return;
		}
		if(new Date(x.value) < new Date()){
			this.toast("입력하신 날짜가 현재보다 전입니다. 올바른 날짜를 선택해주세요.");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	checkSign(x) {
		if(this.drawed == false) {
			this.toast("서명란이 비워져있습니다.");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	checkNum(x, v) {
		let regex = /^[0-9]+$/;
		this.checkNull(x,v);
		if($(x).hasClass("warning") == true) {
			return;
		}
		if(x.value < 0 || x.value.match(regex) == null || x.value - parseInt(x.value) != 0){
			this.toast(v + "이 잘못된 값입니다. (0보다 큰 정수만 입력가능)")
			x.classList.add("warning");
		}else {
			x.classList.remove("warning"); 
		}
	}

	checkword(x, v) {
		let regex = /^[ㄱ-ㅎㅏ-ㅣ가-힣a-zA-Z ]+$/;
		this.checkNull(x, v);
		if($(x).hasClass("warning")==true){
			return; 
		}
		if(x.value.match(regex) == null) {
			this.toast(v + " 잘못된 값입니다. (한글,영문,띄어쓰기만 가능)")
			x.classList.add("warning");
		}else {
			x.classList.remove("warning")
		}
	}

	checkNull(x,v) {
		if(x.value == "" || x.value == "" || x.value === undefined){
			this.toast(v + " 비워져있습니다.");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	drawSign(canvas, x, y, s) {
		let ctx = canvas.getContext("2d");
		
		ctx.beginPath();
		ctx.strokeStyle = "#000";
		ctx.moveTo(this.prevX, this.prevY);
		ctx.lineTo(x,y);
		if(s == true) {
			ctx.lineWidth = 1;
		}else {
			ctx.lineWidth = 3;
		}
		ctx.stroke();
		ctx.closePath();
		this.drawed = true;
	}

	fundupTemp(x){
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
					<input type="text" value="홍길동"class="fundup-email"/>
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

	fundTemp(x) {
		let name = this.check(x.name, 40);
		let total = parseInt(x.total).toLocaleString();
		let current = parseInt(x.current).toLocaleString();
		let owner = "아무개";
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

	checkEmail(x){
		this.checkNull(x, "이메일이");
		if($(x).hasClass("warning") == true){
			return;
		}
		let regex = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[0-9a-zA-Z]+$/;
		if(x.value.match(regex) == null){
			this.toast("이메일 형식이 올바르지 않습니다.");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	checkPass(x){
		this.checkNull(x, "비밀번호가")
		if($(x).hasClass("warning") == true){
			return;
		}
		let regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*()])[a-zA-Z0-9!@#$%^&*()]+$/;
		if(x.value.match(regex) == null) {
			this.toast("비밀번호 형식이 잘못된 형식입니다. (영문,특문,숫자 모두 포함)");
			x.classList.add("warning");
		}else {
			x.classList.remove("warning");
		}
	}

	checkRepass(x, y){
		this.checkNull(x, "비밀번호 확인란이");
		if($(x).hasClass("warning") == true){
			return;
		}
		if(x.value != y.value){
			this.toast("비밀번호와 비밀번호 확인란의 값이 일치하지 않습니다.");
			x.classList.add("warning"); 
		}else {
			x.classList.remove("warning");
		}
	}
}