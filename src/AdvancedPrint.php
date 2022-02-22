<?php

namespace AdvancedPrint;

class AdvancedPrint
{
    const HIDE_CURSOR       = "\033[?25l";  // Hide the cursor.     
    const SHOW_CURSOR       = "\033[?25h";  // Show the cursor.    
    const CLEAR_TILL_END    = "\033[0K\r";  // Delete everything from the cursor to the end of the line.
    
    /**
     * Color escape sequences
     * 
     * @var array
     */
    private static $color_esc = array(
        'Reset'         => "\e[0m",       # Text Reset
        
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
        'B_Black'       => "\e[1;30m",    # Bold Black
        'B_Red'         => "\e[1;31m",    # Bold Red
        'B_Green'       => "\e[1;32m",    # Bold Green
        'B_Yellow'      => "\e[1;33m",    # Bold Yellow
        'B_Blue'        => "\e[1;34m",    # Bold Blue
        'B_Purple'      => "\e[1;35m",    # Bold Purple
        'B_Cyan'        => "\e[1;36m",    # Bold Cyan
        'B_White'       => "\e[1;37m",    # Bold White
        
        // Dim colors
        'D_Black'       => "\e[2;30m",    # Dim Black
        'D_Red'         => "\e[2;31m",    # Dim Red
        'D_Green'       => "\e[2;32m",    # Dim Green
        'D_Yellow'      => "\e[2;33m",    # Dim Yellow
        'D_Blue'        => "\e[2;34m",    # Dim Blue
        'D_Purple'      => "\e[2;35m",    # Dim Purple
        'D_Cyan'        => "\e[2;36m",    # Dim Cyan
        'D_White'       => "\e[2;37m",    # Dim White

        // Italic
        'It_Black'      => "\e[3;30m",    # Italic Black
        'It_Red'        => "\e[3;31m",    # Italic Red
        'It_Green'      => "\e[3;32m",    # Italic Green
        'It_Yellow'     => "\e[3;33m",    # Italic Yellow
        'It_Blue'       => "\e[3;34m",    # Italic Blue
        'It_Purple'     => "\e[3;35m",    # Italic Purple
        'It_Cyan'       => "\e[3;36m",    # Italic Cyan
        'It_White'      => "\e[3;37m",    # Italic White
        

        // Underline
        'U_Black'       => "\e[4;30m",    # Underline Black
        'U_Red'         => "\e[4;31m",    # Underline Red
        'U_Green'       => "\e[4;32m",    # Underline Green
        'U_Yellow'      => "\e[4;33m",    # Underline Yellow
        'U_Blue'        => "\e[4;34m",    # Underline Blue
        'U_Purple'      => "\e[4;35m",    # Underline Purple
        'U_Cyan'        => "\e[4;36m",    # Underline Cyan
        'U_White'       => "\e[4;37m",    # Underline White

        // Flashing
        'F_Black'       => "\e[5;30m",    # Flashing Black
        'F_Red'         => "\e[5;31m",    # Flashing Red
        'F_Green'       => "\e[5;32m",    # Flashing Green
        'F_Yellow'      => "\e[5;33m",    # Flashing Yellow
        'F_Blue'        => "\e[5;34m",    # Flashing Blue
        'F_Purple'      => "\e[5;35m",    # Flashing Purple
        'F_Cyan'        => "\e[5;36m",    # Flashing Cyan
        'F_White'       => "\e[5;37m",    # Flashing White

        // Fast Flashing
        'FF_Black'      => "\e[6;30m",    # Fast flashing Black
        'FF_Red'        => "\e[6;31m",    # Fast flashing Red
        'FF_Green'      => "\e[6;32m",    # Fast flashing Green
        'FF_Yellow'     => "\e[6;33m",    # Fast flashing Yellow
        'FF_Blue'       => "\e[6;34m",    # Fast flashing Blue
        'FF_Purple'     => "\e[6;35m",    # Fast flashing Purple
        'FF_Cyan'       => "\e[6;36m",    # Fast flashing Cyan
        'FF_White'      => "\e[6;37m",    # Fast flashing White

        // Inversion
        'Inv_Black'     => "\e[7;30m",    # Inversion Black
        'Inv_Red'       => "\e[7;31m",    # Inversion Red
        'Inv_Green'     => "\e[7;32m",    # Inversion Green
        'Inv_Yellow'    => "\e[7;33m",    # Inversion Yellow
        'Inv_Blue'      => "\e[7;34m",    # Inversion Blue
        'Inv_Purple'    => "\e[7;35m",    # Inversion Purple
        'Inv_Cyan'      => "\e[7;36m",    # Inversion Cyan
        'Inv_White'     => "\e[7;37m",    # Inversion White

        // Background
        'Bg_Black'      => "\e[40m",      # Background Black
        'Bg_Red'        => "\e[41m",      # Background Red
        'Bg_Green'      => "\e[42m",      # Background Green
        'Bg_Yellow'     => "\e[43m",      # Background Yellow
        'Bg_Blue'       => "\e[44m",      # Background Blue
        'Bg_Purple'     => "\e[45m",      # Background Purple
        'Bg_Cyan'       => "\e[46m",      # Background Cyan
        'Bg_White'      => "\e[47m",      # Background White / Light gray

        // High Intense
        'HI_Black'      => "\e[0;90m",    # Black / Dark gray
        'HI_Red'        => "\e[0;91m",    # Red
        'HI_Green'      => "\e[0;92m",    # Green
        'HI_Yellow'     => "\e[0;93m",    # Yellow
        'HI_Blue'       => "\e[0;94m",    # Blue
        'HI_Purple'     => "\e[0;95m",    # Purple
        'HI_Cyan'       => "\e[0;96m",    # Cyan
        'HI_White'      => "\e[0;97m",    # White

        // Bright High Intense
        'BHI_Black'     => "\e[1;90m",    # Black
        'BHI_Red'       => "\e[1;91m",    # Red
        'BHI_Green'     => "\e[1;92m",    # Green
        'BHI_Yellow'    => "\e[1;93m",    # Yellow
        'BHI_Blue'      => "\e[1;94m",    # Blue
        'BHI_Purple'    => "\e[1;95m",    # Purple
        'BHI_Cyan'      => "\e[1;96m",    # Cyan
        'BHI_White'     => "\e[1;97m",    # White

        // High Intense Background
        'HI_Bg_Black'   => "\e[0;100m",   # Black
        'HI_Bg_Red'     => "\e[0;101m",   # Red
        'HI_Bg_Green'   => "\e[0;102m",   # Green
        'HI_Bg_Yellow'  => "\e[0;103m",   # Yellow
        'HI_Bg_Blue'    => "\e[0;104m",   # Blue
        'HI_Bg_Purple'  => "\e[0;105m",   # Purple
        'HI_Bg_Cyan'    => "\e[0;106m",   # Cyan

        // Through
        'T_Black'       => "\e[9;30m",    # Through Black
        'T_Red'         => "\e[9;31m",    # Through Red
        'T_Green'       => "\e[9;32m",    # Through Green
        'T_Yellow'      => "\e[9;33m",    # Through Yellow
        'T_Blue'        => "\e[9;34m",    # Through Blue
        'T_Purple'      => "\e[9;35m",    # Through Purple
        'T_Cyan'        => "\e[9;36m",    # Through Cyan
        'T_White'       => "\e[9;37m",    # Through White
        
        // Double Underline
        'DU_Black'      => "\e[21;30m",   # Underline Black
        'DU_Red'        => "\e[21;31m",   # Underline Red
        'DU_Green'      => "\e[21;32m",   # Underline Green
        'DU_Yellow'     => "\e[21;33m",   # Underline Yellow
        'DU_Blue'       => "\e[21;34m",   # Underline Blue
        'DU_Purple'     => "\e[21;35m",   # Underline Purple
        'DU_Cyan'       => "\e[21;36m",   # Underline Cyan
        'DU_White'      => "\e[21;37m",   # Underline White
        
        // Overline
        'O_Black'       => "\e[53;30m",   # Overline Black
        'O_Red'         => "\e[53;31m",   # Overline Red
        'O_Green'       => "\e[53;32m",   # Overline Green
        'O_Yellow'      => "\e[53;33m",   # Overline Yellow
        'O_Blue'        => "\e[53;34m",   # Overline Blue
        'O_Purple'      => "\e[53;35m",   # Overline Purple
        'O_Cyan'        => "\e[53;36m",   # Overline Cyan
        'O_White'       => "\e[53;37m",   # Overline White
        
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
     * Cenvert percent into string
     *
     * @param string $percent   Percent string value
     * @param string $pn_color  Percent number color
     * @param string $ps_color  Percent symbol color
     * @param integer $indent   Indent between number and sing. By default there is no indent
     * @return string
     */
    private static function makePercentageStr(string $percent, string $pn_color, string $ps_color, int $indent = 0): string
    {       
        $result  =  ( $pn_color ? ( $pn_color . $percent) : $percent ) . 
                        ( $ps_color ? ( $ps_color . '%') : '%' );

        return $result;
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
        echo self::$color_esc['Reset'] . self::parse_colors($msg) . self::$color_esc['Reset'];        
    }

    /**
     * Print colored string with line-break
     *
     * @param string $msg
     * @return void
     */
    public static function printLn(string $msg)
    {
        echo self::print($msg) . self::$color_esc['Reset'] . PHP_EOL;
    }

    /**
     * Print formatted string filled with character.
     *
     * @param string $msg           String to print
     * @param integer $length       Formatted string length: Default - 0 (Terminal length)
     * @param integer $position     Text position in string: 0 - left, 1 - center, 2 - right. Defaul - 0
     * @param string $fill          Fill symbol
     * @param boolean $new_line     Print with line-break
     * @return void
     */
    public static function printf(string $msg, int $length=0, int $position=0, string $fill='', bool $new_line = false): void
    {
        $clean_msg = preg_replace("/\[([A-z_]+)\]/", '', $msg);

        $clean_msg_lenght = strlen($clean_msg);
        
        if ($length == 0) {
            $length = self::getTerminalColumnCount();
        }

        $msg = self::parse_colors($msg);        

        if($length >= $clean_msg_lenght) {            

            $free_space = $length - $clean_msg_lenght;

            switch ($position) {
                case 0:                    
                    $msg = $msg . str_repeat($fill, $free_space);
                    break;
                case 1:                                        
                    $left = round($free_space / 2);
                    $right = $free_space - $left;                    
                    $filled_msg =  str_repeat($fill, $left) . $clean_msg . str_repeat($fill, $right);       
                    $msg = str_replace($clean_msg, $filled_msg, $msg );                    
                    break;
                case 2:
                    $filled_msg =  str_repeat($fill, $free_space) . $clean_msg; 
                    $msg = str_replace($clean_msg, $filled_msg, $msg);    
                default:                    
                    break;
            }
           
        } else {

            $trimmed_msg = substr($clean_msg, 0, $length);

            $msg = str_replace($clean_msg, $trimmed_msg, $msg);

        }

        echo self::print($msg) . self::$color_esc['Reset'] . ($new_line ? PHP_EOL : '');
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
        $percent = floor(($item/$total)*100);
               
        $percentage = self::makePercentageStr(percent: $percent, pn_color: $pn_color, ps_color: $ps_color);
                        
        $msg = self::parse_colors($msg) . self::parse_colors($percentage);
        
        if ($percent < 100) {
            echo self::CLEAR_TILL_END . $msg . self::HIDE_CURSOR;
        } else {
            echo self::CLEAR_TILL_END . $msg . self::SHOW_CURSOR . PHP_EOL;
        }
    }    

    /**
     * Geet terminal columns count
     *
     * @return integer
     */
    private static function getTerminalColumnCount(): int
    {
        return exec('tput cols');
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
        
        if (!$length) {
            $length = self::getTerminalColumnCount();
        } else if ($length < 20) {
            $length = 20;
        }
     
        // Message length
        $msg_length = strlen(preg_replace("/\[([a-z_A-Z]+)\]/", "", $msg));        

        // Calculate percent        
        $percent = floor(($item/$total)*100);

        $percent_str = self::makePercentage($percent);
        
        $percent_length = strlen($percent_str)+1;

        // Percent String
        $percentage = self::makePercentageStr(percent: $percent_str, pn_color: $pn_color, ps_color: $ps_color);
        
        // Progress Bar length
        $progress_bar_length = $length - $msg_length - $percent_length - 2;
        
        
        // Progress Bar Step
        $progress_step = $progress_bar_length/100;

        // Replace Color code with 
        $msg = self::parse_colors($msg);
                
        $filled_str_length = round($percent*$progress_step);        
        if ($percent < 100) {            
            echo    self::CLEAR_TILL_END .
                    self::HIDE_CURSOR .
                    $msg . 
                    '[' .
                    str_repeat("\e[1;32m".$fill."\e[0m", $filled_str_length) .
                    str_repeat(' ', $progress_bar_length - $filled_str_length) .
                    ']' .
                    self::parse_colors($percentage);            
        } else {                        
            echo    self::CLEAR_TILL_END .
                    $msg . 
                    '[' .
                    str_repeat("\e[1;32m".$fill."\e[0m", $progress_bar_length) . 
                    ']'.
                    self::parse_colors($percentage) .  
                    PHP_EOL . 
                    self::SHOW_CURSOR;
        }
    }
}