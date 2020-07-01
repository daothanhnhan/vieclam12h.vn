<ul class="row">
                            <div class="col-sm-6">
                                <li class="col-sm-12"><strong style="color: #02a18b; font-size: 15px; text-transform: uppercase;">Trình độ học vấn:</strong></li>
                                <li class="col-sm-12"><i class="fa icon-graduation-hat" style="color: #000;"></i> <strong>Trường: </strong> <?= $ho_so['school'] ?></li>
                                <li class="col-sm-12"><i class="fa icon-graduation-hat" style="color: #000;"></i> <strong>Trình độ: </strong> <?= $level[$ho_so['level']] ?></li>
                                <?php if ($ung_vien['type'] == 0) { ?>
                                <li class="col-sm-12"><i class="fa icon-hammer-wrench" style="color: #000;"></i> <strong>Chuyên ngành:</strong> <?= $ho_so['career'] ?></li>
                                <li class="col-sm-12"><i class="fa icon-pen" style="color: #000;"></i> <strong>Khóa học:</strong> <?= $ho_so['year'] ?></li>
                                <li class="col-sm-12"><i class="fa icon-trophy2" style="color: #000;"></i> <strong>Xếp loại:</strong> <span style="color: #000;"><?= $ho_so['xep_loai'] ?></span></li>
                                <li class="col-sm-12"><i class="fa icon-earth" style="color: #000;"></i> <strong>Ngoại ngữ: </strong> <span style="color: #000;"><?= $action->getDetail('ngoai_ngu_1', 'id', $ho_so['ngoai_ngu_tin_hoc'])['name'] ?></span></li>
                                <?php } ?>
                                         

                                
                            </div>
                            <div class="col-sm-6">
                                <li class="col-sm-12"><strong style="color: #02a18b; font-size: 15px; text-transform: uppercase;">Hồ sơ cá nhân:</strong></li>
                                <li class="col-sm-12"><i class="fa icon-man-woman" style="color: #000;"></i> <strong>Giới tính:</strong> <?= $ung_vien['sex']==1 ? 'Nam' : 'Nữ' ?></li>
                                <li class="col-sm-12"><i class="glyphicon glyphicon-time"></i> <strong>Kinh nghiệm: </strong> <span style="color: red;font-weight: bold;"><?= $kinh_nghiem[$ho_so['experience']] ?></span></li>
                                <li class="col-sm-12"><i class="fa icon-users2" style="color: #000;"></i> <strong>Tình trạng hôn nhân:</strong> <?= $action->getDetail('hon_nhan', 'id',$ho_so['hon_nhan'])['name'] ?></li>
                                
                                <li class="col-sm-12"><i class="fa icon-store" style="color: #000;"></i> <strong>Loại hình công việc:</strong> <span style=""><?= $hinh_thuc[$ho_so['form']] ?></span></li>
                                <li class="col-sm-12"><i class="fa icon-cash-dollar" style="color: #000;"></i> <strong>Mức lương mong muốn:</strong> <?php include DIR_PRODUCT."MS_PRODUCT_VIECLAM_0002_1.php";?></li>
                                <li class="col-sm-12"><i class="fa icon-height" style="color: #000;"></i> <strong>Vị trí ứng tuyển:</strong> <span style="color: #000;"><?= $ho_so['position'] ?></span></li>
                                <!-- <li class="col-sm-12"><strong>Ngày tạo hồ sơ: </strong> <?= date('d/m/Y', strtotime($ho_so['created_at'])) ?></li> -->
                            </div>

                        </ul>