<?php

class Img{

	static function creerMin($img,$chemin,$nom,$mlargeur=100,$mhauteur=100) {

		$ext = substr($nom, strpos($nom,'.'), strlen($nom)-1);
		
		$nom = substr($nom,0,-4);

		$dimension=getimagesize($img);
		

		if(substr(strtolower($img),-4)==".jpg") { $image = imagecreatefromjpeg($img); }

		elseif(substr(strtolower($img),-4)==".JPG") { $image = imagecreatefromjpeg($img); }

		elseif(substr(strtolower($img),-5)==".jpeg") { $image = imagecreatefromjpeg($img); }

		elseif(substr(strtolower($img),-5)==".JPEG") { $image = imagecreatefromjpeg($img); }

		elseif(substr(strtolower($img),-4)==".png") { $image = imagecreatefrompng($img); }

		elseif(substr(strtolower($img),-4)==".PNG") { $image = imagecreatefrompng($img); }

		elseif(substr(strtolower($img),-4)==".gif") { $image = imagecreatefromgif($img); }

		elseif(substr(strtolower($img),-4)==".GIF") { $image = imagecreatefromgif($img); }

		else {return false; }


		$miniature =imagecreatetruecolor ($mlargeur,$mhauteur);

		imagealphablending($miniature, true);

		imagesavealpha($miniature, true);

		$a = imagecolorallocatealpha($miniature, 225, 225, 225, 100);

		imagefill($miniature, 0, 0, $a);


		if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ) {

			$dimY=$mhauteur;

			$dimX=$mhauteur*$dimension[0]/$dimension[1];

			$decalX=-($dimX-$mlargeur)/2;

			$decalY=0;
		}

		if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]) {

			$dimX=$mlargeur;

			$dimY=$mlargeur*$dimension[1]/$dimension[0];

			$decalY=-($dimY-$mhauteur)/2;

			$decalX=0;

		}

		if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]) {

			$dimX=$mlargeur;

			$dimY=$mhauteur;

			$decalX=0;

			$decalY=0;

		}

		
		imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);

		
		if($ext == ".jpg" || $ext == ".JPG" || $ext == ".jpeg" || $ext == ".JPEG") {

			imagejpeg($miniature,$chemin."/".$nom.$ext,90);

			return true;

		}

		elseif($ext == ".png" || $ext == ".PNG") {

			imagepng($miniature,$chemin."/".$nom.$ext);

			return true;

		}

		elseif($ext == ".gif" || $ext == ".GIF") {

			imagegif($miniature,$chemin."/".$nom.$ext,90);

			return true;

		}
		
	}
	
}

?>
