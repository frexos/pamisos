<?php
$reviews = get_field("reviews");
$num_of_reviews = count($reviews);
$summ = 0;
if($reviews):
    array_push($reviews,array("review_title"=>__("Overall rating","um_lang"),"rating"=>0));

    $reviews = group_array($reviews,2);
    ?>
    <div class="mag-review">
        <table>
            <?php foreach($reviews as $r): ?>
                <tr>
                    <?php foreach($r as $review): ?>
                        <td class="cell"><?php echo $review["review_title"].__(":","um_lang"); ?></td>
                        <td class="cell-value"><?php echo $review["rating"].__("%","um_lang"); ?></td>
                    <?php
                        $summ += floatval($review["rating"]);
                        endforeach;
                    ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="hidden" id="overall_rating" value="<?php echo number_format(($summ / $num_of_reviews), 2, '.', '').__("%","um_lang"); ?>"/>
    </div>
<?php endif; ?>