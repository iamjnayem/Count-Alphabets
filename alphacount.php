#!/usr/bin/php
<?php 

class AlphaCounter{

    private string $input;
    private int $numberOfAlphabets;
    private int $argc;
    private array $argv;


    public function __construct($argc, $argv)
    {
        $this->argc = $argc;
        $this->argv = $argv;
        $this->numberOfAlphabets = 0;
    }

    public function startCounting(): int{
        $this->takeInput();
        $this->countAlphabet();
        return $this->numberOfAlphabets;
    }


    public function takeInput(): void{
        if($this->argc < 2) $this->usuageInstructions();

        $command_line_input = array_slice($this->argv, 1);
        
        $this->input = strtolower(join("", $command_line_input));
        
    }

    public function countAlphabet(){
        $counter = 0;
        foreach(str_split($this->input, 1) as $char){
           if($char >= 'a' && $char <= 'z') $counter += 1;
        }
       
        $this->numberOfAlphabets = $counter;
    }

    public function usuageInstructions(): void{
        echo "===== How To Run the Script =====\n";
        echo "php name_of_the_file 'input'\n";
        echo "example: php alphacount.php 'every soul will test the death!'\n\n";
        exit;
    }

    public function printError(Exception $e){
        echo "\nThe following problem has occurred\n";
        echo "====================================================\n";
        echo $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . "\n";
        echo "Line: ". $e->getLine() . "\n\n";
        $this->usuageInstructions();
    }
}


try{
    if(!is_link('./alphacount')){
        symlink("./alphacount.php", "./alphacount");
    }

    $alphaCounter  = new AlphaCounter($argc, $argv);
    echo "\nNumber of alphabets in the given sentence: " . $alphaCounter->startCounting() . "\n\n";
}catch(Exception $e){
    $alphaCounter->printError($e);
}
