<?php
/*
 Romulan word creator based on the original ROMULAN.PRT and the C port from Curtis Synder
 (C)1996 by Diane Duane
 Ported to PHP by Aizenmyou (orrhanen@rihannsu.org)
 Ported to console executable by Julian Mc-Menor (julianmc-menor@outlook.com)
 
 NOTES:
  1. A seed is not used for rand() as PHP does this internally in versions 4.2.0+
*/

//Begin main code
$r = array("H'","Ae","D'","W","U","N'","R'","O","V","Ll");
$v = array("ae", "A", "i'", "a", " Eh", "e", "T'", "I", "u'", "s", " ", "ae", "ea", "ei", "e", "a", "iu", "o", "ie", "i",
"eo", "i ", "ae", "ie", "ai", " ", "au", "a", "ei", "ah", "ao", "a ", "aeu", "u", " ", "ae", "oa", "i", " ", "s",
"i", ", ", "ea", "ia", " E", "ei", "ta'", "ra-", "ei", " ", " ", "'h", "ae", "oi", "iy", "u", "ei", "eh", "s'h", "i",
"e'", "ia", " ", "ie", "iy", "ih", "ae", "io", "ai", "ui", "ae", "y", " ", "ei", "ie", "a'e", "u", "iu", "ou", "aa",
"a", "i", "ih", "i'h", "e ", "ea", "aa", "ae", "u", "aeih", "ae", "ei", " -- ", "iu", "oa", "ei", "o", "oi", "ue", " ",
"'ss", "l'", "k'h", "hw", "rr", "r", "rr'", "mm", "t'd", "'hh", "qh", "vh", "fv", "nh", "d", "e", "hh", "k", "a", "t",
"dl", "dl", "rh", "nnh", "rai", "th", "dh-", "yrh", "aith", "qh", "m", "t", "r", "q", "s", "f", "v", "h", "z", "y");

$c = array("s", "ll", "R", "m", "k", "t", "h", "r", "rr", "...", " ", "v", "mn", "kh", "d", "hv", "fv", " ", "r", "t",
"-", "th", "k", "lh", "d", "bh", " ", "d'", "dr", "ht", " ", "ll", "lh", "dt'", "ht", "th", "kh", "l'", "nn", "n",
" ", "'rh", "rh", "jh", "kj", "lh", "nv", "tr", "hw", "fv", "nn", "hw", "d", "nv", "! ", "mn", "dh", "rh", "ll'", "sw",
"lmn", "l", "mn", "-", "h'n", "t", "ss", "hv", "hs", "hr", "hj", " ", "hf", "wh", "rrh", "bh", "j", "y", " ", "; ",
"llu", "dh", "kh", "rh", " ", ", ", ", ", "; ", "wh", " ", "mn", "e", "ii", "a", "ee", "eu", "i", "o", "iu", "uu", " ",
"uy", "ae", "e", " i", "'i", "'u", "'u", "iae", "eu", "a", "ae", "hl", "iu", "-a", "ss", "-t", "r-", "nn", " 'nh", "ai",
"iu", "iu", "hu", "ha", "la", "se", "mo", "tha", "kha", "dha", "a", " i", "t", "e", "e", "ae", "ai", "ia", "ia", "ou");

$rand2 = 0;
$rand6 = 0;

function rfield()
{
  global $r;
  
  $ivalue = rand() % 10;
  echo $r[$ivalue];
}

function vowel($offset)
{
  global $v, $rand6;
  
  $ivalue = rand() % 10 + ($offset * 10);
  echo $v[$ivalue];
  
  if($offset == 5)
  {
    $rand6 = $ivalue;
  }
}

function adjustments()
{
  global $v;
  
  $ivalue = rand() % 10 + 130;
  echo $v[$ivalue];
}

function consonant($offset)
{
  global $c, $rand2;
  
  $ivalue = rand() % 10 + ($offset * 10);
  echo $c[$ivalue];
  
  if($offset == 1)
  {
    $rand2 = $offset;
  }
}

function next_word()
{
  $ivalue = rand() % 10;
  
  if($ivalue < 4)
  {
    echo " ";
  }
}

function line_adjustment()
{
  global $rand2;
  
  switch($rand2)
  {
    case 0:
    case 1:
    case 2:
    case 3:
    case 4:
      echo " ";
      break;
    case 5:
      echo "?";
      break;
    case 6:
      echo "....";
      break;
    case 7:
      echo ", ";
      break;
    case 8:
      echo " ";
      break;
  }
}

function gen_text()
{
  global $rand6;
  
  $t = 0;
  $g = 0;
  $i = 0;
 
  for($t = 1; $t < 20; $t++)
  {
   if($g != 1)
   {
     $g = 1;
     rfield();
   }
   
   for($i = 0; $i < 11; $i++)
   {
     vowel($i);
     
     if($i == 2)
     {
       next_word();
     }
     
     consonant($i);
     
     if(($i == 7) && ($rand6 >= 6))
     {
       echo " ";
     }
   }
   
   adjustments();
   line_adjustment();
   
   echo "
  ";
  }
 
  echo "
  ";
 
}

function main()
{
  global $bgcolor, $font_color, $font_face, $font_size;
  
  echo "
   __           ______             ______           __
   \ '----._____.-'   '-----------'   '-._____.----' /
    '._/  /        \_       \/      _/        \  \_.'
        \_  |  |  \  '._ \     / _.'  /  |  |  _/
          \/_  |  | /   '.\   /.'   \ |  |  _\/
             \/__/_/ /ww\ (' ') /ww\ \_\__\/
                .--' \__/  \ /  \__/ '--.
                 \/  /'|    |    |'\  \/
                   \/_/  |  |  |  \_\/ 
                       \/_/ | \_\/ 
                          '-|-'  
  RIHANNSU               \     /
  WORDS                   \   /
  CREATOR                  \ /

  based on the original ROMULAN.PRT and the C port from Curtis Synder

  (C)1996 by Diane Duane
  
  Ported to PHP by Aizenmyou (orrhanen@rihannsu.org)
  Ported to console executable by Julian Mc-Menor (julianmc-menor@outlook.com)
  
  Begin creation

  ";
  
  //na rhA¦
  gen_text();
  
  echo "End creation

  To create a new language block, please restart the program";
}
main();
fgetc(STDIN)




?>