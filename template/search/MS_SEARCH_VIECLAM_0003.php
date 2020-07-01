<?php 
    $career = $action->getList('career', '', '', 'id', 'asc', '', '', '');
    $location = $action->getList('location', '', '', 'id', 'asc', '', '', '');
    $office = $action->getList('office', '', '', 'id', 'asc', '', '', '');
    $experience = $action->getList('experience', '', '', 'id', 'asc', '', '', '');
    $luong = $action->getList('luong', '', '', 'id', 'asc', '', '', '');
    $sex = $action->getList('sex', '', '', 'id', 'asc', '', '', '');
    $level = $action->getList('level_1', '', '', 'id', 'asc', '', '', '');
?>
<div class="gb-timkiem-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Tìm kiếm nâng cao</h3>
        <div class="widget-content">
            <form action="/index.php" method="get">
                <input type="hidden" name="page" value="tim-kiem-1">
                <input type="hidden" name="title" value="">
                <!-- <div class="form-group">
                    <select name="career" id="career" class="form-control" style="display: none;">
                        <?php foreach ($career as $item) { ?>
                        <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                        <?php } ?>
                    </select>
                </div> -->
                <div class="form-group">
                    <select name="location" id="location" class="form-control">
                        <?php foreach ($location as $item) { ?>
                        <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="experience" id="experience" class="form-control">
                        <?php foreach ($experience as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="office" id="office" class="form-control">
                        <?php foreach ($office as $item) { ?>
                        <option value="<?= $item['id'] ?>"> <?= $item['name'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="salary" id="form" class="form-control">
                        <?php foreach ($luong as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="sex" id="form" class="form-control">
                        <?php foreach ($sex as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="level" id="form" class="form-control">
                        <?php foreach ($level as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Tìm kiếm" class="form-control" >
                </div>
            </form>
        </div>
    </aside>
</div>