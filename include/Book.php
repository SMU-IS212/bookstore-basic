<?php

class Book {
    // property declaration
    // public $title;
    // public $isbn13;    
    // public $price;
    // public $availability;
    public function __construct(){
        $argv = func_get_args();

        switch (func_num_args()){
            case 3:
                self::__construct0($argv[0],$argv[1],$argv[2]);
                break;
            case 4:
                self::__construct1($argv[0],$argv[1],$argv[2],$argv[3]);
                break;
            case 5:
                self::__construct2($argv[0],$argv[1],$argv[2],$argv[3],$argv[4]);
        }
    }

     public function __construct0($title='', $isbn13='', $price='') {
        $this->title = $title;
        $this->isbn13 = $isbn13;
        $this->price = $price;
    }

    public function __construct1($title='', $isbn13='', $price='', $availability='') {
        $this->title = $title;
        $this->isbn13 = $isbn13;
        $this->price = $price;
        $this->availability = $availability;
    }

    public function __construct2($title='', $isbn13='', $price='', $availability='', $storeid) {
        $this->title = $title;
        $this->isbn13 = $isbn13;
        $this->price = $price;
        $this->availability = $availability;
        $this->storeid = $storeid;
    }
}

?>