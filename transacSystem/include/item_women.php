<p class="item-title">Womens</p>
    <div class="items-column-container" id="womens">

<?php
    if ($womenshit_result->num_rows > 0) {
        while ($row = $womenshit_result->fetch_assoc()) {
            echo '<div class="item">';
            echo '<a href="' . $item_base_url . 'womens&id=' . $row["id"] . '">';
            echo '<img src="' . $womens_base_url . $row["item_image_filename"] . '" class="item-image">';
            echo '<div class="item-content">';
            echo '<p class="item-price">' . '₱' . $row["item_price"] . '</p>';
            echo '<strong><p class="item-name">' . $row["item_name"] . '</p></strong>';
            // echo '<p class="item-desc">' . $row["item_content"] . '</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo "0 results";
    }
?>

    </div>