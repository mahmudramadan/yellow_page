<?php
class AdsBody
{
    private $adsId;
    private $adsImage;
    private $adsDescription;

    public function __construct($adsId , $Image, $Description)
    {
        $this->adsId = $adsId;
        $this->adsImage = $Image;
        $this->adsDescription = $Description;
    }

    public function getImageAndDescription()
    {
        echo '
                    <a href="ads.php?id='.$this->adsId.'">
                    <img src="uploads/'.$this->adsImage.'" class="img img-responsive" style="max-height:500px;    margin: auto;">
                    <b>'.$this->adsDescription.'</b>
                    </a>
                 '; 
    }
}

class AdsBodyFactory
{
    public static function create($Id ,$Image, $Description)
    {
        return new AdsBody($Id , $Image, $Description);
    }
}


