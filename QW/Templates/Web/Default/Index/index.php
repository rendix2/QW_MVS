Hlavní stránka :P
<br>
<img src="<?php

    use QW\FW\DataStructures\Trees\Binary\BinaryTree;
    use QW\FW\DataStructures\Trees\Ternary\TernaryTree;
    use QW\FW\Utils\Math\Math;

    echo \QW\Libs\Config::URL ?>/ImageShow.php"/>
<br>

<?php

    foreach ( $this->getTableData () as $row ) {
        echo $row[ 'user_name' ] . "<br>\n";
    }

    $root2 = new BinaryTree( new BinaryTree( new BinaryTree( NULL, NULL, 'D' ), new BinaryTree( new BinaryTree( NULL, NULL, 'H' ), new BinaryTree( NULL, NULL, 'I' ), 'E' ), 'B' ), new BinaryTree( new BinaryTree( NULL, NULL, 'F' ), new BinaryTree( NULL, NULL, 'G' ), 'C' ), 'A' );

    print_r ( $root2->iteratorPreOrderIterative ()
                    ->getFinalData () );
    print_r ( $root2->iteratorPreOrderRecourse ()
                    ->getFinalData () );
    echo '<br><br>';

    print_r ( $root2->iteratorInOrderIterative ()
                    ->getFinalData () );
    print_r ( $root2->iteratorInOrderRecourse ()
                    ->getFinalData () );
    echo '<br><br>';

    print_r ( $root2->iteratorPostOrderIterative ()
                    ->getFinalData () );
    print_r ( $root2->iteratorPostOrderRecourse ()
                    ->getFinalData () );
    echo 'EULER:::';

    print_r ( $root2->iteratorEulerTour ()
                    ->getFinalData () );
    echo '<br><br>';

    $root2 = NULL;


    $arrray = [ 5, 6, 7, 5, 1, 85678, 567890, 567890, 67898761, 6, 8, 15, -2 ];

    print_r ( $arrray );


    $ms = new \QW\FW\DataWorking\Sort\MergeSort( $arrray );

    echo '<br><br>UNSORTED:::<br><br>';
    print_r ( $ms->getOriginalArray () );
    echo '<br><br>SORTED BY MERGE SORT:::<br><br>';
    print_r ( $ms->getSortedArray () );
    /*
	echo 'try Ackermann function:';
	echo Math::ackermann( 2, 5 );

	echo '<br>Finding Ackermnann inv:<br>';

	Math::ackermannInv( 125 )
		->printMatrix();
	*/
    echo '<br>';

    var_dump ( Math::randomBoolean () );


    $root = new TernaryTree( new BinaryTree( NULL, NULL, 1 ), new BinaryTree( NULL, NULL, 2 ),
            new BinaryTree( NULL, NULL, 3 ), 4, FALSE );
    echo 'Z------';
    print_r ( $root->iteratorEulerTour ()
                   ->getFinalData () );

    $root = NULL;

    $root3 = new TernaryTree( new TernaryTree( NULL, NULL, NULL, 2 ), new  TernaryTree( NULL, NULL, NULL, 3 ),
            new TernaryTree( new TernaryTree( NULL, NULL, NULL, 5 ), new TernaryTree( NULL, NULL, NULL, 6 ), NULL, 4 ), 1 );

    echo 'Euler TERNARY:<br>';
    print_r ( $root3->iteratorEulerTour ()
                    ->getFinalData () );

    $root3 = NULL;
    $root4 = new \QW\FW\DataStructures\Trees\Nary\NaryTree( [ new \QW\FW\DataStructures\Trees\Nary\NaryTree( [ ], 3 ),
            new \QW\FW\DataStructures\Trees\Nary\NaryTree( [ ], 3 ),
            new \QW\FW\DataStructures\Trees\Nary\NaryTree( [ new \QW\FW\DataStructures\Trees\Nary\NaryTree( [ ], 5 ), new \QW\FW\DataStructures\Trees\Nary\NaryTree( [ ], 6 ),
            ], 4 ),
    ], 1 );
    $root4 = NULL;


?>


