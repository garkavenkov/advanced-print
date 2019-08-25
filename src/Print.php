<?php

namespace AdvancedPrint;

class AdvancedPrint
{
    /**
     * Terminal width
     *
     * @var int
     */
    private static $trm_width;

    /**
     * Color escape sequences
     * 
     * @var array
     */
    private static $color_esc = array(
        'NC'            => "\e[0m",       # Text Reset
        // Common colors
        'Black'         => "\e[0;30m",    # Black
        'Red'           => "\e[0;31m",    # Red
        'Green'         => "\e[0;32m",    # Green
        'Yellow'        => "\e[0;33m",    # Yellow
        'Blue'          => "\e[0;34m",    # Blue
        'Purple'        => "\e[0;35m",    # Purple
        'Cyan'          => "\e[0;36m",    # Cyan
        'White'         => "\e[0;37m",    # White / Light Gray

        // Bold colors
        'BBlack'        => "\e[1;30m",    # Bold Black
        'BRed'          => "\e[1;31m",    # Bold Red
        'BGreen'        => "\e[1;32m",    # Bold Green
        'BYellow'       => "\e[1;33m",    # Bold Yellow
        'BBlue'         => "\e[1;34m",    # Bold Blue
        'BPurple'       => "\e[1;35m",    # Bold Purple
        'BCyan'         => "\e[1;36m",    # Bold Cyan
        'BWhite'        => "\e[1;37m",    # Bold White
        
        // Dim colors
        'DBlack'        => "\e[2;30m",    # Dim Black
        'DRed'          => "\e[2;31m",    # Dim Red
        'DGreen'        => "\e[2;32m",    # Dim Green
        'DYellow'       => "\e[2;33m",    # Dim Yellow
        'DBlue'         => "\e[2;34m",    # Dim Blue
        'DPurple'       => "\e[2;35m",    # Dim Purple
        'DCyan'         => "\e[2;36m",    # Dim Cyan
        'DWhite'        => "\e[2;37m",    # Dim White

        'CRed'          => "\e[3;31m",    # Italic Red
        'TRed'          => "\e[9;31m",    # Through Red  

        // Underline
        'UBlack'        => "\e[4;30m",    # Underline Black
        'URed'          => "\e[4;31m",    # Underline Red
        'UGreen'        => "\e[4;32m",    # Underline Green
        'UYellow'       => "\e[4;33m",    # Underline Yellow
        'UBlue'         => "\e[4;34m",    # Underline Blue
        'UPurple'       => "\e[4;35m",    # Underline Purple
        'UCyan'         => "\e[4;36m",    # Underline Cyan
        'UWhite'        => "\e[4;37m",    # Underline White

        // Background
        'On_Black'      => "\e[40m",      # Background Black
        'On_Red'        => "\e[41m",      # Background Red
        'On_Green'      => "\e[42m",      # Background Green
        'On_Yellow'     => "\e[43m",      # Background Yellow
        'On_Blue'       => "\e[44m",      # Background Blue
        'On_Purple'     => "\e[45m",      # Background Purple
        'On_Cyan'       => "\e[46m",      # Background Cyan
        'On_White'      => "\e[47m",      # Background White / Light gray

        // High Intense
        'IBlack'        => "\e[0;90m",    # Black / Dark gray
        'IRed'          => "\e[0;91m",    # Red
        'IGreen'        => "\e[0;92m",    # Green
        'IYellow'       => "\e[0;93m",    # Yellow
        'IBlue'         => "\e[0;94m",    # Blue
        'IPurple'       => "\e[0;95m",    # Purple
        'ICyan'         => "\e[0;96m",    # Cyan
        'IWhite'        => "\e[0;97m",    # White

        // Bright High Intense
        'BIBlack'       => "\e[1;90m",    # Black
        'BIRed'         => "\e[1;91m",    # Red
        'BIGreen'       => "\e[1;92m",    # Green
        'BIYellow'      => "\e[1;93m",    # Yellow
        'BIBlue'        => "\e[1;94m",    # Blue
        'BIPurple'      => "\e[1;95m",    # Purple
        'BICyan'        => "\e[1;96m",    # Cyan
        'BIWhite'       => "\e[1;97m",    # White

        // High Intense Background
        'On_IBlack'     => "\e[0;100m",   # Black
        'On_IRed'       => "\e[0;101m",   # Red
        'On_IGreen'     => "\e[0;102m",   # Green
        'On_IYellow'    => "\e[0;103m",   # Yellow
        'On_IBlue'      => "\e[0;104m",   # Blue
        'On_IPurple'    => "\e[0;105m",   # Purple
        'On_ICyan'      => "\e[0;106m"    # Cyan
    );

