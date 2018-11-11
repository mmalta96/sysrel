   			<?php

   			$testeB = "Fernando;21;Porto Alegre";

                   
   					$arrayInicial = explode(';', $testeB);

        			foreach ($arrayInicial as $value) {
        				echo $value . '<br/>';
        			}


   			?>