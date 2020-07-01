<!--HOTLINE TƯ VẤN DÀNH CHO NHÀ TUYỂN DỤNG-->
<?php if ($_GET['page'] != 'bao-gia') { ?>
<?php if ($_GET['page'] != 'dang-ky-nha-tuyen-dung') { ?>
<?php if ($_GET['page'] != 'viec-lam-da-dang') { ?>
<?php if ($_GET['page'] != 'ho-so-ung-tuyen') { ?>
<?php include DIR_CONTACT."MS_CONTACT_VIECLAM_0001.php";?>
<?php //include DIR_CONTACT."MS_CONTACT_VIECLAM_0005.php";?>
<?php include DIR_SEARCH."MS_SEARCH_VIECLAM_0001.php";?>

<?php include DIR_CHARACTERISTICS."MS_CHARACTERISTICS_VIECLAM_0001.php";?>
<?php } } } } ?>
<?php include DIR_NEWS . "MS_NEWS_VIECLAM_0004.php"; ?>
<?php include DIR_FOOTER."MS_FOOTER_VIECLAM_0001.php";?>
<?php 
    $thong_bao_gg = $action->getDetail('page', 'page_id', 48);
?>
<script>
	
	function notifyf () {
		var notify;
		// alert('noti');
		// alert(Notification.permission);
		if (!window.Notification)
        {
            // alert('Trình duyệt của bạn không hỗ trợ chức năng này.');
        }

        if (Notification.permission == 'default')
        {
            // alert('Bạn phải cho phép thông báo trên trình duyệt mới có thể hiển thị nó.');
            Notification.requestPermission(function (p) {
                // Nếu không cho phép
                if (p === 'denied')
                {
                    // alert('Bạn đã không cho phép thông báo trên trình duyệt.');
                }
                // Ngược lại cho phép
                else
                {
                    // alert('Bạn đã cho phép thông báo trên trình duyệt, hãy bắt đầu thử Hiển thị thông báo.');
                }
            });
        }
        // Ngược lại đã cho phép
        else
        {
        	// alert('ok');
            // Tạo thông báo
            notify = new Notification(
                '<?= $thong_bao_gg['page_name'] ?>', // Tiêu đề thông báo
                {
                    body: '<?= $thong_bao_gg['page_des'] ?>', // Nội dung thông báo
                    icon: 'https://vieclam12h.vn/images/vieclam/vieclam.jpg', // Hình ảnh
                    tag: 'https://vieclam12h.vn/' // Đường dẫn 
                }
            );
            // Thực hiện khi nhấp vào thông báo
            notify.onclick = function () {
            window.location.href = this.tag; // Di chuyển đến trang cho url = tag
            }
        }
	}

	notifyf();
	
</script>