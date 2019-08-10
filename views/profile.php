	<section id="profile">
			
		<div class="size">
			
			<div class="profile_title">
				<h2>내 정보</h2>
				<div class="line100"></div>
				<p>킥스타터가 여러분의 정보를 안전하게 보호해드립니다.</p>
			</div>

			<div class="profile_box">

				<div class="profile_box_title">
					<h3>회원정보</h3>
				</div>

				<div class="profile_notice">
					<div class="profile_left"><span>&bull; </span>이메일</div>
					<div class="profile_right"><?= $user->email ?></div>
				</div>
				<div class="profile_notice">
					<div class="profile_left"><span>&bull; </span>이름</div>
					<div class="profile_right"><?= $user->nickname ?></div>
				</div>
				<div class="profile_notice">
					<div class="profile_left"><span>&bull; </span>보유금액</div>
					<div class="profile_right"><?= number_format($user->money) ?>원</div>
				</div>
				
			</div>
			
			<div class="fundbox">
				<div class="profile_title">
					<h2>등록한 펀드</h2>
					<div class="line100"></div>
					<p>등록하신 펀드목록입니다.</p>
				</div>

				<?php foreach ($fund as $i) { ?>
					<div class="profile_box">

						<div class="profile_box_title">
							<h3><?= $i->number ?></h3>
							<span>모집율 : <?= $i->current / $i->total * 100 ?>%</span>
						</div>

						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>창업펀드명</div>
							<div class="profile_right"><?= $i->name ?></div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>모집마갑일</div>
							<div class="profile_right"><?= $i->endDate ?></div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>모집금액</div>
							<div class="profile_right"><?= number_format($i->total) ?>원</div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>현재금액</div>
							<div class="profile_right"><?= number_format($i->current) ?>원</div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>펀드등록자</div>
							<?php if($i->owner == null) : ?>
								<div class="profile_right">등록되지 않음</div>
							<?php else : ?>
								<div class="profile_right"><?= $i->owner ?></div>
							<?php endif; ?>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>상세설명</div>
							<?php if($i->sub == null) : ?>
								<div class="profile_right">등록되지 않음</div>
							<?php else : ?>
								<div class="profile_right"><?= $i->sub ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
				
			</div>
			
			<div class="investbox">
				<div class="profile_title">
					<h2>투자한 펀드</h2>
					<div class="line100"></div>
					<p>투자한 펀드목록입니다.</p>
				</div>
				
				<?php foreach ($invest as $i) { ?>
					<div class="profile_box">

						<div class="profile_box_title">
							<h3><?= $i->number ?></h3>
							<span>모집율 : <?= $i->current / $i->total * 100 ?>%</span>
						</div>

						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>창업펀드명</div>
							<div class="profile_right"><?= $i->name ?></div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>모집마갑일</div>
							<div class="profile_right"><?= $i->endDate ?></div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>모집금액</div>
							<div class="profile_right"><?= number_format($i->total) ?>원</div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>현재금액</div>
							<div class="profile_right"><?= number_format($i->current) ?>원</div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>펀드등록자</div>
							<?php if($i->owner == null) : ?>
								<div class="profile_right">등록되지 않음</div>
							<?php else : ?>
								<div class="profile_right"><?= $i->owner ?></div>
							<?php endif; ?>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>상세설명</div>
							<?php if($i->sub == null) : ?>
								<div class="profile_right">등록되지 않음</div>
							<?php else : ?>
								<div class="profile_right"><?= $i->sub ?></div>
							<?php endif; ?>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>투자금액</div>
							<div class="profile_right"><?= number_format($i->pay) ?>원</div>
						</div>
					</div>
				<?php } ?>

			</div>

			<div class="businessbox">
				<div class="profile_title">
					<h2>진행 사업 정보</h2>
					<div class="line100"></div>
					<p>등록한 펀드 중 모집이 완료되어 진행중인 사업 목록입니다,</p>
				</div>

				<?php foreach ($business as $i) { ?>
					<div class="profile_box">

						<div class="profile_box_title">
							<h3><?= $i->number ?></h3>
							<span>모집율 : <?= $i->current / $i->total * 100 ?>%</span>
						</div>

						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>창업펀드명</div>
							<div class="profile_right"><?= $i->name ?></div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>모집마갑일</div>
							<div class="profile_right"><?= $i->endDate ?></div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>모집금액</div>
							<div class="profile_right"><?= number_format($i->total) ?>원</div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>현재금액</div>
							<div class="profile_right"><?= number_format($i->current) ?>원</div>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>펀드등록자</div>
							<?php if($i->owner == null) : ?>
								<div class="profile_right">등록되지 않음</div>
							<?php else : ?>
								<div class="profile_right"><?= $i->owner ?></div>
							<?php endif; ?>
						</div>
						<div class="profile_notice">
							<div class="profile_left"><span>&bull; </span>상세설명</div>
							<?php if($i->sub == null) : ?>
								<div class="profile_right">등록되지 않음</div>
							<?php else : ?>
								<div class="profile_right"><?= $i->sub ?></div>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
			</div>

		</div>

	</section>