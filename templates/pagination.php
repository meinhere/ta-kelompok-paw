<?php function pagination($total_page, $active_page, $href = "?page=") { ?>
<div class="pagination">
    <ul>
        <li>
            <a class="primary-btn" href="<?= ($active_page > 1) ? $href . $active_page - 1 : $href . $active_page ?>">Prev</a>
        </li>
        <?php for ($i = 1; $i <= $total_page; $i++) : ?>
            <?php if ($i == $active_page) : ?>
                <li>    
                    <a class="primary-btn active"><?= $i ?></a>
                </li>
            <?php else : ?>
                <li>
                    <a class="primary-btn" href="<?= $href . $i ?>"><?= $i; ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <li>
            <a class="primary-btn" href="<?= ($active_page < $total_page) ? $href . $active_page + 1 : $href . $active_page ?>">Next</a>
        </li>
    </ul>
</div>
<?php } ?>