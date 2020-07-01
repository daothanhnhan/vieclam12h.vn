<?php

include_once "functions/library.php";
include_once "functions/pagination/Pagination.php";

class action_ungvien extends library{

	public function getList ($type, $loai_nganh) {
		global $conn_vn;
		$sql = "SELECT ung_vien.* FROM ung_vien INNER JOIN ho_so ON ung_vien.id = ho_so.ung_vien_id WHERE ung_vien.type = $type AND ho_so.loai_nganh = $loai_nganh ORDER BY ung_vien.time desc LIMIT 360";
		// echo $sql;
		$result = mysqli_query($conn_vn, $sql);
		$rows = array();
		$num = mysqli_num_rows($result);
		if ($num > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = $row;
			}
		}
		return $rows;
	}

	public function cung_nganh ($type, $item, $limit) {
		global $conn_vn;
		$sql = "SELECT ung_vien.* FROM ung_vien INNER JOIN ho_so ON ung_vien.id = ho_so.ung_vien_id WHERE ho_so.item LIKE '%\"$item\"%' AND ung_vien.type = $type ORDER BY ung_vien.time desc LIMIT $limit";
		// echo $sql;
		$result = mysqli_query($conn_vn, $sql);
		$rows = array();
		$num = mysqli_num_rows($result);
		if ($num > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$rows[] = $row;
			}
		}
		return $rows;
	}

}
