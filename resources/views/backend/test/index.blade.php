<?php
    $product_attribute_values = \App\Models\Product_attribute_value::getValueByProductId(17);
    foreach ($product_attribute_values as $index => $product_attribute_values) {
        $product_variants_json[] = $product_attribute_values->product_attribute_values;
    }
    foreach ($product_variants_json as $product_variant_json) {
        $product_variants[] = json_decode($product_variant_json);
    }

    echo '<table border="1" style="width: 100%;  text-align: center">';
        echo '<tr>';
        echo '<td>Màu sắc</td>';
        echo '<td>Kích cỡ</td>';
        echo '<td>Số lượng</td>';
        echo '<td>Giá</td>';
        echo '<td>Giá khuyến mãi</td>';
        echo '</tr>';
        foreach ($product_variants as $product_variant) {
            echo '<tr>';
                echo '<td>'.\App\Models\Attribute_value::getAttributeValueById($product_variant->attribute_value_id_1)->value.'</td>';
                echo '<td>'.\App\Models\Attribute_value::getAttributeValueById($product_variant->attribute_value_id_2)->value.'</td>';
                echo '<td>'.$product_variant->quantity.'</td>';
                echo '<td>'.$product_variant->price.'</td>';
                echo '<td>'.$product_variant->sale_price.'</td>';
            echo '<tr>';
        }
    echo '</table>';
?>
