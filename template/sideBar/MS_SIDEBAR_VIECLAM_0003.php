<?php 
    $sidebar_news_new = $action_news->getListNewsNew_hasLimit(4);//var_dump($sidebar_news_new);
?>
<div class="gb-recenpost-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Bài viết mới nhất</h3>
        <div class="widget-content">
            <div class="gb-blog-left-recent-posts_ruouvang">
                <ul>
                    <?php 
                    foreach ($sidebar_news_new as $item) {
                        $rowLang = $action_news->getNewsLangDetail_byId($item['news_id'],$lang);
                    ?>
                    <li>
                        <div class="gb-item-recent-posts_ruouvang">
                            <div class="gb-item-recent-posts_ruouvang-img">
                                <a href="/<?= $rowLang['friendly_url'] ?>"><img src="/images/<?= $item['news_img'] ?>" alt="new"></a>
                            </div>
                            <div class="gb-item-recent-posts_ruouvang-text">
                                <h2><a href="/<?= $rowLang['friendly_url'] ?>"><?= $rowLang['lang_news_name'] ?></a></h2>
                                <div class="gb-item-recent-post-time_ruouvang">
                                    <span><i class="fa fa-calendar" aria-hidden="true"></i> <?= substr($item['news_created_date'], 0, 10) ?></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </aside>
</div>