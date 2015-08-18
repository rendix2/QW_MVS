Hlavní stránka :P
<br>
<img src="<?php
use QW\FW\Trees\Binary\BinaryTree;

echo \QW\Libs\Config::URL ?>/ImageShow.php"/>
<br>


<?php

foreach ( $this->getTableData() as $row ) {
    echo $row[ 'user_name' ] . "<br>\n";
}


$root2 = new BinaryTree( new BinaryTree( new BinaryTree( NULL, NULL, 'D' ),
    new BinaryTree( new BinaryTree( NULL, NULL, 'H' ), new BinaryTree( NULL, NULL, 'I' ), 'E' ), 'B' ),
    new BinaryTree( new BinaryTree( NULL, NULL, 'F' ), new BinaryTree( NULL, NULL, 'G' ), 'C' ), 'A' );

print_r( $root2->iteratorPreOrderIterative()
               ->getFinalData() );
print_r( $root2->iteratorPreOrderRecourse()
               ->getFinalData() );
echo '<br>';
echo '<br>';

print_r( $root2->iteratorInOrderIterative()
               ->getFinalData() );
print_r( $root2->iteratorInOrderRecourse()
               ->getFinalData() );
echo '<br>';
echo '<br>';

print_r( $root2->iteratorPostOrderIterative()
               ->getFinalData() );
print_r( $root2->iteratorPostOrderRecourse()
               ->getFinalData() );
echo '<br>';
echo '<br>';

