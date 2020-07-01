<?php 
	$news_home = $action->getList('news', '', '', 'news_id', 'desc', '', '3', '');
?>
<div class="container hidden-xs" style="margin-bottom: 20px;padding: 0 5%;">
	<h2 style="text-align: center;font-size: 34px;margin-bottom: 18px;"><a href="/tin-tuc" style="color: #000;">Thông tin tuyển dụng</a></h2>
	<div class="row">
		<?php foreach ($news_home as $item) { ?>
		<div class="col-md-4">
			<div style="border: 2px solid #ccc;">
				<a href="/<?= $item['friendly_url'] ?>" title="">
					<div style="height: 175px">
						<img src="/images/<?= $item['news_img'] ?>" alt="" style="width: 100%;height: 100%;">						
					</div>
					<div style="background: #fff;">
						<p style="padding: 10px 13px 5px 13px;text-align: left;font-size: 15px;font-weight: 600;margin-bottom: 0px;color:#000;">
						<?= $item['news_name'] ?>
						</p>
						<p style="max-height: 48px;overflow: hidden;padding: 0px 13px 10px 13px;text-align: left;display: block;color:#000;">
							<?= substr($item['news_des'], 0, 70) ?>...
						</p>
					</div>
					
				</a>
			</div>
		</div>
		<?php } ?>
	</div>
</div>