    /**
     * Replace colore code for escape sequence
     *
     * @param string $msg
     * @return string
     */
    private static function parse_colors(string $msg): string
    {
        // Matches color code in the string
        preg_match_all("/\[([a-z_A-Z]+)\]/", $msg, $matches);
        
        $patterns = array_shift($matches);
        $colors   = array_shift($matches);
        
        foreach ($patterns as $key => $value) {
            $esc = self::$color_esc[$colors[$key]];
            $msg = str_replace($value, $esc, $msg);
        }
        
        return $msg;
    }

    /**
     * Convert percent into string
     *
     * @param integer $percent
     * @return string
     */
    private static function makePercentage(int $percent): string
    {
        switch (strlen($percent)) {
            case 1:
                $percent = "  " . $percent;
                break;
            case 2:
                $percent = " " . $percent;
                break;
            case 3:
                $percent = $percent;
                break;
        }

        return $percent;
    }

    /**
     * Print colored string without line-break
     *
     * @param string $msg
     * @return void
     */
    public static function print(string $msg)
    {
        echo self::parse_colors($msg) . self::$color_esc['NC'];
    }

    /**
     * Print colored string with line-break
     *
     * @param string $msg
     * @return void
     */
    public static function printLn(string $msg)
    {
        echo self::print($msg) . self::$color_esc['NC'] . PHP_EOL;
    }

    /**
     * Print string with percent progress
     * @param  string $msg          String to output
     * @param  int    $total        Total number
     * @param  int    $item         Current item
     * @param  string $pn_color     Color for percent value. 
     * @param  string $ps_color     Color for percent symbol
     */
    public static function printPercentage(string $msg, int $total, int $item, string $pn_color = null, string $ps_color = null)
    {
        $percent = round(($item/$total)*100);
        
        $percentage = self::makePercentage($percent, $pn_color, $ps_color);
        
        $percentage  = $pn_color ? ( $pn_color . $percentage) : $percentage;
        $percentage  = $ps_color ? ( $ps_color . '%') : '%';
        
        $msg = self::parse_colors($msg) . self::parse_colors($percentage);
        
        // "\033[?25l"  -   Hide the cursor. 
        // "\033[?25h"  -   Show the cursor.
        // "\033[0K\r"  -   Delete everything from the cursor to the end of the line.     
        
        if ($percent < 100) {
            echo "\033[0K\r". $msg . "\033[?25l";
        } else {
            echo "\033[0K\r". $msg . "\033[?25h" .PHP_EOL;
        }
    }    

     /**
     * Print ProgressBar 
     * @param  string $msg    String to output
     * @param  int    $total  Total value
     * @param  int    $item   Current value
     * @param  string $fill   Symbol for fill progress bar
     * @param  int    $length Progress bar length
     */
    public static function printProgressBar(string $msg, int $total, int $item, string $fill, string $pn_color = null, string $ps_color = null, int $length=null)
    {
        if (!self::$trm_width) {
            self::$trm_width = exec('tput cols');
        }

        // Message length
        $msg_length = strlen(preg_replace("/\[([a-z_A-Z]+)\]/", "", $msg));        

        // Calculate percent
        $percent = round(($item/$total)*100);
 
        $percentage = self::makePercentage($percent);
        
        // Percent length
        $percentage_length = strlen($percentage)+1;     
        
       
        $percentage  =  ( $pn_color ? ( $pn_color . $percentage) : $percentage ) . 
                        ( $ps_color ? ( $ps_color . '%') : '%' );
      
        // Progress Bar length
        $progress_bar_length = self::$trm_width - $msg_length - $percentage_length - 2;

        // Progress Bar Step
        $progress_step = $progress_bar_length/100;

        $msg = self::parse_colors($msg);

        // Fill Progres Bar
        if ($percent < 100) {
            $fill_str = round($percent*$progress_step);
            echo    "\033[0K\r".
                    "\033[?25l".
                    $msg . 
                    '[' .
                    str_repeat("\e[1;32m".$fill."\e[0m", $fill_str) .
                    str_repeat(' ', $progress_bar_length - $fill_str) .
                    ']' .
                    self::parse_colors($percentage);
        } else {
            echo    "\033[0K\r".
                    $msg . 
                    '[' .
                    str_repeat("\e[1;32m".$fill."\e[0m", $progress_bar_length) . 
                    ']'.
                    self::parse_colors($percentage) .  
                    PHP_EOL . 
                    "\033[?25h";
        }
    }
}