Hlavní stránka :P
<br>
<img src="<?php

use QW\FW\DataStructures\Trees\Binary\BinaryTree;

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
echo '<br><br>';

print_r( $root2->iteratorInOrderIterative()
               ->getFinalData() );
print_r( $root2->iteratorInOrderRecourse()
               ->getFinalData() );
echo '<br><br>';

print_r( $root2->iteratorPostOrderIterative()
               ->getFinalData() );
print_r( $root2->iteratorPostOrderRecourse()
               ->getFinalData() );
echo '<br><br>';

$root2 = NULL;


$arrray = [ 5, 6, 7, 5, 1, 85678, 567890, 567890, 67898761, 6, 8, 15, -2 ];

print_r( $arrray );


$ms = new \QW\FW\DataWorking\Sort\MergeSort( $arrray );

echo '<br><br>UNSORTED:::<br><br>';
print_r( $ms->getOriginalArray() );
echo '<br><br>SORTED BY MERGE SORT:::<br><br>';
print_r( $ms->getSortedArray() );