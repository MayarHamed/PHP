<?php
$current_index = isset($_GET["next"]) && is_numeric($_GET["next"]) ? (int) $_GET["next"] : 0;
$next_index = $current_index + __RECORDS_PER_PAGE__;
$previous_index = ($current_index - __RECORDS_PER_PAGE__ > 0) ? $current_index - __RECORDS_PER_PAGE__ : 0;
$items = $db->get_all_records(array(), 0);
?>

<table>
    <tr>
        <th>
            Item Id
        </th>
        <th>
            Name
        </th>
        <th>
            Details
        </th>
    </tr>
    <?php
    foreach ($items as $item) {
        echo "<tr><td>" . $item["id"] . "</td>";
        echo "<td>" . $item["product_name"] . "</td>";
        echo "<td> <a href ='" . $_SERVER["PHP_SELF"] . "?id=" . $item["id"] . "'> view the item </a> </td> </tr>";
    }
    ?>
</table>

<a href ="<?php echo $_SERVER["PHP_SELF"] . "?next=" . $next_index; ?>" >next >> </a>;
<a href ="<?php echo $_SERVER["PHP_SELF"] . "?next=" . $previous_index; ?>" > << previous </a>;
