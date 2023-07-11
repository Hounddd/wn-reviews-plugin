<?php if ($this->previewMode): ?>

    <?php if ($value > 0): ?>
        <span class="form-control">
        <?php
            for ($i = 1; $i <= $maxStars; $i++) {
                echo $i <= $value ? '&starf;':'&star;';
            }
        ?>
        </span>
    <?php endif ?>

<?php else: ?>

    <fieldset class="rating" data-input-id="<?= $this->getId('input') ?>"
        <?php if ($color) {
            echo 'style="--star-color:'. $color .';"';
        }  ?>
    >
        <?php
            for ($i = $maxStars; $i >= 1; $i--) {
                $id = $name .'-'. $i;
                $checked = $i != $value ?: ' checked';
                echo '<input type="radio" name="'. $name .'" value="'. $i .'" id="'. $id .'"'. $checked .'><label for="'. $id .'" title="'. $i .'">☆</label>';
            }
        ?>

        <?php if ($allowReset): ?>
            <input type="button" value="&#10226;" onclick="javascript: var ele=document.getElementsByName('<?= $name ?>');for(var i=0;i<ele.length;i++) ele[i].checked = false; " title="clear">
        <?php endif ?>
    </fieldset>

<?php endif ?>
