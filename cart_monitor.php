<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 9/21/16
 * Time: 2:58 PM
 */
define("DB_USERNAME", 'root');
define("DB_PASSWORD", 'root');
define("DB_NAME", 'fblive');
define("DB_HOST", '127.0.0.1');

define("GOOD_CONDITION", "OK");
define("BAD_CONDITION", "NOT-OK");

/**
 * THRESHOLD DEFINES:
 * set a threshold for one or more hours of the day
 * the constant should be named "THRESHOLD_[hour 0-23]"
 * the value should be the number of hours since the last
 * configurable item was added to the cart that will indicate
 * a "BAD_CONDITION". Any Missing constants in the 0-23 range
 * will be carried based on the last given value. For example
 * if you set THRESHOLD_14 TO "2" but do not set THRESHOLD_15
 * or THRESHOLD_16, then THRESHOLD_15 and THRESHOLD_16 will
 * be set to "2" as well.
 */
define("THRESHOLD_0",  "4");
define("THRESHOLD_4",  "8");
define("THRESHOLD_10", "4");
define("THRESHOLD_14", "3");
define("THRESHOLD_17", "2");
define("THRESHOLD_19", "7");
define("THRESHOLD_21", "9");


try {
    $dbh = new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME), DB_USERNAME, DB_PASSWORD);
} catch (PDOException $e) {
    exit(BAD_CONDITION);
}

$threshold = get_threshold();

$sql = [];
$sql[] = "select count(distinct sfqi.product_id) as cart_items";
$sql[] = "from sales_flat_quote_item sfqi";
$sql[] = "inner join sales_flat_quote_item sfqi2 on sfqi2.item_id = sfqi.parent_item_id";
$sql[] = "  inner join catalog_product_super_link cpsl on cpsl.parent_id = sfqi2.product_id";
$sql[] = "where sfqi.product_type = 'simple'";
$sql[] = "  and TIMESTAMPDIFF(SECOND, sfqi.created_at, utc_timestamp()) < $threshold";
$count = $dbh->query(implode("\n", $sql));

foreach($count as $row) {
    if($row[0] > 0 ) {
        exit(GOOD_CONDITION);
    } else {
        exit(BAD_CONDITION);
    }
}

/**
 * This function will return the threshold in seconds
 * for how long it has been since the last configurable
 * item has been added to the cart before a "bad condition"
 * is thrown.
 *
 * @return string
 */
function get_threshold() {
    $lt = localtime(time(), true);
    $hrs = [];
    for($i = 0; $i < 24; $i++){
        if(defined(sprintf("THRESHOLD_%d", intval($i)))) {
            $hrs[$i] = constant(sprintf("THRESHOLD_%d", intval($i)));
        } else {
            $hrs[$i] = $i > 0 ? $hrs[$i - 1] : 1;
        }
    }
    return intval($hrs[$lt['tm_hour']]) * 60 * 60;
}