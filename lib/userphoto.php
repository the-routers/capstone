<?php

namespace Rhariyani\capstone;
require_once("../php/Classes/userPhoto.php");


$Rishita = new userPhoto("b6a001d5-e264-4ae0-8b01-38f545cc93ab",
	"887da938-c6e2-4ef6-b884-fb23427cded9", "c52f079c-c9e1-452d-97df-8602504f9f0c ",
	"test sign", 1, "\"https://www.gravatar.com/avatar/HASH\"");
var_dump($Rishita);


?>
